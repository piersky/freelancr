<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = DB::table('jobs')
            ->leftJoin('customers', 'jobs.customer_id', '=', 'customers.id')
            ->select([
                'jobs.id',
                'jobs.is_done',
                'jobs.description',
                'jobs.deadline',
                'customers.name AS customer_name'
            ])
            ->where('jobs.belongs_to_id', '=', Auth::user()->id)
            ->where('jobs.is_done', '=', false)
            ->orderByDesc('jobs.deadline')
            ->get();

        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        $activities = DB::table('activities', 'a')
            ->select('a.*')
            ->orderByDesc('a.start_at')
            ->limit(5)
            ->get();

        return view('admin.index', [
            'jobs' => $jobs,
            'customers' => $customers,
            'activities' => $activities
        ]);
    }

    public function graphData(){
        $result = DB::table('activities')
            ->selectRaw('YEAR(start_at) year, MONTH(start_at) month, DAY(start_at) day, SUM(used_hours) hours')
            ->whereRaw('start_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()')
            ->groupByRaw('YEAR(start_at), MONTH(start_at), DAY(start_at)')
            ->get();

        if (request()->ajax()) return '' . $result;
        else return redirect()->back();
    }
}
