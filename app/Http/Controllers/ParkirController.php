<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class ParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugas = Petugas::pluck('name', 'id');

        return view('admin.parkir.index', compact('petugas'));
    }

    public function data(Request $request)
    {
        $query = Parkir::with('petugas')
            ->when($request->has('filter_status') != "" && $request->filter_status != "",  function ($q) use ($request) {
                $q->where('status', $request->filter_status);
            })
            ->when($request->has('filter_petugas') != "" && $request->filter_petugas != "",  function ($q) use ($request) {
                $q->where('petugas_id', $request->filter_petugas);
            });

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('foto_wajah', function ($query) {
                if (isEmpty($query->foto_wajah)) {
                    return '
                        <img src="' . Storage::url($query->foto_wajah) . '" style="width: 40px">
                    ';
                }
                return '
                    <img src="' . asset('assets/images/not.png') . '" class="thumbnail img-responsive" style="width:40px">
                ';
            })
            ->addColumn('foto_plat', function ($query) {
                if (!empty($query->foto_plat)) {
                    return '
                        <img src="' . Storage::url($query->foto_plat) . '" style="width: 40px">
                    ';
                }
                return '
                    <img src="' . asset('assets/images/not.png') . '" class="thumbnail img-responsive" style="width:40px">
                ';
            })
            ->editColumn('status', function ($query) {
                return '
                    <span class="badge badge-' . $query->statusColor() . '">' . $query->status . '</span>
                ';
            })
            ->editColumn('petugas', function ($query) {
                if (empty($query->petugas_id)) {
                    return '
                    <span class="badge badge-warning">Belum melakukan scan keluar</span>
                ';
                }
                return '
                    <span class="badge badge-success">' . $query->petugas->name . '</span>
                ';
            })
            ->editColumn('waktu_masuk', function ($query) {
                return date('d-m-Y H:i:s', strtotime($query->created_at));
            })
            ->editColumn('waktu_keluar', function ($query) {
                if ($query->status == 'Keluar') {
                    return date('d-m-Y H:i:s', strtotime($query->updated_at));
                }
                return '-';
            })

            ->escapeColumns([])
            ->make(true);
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
    public function show(Parkir $parkir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parkir $parkir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parkir $parkir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parkir $parkir)
    {
        //
    }
}
