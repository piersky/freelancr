<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class DeadlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deadlines = DB::table('deadlines', 'd')
            ->join('customers AS c', 'd.customer_id', '=', 'c.id')
            ->join('deadline_categories AS dc', 'd.deadline_category_id', '=', 'dc.id')
            ->select([
                'd.*',
                'c.name AS customer_name',
                'dc.name AS category_name'
            ])
            ->where('dc.lang_id', '=', 'it')
            ->paginate();

        return view('admin.deadlines.index', [
            'deadlines' => $deadlines,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deadline = new Deadline();

        $categories = DB::table('deadline_categories')
            //TODO: use settings
            ->where('lang_id', '=', 'it')
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->where('is_active', '=', true)
            ->orderBy('name')
            ->get();

        return view('admin.deadlines.create', [
            'deadline' => $deadline,
            'categories' => $categories,
            'customers' => $customers
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
        $deadline = new Deadline();

        $deadline['name'] = $request->input('name');
        $deadline['deadline_category_id'] = $request->input('deadline_category_id');
        $deadline['description'] = $request->input('description');
        $deadline['deadline_at'] = $request->input('deadline_at');
        $deadline['customer_id'] = $request->input('customer_id');
        $deadline->created_by = Auth::user()->id;
        $deadline->updated_by = Auth::user()->id;

        $deadline->save();

        return redirect('/admin/deadlines')->with('success', 'Deadlines saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deadline = DB::table('deadlines', 'd')
            ->join('customers AS c', 'd.customer_id', '=', 'c.id')
            ->join('deadline_categories AS dc', 'd.deadline_category_id', '=', 'dc.id')
            ->select([
                'd.*',
                'c.name AS customer_name',
                'dc.name AS category_name'
            ])
            ->where('dc.lang_id', '=', 'it')
            ->where('d.id', '=', $id)
            ->first();

        return view('admin.deadlines.show', [
            'deadline' => $deadline
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deadline = Deadline::find($id);

        $categories = DB::table('deadline_categories')
            //TODO: use settings
            ->where('lang_id', '=', 'it')
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->where('is_active', '=', true)
            ->orderBy('name')
            ->get();

        return view('admin.deadlines.edit', [
            'deadline' => $deadline,
            'categories' => $categories,
            'customers' => $customers
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
        $deadline = Deadline::find($id);

        $deadline['name'] = $request->input('name');
        $deadline['deadline_category_id'] = $request->input('deadline_category_id');
        $deadline['description'] = $request->input('description');
        $deadline['deadline_at'] = $request->input('deadline_at');
        $deadline['customer_id'] = $request->input('customer_id');
        $deadline->created_by = Auth::user()->id;
        $deadline->updated_by = Auth::user()->id;

        $deadline->save();

        return redirect('/admin/deadlines')->with('success', 'Deadlines update');
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
