<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Http\Requests\ApproveStatusRequest;
use App\Http\Requests\RejectBatchRequest;
use App\Project;
use App\User;
use App\Bpr;
use App\BprProduct;
use App\MprProduct;
use App\Product;
use App\Mpr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BprController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {

    }

//    public function issue()
//    {
//
//    }

//    public function store(Request $request)
//    {
//        $MprProducts = MprProduct::where('mpr_id', $request->mpr_id)->get();
//
//        $noInventoryName = array();
//        $noInventoryAmount = array();
//
//
//        foreach($MprProducts as $mprProduct) {
//            $product = Product::findOrFail($mprProduct->product_id);
//
//            if ($mprProduct->category_id == 1) {
//                $amount = $mprProduct->amount * 0.001 * $request->serving_size * ($request->bottle_count * 1.05);
//            } else {
//                $amount = $request->bottle_count * 1.05;
//            }
//
//            if($amount > $product->total){
//                $noInventoryName[] = $product->name;
//                $noInventoryAmount[] = $amount;
//            }
//
//        }
//            if(empty($noInventoryName)){
//               // Code to create BPR here
//            }else{
//
//                return view('bprs.error')->with('noInventoryName', $noInventoryName)->with('noInventoryAmount', $noInventoryAmount);
//            }
//
//    }



    public function store(Request $request)
    {
        $MprProducts = MprProduct::where('mpr_id', $request->mpr_id)->get();

//        dd($MprProducts);

        $run_count = $request->run_count + 1;
        $pn = $request->project_id;
        $dt = Carbon::now();
        $dt = substr($dt->toDateString(), 2, 2);
        $count = str_pad($run_count, 3, "0", STR_PAD_LEFT);
        $lot = $pn.$dt.$count;
        $user = User::findOrFail(auth()->user()->id)->first();



            $bpr = $user->bpr()->create([
                'mpr_id' => $request->mpr_id,
                'lot_number' => $lot,
                'bottle_count' => $request->bottle_count * 1.05,
                'created_by' => auth()->user()->id,
                'project_id' => $request->project_id,
            ]);

                $project = Project::findOrFail($request->project_id);

                $project->update([
                    'batch_count' => $count
                ]);

        foreach($MprProducts as $mprProduct) {


            if ($mprProduct->category_id == 1) {
                $amount = $mprProduct->amount * 0.001 * $request->serving_size * ($request->bottle_count * 1.05);
            } else {
                $amount = $request->bottle_count * 1.05;
            }
            $bpr->products()->attach($mprProduct->product_id, ['amount' => $amount, 'category_id' => $mprProduct->category_id]);
        }









        session()->flash('success', 'Batch created');

        return back();

    }

    public function show(Bpr $bpr)
    {


        return view('bprs.show')->with('bpr', $bpr);
    }


    public function approve(Bpr $bpr, ApproveStatusRequest $request)
    {
        $BprProducts = BprProduct::where('bpr_id', $bpr->id)->get();
//            dd($BprProducts);
//        dd(Arr::flatten($BprProducts));
//        $BprProducts = Arr::flatten($BprProducts);

        $noInventory = array();


        foreach($BprProducts as $bprProduct){
            $product = Product::findOrFail($bprProduct->product_id);
            $amount = $bprProduct->amount;
            $amountK = $bprProduct->amount / 1000;


            if($product->category_id == 1){
                if($amountK > $product->total){
                    $noInventory[] = $product->name .' ('.$amount. ' grams)';
                }
            }else{
                if ($amount > $product->total){
                    $noInventory[] = $product->name .' ('.$amount. ' each)';
                }
            }
        }

        if(empty($noInventory)){
            //Get user data
            $user_id = auth()->user()->id;
            $user = User::find($user_id);


            //Check user password
            if (Hash::check($request->password, $user->password)) {
                foreach($BprProducts as $bprProduct){
                    $product = Product::findorFail($bprProduct->product_id);
                    $amountO = $bprProduct->amount;
                    $amountK = $amountO/1000;
                    $total = $product->total;
                    if($bprProduct->category_id == 1){
                        $product->inventories()->create([
                            'input_unit' => 'g',
                            'input_amount' => $amountO,
                            'use_amount' => $amountK,
                            'vendor_id' => 0,
                            'vendor_lot' => 0,
                            'notes' => 'Batch issue',
                            'status' => 'open',
                            'expiration_date' => Carbon::now(),
                            'type' => 'temp-deduction',
                            'created_by' => $user_id
                        ]);
                        $total = $total - $amountK;
                        $product->update([
                            'total' => $total
                        ]);
                    }else{
                        $product->inventories()->create([
                            'input_unit' => 'ea',
                            'input_amount' => $amountO,
                            'use_amount' => $amountO,
                            'vendor_id' => 0,
                            'vendor_lot' => 0,
                            'notes' => 'Batch issue',
                            'status' => 'open',
                            'expiration_date' => Carbon::now(),
                            'type' => 'temp-deduction',
                            'created_by' => $user_id
                        ]);
                        $total = $total - $amountO;
                        $product->update([
                            'total' => $total
                        ]);
                    }



                }
                $bpr->update([
                    'status' => 'issued',
                    'created_by' => $user_id
                ]);

                $i = 1;
                foreach($BprProducts as $bprProduct){
                    $product = Product::findOrFail($bprProduct->product_id);

                    $amount = $bprProduct->amount;
                    if($bprProduct->category_id == 1){
                        $bpr->steps()->create([
                            'step_number' => $i,
                            'details' => 'Use ' .$amount.' grams of '.$product->name
                        ]);
                    }else{
                        $bpr->steps()->create([
                            'step_number' => $i,
                            'details' => 'Use ' .$amount.' ea of '.$product->name
                        ]);
                    }
                    $i++;

                }


                return view('bprs.issued');
            }
            else {

                //If fail (wrong password for example)
                session()->flash('fail', 'Approve Failed');
                return view('bprs.error');
            }
        }else{
            return view('bprs.error')->with('noInventory', $noInventory);
        }


    }

    public function reject(Bpr $bpr, RejectBatchRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $bpr->update([
                'status' => 'rejected',
                'approved_by' => $user->id,
                'reason' => $request->reason
            ]);

            session()->flash('success', 'Batch Rejected');

            return back();
        }
        else {
            session()->flash('fail', 'Rejection Failed');

            return back();
        }
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
