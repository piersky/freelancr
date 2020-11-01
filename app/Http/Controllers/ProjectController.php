<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = DB::table('projects')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->select('projects.*', 'customers.name AS customer_name')
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.projects.create', ['project' => $project, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project();

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->customer_id = $request->input('customer_id');
        $project->deadline_date = $request->input('deadline_date');
        $project->is_active = $request->input('is_active')=='on'?1:0;
        $project->created_by = Auth::user()->id;
        $project->updated_by = Auth::user()->id;

        $project->save();

        return redirect('admin/projects')->with('success', 'Project saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.projects.edit', ['project' => $project, 'customers' => $customers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->customer_id = $request->input('customer_id');
        $project->deadline_date = $request->input('deadline_date');
        $project->is_active = $request->input('is_active')=='on'?1:0;
        $project->updated_by = Auth::user()->id;

        $project->save();

        return redirect('admin/projects')->with('success', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
