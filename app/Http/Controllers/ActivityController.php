<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\HourStack;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = DB::table('activities')
            ->join('projects', 'activities.project_id', '=', 'projects.id')
            ->join('hour_stacks', 'activities.hourstack_id', '=', 'hour_stacks.id')
            ->join('users', 'users.id', '=', 'activities.assigned_to')
            ->select([
                'activities.id',
                'activities.name',
                'activities.start_at',
                'activities.stop_at',
                'activities.is_active',
                'hour_stacks.name AS hour_stack_name',
                'users.name AS user_name'
            ])
            ->orderByDesc('activities.created_at')
            ->paginate(20);

        return view('admin.activities.index', ['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activity = new Activity();
        $projects = Project::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();
        $hour_stacks = HourStack::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();
        $users = User::all();

        return view('admin.activities.create', [
            'activity' => $activity,
            'projects' => $projects,
            'hour_stacks' => $hour_stacks,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = new Activity();

        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->project_id = $request->input('project_id');
        $activity->start_at = $request->input('start_at');
        $activity->stop_at = $request->input('stop_at');
        $activity->hourstack_id = $request->input('hourstack_id');
        $activity->assigned_to = $request->input('assigned_to');
        $activity->is_active = $request->input('is_active')=='on'?1:0;
        $activity->created_by = Auth::user()->id;
        $activity->updated_by = Auth::user()->id;

        $activity->save();

        return redirect('admin/activities')->with('success', 'Activity saved');
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
        //
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
        //
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
