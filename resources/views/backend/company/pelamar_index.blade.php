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
                        <h4 class="card-title mb-0">Semua Pelamar</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <table class="table table-hover table-striped rounded">
            <tr>
                <th>No</th>
                <th>Gender</th>
                <th>Tanggal Lahir</th>
                <th>Address</th>
                <th>Aksi</th>
            </tr>
            @foreach ($pelamars as $pelamar)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pelamar->gender }}</td>
                <td>{{ $pelamar->date_of_birth }}</td>
                <td>{{ $pelamar->address }}</td>
                <td>
                    <a href="/company/job/{{ $pelamar->lamaran_id }}/pelamar/{{ $pelamar->id }}" class="btn btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                    <button id="statusedit" data-status="{{ $pelamar->status }}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editstatus"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            @endforeach
        </table>
    </section>
</div>
<!--warning theme Modal -->
<div class="modal fade text-left" id="editstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel160">
                    Status Edit
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="GET">
                @csrf
                <div class="modal-body">
                    <input value="menunggu" type="radio" name="status" id="status1" checked>
                    <Label class="label-control" style="margin-left: 10px;" for="status1">Waiting for confirmed</Label><br>
                    <input value="sudah" type="radio" name="status" id="status2">
                    <Label class="label-control" style="margin-left: 10px;" for="status2">Accept</Label><br>
                    <input value="ditolak" type="radio" name="status" id="status3">
                    <Label class="label-control" style="margin-left: 10px;" for="status3">Reject</Label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-warning ml-1" data-bs-dismiss="submit">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#statusedit").click(function() {
            var status = $(this).data('status');
            $('input').removeAttr('checked');
            if (status == 'menunggu') {
                $('#status1').attr('checked', '');
            }
            if (status == 'sudah') {
                $('#status2').attr('checked', '');
            }
            if (status == 'ditolak') {
                $('#status3').attr('checked', '');
            }
        });
    });
</script>
@endsection