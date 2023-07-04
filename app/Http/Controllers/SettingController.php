<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();

        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'nama_aplikasi' => 'required',
        ];

        if ($request->hasFile('logo_aplikasi')) {
            $rules = [
                'logo_aplikasi' => 'required|mimes:png,jpg,jpeg|max:2048',
                'logo_header' => 'required|mimes:png,jpg,jpeg|max:2048',
                'logo_favicon' => 'required|mimes:png,jpg,jpeg|max:2048',
                'login_header' => 'required|mimes:png,jpg,jpeg|max:2048',
                'logo_login' => 'required|mimes:png,jpg,jpeg|max:2048',
            ];
        }

        $message = [
            'logo_aplikasi.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'logo_aplikasi.max' => 'Logo berukuran maksimal 2MB.',
            'logo_header.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'logo_header.max' => 'Logo berukuran maksimal 2MB.',
            'logo_favicon.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'logo_favicon.max' => 'Logo berukuran maksimal 2MB.',
            'login_header.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'login_header.max' => 'Logo berukuran maksimal 2MB.',
            'logo_login.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'logo_login.max' => 'Logo berukuran maksimal 2MB.',

            'nama_aplikasi.required' => 'Nama aplikasi wajib diisi.',
            'nama_singkatan.required' => 'Singkatan aplikasi wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = $request->except('logo_aplikasi', 'logo_header', 'logo_favicon', 'login_header', 'logo_login');

        if ($request->hasFile('logo_aplikasi')) {
            if (Storage::disk('public')->exists($setting->logo_aplikasi)) {
                Storage::disk('public')->delete($setting->logo_aplikasi);
            }
            $data['logo_aplikasi'] = upload('setting', $request->file('logo_aplikasi'), 'setting');
        }

        if ($request->hasFile('logo_header')) {
            if (Storage::disk('public')->exists($setting->logo_header)) {
                Storage::disk('public')->delete($setting->logo_header);
            }
            $data['logo_header'] = upload('setting', $request->file('logo_header'), 'setting');
        }

        if ($request->hasFile('logo_favicon')) {
            if (Storage::disk('public')->exists($setting->logo_favicon)) {
                Storage::disk('public')->delete($setting->logo_favicon);
            }
            $data['logo_favicon'] = upload('setting', $request->file('logo_favicon'), 'setting');
        }

        if ($request->hasFile('login_header')) {
            if (Storage::disk('public')->exists($setting->login_header)) {
                Storage::disk('public')->delete($setting->login_header);
            }
            $data['login_header'] = upload('setting', $request->file('login_header'), 'setting');
        }

        if ($request->hasFile('logo_login')) {
            if (Storage::disk('public')->exists($setting->logo_login)) {
                Storage::disk('public')->delete($setting->logo_login);
            }
            $data['logo_login'] = upload('setting', $request->file('logo_login'), 'setting');
        }

        $setting->update($data);

        return back()->with([
            'message'   => 'Data Pengaturan Berhasil Disimpan.',
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
