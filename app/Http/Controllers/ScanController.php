<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScanController extends Controller
{
    public function index()
    {
        return view('karyawan.scan.index');
    }

    public function data($qrcode)
    {
        $parkir = Parkir::where('code_qr', $qrcode)->first();
        $parkir->foto_plat = Storage::url($parkir->foto_plat);
        $parkir->foto_wajah = Storage::url($parkir->foto_wajah);
        $parkir->tglmasuk = tanggal_indonesia($parkir->created_at);

        return response()->json(['data' => $parkir]);
    }

    public function validasiQrCode(Request $request)
    {
        $userId = auth()->user()->id;
        $petugas = Petugas::where('user_id', $userId)->first();

        $qrCode = Parkir::where('code_qr', $request->qrcode)->first();

        if ($qrCode == null) {
            return response()->json(['message' => 'Data tidak ditemukan dalam sistem'], 400);
        }

        if ($qrCode->status == "Keluar") {
            return response()->json(['message' => 'Data tidak valid'], 400);
        }

        $qrCode->update([
            'status' => 'Keluar',
            'petugas_id' => $petugas->id,
        ]);

        return response()->json(['message' => 'Data valid']);
    }
}