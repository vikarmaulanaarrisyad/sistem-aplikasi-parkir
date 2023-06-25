@extends('layouts.app')

@section('title', 'Daftar Parkir')

@section('header', 'Daftar Parkir')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Parkir</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <x-card>

                {{-- Filter --}}
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <select name="filter_status" id="filter_status" class="form-control">
                                <option value="" disabled selected>- Pilih Status -</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Keluar">Keluar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <select name="filter_petugas" id="filter_petugas" class="custom-select">
                                <option value="" disabled selected>- Pilih Petugas -</option>
                                @foreach ($petugas as $key => $p)
                                    <option value="{{ $key }}">{{ $p }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button id="btn-reset-filter" onclick="resetFilter()"
                                class="btn btn-outline-danger">Reset</button>
                        </div>
                    </div>
                </div>
                {{-- End Filter --}}
                <hr>
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 8%">No</th>
                            <th style="width: 130px">Foto Wajah</th>
                            <th style="width: 130px">Foto Plat</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th>Waktu Keluar</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
@endsection
@includeIf('include.datatable')

@include('admin.parkir.scripts')
