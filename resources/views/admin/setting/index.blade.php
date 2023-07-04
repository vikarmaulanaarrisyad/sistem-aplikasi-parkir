@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pengaturan Aplikasi</li>
@endsection

@section('content')
    <form action="{{ route('setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_aplikasi">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Nama Aplikasi</span></label>
                                    <input id="nama_aplikasi" class="form-control form-control-border" type="text"
                                        name="nama_aplikasi" value="{{ $setting->nama_aplikasi }}"
                                        placeholder="Tuliskan nama aplikasi" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="singkatan_aplikasi">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Nama Singkatan Aplikasi</span></label>
                                    <input id="singkatan_aplikasi" class="form-control form-control-border" type="text"
                                        value="{{ $setting->singkatan_aplikasi }}" name="singkatan_aplikasi"
                                        placeholder="Tuliskan singkatan nama aplikasi" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="diskripsi_aplikasi">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Tentang Aplikasi</span></label>

                                    <textarea class="form-control" name="diskripsi_aplikasi" id="" cols="30" rows="3">{{ $setting->diskripsi_aplikasi ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <hr>


                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="logo_header">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Logo Header</span></label>

                                    <input class="form-control" name="logo_header" type="file">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="logo_favicon">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Favicon</span></label>

                                    <input class="form-control" name="logo_favicon" type="file">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="login_header">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Login Header</span></label>

                                    <input class="form-control" name="login_header" type="file">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="logo_login">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Login</span></label>

                                    <input class="form-control" name="logo_login" type="file">
                                </div>
                            </div>
                        </div>

                        <hr>

                         <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="slide1">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Gambar Slide 1</span></label>

                                    <input class="form-control" name="slide1" type="file">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="slide2">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Gambar Slide 2</span></label>

                                    <input class="form-control" name="slide2" type="file">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="slide3">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Gambar Slide 3</span></label>

                                    <input class="form-control" name="slide3" type="file">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="slide4">Pengaturan <span class="text-danger"
                                            style="font-size: 0.80em;">Gambar Slide 4</span></label>

                                    <input class="form-control" name="slide4" type="file">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex">
                            <button class="btn btn-outline-primary btn-sm" style="width: 150px"><i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

<x-notif></x-notif>
