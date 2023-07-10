<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Parkir;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = now()->subDays(30)->format('Y-m-d');
        $end = date('Y-m-d');

        if ($request->has('start') && $request->start != "" && $request->has('end') && $request->end != "") {
            $start = $request->start;
            $end = $request->end;
        }

        return view('admin.laporan.index', compact('start', 'end'));
    }

    public function getData($start, $end, $escape = false)
    {
        $data = [];
        $i = 1;

        $parkir = Parkir::with('petugas')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        if ($parkir->isEmpty()) {
            $data[] = [
                'DT_RowIndex' => '',
                'tanggal' => '',
                'petugas' => '',
                'status' => '',
                'jammasuk' => '',
                'jamkeluar' => '',
            ];
        } else {
            foreach ($parkir as $p) {
                $row = [];
                $row['DT_RowIndex'] = $i++;
                $row['tanggal'] = tanggal_indonesia($p->created_at, strtotime($p->created_at));
                $row['petugas'] = $p->petugas->name ?? '-';
                $row['status'] =  $p->status;
                $row['jammasuk'] = date('H:i:s', strtotime($p->created_at));
                $row['jamkeluar'] = $p->status == 'Keluar' ?  date('H:i:s', strtotime($p->updated_at)) : '-';

                $data[] = $row;
            }
        }

        return $data;
    }

    public function data($start, $end)
    {
        $data = $this->getData($start, $end);

        return datatables($data)
            ->escapeColumns([])
            ->make(true);
    }

    public function exportPDF($start, $end)
    {
        $data = $this->getData($start, $end);
        $pdf = PDF::loadView('admin.laporan.pdf', compact('start', 'end', 'data'));

        return $pdf->download('Laporan-parkir-phb-' . date('Y-m-d-his') . '.pdf');
    }

    public function exportExcel($start, $end)
    {
        $data = $this->getData($start, $end, true);
        $excel = new ReportExport($start, $end, $data);

        return Excel::download($excel, 'Laporan-parkir-phb-' . date('Y-m-d-his') . '.xlsx');
    }
}
