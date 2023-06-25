<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Petugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalPetugas = Petugas::totalPetugas();
        $totalParkirMasuk = Parkir::parkirMasuk();
        $totalParkirKeluar = Parkir::parkirKeluar();

        if ($user->hasRole('admin')) {
            return view('admin.dashboard.index', compact([
                'totalPetugas', 'totalParkirKeluar', 'totalParkirMasuk'
            ]));
        } else {
            return view('karyawan.dashboard.index', compact([
               'totalParkirKeluar', 'totalParkirMasuk'
            ]));
        }
    }
}
