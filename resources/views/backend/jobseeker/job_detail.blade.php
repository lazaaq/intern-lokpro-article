@extends('backend.layouts.main')
@section('backendcontainer')
<div class="page-heading">
    <!-- Basic Horizontal form layout section start -->
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                @if(session()->has('gagal'))
                <div class="alert alert-danger alert-dismissible show fade">
                    {{ session('gagal') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session()->has('berhasil'))
                <div class="alert alert-success alert-dismissible show fade">
                    {{ session('berhasil') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <section id="basic-horizontal-layouts">
                    <div class="card-header">
                        <h3 class="text-center">Company Data</h3>
                        <img class="mb-3 mt-3" style="display:block; margin:auto;" height="60px" width="60px" src="/backend/images/logocompany/{{ $lm->logo }}" alt="logo company">
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-bold-500">Company Name</td>
                                    <td>: {{ $lm->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">Company Location</td>
                                    <td>: {{ $lm->company_location }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">Company Culture</td>
                                    <td>: {{ $lm->company_culture }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h3 class="text-center mt-5 mb-3">Job Vacanci</h3>
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-bold-500">Job Position</td>
                                    <td>: {{ $lm->job_position }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">Job Nature</td>
                                    <td>: {{ $lm->job_nature }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">Salary Range</td>
                                    <td>: {{ $lm->salary_range }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">Job Location</td>
                                    <td>: {{ $lm->lokasi_kerja }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-bold-500 text-center">Job Description</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class=""><?= nl2br(htmlspecialchars($lm->job_description)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="text-center mt-5 mb-3">Apply Now</h3>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="/jobseeker/job_detail" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="lamaran_id" value="{{ $lm->id_lamaran }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Job Position</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input readonly type="text" id="first-name" class="form-control" placeholder="Job Position" value="{{ $lm->job_position }}">
                                        </div>
                                        <h4 class="mt-5 mb-2"><u>Personal data</u></h4>
                                        <div class="col-md-4">
                                            <label>Full Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input readonly type="text" id="first-name" class="form-control" name="fname" placeholder="Full Name" value="{{ user()->name }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>KTP Number</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('ktp_number') autofocus @enderror type="number" id="email-id" class="form-control @error('ktp_number') is-invalid @enderror" name="ktp_number" placeholder="KTP Number" value="{{ old('ktp_number') }}">
                                            @error('ktp_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Place of birth</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('place_of_birth') autofocus @enderror type="text" id="contact-info" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Place of birth" value="{{ old('place_of_birth') }}">
                                            @error('place_of_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Date of birth</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('date_of_birth') autofocus @enderror type="date" id="contact-info" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" placeholder="Date of birth" value="{{ old('date_of_birth') }}">
                                            @error('date_of_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('address') autofocus @enderror type="text" id="contact-info" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" value="{{ old('address') }}">
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Phone Number</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('phone_number') autofocus @enderror type="number" id="contact-info" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Email Address</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input readonly type="email" id="contact-info" class="form-control" name="email_adrress" placeholder="Email Address" value="{{ user()->email }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Gender</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <Select @error('gender') autofocus @enderror name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Gender</option>
                                                <option {{ old('gender')=='Male'?'selected':''}} value="Male">Male</option>
                                                <option {{ old('gender')=='Female'?'selected':''}} value="Memale">Female</option>
                                            </Select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Religion</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('religion') autofocus @enderror type="text" id="contact-info" class="form-control @error('religion') is-invalid @enderror" name="religion" placeholder="Religion" value="{{ old('religion') }}">
                                            @error('religion')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Marital status</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <Select @error('marital_status') autofocus @enderror name="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                                                <option value="">Marital Status</option>
                                                <option {{ old('marital_status')=='Single'?'selected':''}} value="Single">Single</option>
                                                <option {{ old('marital_status')=='Married'?'selected':''}} value="Married">Married</option>
                                                <option {{ old('marital_status')=='Windower'?'selected':''}} value="Widower">Widower</option>
                                                <option {{ old('marital_status')=='Widow'?'selected':''}} value="Widow">Widow</option>
                                            </Select>
                                            @error('marital_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Document (PDF)</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input @error('document') autofocus @enderror type="file" id="contact-info" class="form-control @error('document') is-invalid @enderror" name="document" placeholder="Document">
                                            @error('document')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    <!-- // Basic Horizontal form layout section end -->
</div>
@endsection