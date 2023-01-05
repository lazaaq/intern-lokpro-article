@extends('backend.layouts.main')
@section('backendcontainer')
<section class="py-0" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 py-6 text-sm-start">
                <h1 class="mt-6 mb-sm-4 display-2 fw-semi-bold lh-sm fs-4 fs-lg-6 fs-xxl-8 text-center">Edit Lowongan Pekerjaan</h1>
                <hr>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <form action="{{route('lowongan.update', $lowongan->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="posisi" class="form-label">Posisi</label>
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Posisi/Jabatan Pekerjaan" value="{{ $lowongan->posisi }}">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Pekerjaan" value="{{ $lowongan->deskripsi }}">
            </div>
            <div class="mb-3">
                <label for="gaji" class="form-label">Range Gaji</label>
                <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Rp 5.000.000 - Rp 7.000.000" value="{{ $lowongan->gaji }}">
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi Kerja</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Yogyakarta" value="{{ $lowongan->lokasi }}">
            </div>
            <div class="mb-3">
                <a href="{{ route('lowongan.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection