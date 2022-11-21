<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Settings;
use App\SettingsUser;
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
    public function index(SettingsUser $userSettings)
    {
        $creds = DB::table('credentials AS c')
            ->join('credential_categories AS cc', 'cc.id', '=', 'c.credential_category_id')
            ->join('customers AS cu', 'c.customer_id', '=', 'cu.id')
            ->select([
                'c.*',
                'cc.name AS category',
                'cu.name AS customer'
            ])
            ->where('cc.lang_id', '=', ($userSettings->has('lang_id')?$userSettings->get('lang_id'):"en"));

        if ($userSettings->has('credential_filter_credential_category_id')) {
            $creds = $creds->where('c.credential_category_id', '=', $userSettings->get('credential_filter_credential_category_id'));
        }

        if ($userSettings->has('credential_filter_name')) {
            $creds = $creds->where('c.name', 'LIKE', "%".$userSettings->get('credential_filter_name')."%");
        }

        if ($userSettings->has('credential_filter_host_name')) {
            $creds = $creds->where('c.host_name', 'LIKE', "%".$userSettings->get('credential_filter_host_name')."%");
        }

        if ($userSettings->has('credential_filter_user_name')) {
            $creds = $creds->where('c.user_name', 'LIKE', "%".$userSettings->get('credential_filter_user_name')."%");
        }

        if ($userSettings->has('credential_filter_description')) {
            $creds = $creds->where('c.description', 'LIKE', "%".$userSettings->get('credential_filter_description')."%");
        }

        if ($userSettings->has('credential_filter_customer_id')) {
            $creds = $creds->where('c.customer_id', '=', $userSettings->get('credential_filter_customer_id'));
        }

        $creds = $creds
            ->orderByDesc('c.id')
            ->get();
            //->paginate('50');

        $categories = DB::table('credential_categories')
            ->where('lang_id', '=', ($userSettings->has('lang_id')?$userSettings->get('lang_id'):"en"))
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->where('is_active', '=', true)
            ->orderBy('name')
            ->get();

        return view('admin.credentials.index', [
            'credentials' => $creds,
            'categories' => $categories,
            'customers' => $customers,
            'customer_id' => ($userSettings->has('credential_filter_customer_id')?$userSettings->get('credential_filter_customer_id'):""),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SettingsUser $userSettings)
    {
        $credential = new Credential();

        $categories = DB::table('credential_categories')
            ->where('lang_id', '=', ($userSettings->has('lang_id')?$userSettings->get('lang_id'):"en"))
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

        return redirect('/admin/credentials')->with('success', 'Credentials saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, SettingsUser $userSettings)
    {
        $credential = DB::table('credentials AS c')
            ->join('credential_categories AS cc', 'cc.id', '=', 'c.credential_category_id')
            ->join('customers AS cu', 'c.customer_id', '=', 'cu.id')
            ->select([
                'c.*',
                'cc.name AS category',
                'cu.name AS customer'
            ])
            ->where('cc.lang_id', '=', ($userSettings->has('lang_id')?$userSettings->get('lang_id'):"en"))
            ->where('c.id', '=', $id)
            ->first();

        return view('admin.credentials.show', ['credential' => $credential]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, SettingsUser $settingsUser)
    {
        $credential = Credential::find($id);

        $categories = DB::table('credential_categories')
            ->where('lang_id', '=', ($settingsUser->has('lang_id')?$settingsUser->get('lang_id'):"en"))
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
        $credential = Credential::find($id);

        $credential['credential_category_id'] = $request->input('credential_category_id');
        $credential['name'] = $request->input('name');
        $credential['host_name'] = $request->input('host_name');
        $credential['user_name'] = $request->input('user_name');
        $credential['password'] = $request->input('password');
        $credential['description'] = $request->input('description');
        $credential['customer_id'] = $request->input('customer_id')==""?null:$request->input('customer_id');
        $credential->updated_by = Auth::user()->id;

        $credential->save();

        return redirect('/admin/credentials')->with('success', 'Credentials updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credential = Credential::find($id);
        $result = $credential->delete();

        if (request()->ajax()) return '' . $result;
        else return redirect()->back();
    }

    public function filter(Request $request, SettingsUser $userSettings)
    {
        $creds = DB::table('credentials AS c')
            ->join('credential_categories AS cc', 'cc.id', '=', 'c.credential_category_id')
            ->join('customers AS cu', 'c.customer_id', '=', 'cu.id')
            ->select([
                'c.*',
                'cc.name AS category',
                'cu.name AS customer',
            ])
            ->where('cc.lang_id', '=', ($userSettings->has('lang_id')?$userSettings->get('lang_id'):"en"));

        if ($request->input('credential_category_id') != "") {
            $creds = $creds->where('c.credential_category_id', '=', $request->input('credential_category_id'));
            $userSettings->put('credential_filter_credential_category_id', $request->input('credential_category_id'));
        } else {
            $userSettings->forget('credential_filter_credential_category_id');
        }

        if ($request->input('name') != "") {
            $creds = $creds->where('c.name', 'LIKE', "%".$request->input('name')."%");
            $userSettings->put('credential_filter_name', $request->input('name'));
        } else {
            $userSettings->forget('credential_filter_name');
        }

        if ($request->input('host_name') != "") {
            $creds = $creds->where('c.host_name', 'LIKE', "%".$request->input('host_name')."%");
            $userSettings->put('credential_filter_host_name', $request->input('host_name'));
        } else {
            $userSettings->forget('credential_filter_host_name');
        }

        if ($request->input('user_name') != "") {
            $creds = $creds->where('c.user_name', 'LIKE', "%".$request->input('user_name')."%");
            $userSettings->put('credential_filter_user_name', $request->input('user_name'));
        } else {
            $userSettings->forget('credential_filter_user_name');
        }

        if ($request->input('description') != "") {
            $creds = $creds->where('c.description', 'LIKE', "%".$request->input('description')."%");
            $userSettings->put('credential_filter_description', $request->input('description'));
        } else {
            $userSettings->forget('credential_filter_description');
        }

        if ($request->input('customer_id') != "") {
            $creds = $creds->where('c.customer_id', '=', $request->input('customer_id'));
            $userSettings->put('credential_filter_customer_id', $request->input('customer_id'));
        } else {
            $userSettings->forget('credential_filter_customer_id');
        }

        $creds = $creds->orderByDesc('c.id')
            ->get();
            //->paginate('50');

        $categories = DB::table('credential_categories')
            ->where('lang_id', '=', ($userSettings->has('lang_id')?$userSettings->get('lang_id'):"en"))
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->where('is_active', '=', true)
            ->orderBy('name')
            ->get();

        return view('admin.credentials.index', [
            'credentials' => $creds,
            'categories' => $categories,
            'customers' => $customers,
            'customer_id' => ($userSettings->has('credential_filter_customer_id')?$userSettings->get('credential_filter_customer_id'):""),
        ]);
    }

    public function reset_filter(SettingsUser $userSettings)
    {
        $userSettings->forget('credential_filter_credential_category_id');
        $userSettings->forget('credential_filter_name');
        $userSettings->forget('credential_filter_host_name');
        $userSettings->forget('credential_filter_user_name');
        $userSettings->forget('credential_filter_description');
        $userSettings->forget('credential_filter_customer_id');

        if (request()->ajax()) return '1';
        else return redirect()->back();
    }
}
