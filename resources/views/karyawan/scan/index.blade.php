@extends('layouts.app')

@section('title', 'Scan Parkir')

@section('header', 'Scan Parkir')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Scan Parkir</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div id="reader" width="500px"></div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <x-card>
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 20%">No Parkir</th>
                            <th style="width: 2%">:</th>
                            <td id="code_qr"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Foto Wajah </th>
                            <th style="width: 2%">:</th>
                            <td id="foto_wajah">
                                <img id="wajah" src="" alt="" class="img-thumbnail" width="100px" height="100px">
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Foto Plat </th>
                            <th style="width: 2%">:</th>
                            <td id="foto_plat">
                                 <img id="plat" src="" alt="" class="img-thumbnail" width="100px" height="100px">
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Tanggal Masuk </th>
                            <th style="width: 2%">:</th>
                            <td id="tglmasuk"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Status </th>
                            <th style="width: 2%">:</th>
                            <td id="status"></td>
                        </tr>
                    </thead>
                </table>
            </x-card>
        </div>
    </div>
@endsection

@include('karyawan.scan.scripts')
