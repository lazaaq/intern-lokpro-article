@extends('backend.layouts.main')
@section('backendcontainer')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Job Detail</h3>
                <img class="mb-3 mt-3" style="display:block; margin:auto;" height="60px" width="60px" src="/backend/images/logocompany/{{ $lm->logo }}" alt="logo company">
                <table class="table table-striped mb-0">
                    <tbody>
                        <tr>
                            <td class="text-bold-500">Job Position</td>
                            <td>: {{ $lm->job_position }}</td>
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
                            <td colspan="2"><?= nl2br(htmlspecialchars($lm->job_description)); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <h3 class="text-center mt-5 mb-2">Applicant Data</h3>
                @if(session()->has('berhasil'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('berhasil') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="text-center mb-3">
                            <select class="border border-light" name="" id="status">
                                <option value="semua">All</option>
                                <option {{ $status == 'menunggu' ? 'selected' : '' }} value="menunggu">Waiting</option>
                                <option {{ $status == 'sudah' ? 'selected' : '' }} value="sudah">Confrimed</option>
                                <option {{ $status == 'ditolak' ? 'selected' : '' }} value="ditolak">Rejected</option>
                            </select>
                </div>
                <script>
                    $(document).ready(function(){
                        $('#status').on('change', function(){
                            const selected = $('#status').val();
                            if(selected == 'semua'){
                                window.location.href = "/company/job_detail/?id={{ $id }}";
                            }else{
                                window.location.href = "/company/job_detail/?id={{ $id }}&status="+ selected;
                            }
                        });
                    });
                </script>
                Status:
                <span class="badge bg-warning">Waiting for confirmation</span>
                <span class="badge bg-success">Confirmed</span>
                <span class="badge bg-danger">Rejected</span>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Status</th>
                            <th>fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>KTP Number</th>
                            <th>Place Of Birth</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Religion</th>
                            <th>Marital Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plr as $pl)
                        <tr>
                            @if($pl->status == 'menunggu')
                            <td>
                                <button id="btn-status" data-id="{{ $pl->id_pelamar }}" class="border border-0" data-bs-toggle="modal" data-bs-target="#primary"><i class="fas fa-cog"></i></button>
                            </td>
                            @else
                            <td>
                                <button class="border border-0"><i class="fas fa-cog"></i></button>
                            </td>
                            @endif
                            <td>
                                <span class="badge {{ $pl->status=='menunggu'?'bg-warning':($pl->status=='sudah'?'bg-success':($pl->status='ditolak'?'bg-danger':'bg-primary')) }}"> </span>
                            </td>
                            <td>{{ $pl->name }}</td>
                            <td>{{ $pl->email }}</td>
                            <td>{{ $pl->phone_number }}</td>
                            <td>{{ $pl->address }}</td>
                            <td>{{ $pl->ktp_number }}</td>
                            <td>{{ $pl->place_of_birth }}</td>
                            <td>{{ $pl->date_of_birth }}</td>
                            <td>{{ $pl->gender }}</td>
                            <td>{{ $pl->religion }}</td>
                            <td>{{ $pl->marital_status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<div class="modal fade text-left" id="primary" tabindex="-1"
role="dialog" aria-labelledby="myModalLabel160"
aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">
                    Status Confirmation
                </h5>
                <button type="button" class="close"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-footer">
                <a id="tolak" href="">
                    @csrf
                    <button onclick="return confirm('Are you sure?\ncan\'t recover after resuming.')" type="button" class="btn btn-danger ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reject</span>
                    </button>
                </a>
                <a id="terima" href="">
                    <button onclick="return confirm('Are you sure?\ncan\'t recover after resuming.')" type="button" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#btn-status').on('click', function(){
            const id_pelamar = $(this).attr("data-id");
            $('#tolak').attr('href', '/company/job_detail?id={{ $id }}&id_pelamar='+id_pelamar+'&status=2');
            $('#terima').attr('href', '/company/job_detail?id={{ $id }}&id_pelamar='+id_pelamar+'&status=3');
        });
    });
</script>
@endsection