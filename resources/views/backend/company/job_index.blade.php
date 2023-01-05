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
                    <div class="col-md-8 mb-3">
                        <h4 class="card-title">All Job Vacanci</h4>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input class="form-control" id="search" type="text" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
          $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myList .pilih").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
    <section class="section">
        <div class="row" id="myList">
            @if(empty(lamaran_company()[0]->id))
            <span class="text-center">Empty Job</span>
            @endif
            @foreach(lamaran_company() as $l)
            <div class="col-lg-4 pilih">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-2">
                                <img height="30px" width="30px" src="/backend/images/logocompany/{{ $l->logo }}" alt="tes">
                            </div>
                            <div class="col-10">
                                <h5>{{ $l->job_position }}</h5>
                            </div>
                        </div>
                        <p>
                            <span>Company: {{ $l->name }}</span>
                            <br>
                            <i>Job location: {{ $l->lokasi_kerja }}</i>
                            <br>
                            <b>Rp. {{ $l->salary_range }}</b>    
                        </p>
                        <a href="{{ route('job.show', $l->id_lamaran) }}">
                            <button class="btn btn-primary btn-block btn-sm"><i class="fas fa-eye"></i></button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection