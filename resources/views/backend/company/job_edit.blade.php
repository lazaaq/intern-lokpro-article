@extends('backend.layouts.main')
@section('backendcontainer')
<div class="page-heading">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if(session()->has('berhasil'))
                        <div class="alert alert-success alert-dismissible show fade">
                            {{ session('berhasil') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <h3 class="text-center mb-5">POST NEW JOB</h3>
                            <form class="form form-horizontal mt-3" action="{{ route('job.update', $job->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Job Position</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="job_position" class="form-control @error('job_position') is-invalid @enderror" name="job_position" placeholder="Job position" value="{{ $job->job_position }}">
                                            @error('job_position')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Salary Range</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                                <input type="text" class="form-control uang @error('salary_range') is-invalid @enderror" name="salary_range" id="salary_range" placeholder="" aria-label="salary_range" aria-describedby="basic-addon1" value="{{ $job->salary_range }}">
                                                @error('salary_range')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Job Location</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="job_location" class="form-control @error('job_location') is-invalid @enderror" name="job_location" placeholder="Job location" value="{{ $job->job_location }}">
                                            @error('job_location')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Job description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea placeholder="Job description" class="form-control @error('job_description') is-invalid @enderror" name="job_description" id="" cols="5" rows="5">{{ $job->job_description }}</textarea>
                                            @error('job_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script type="text/javascript">
	// $(document).ready(function(){
	     // Format mata uang.
	//     $( '.uang' ).mask('0.000.000.000.000.000.000', {reverse: true});
	// })
</script>
@endsection