@extends('backend.layouts.main')
@section('backendcontainer')
<div class="page-heading">
    <section class="section">
        <div class="card">
            @if(session()->has('berhasil'))
            <div class="alert alert-success alert-dismissible show fade">
                {{ session('berhasil') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title mb-0">Single Pelamar</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Id --}}
                    <div class="col-md-2 mb-3">
                        Id
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->id }}</b>
                    </div>
                    {{-- Pelamar Id --}}
                    <div class="col-md-2 mb-3">
                        Pelamar Id
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->pelamar_id }}</b>
                    </div>
                    {{-- Lamaran Id --}}
                    <div class="col-md-2 mb-3">
                        Lamaran Id
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->lamaran_id }}</b>
                    </div>
                    {{-- KTP Number --}}
                    <div class="col-md-2 mb-3">
                        KTP Number
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->ktp_number }}</b>
                    </div>
                    {{-- Tempat Lahir --}}
                    <div class="col-md-2 mb-3">
                        Tempat Lahir
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->place_of_birth }}</b>
                    </div>
                    {{-- Tanggal Lahir --}}
                    <div class="col-md-2 mb-3">
                        Tanggal Lahir
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->place_of_birth }}</b>
                    </div>
                    {{-- Alamat Rumah --}}
                    <div class="col-md-2 mb-3">
                        Alamat Rumah
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->address }}</b>
                    </div>
                    {{-- Nomor Handphone --}}
                    <div class="col-md-2 mb-3">
                        Nomor Handphone
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->address }}</b>
                    </div>
                    {{-- Gender --}}
                    <div class="col-md-2 mb-3">
                        Gender
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->gender }}</b>
                    </div>
                    {{-- Agama --}}
                    <div class="col-md-2 mb-3">
                        Agama
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->religion }}</b>
                    </div>
                    {{-- Status Kawin --}}
                    <div class="col-md-2 mb-3">
                        Status Kawin
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->marital_status }}</b>
                    </div>
                    {{-- Document --}}
                    <div class="col-md-2 mb-3">
                        Dokumen
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->document }}</b>
                    </div>
                    {{-- Status --}}
                    <div class="col-md-2 mb-3">
                        Status
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->status == 'menunggu' ? 'Waiting for confirmed' : ($pelamar->status == 'sudah' ? 'Confirmed' : 'Rejected') }}</b>
                    </div>
                    {{-- Created At --}}
                    <div class="col-md-2 mb-3">
                        Created At
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->created_at }}</b>
                    </div>
                    {{-- Updated At --}}
                    <div class="col-md-2 mb-3">
                        Updated At
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $pelamar->updated_at }}</b>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection