@extends('layouts.app')

@section('title', 'Laporan Data Parkir')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Data Parkir</li>
@endsection

@section('content')

   <div class="row">
        <div class="col-md-12 col-lg-12">
            <x-card>
                 <x-slot name="header">
                <div class="btn-group">
                    <button data-toggle="modal" data-target="#modal-form" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah Periode</button>
                    <a target="_blank" href="{{ route('report.export_pdf', compact('start', 'end')) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
                    <a target="_blank" href="{{ route('report.export_excel', compact('start', 'end')) }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div>
            </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 8%">No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('admin.laporan.form')
@endsection
@includeIf('include.datatable')
@include('include.datepicker')

@include('admin.laporan.scripts')
