<?php

namespace App\Http\Controllers;
use App\Box;

use App\Http\Requests\ReopenRequest;
use App\ReopenedBoxes;
use App\Retention;
use Illuminate\Http\Request;

class ReopenController extends Controller
{
    public function open(Box $box, ReopenRequest $request){

        //updated box status to show it has been reopened
        $box->update([
            'status' => 'reopened'
        ]);


        //create entry in reopened table to store data about it being reopened

        ReopenedBoxes::create([
            'box_id' => $box->id,
            'reopen_date' => $request->reopen_date,
            'requested_by_id' => $request->requested_by_id,
            'opened_by_id' => auth()->user()->id,
            'reason' => $request->reason
        ]);

        session()->flash('succuss', 'This box has been reopened succuessfully.');

        return redirect(route('boxes.index'));
    }

    public function show(Box $box, $id)
    {
        $reopenData = ReopenedBoxes::findOrFail($id);
        $retentions = Retention::where('box_id', $box->id)->get();




        return view('boxes.reopens')
            ->with('box', $box)
            ->with('reopendata', $reopenData)
            ->with('retentions', $retentions);
    }

    public function close(Box $box, $id, Request $request)
    {
       $reopen = ReopenedBoxes::findOrFail($id);


        $box->update([
            'status' => 'closed'
        ]);

        $reopen->update([
            'close_date' => $request->close_date,
            'closed_by' => $request->closed_by
        ]);

        session()->flash('success', 'Box has been closed.');

        return redirect(route('boxes.index'));

        return 'Box closed';

    }
}
