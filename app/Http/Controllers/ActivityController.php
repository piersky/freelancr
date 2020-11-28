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
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->join('hour_stacks', 'activities.hourstack_id', '=', 'hour_stacks.id')
            ->join('users', 'users.id', '=', 'activities.assigned_to')
            ->select([
                'activities.id',
                'activities.name',
                'activities.start_at',
                'activities.stop_at',
                'activities.is_active',
                'activities.used_hours',
                'hour_stacks.name AS hour_stack_name',
                'users.name AS user_name',
                'customers.name AS customer_name'
            ])
            ->orderByDesc('activities.start_at')
            ->paginate(20);

        $sum = $activities->sum('used_hours');

        return view('admin.activities.index', ['activities' => $activities, 'sum' => $sum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activity = new Activity();

        $projects = DB::table('projects')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->select([
                'projects.*',
                'customers.name AS customer_name'
            ])
            ->where('projects.is_active', '=', 1)
            ->orderBy('customers.name')
            ->orderby('projects.name')
            ->get();

        $hour_stacks = DB::table('hour_stacks')
            ->join('customers', 'hour_stacks.customer_id', '=', 'customers.id')
            ->select([
                'hour_stacks.*',
                'customers.name AS customer_name'
            ])
            ->where('hour_stacks.is_active', '=', 1)
            ->orderby('customers.name')
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
        $activity->used_hours = $request->input('used_hours');
        $activity->hourstack_id = $request->input('hourstack_id');
        $activity->assigned_to = $request->input('assigned_to');
        $activity->is_active = $request->input('is_active')=='on'?1:0;
        $activity->created_by = Auth::user()->id;
        $activity->updated_by = Auth::user()->id;

        $activity->save();

        return redirect('admin/activities')->with('success', 'Activity saved');
    }

    public function storeAndNew(Request $request)
    {
        $activity = new Activity();

        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->project_id = $request->input('project_id');
        $activity->start_at = $request->input('start_at');
        $activity->stop_at = $request->input('stop_at');
        $activity->used_hours = $request->input('used_hours');
        $activity->hourstack_id = $request->input('hourstack_id');
        $activity->assigned_to = $request->input('assigned_to');
        $activity->is_active = $request->input('is_active')=='on'?1:0;
        $activity->created_by = Auth::user()->id;
        $activity->updated_by = Auth::user()->id;

        $activity->save();

        $activity = new Activity();

        $projects = DB::table('projects')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->select([
                'projects.*',
                'customers.name AS customer_name'
            ])
            ->where('projects.is_active', '=', 1)
            ->orderBy('customers.name')
            ->orderby('projects.name')
            ->get();

        $hour_stacks = DB::table('hour_stacks')
            ->join('customers', 'hour_stacks.customer_id', '=', 'customers.id')
            ->select([
                'hour_stacks.*',
                'customers.name AS customer_name'
            ])
            ->where('hour_stacks.is_active', '=', 1)
            ->orderby('customers.name')
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = DB::table('activities')
            ->join('projects', 'activities.project_id', '=', 'projects.id')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->join('hour_stacks', 'activities.hourstack_id', '=', 'hour_stacks.id')
            ->join('users', 'users.id', '=', 'activities.assigned_to')
            ->select([
                'activities.*',
                'projects.name AS project_name',
                'hour_stacks.name AS hour_stack_name',
                'users.name AS user_name',
                'customers.name AS customer_name'
            ])
            ->where('activities.id', '=', $id)
            ->get();

        return view('admin.activities.show', ['activity' => $activity[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);

        $projects = DB::table('projects')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->select([
                'projects.*',
                'customers.name AS customer_name'
            ])
            ->where('projects.is_active', '=', 1)
            ->orderBy('customers.name')
            ->orderby('projects.name')
            ->get();

        $hour_stacks = DB::table('hour_stacks')
            ->join('customers', 'hour_stacks.customer_id', '=', 'customers.id')
            ->select([
                'hour_stacks.*',
                'customers.name AS customer_name'
            ])
            ->where('hour_stacks.is_active', '=', 1)
            ->orderby('customers.name')
            ->get();

        $users = User::all();

        return view('admin.activities.edit',[
            'activity' => $activity,
            'projects' => $projects,
            'hour_stacks' => $hour_stacks,
            'users' => $users
            ]);
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
        $activity = Activity::find($id);

        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->project_id = $request->input('project_id');
        $activity->start_at = $request->input('start_at');
        $activity->stop_at = $request->input('stop_at');
        $activity->used_hours = $request->input('used_hours')!=""?$request->input('used_hours'):0;
        $activity->hourstack_id = $request->input('hourstack_id');
        $activity->assigned_to = $request->input('assigned_to');
        $activity->is_active = $request->input('is_active')=='on'?1:0;
        $activity->updated_by = Auth::user()->id;

        $activity->save();

        return redirect('admin/activities')->with('success', 'Activity updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $result = $activity->delete();

        if (request()->ajax()) return '' . $result;
        else return redirect()->back();
    }

    public function filter($hsid) {
        $activities = DB::table('activities')
            ->join('projects', 'activities.project_id', '=', 'projects.id')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->join('hour_stacks', 'activities.hourstack_id', '=', 'hour_stacks.id')
            ->join('users', 'users.id', '=', 'activities.assigned_to')
            ->select([
                'activities.id',
                'activities.name',
                'activities.start_at',
                'activities.stop_at',
                'activities.is_active',
                'activities.used_hours',
                'hour_stacks.name AS hour_stack_name',
                'users.name AS user_name',
                'customers.name AS customer_name'
            ])
            ->where('activities.hourstack_id', '=', $hsid)
            ->orderByDesc('activities.start_at')
            ->paginate(20);

        $sum = $activities->sum('used_hours');

        return view('admin.activities.index', ['activities' => $activities, 'sum' => $sum]);
    }
}
