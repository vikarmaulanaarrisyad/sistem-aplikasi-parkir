@extends('layouts.app')

@section('title', 'Scan Parkir')

@section('header', 'Scan Parkir')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Scan Parkir</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5>
                        <div class="i fas fa-qrcode"></div> Scan QR Code Parkir Keluar
                    </h5>
                </div>
                <div class="card-body box-profile">
                    <div id="reader" width="100%"></div>
                </div>
                <div class="card-footer">
                    <p class="text-justify text-info text-1x">Jika QR Code pada karcis kendaraan tidak terdeteksi oleh sistem silahkan
                        tambahkan manual parkir kendaraan secara manual</p>
                </div>
            </div>
        </div>

        <div class="col-md-7">
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
                                <img id="wajah" src="" alt="" class="img-thumbnail" width="100px"
                                    height="100px">
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Foto Plat </th>
                            <th style="width: 2%">:</th>
                            <td id="foto_plat">
                                <img id="plat" src="" alt="" class="img-thumbnail" width="100px"
                                    height="100px">
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Waktu Masuk </th>
                            <th style="width: 2%">:</th>
                            <td id="waktumasuk"></td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Waktu Keluar </th>
                            <th style="width: 2%">:</th>
                            <td id="waktukeluar"></td>
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
