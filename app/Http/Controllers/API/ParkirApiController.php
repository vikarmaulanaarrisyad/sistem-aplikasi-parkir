<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParkirApiResource;
use App\Models\Parkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParkirApiController extends Controller
{
    public function index()
    {
        //get parkirs
        $parkirs = Parkir::all();

        foreach ($parkirs as $parkir) {
            $parkir->foto_wajah = Storage::url($parkir->foto_wajah);
            $parkir->foto_plat = Storage::url($parkir->foto_plat);
        }

        //return collection of parkirs as a resource
        return new ParkirApiResource(true, 'List Data Parkir', $parkirs);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'code_qr'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $parkir = Parkir::create([
            'code_qr'     => $request->code_qr,
        ]);

        //return response
        return new ParkirApiResource(true, 'Data Parkir Berhasil Ditambahkan!', $parkir);
    }

    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Parkir $parkir)
    {
        //return single parkir as a resource
        return new ParkirApiResource(true, 'Data Parkir Ditemukan!', $parkir);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $parkir
     * @return void
     */

    public function update(Request $request, Parkir $parkir)
    {

        //define validation rules
        $validator = Validator::make($request->all(), [
            'foto_wajah'     => 'required|mimes:png,jpg,jpeg',
            'foto_plat'   => 'required|mimes:png,jpg,jpeg',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // cek status camera 1 dan 2
        if ($parkir->is_cam1 == 0 && $parkir->is_cam2 == 0) {
            return response()->json($validator->errors(), 422);
        }

        //update post without image
        $parkir->update([
            'foto_wajah'     => $request->foto_wajah,
            'foto_plat'   => $request->foto_plat,
        ]);

        //return response
        return new ParkirApiResource(true, 'Data Parkir Berhasil Diubah!', $parkir);
    }

    //update gambar data terakhir
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function uploadImage(Request $request)
    {
        //return single parkir as a resource
        $parkir = Parkir::whereNotNull('is_cam1')
            ->whereNotNull('is_cam2')
            ->latest()
            ->take(1)
            ->first();

        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'foto_wajah'     => 'required|mimes:png,jpg,jpeg',
                'foto_plat'   => 'required|mimes:png,jpg,jpeg',
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('foto_wajah') && $request->hasFile('foto_plat')) {
            if (Storage::disk('public')->exists($parkir->foto_wajah) && Storage::disk('public')->exists($parkir->foto_plat)) {

                Storage::disk('public')->delete($parkir->foto_wajah);
                Storage::disk('public')->delete($parkir->foto_plat);
            }

            $data['foto_wajah'] = upload('wajah', $request->file('foto_wajah'), 'parkir');
            $data['foto_plat'] = upload('plat', $request->file('foto_plat'), 'parkir');
        }

        $data['is_cam1'] = 1;
        $data['is_cam2'] = 1;

        $parkir->update($data);

        //return response
        return new ParkirApiResource(true, 'Data Parkir Berhasil Diubah!', $parkir);
    }
}
