@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
    @include('karyawan.dashboard.small_box')
    @include('karyawan.dashboard.slider')
@endsection
