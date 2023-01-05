@extends('backend.layouts.main')
@section('backendcontainer')
<section class="content">
    <div class="container">
        @if(session()->has('success_added'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_added') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session()->has('success_updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_updated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session()->has('success_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="tambah mb-3 text-end">
            <a href="{{ route('lowongan.create') }}" class="btn btn-primary">Tambah Lowongan</a>
        </div>
        <div class="row">
            @foreach($lowongans as $lowongan)
            <div class="col-12">
                <div class="box rounded p-4" style="background-color:#c4c4c4;color:black;">
                    <h3>{{ $lowongan->posisi }}</h3>
                    <div style="display:flex;">
                        <div class="kiri" style="width: 80%">
                            <h6><i class="bi bi-geo-alt me-1"></i>{{$lowongan->lokasi}}</h6>
                            <h6>{{$lowongan->gaji}}</h6>
                            <p style="color:#112D58; font-size:0.8rem; margin:0">{{$lowongan->deskripsi}}</p>
                        </div>
                        <div class="tombol text-end" style="width: 20%;display:flex;align-items:flex-end; justify-content:flex-end">
                            <div>
                                <a href="{{ route('lowongan.show', $lowongan->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" style="width: fit-content;display:inline-block!important">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection