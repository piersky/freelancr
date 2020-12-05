<?php

namespace App\Http\Controllers;

use App\Models\HourStack;
use App\Models\Customer;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class HourStackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hourstacks = DB::table('hour_stacks')
            ->join('customers', 'hour_stacks.customer_id', '=', 'customers.id')
            ->leftJoin('used_hours_v', 'hour_stacks.id', '=', 'used_hours_v.id')
            ->select([
                'hour_stacks.id',
                'hour_stacks.name',
                'hour_stacks.qty',
                'hour_stacks.is_active',
                'customers.name AS customer_name',
                'used_hours_v.used_hours',
                'hour_stacks.price'
            ])
            ->orderByDesc('hour_stacks.is_active')
            ->orderByDesc('hour_stacks.created_at')
            ->get();

        return view('admin.hourstacks.index', ['hourstacks' => $hourstacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hourstacks = new HourStack();

        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.hourstacks.create', ['hourstacks' => $hourstacks, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hourstack = new HourStack();

        $hourstack->name = $request->input('name');
        $hourstack->qty = $request->input('qty');
        $hourstack->price = $request->input('price');
        $hourstack->customer_id = $request->input('customer_id');
        $hourstack->is_active = $request->is_active=='on'?1:0;
        $hourstack->created_by = Auth::user()->id;
        $hourstack->updated_by = Auth::user()->id;

        $hourstack->save();

        return redirect('admin/hourstacks')->with('success', 'Hour stack saved');
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
        $hourstack = HourStack::find($id);

        $customers = Customer::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.hourstacks.edit', ['hourstack' => $hourstack, 'customers' => $customers]);
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
        $hourstack = HourStack::find($id);

        $hourstack->name = $request->input('name');
        $hourstack->qty = $request->input('qty');
        $hourstack->price = $request->input('price');
        $hourstack->customer_id = $request->input('customer_id');
        $hourstack->is_active = $request->is_active=='on'?1:0;
        $hourstack->updated_by = Auth::user()->id;

        $hourstack->save();

        return redirect('admin/hourstacks')->with('success', 'Hour stack updated');
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
