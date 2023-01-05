@extends('backend.layouts.main')
@section('backendcontainer')
<section class="py-0" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 py-6 text-sm-start">
                <h1 class="mt-6 mb-sm-4 display-2 fw-semi-bold lh-sm fs-4 fs-lg-6 fs-xxl-8 text-center">Detail Lowongan Pekerjaan</h1>
                <hr>
            </div>
        </div>
    </div>
</section>

<section class="content pb-3">
    <div class="container">
        <div class="row text-dark">
            <div class="col-2">
                Posisi
            </div>
            <div class="col-10">
                : {{ $lowongan->posisi }}
            </div>
        </div>
        <div class="row mt-3 text-dark">
            <div class="col-2">
                Deskripsi
            </div>
            <div class="col-10">
                : {{ $lowongan->deskripsi }}
            </div>
        </div>
        <div class="row mt-3 text-dark">
            <div class="col-2">
                Rentang Gaji
            </div>
            <div class="col-10">
                : {{ $lowongan->gaji }}
            </div>
        </div>
        <div class="row mt-3 text-dark">
            <div class="col-2">
                Lokasi
            </div>
            <div class="col-10">
                : {{ $lowongan->lokasi }}
            </div>
        </div>
        <div class="row mt-5 ps-3">
            <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-warning d-block" style="width: fit-content">Edit</a>
            <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" style="width: fit-content;display:inline-block!important">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
    <hr>
</section>


{{-- <section class="pelamar p-0">
    <div class="container">
        <div class="judul text-dark text-center" style="font-size: 2rem">DAFTAR PELAMAR</div>
    </div>
</section> --}}
@endsection