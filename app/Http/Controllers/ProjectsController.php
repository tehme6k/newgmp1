<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\CreateProjectRequest;
use App\Mpr;
use App\Bpr;
use App\Project;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;

class ProjectsController extends Controller
{

    public function index()
    {
        return view('projects.index')
            ->with('countries', Country::all())
            ->with('types', Type::all())
            ->with('projects', Project::paginate(25));
    }

    public function create()
    {
        //
    }

    public function store(CreateProjectRequest $request)
    {
        try{
            Project::create([
                'name' => $request->name,
                'type_id' => $request->type_id,
                'created_by' => auth()->user()->id,
                'flavor' => $request->flavor,
                'country_id' => $request->country_id
            ]);
            session()->flash('success', 'Project created successfully');
            return back();
        }
        catch (QueryException $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                session()->flash('success', 'Type Already Exists');

                return view('errors.duplicate');
            }
        }


    }

    public function show(Project $project)
    {
        $mprs = Mpr::where('project_id', $project->id)->get();

        $bprs = Bpr::where('project_id', $project->id)->get();

        return view('projects.show')
            ->with('project', $project)
            ->with('mprs', $mprs)
            ->with('bprs', $bprs);
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
