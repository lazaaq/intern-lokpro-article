@extends('layouts.backend.jobseeker.app')

@section('style')
<style>
    .profile-box {
        width: 150px;
        height: 150px;
    }
</style>

@endsection

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Your Profile</h3>
                <p class="text-subtitle text-muted">Complete your profile to get the best of our services</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('jobseeker.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Your Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="personal-information-tab" data-bs-toggle="tab" href="#personal-information" role="tab" aria-controls="personal-information" aria-selected="true">Personal Information</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="education-contact-tab" data-bs-toggle="tab" href="#education-contact" role="tab" aria-controls="exp-education" aria-selected="false">Education & Contacts</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="experience-preference-tab" data-bs-toggle="tab" href="#experience-preference" role="tab" aria-controls="experience-preference" aria-selected="false">Experience & Job Preferences</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel" aria-labelledby="personal-information-tab">
                            <form id="personal-information-form" class="form" action="{{ route('jobseeker.profile.update-personal-info') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        @if(!isset(jobseeker()->profile_picture))
                                        <img src="{{ asset('/backend/images/faces/2.jpg') }}" alt="" class="w-100">
                                        @else
                                        <img src="/backend/images/faces/{{ jobseeker()->profile_picture }}" alt="" class="w-100">
                                        @endif
                                        <button type="button" id="change-profile-picture-button" class="btn btn-block btn-primary mt-2 font-weight-bold">CHANGE</button>
                                        <div style="display: none">
                                            <input type="file" name="profile_picture" id="profile_picture">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <h3>{{ $jobseeker->name }}</h3>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="p-1 m-1">
                                            @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                            </li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="fullname">Full Name *</label>
                                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" value="{{ $jobseeker->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="date_of_birth">Date of Birth *</label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ isset($jobseeker->jobseekerDetail)?$jobseeker->jobseekerDetail->date_of_birth:'' }}">
                                                <span class="input-group-text" id="basic-addon2">
                                                    <i class="bi bi-calendar-week"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="gender">Gender *</label>
                                            <select class="form-select" name="gender" id="gender">
                                                <option value="">Choose</option>
                                                @if (isset($jobseeker->jobseekerDetail))
                                                @if ($jobseeker->jobseekerDetail->gender == 'male')
                                                <option value="male" selected>Laki - laki</option>
                                                <option value="female">Perempuan</option>
                                                @else
                                                <option value="male">Laki - laki</option>
                                                <option value="female" selected>Perempuan</option>
                                                @endif
                                                @else
                                                <option value="male">Laki - laki</option>
                                                <option value="female">Perempuan</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number *</label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ isset($jobseeker->jobseekerDetail)?$jobseeker->jobseekerDetail->phone_number:'' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone_number">Address *</label>
                                            <input type="text" id="address_description" name="address_description" class="form-control" placeholder="Address" value="{{ isset($jobseeker->jobseekerAddress)?$jobseeker->jobseekerAddress->address_description:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="province">Province *</label>
                                            <div class="form-group">
                                                <select class="form-select" name="province" id="province">
                                                    <option class="opt_city" value="{{ isset($dt->id_province)?$dt->id_province:'' }}">{{ isset($dt->name_province)?$dt->name_province:'Choose' }}</option>
                                                    @foreach($provinces as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <div id="city-input-field">
                                                <select class="form-select" name="city" id="city">
                                                    <option class="opt_city" value="{{ isset($dt->name_city)?$dt->id_cities:'' }}">{{ isset($dt->name_city)?$dt->name_city:'Choose' }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Bio</label>
                                            <textarea class="form-control" name="bio" id="bio" cols="30" rows="10">{{ isset($jobseeker->jobseekerDetail)?$jobseeker->jobseekerDetail->bio:'' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">SAVE</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="education-contact" role="tabpanel" aria-labelledby="education-contact-tab">
                            <form method="POST" action="/jobseeker/degree" id="education-contact-form" class="form mt-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="gender">Education/Degree *</label>
                                            <select class="form-select" id="degree" name="degree">
                                                <option value="">Choose</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'sd' ? 'selected' : ''):'' }} value="sd">SD</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'smp' ? 'selected' : ''):'' }} value="smp">SMP</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'sma' ? 'selected' : ''):'' }} value="sma">SMA</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'd1' ? 'selected' : ''):'' }} value="d1">D1</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'd2' ? 'selected' : ''):'' }} value="d2">D2</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'd3' ? 'selected' : ''):'' }} value="d3">D3</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 'd4' ? 'selected' : ''):'' }} value="d4">D4</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 's1' ? 'selected' : ''):'' }} value="s1">S1</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 's2' ? 'selected' : ''):'' }} value="s2">S2</option>
                                                <option {{ isset($dt->degree)?($dt->degree == 's3' ? 'selected' : ''):'' }} value="s3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="fullname">Institution *</label>
                                            <input type="text" value="{{ isset($dt->institution_name)?$dt->institution_name:'' }}" id="institution_name" name="institution_name" class="form-control" placeholder="Institution Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="gender">Graduation Year *</label>
                                            <select class="form-select" id="graduation_year" name="graduation_year">
                                                <option value="">Choose</option>
                                                {{ $date =  date('Y')+1 }}
                                                @for($i=0; $i<100; $i++) {{ $date = $date-1 }} <option {{ isset($dt->graduation_year)?($date == $dt->graduation_year ? 'selected':''):'' }} value="{{ $date }}">{{ $date }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">SAVE</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="experience-preference" role="tabpanel" aria-labelledby="experience-preference-tab">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    $("#change-profile-picture-button").on('click', function(event) {
        $('#profile_picture').trigger('click');
    });

    $(document).ready(function() {
        $('#province').on('change', function() {
            const selectedPackage = $('#province').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/jobseeker/cities",
                data: {
                    province_id: selectedPackage
                },
                method: "post",
                // dataType: "json",
                success: function(data) {
                    console.log(data);
                    $(".opt_city").remove();
                    $("#city").append(data);
                }
            });
        });
    });
</script>
@endsection