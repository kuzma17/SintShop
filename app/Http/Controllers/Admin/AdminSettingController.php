<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Setting $setting)
    {
        $sets = $setting->getAllSettings();

        return view('admin.settings.index', ['settings'=>$sets]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $sets = $request->all();
        unset($sets['_token']);

        $setting->setAllSettings($sets);

       return redirect()->route('admin.settings.index');
    }

}
