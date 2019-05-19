<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRetentionBottleRequest;
use App\Retention;
use App\Box;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RetentionController extends Controller
{

    public function add(AddRetentionBottleRequest $request, $id)
    {
        $bottle = Retention::where('lot_number', $request->lot_number)->first();


        if($bottle != null){
            echo "<script>";
            echo "window.confirm('test')";
            echo "</script>";




        }

            $project_id = substr($request->lot_number, 0, 4);
            $project_id = $project_id-1000;

            $production_date = $request->production_date;

            $expiration_date = Carbon::create($production_date);

            $expiration_date->addYears($request->expiration_length);

            Retention::create([
                'lot_number' => $request->lot_number,
                'project_id' => $project_id,
                'production_date' => $production_date,
                'expiration_date' => $expiration_date,
                'expiration_length' => $request->expiration_length,
                'box_id' => $id,
                'user_id' => auth()->user()->id
            ]);

            session()->flash('success', 'Bottle added!');

            return back();




    }

    public function closed()
    {
        $all_boxes = Box::all();
        $closed_boxes_count = Box::where('status', 'closed')->get();
        $open_boxes_count = Box::where('status', 'open')->get();
        $reopen_boxes = Box::where('status', 'reopened')->get();

        $closed_boxes = Box::where('status', '=', 'closed')->orderBy('id', 'DESC')->paginate(10);
        return view('boxes.closed')
            ->with('all_boxes', $all_boxes)
            ->with('open_boxes_count', $open_boxes_count)
            ->with('reopen_boxes', $reopen_boxes )
            ->with('closed_boxes_count', $closed_boxes_count)
            ->with('boxes', $closed_boxes);
    }


}
