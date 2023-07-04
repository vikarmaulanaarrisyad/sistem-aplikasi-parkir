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
                'slide1' => 'required|mimes:png,jpg,jpeg|max:2048',
                'slide2' => 'required|mimes:png,jpg,jpeg|max:2048',
                'slide3' => 'required|mimes:png,jpg,jpeg|max:2048',
                'slide4' => 'required|mimes:png,jpg,jpeg|max:2048',
            ];
        }

        $message = [
            'logo_aplikasi.mimes' => 'Gambar harus bertipe png,jpg,jpeg.',
            'logo_aplikasi.max' => 'Gambar berukuran maksimal 2MB.',
            'logo_header.mimes' => 'Gambar harus bertipe png,jpg,jpeg.',
            'logo_header.max' => 'Gambar berukuran maksimal 2MB.',
            'logo_favicon.mimes' => 'Gambar harus bertipe png,jpg,jpeg.',
            'logo_favicon.max' => 'Gambar berukuran maksimal 2MB.',
            'login_header.mimes' => 'Gambar harus bertipe png,jpg,jpeg.',
            'login_header.max' => 'Gambar berukuran maksimal 2MB.',
            'logo_login.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'logo_login.max' => 'Gambar berukuran maksimal 2MB.',
            'slide1.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'slide1.max' => 'Gambar berukuran maksimal 2MB.',
            'slide2.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'slide2.max' => 'Gambar berukuran maksimal 2MB.',
            'slide3.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'slide3.max' => 'Gambar berukuran maksimal 2MB.',
            'slide4.mimes' => 'Logo harus bertipe png,jpg,jpeg.',
            'slide4.max' => 'Gambar berukuran maksimal 2MB.',

            'nama_aplikasi.required' => 'Nama aplikasi wajib diisi.',
            'nama_singkatan.required' => 'Singkatan aplikasi wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = $request->except('logo_aplikasi', 'logo_header', 'logo_favicon', 'login_header', 'logo_login','slide1', 'slide2', 'slide3', 'slide4');

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

        if ($request->hasFile('slide1')) {
            if (Storage::disk('public')->exists($setting->slide1)) {
                Storage::disk('public')->delete($setting->slide1);
            }
            $data['slide1'] = upload('setting', $request->file('slide1'), 'setting');
        }

        if ($request->hasFile('slide2')) {
            if (Storage::disk('public')->exists($setting->slide2)) {
                Storage::disk('public')->delete($setting->slide2);
            }
            $data['slide2'] = upload('setting', $request->file('slide2'), 'setting');
        }

        if ($request->hasFile('slide3')) {
            if (Storage::disk('public')->exists($setting->slide3)) {
                Storage::disk('public')->delete($setting->slide3);
            }
            $data['slide3'] = upload('setting', $request->file('slide3'), 'setting');
        }

        if ($request->hasFile('slide4')) {
            if (Storage::disk('public')->exists($setting->slide4)) {
                Storage::disk('public')->delete($setting->slide4);
            }
            $data['slide4'] = upload('setting', $request->file('slide4'), 'setting');
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
