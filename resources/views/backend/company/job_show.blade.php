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
                        <h4 class="card-title mb-0">Single Job</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <p>Job Position</p>
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $job->job_position }}</b>
                    </div>
                    <div class="col-md-2 mb-3">
                        <p>Salary Range</p>
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $job->salary_range }}</b>
                    </div>
                    <div class="col-md-2 mb-3">
                        <p>Job Location</p>
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $job->job_location }}</b>
                    </div>
                    <div class="col-md-2 mb-3">
                        <p>Job Description</p>
                    </div>
                    <div class="col-md-10 mb-3">
                        <b>{{ $job->job_description }}</b>
                    </div>
                    <div class="col-12 d-flex">
                        <a href="/company/job/{{ $job->id }}/pelamar" class="btn btn-info ms-auto me-2">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('job.edit', $job->id) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('job.destroy', $job->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection