<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $namaFile);

            $setting->logo = $namaFile;
        }

        $setting->nama_apotek = $request->nama_apotek;
        $setting->save();

        return back()->with('success', 'Berhasil update!');
    }
}