@extends('layouts.app')

@section('title', 'Daftar Petugas')

@section('header', 'Daftar Petugas')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Petugas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('petugas.store') }}`)" class="btn btn-primary btn-sm"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                    {{-- <button  onclick="importForm(`{{ route('petugas.import_excel') }}`)" class="btn btn-success btn-sm"><i
                            class="fas fa-upload"></i> Upload Petugas</button> --}}
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th style="width: 30px">Foto</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('admin.petugas.form')
    @include('admin.petugas.import_form')
    @include('admin.petugas.detail_form')
@endsection
@includeIf('include.datatable')

@include('admin.petugas.scripts')
