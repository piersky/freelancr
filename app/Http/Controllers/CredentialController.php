<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creds = DB::table('credentials AS c')
            ->join('credential_categories AS cc', 'cc.id', '=', 'c.credential_category_id')
            ->select([
                'c.*',
                'cc.name AS category',
            ])
            //TODO: change accordingly with settings
            ->where('cc.lang_id', '=', 'it')
            ->paginate('50');

        return view('admin.credentials.index', ['credentials' => $creds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $credential = new Credential();

        $categories = DB::table('credential_categories')
            //TODO: use settings
            ->where('lang_id', '=', 'it')
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->where('is_active', '=', true)
            ->orderBy('name')
            ->get();

        return view('admin.credentials.create', [
            'credential' => $credential,
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
        $credential = new Credential();

        $credential['credential_category_id'] = $request->input('credential_category_id');
        $credential['name'] = $request->input('name');
        $credential['host_name'] = $request->input('host_name');
        $credential['user_name'] = $request->input('user_name');
        $credential['password'] = $request->input('password');
        $credential['description'] = $request->input('description');
        $credential['customer_id'] = $request->input('customer_id');
        $credential->created_by = Auth::user()->id;
        $credential->updated_by = Auth::user()->id;

        $credential->save();

        return redirect('admin.credentials')->with('success', 'Credentials saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credential = DB::table('credentials AS c')
            ->join('credential_categories AS cc', 'cc.id', '=', 'c.credential_category_id')
            ->join('customers AS cu', 'c.customer_id', '=', 'cu.id')
            ->select([
                'c.*',
                'cc.name AS category',
                'cu.name AS customer'
            ])
            //TODO: change accordingly with settings
            ->where('cc.lang_id', '=', 'it')
            ->where('c.id', '=', $id)
            ->get();

        return view('admin.credentials.show', ['credential' => $credential[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credential = Credential::find($id);

        $categories = DB::table('credential_categories')
            //TODO: use settings
            ->where('lang_id', '=', 'it')
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->where('is_active', '=', true)
            ->orderBy('name')
            ->get();

        return view('admin.credentials.edit', [
            'credential' => $credential,
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
