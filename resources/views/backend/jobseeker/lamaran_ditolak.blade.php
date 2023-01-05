@extends('backend.layouts.main')
@section('backendcontainer')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <h4 class="card-title">All Job Vacancy</h4>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input class="form-control" id="search" type="text" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
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
            @if(empty($pelamar[0]->id))
            <span class="text-center">Empty job vacancy</span>
            @endif
            @foreach($pelamar as $l)
            <div class="col-lg-4 pilih">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-2">
                                <img data-bs-toggle="modal" data-bs-target="#large" class="dt_detail" data-dt="{{ $l->id_pelamar }}" style="cursor: pointer;" height="30px" width="30px" src="/backend/images/logocompany/{{ $l->logo }}" alt="tes">
                            </div>
                            <div class="col-10">
                                <h5 data-bs-toggle="modal" data-bs-target="#large" class="dt_detail" data-dt="{{ $l->id_pelamar }}" style="cursor: pointer;">{{ $l->job_position }}</h5>
                            </div>
                        </div>
                        <p>
                            <span>Company: {{ $l->name }}</span>
                            <br>
                            <i>Job location: {{ $l->lokasi_kerja }}</i>
                            <br>
                            <b>Rp. {{ $l->salary_range }}</b>
                            <br>
                            <b>Status: <button class="btn  btn-danger btn-sm rounded-pill">Rejected </button></b>
                        </p>
                        {{-- <a href="/jobseeker/job_detail?id={{ $l->id_pelamar }}">
                        <button class="btn btn-warning btn-block btn-sm">Waiting For Confirmate</button>
                        </a> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $('.dt_detail').on('click', function() {
        const detail = $(this).data('dt');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/jobseeker/detail",
            data: {
                detail: detail,
                status: 'ditolak'
            },
            method: "post",
            dataType: "json",
            success: function(data) {
                $('#myModalLabel17').text(data.job_position);
                $('#image').attr('src', '/backend/images/logocompany/' + data.logo);
                $('#statusss').text('Status : ' + data.status);
                $('#company_name').text(data.name);
                $('#company_location').text(data.company_location);
                $('#company_culture').text(data.company_culture);
                $('#job_position').text(data.job_position);
                $('#job_nature').text(data.job_nature);
                $('#salary_range').text(data.salary_range);
                $('#job_location').text(data.lokasi_kerja);
                $('#description').text(data.job_description);
            }
        });
    });
</script>
<!--Modal lg size -->
<div class="me-1 mb-1 d-inline-block">
    <!-- Button trigger for large size modal -->
    {{-- <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
        data-bs-target="#large">
        Large Modal
    </button> --}}
    <!--large size Modal -->
    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img height="60px" width="60px" id="image" src="" alt="logo">
                    <h4 class="modal-title" id="myModalLabel17">Large Modal</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Company Name</td>
                                <td id="company_name"></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Company Location</td>
                                <td id="company_location"></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Job Position</td>
                                <td id="job_position"></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Job Nature</td>
                                <td id="job_nature"></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Salary Range</td>
                                <td id="salary_range"></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Job Location</td>
                                <td id="job_location"></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Status</td>
                                <td class="text-danger"><i class="fas fa-times"></i> Rejected</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-bold-500 text-center">Job Description</td>
                            </tr>
                            <tr>
                                <td colspan="2" id="description"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection