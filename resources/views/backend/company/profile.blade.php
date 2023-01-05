@extends('backend.layouts.main')
@section('backendcontainer')
<div class="page-heading">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="bg-image p-5 text-center shadow-1-strong rounded text-white" style="background-image: url('https://mdbootstrap.com/img/new/slides/003.jpg');">
                            <h1 class="mb-3 h2 text-light">{{ user()->name }}</h1>
                            <img class="p-2" height="60px" width="60px" src="/backend/images/logocompany/{{ user()->logo }}" alt="logo">
                            <p>{{ user()->email; }}</p>
                            <a target="_blank" href="@if($sosmed[0]) //{{ $sosmed[0] }} @else //facebook.com @endif"><i class="text-white fab fa-facebook"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a target="_blank" href="@if($sosmed[1]) //{{ $sosmed[1] }} @else //instagram.com @endif"> <i class="text-white fab fa-instagram"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a target="_blank" href="@if($sosmed[2]) //{{ $sosmed[2] }} @else //twitter.com @endif"> <i class="text-white fab fa-twitter"></i></a>
                        </div>
                        @error('logo')
                        <div class="alert alert-danger alert-dismissible show fade">
                            Failed upload logo, {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror
                        @error('email')
                        <div class="alert alert-danger alert-dismissible show fade">
                            Failed! {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror
                        @if(session()->has('berhasil'))
                        <div class="alert alert-success alert-dismissible show fade">
                            {{ session('berhasil') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session()->has('gagal'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            {{ session('gagal') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="edit-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="edit" aria-selected="false">Edit</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-striped mb-0 mt-3">
                                    <tr>
                                        <td>Company Name</td>
                                        <td>: {{ user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Job Location</td>
                                        <td>: {{ user()->job_location }}</td>
                                    </tr>
                                    <tr>
                                        <td>Workers</td>
                                        <td>: {{ user()->jumlah_pekerja }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company Location</td>
                                        <td>: {{ user()->company_location }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company Culture</td>
                                        <td>: {{ user()->company_culture }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3 class="text-center">Logo</h3>
                                <form class="form form-horizontal mt-3" action="/company/logo" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-1 mb-2   ">
                                                <img class="logo-preview" height="60px" width="60px" src="/backend/images/logocompany/{{ user()->logo }}" alt="logo">
                                            </div>
                                            <div class="col-md-8 form-group mt-2">
                                                <input type="file" id="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" onchange="previewLogo()">
                                                @error('logo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group mt-2">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Save Logo</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <h3 class="text-center mt-5">Company Data</h3>
                                <form class="form mt-3" action="/company/profile" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Company Name</label>
                                                <input type="text" id="first-name-column" class="form-control @error('name') is-invalid @enderror" placeholder="-" name="name" value="{{ user()->name }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">Job Location</label>
                                                <input type="text" id="last-name-column" class="form-control @error('job_location') is-invalid @enderror" placeholder="-" name="job_location" value="{{ user()->job_location }}">
                                                @error('job_location')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">Number of Workers</label>
                                                <input type="number" id="city-column" class="form-control @error('jumlah_pekerja') is-invalid @enderror" placeholder="-" name="jumlah_pekerja" value="{{ user()->jumlah_pekerja }}">
                                                @error('jumlah_pekerja')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Company Location</label>
                                                <input type="text" id="country-floating" class="form-control @error('company_location') is-invalid @enderror" name="company_location" value="{{ user()->company_location }}" placeholder="-">
                                                @error('company_location')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Company Culture</label>
                                                <input type="text" id="company-column" class="form-control @error('company_culture') is-invalid @enderror" name="company_culture" value="{{ user()->company_culture }}" placeholder="-">
                                                @error('company_culture')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show" id="contact" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="text-center">Account</h3>
                                <form class="form form-horizontal mt-3" action="/company/email" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ user()->email }}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Save Email</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form class="form form-horizontal mt-3" action="/company/contact" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Old Password</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Old password">
                                                @error('old_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label>New Password</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="New password">
                                                @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Save Password</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <h3 class="text-center">Social Media</h3>
                                <form class="form form-horizontal mt-3" action="/company/sosmed" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Facebook</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="facebook" class="form-control" name="facebook" placeholder="Enter Facebook URL" value="{{ $sosmed[0] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Instagram</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="instagram" class="form-control" name="instagram" placeholder="Enter Instagram URL" value="{{ $sosmed[1] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Twitter</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="twitter" class="form-control" name="twitter" placeholder="Enter Twitter URL" value="{{ $sosmed[2] }}">
                                            </div>

                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
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
        </div>
    </section>
</div>
@endsection