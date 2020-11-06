<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = DB::table('jobs')
            ->join('users', 'jobs.belongs_to_id', '=', 'users.id')
            ->leftJoin('customers', 'jobs.customer_id', '=', 'customers.id')
            ->select([
                'jobs.id',
                'jobs.is_done',
                'jobs.description',
                'jobs.deadline',
                'users.name AS user_name',
                'customers.name AS customer_name'
            ])
            ->orderBy('is_done')
            ->orderByDesc('jobs.deadline')
            ->get();

        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        /*if (Gate::denies('manage-jobs', $jobs)){
            abort(401, 'Unauthorized');
        }*/

        return view('admin.jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job = new Job();
        $users = User::all();
        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.jobs.create', ['job' => $job, 'users' => $users, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Job();

        $job->description = $request->input('description');
        $job->deadline = $request->input('deadline');
        $job->is_done = $request->input('is_done')=='on'?1:0;
        $job->belongs_to_id = $request->input('belongs_to_id')==""?Auth::user()->id:$request->input('belongs_to_id');
        $job->customer_id = $request->input('customer_id');
        $job->created_by = Auth::user()->id;
        $job->updated_by = Auth::user()->id;

        $job->save();

        return redirect('admin/jobs')->with('success', 'Job saved');
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
        $job = Job::find($id);
        $users = User::all();
        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.jobs.edit', ['job' => $job, 'users' => $users, 'customers' => $customers]);
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
        $job = Job::find($id);
        //$this->authorize('update', $job);

        $job->description = $request->input('description');
        $job->deadline = $request->input('deadline');
        $job->is_done = $request->input('is_done')=='on'?1:0;
        $job->belongs_to_id = $request->input('belongs_to_id')==""?Auth::user()->id:$request->input('belongs_to_id');
        $job->customer_id = $request->input('customer_id');
        $job->updated_by = Auth::user()->id;

        $job->save();

        return redirect('/admin/jobs')->with('message', 'Job updated');
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

    public function toggle($id)
    {
        $job = Job::find($id);
        $job->is_done = !$job->is_done;
        $job->save();

        return ['message' => 'Job changed'];
    }

    public function order($param)
    {

    }

    public function filter($param)
    {
        $jobs = DB::table('jobs')
            ->join('users', 'jobs.belongs_to_id', '=', 'users.id')
            ->leftJoin('customers', 'jobs.customer_id', '=', 'customers.id')
            ->select([
                'jobs.id',
                'jobs.is_done',
                'jobs.description',
                'jobs.deadline',
                'users.name AS user_name',
                'customers.name AS customer_name'
            ])
            ->where('customer_id', '=', $param)
            ->orderBy('is_done')
            ->orderByDesc('jobs.deadline')
            ->get();

        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
    }
}
