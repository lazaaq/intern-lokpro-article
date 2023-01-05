@extends('layouts.backend.jobseeker.app')

@section('content')
<header class="mb-0">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<!-- <div class="page-heading">
    <h3>Dashboard</h3>
</div> -->
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body" id="card-body2">
                        <div class="row">
                            @if(jobseeker() != null)
                            <div class="col-1">
                                <img style="border-radius: 50%;" src="/backend/images/faces/{{ jobseeker()->profile_picture }}" alt="" height="40px" width="40px">
                            </div>
                            @endif
                            <div class="col-10">
                                <input onclick="$('#card-body1').removeAttr('style');$('#card-body2').attr('style', 'visibility: hidden;position: absolute;'); $('#subject').focus()" type="text" class="form-control" type="text" placeholder="Type Something..." readonly>
                            </div>
                            <div class="col-1">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-transparent" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="/jobseeker/dashboard?me=1">
                                            <i class="fas fa-user"></i>
                                            <span style="margin-left: 15%;">Show my article</span>
                                        </a>
                                        <a class="dropdown-item" href="/jobseeker/dashboard">
                                            <i class="fas fa-users"></i>
                                            <span style="margin-left: 15%;">Show all article</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="card-body1" class="card-body" style="visibility: hidden;position: absolute;">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="Subject">Subject</label>
                            </div>
                            <div class="col-6">
                                <button type="button" onclick="$('#card-body2').removeAttr('style');$('#card-body1').attr('style', 'visibility: hidden;position: absolute;')" style="float: right;" class="btn btn-transparent border-0"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <input style="box-shadow: none;" type="text" class="form-control" id="subject" name="subject" autofocus>
                        <div id="invalid-subject" style="visibility: hidden;position: absolute;">
                            <li class="text-danger"></li>
                        </div>
                        <label class="form-label" for="formartikel">Description</label>
                        <div id="formartikel">
                        </div>
                        <div id="invalid-description" style="visibility: hidden;position: absolute;">
                            <li class="text-danger"></li>
                        </div>
                        <textarea style="visibility: hidden;position: absolute;" name="description" id="description" cols="0" rows="0"></textarea>
                        <div class="row mt-2">
                            <div class="col-6">
                                <button type="button" onclick="$('#foto_video').click()" class="btn btn-sm btn-success"><i class="fas fa-photo-video"></i> Picture</button>
                                <input type="file" style="visibility: hidden;position: absolute;" id="foto_video" name="foto_video">
                                <div id="invalid-foto_video" style="visibility: hidden;position: absolute;">
                                    <li class="text-danger"></li>
                                </div>
                            </div>
                            <div class="col-6">
                                <button onclick="return postnow()" type="submit" class="btn btn-sm btn-primary" style="float: right;"><i class="fas fa-paper-plane"></i> Post Now</button>
                            </div>
                        </div>
                        <script>
                            // jika tombol post ditekan
                            function postnow() {
                                // mengambil inputan deskripsi
                                $('#description').text($('.ql-editor').html());

                                // validasi form
                                $('#invalid-subject').attr('style', 'visibility: hidden;position: absolute;')
                                $('#invalid-description').attr('style', 'visibility: hidden;position: absolute;')
                                $('#invalid-foto_video').attr('style', 'visibility: hidden;position: absolute;')

                                var err = 0;
                                if ($('#subject').val() == '') {
                                    $('#invalid-subject').removeAttr('style');
                                    $('#invalid-subject li').text('Subject is required');
                                    var err = 1;
                                }
                                if ($('#formartikel').text() == '') {
                                    $('#invalid-description').removeAttr('style');
                                    $('#invalid-description li').text('Description is required');
                                    var err = 1;
                                }
                                if ($('#foto_video').get(0).files.length === 0) {
                                    $('#invalid-foto_video').removeAttr('style');
                                    $('#invalid-foto_video li').text('Image is required');
                                    var err = 1;
                                } else {
                                    var ext = $('#foto_video').val().split('.').pop().toLowerCase();
                                    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                        $('#invalid-foto_video').removeAttr('style');
                                        $('#invalid-foto_video li').text("Allowed extensions : 'gif', 'png', 'jpg', 'jpeg'.");
                                        var err = 1;
                                    }
                                }
                                if (err == 1) {
                                    return false;
                                }
                            }
                        </script>
                    </div>
                    <!-- <div class="card-body" id="card-body2">
                        <input onclick="$('#card-body1').removeAttr('style');$('#card-body2').attr('style', 'visibility: hidden;position: absolute;'); $('#subject').focus()" type="text" class="form-control bg-transparent" placeholder="Ketikan Sesuatu..." readonly>
                    </div> -->
                </div>
            </form>
            <?php $t = 0 ?>
            @foreach($artikel as $a)
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 text-center">
                                <img style="border-radius: 50%;" src="/backend/images/faces/{{ $a->profile_picture }}" alt="" height="40px" width="40px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $a->name }}">
                            </div>
                            <div class="col-8 text-center">
                                <h3>{{ $a->name }}</h3>
                            </div>
                            <div class="col-2 text-center">
                                <!-- <button class="btn btn-transparent"><i class="fas fa-ellipsis-v"></i></button> -->
                                <div class="dropdown">
                                    <button type="button" class="btn btn-transparent" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @if($a->user_id == user()->id)
                                        <a onclick="window.location.href= '/jobseeker/artikel_delete?id=<?= $a->id_artikel ?>'" class="dropdown-item" href="#">
                                            <i class="fas fa-trash"></i>
                                            <span style="margin-left: 15%;">Delete</span>
                                        </a>
                                        <!-- <a class="dropdown-item" href="#">
                                            <i class="fas fa-edit"></i>
                                            <span style="margin-left: 15%;">Edit</span>
                                        </a> -->
                                        @endif
                                        <a class="dropdown-item" data-koment="{{ $a->id_artikel }}" onclick="tampilkomen(this)" href="#" data-bs-toggle="modal" data-bs-target="#showartikel">
                                            <i class="fas fa-eye"></i>
                                            <span style="margin-left: 15%;">Show</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12" style="text-align: center;">
                                <a style="visibility: hidden;position: absolute;" class="full-foto" href="/backend/images/artikel/{{ $a->foto_video }}" target="_blank"></a>
                                <img onclick="document.getElementsByClassName('full-foto')['<?= $t++ ?>'].click()" height="200px" width="200px" src="/backend/images/artikel/{{ $a->foto_video }}" alt="Articel">
                            </div>
                            <div class="col-lg-9 col-sm-12">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h5 style="margin-left: 2%;"><?= str_word_count($a->subject) > 10 ? substr($a->subject, 0, 80) . "<span style='cursor: pointer;'>[..]</span>" : $a->subject ?></h5>
                                    </div>
                                    <hr>
                                    <div class="col-12" style="margin-top: -7%;">
                                        <div style="line-height: 16px;" class="ql-editor" data-gramm="false" contenteditable="false" spellcheck="false" data-ms-editor="true">
                                            <?= str_word_count($a->description) > 140 ? substr($a->description, 0, 312) . "<span style='cursor: pointer;'>[..]</span>" : $a->description ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-4">
                                <button type="button" class="btn btn-primary" onclick="
                                        $.ajax({
                                            url: '/jobseeker/dashboard',
                                            data: {suka : <?= $a->id_artikel ?>},
                                            method: 'get',
                                            dataType: 'json',
                                            success: function(dt) {
                                                $('.suka<?= $a->id_artikel; ?>').text(dt);
                                            }
                                        });
                                    ">
                                    <i class="fas fa-thumbs-up"></i> <span class="suka<?= $a->id_artikel; ?>"><?= $like->where('like_artikels.artikel_id', '=', $a->id_artikel)->count(); ?></span>
                                    <!-- <i class="far fa-thumbs-up"></i> -->
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" data-koment="{{ $a->id_artikel }}" onclick="tampilkomen(this)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showartikel">
                                    <i class="fas fa-comment"></i> <span class="comment<?= $a->id_artikel; ?>"><?= $comment->where('comments.artikel_id', '=', $a->id_artikel)->count(); ?></span>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <button id="card-body2" onclick="$('#card-body1').removeAttr('style');$('#card-body2').attr('style', 'visibility: hidden;position: absolute;'); $('#subject').focus()" type="text" class="btn btn-primary btn-lg" style="position: fixed;border-radius: 50%;right: 15%;top: 2%;"><i class="fas fa-plus"></i></button>
            <button id="card-body2" type="text" class="btn btn-primary btn-lg" style="position: fixed;border-radius: 50%;right: 11%;top: 2%;"><i class="fas fa-ellipsis-v"></i></button> -->
        </div>
    </section>
</div>
<!-- Modal showartikel -->
<div class="modal fade" id="showartikel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row" style="width: 100%;">
                    <div class="col-2 text-center">
                        <img class="mt-2 modal_pp" style="border-radius: 50%;" src="" alt="" height="40px" width="40px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="">
                    </div>
                    <div class="col-8 text-center">
                        <h3 id="modal_name" class="mt-2"></h3>
                    </div>
                    <div class="col-2 text-center">
                        <button id="stop_interval" type="button" class="btn-close mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-6" style="text-align: center;">
                        <img id="modal_picture" height="400px" width="400px" src="" alt="article picture">
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <h3 id="modal_subject"></h3>
                        <div id="modal_description" style="line-height: 16px;" class="ql-editor" data-gramm="false" contenteditable="false" spellcheck="false" data-ms-editor="true">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h3 id="label-comment">Komentar:</h3>
                        <span style="position: absolute;visibility: hidden;" id="id-artikel"></span>
                    </div>
                    <div class="row mb-4">
                        <div class="col-2">
                            <img class="modal_pp" style="float: right;border-radius: 50%;" width="40px" height="40px" src="" alt="">
                        </div>
                        <div class="col-8">
                            <input id="comment" type="text" class="form-control" placeholder="Type your answer...">
                        </div>
                        <div class="col-2">
                            <button onclick="addComment()" style="float: left;" class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i></button>
                        </div>
                    </div>
                    <div id="load_komentar">
                        <!-- <div class="row mt-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12" style="text-align: right;">
                                        <h4>Marthin</h4>
                                    </div>
                                    <div class="col-12" style="text-align: right;">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eligendi sit aspernatur illo quisquam sed recusandae deleniti ad eaque pariatur aliquid unde laudantium voluptatem voluptate, officiis corrupti ducimus nostrum possimus.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <img style="border-radius: 50%;float: left;" width="40px" height="40px" src="/backend/images/logo/fp.png" alt="">
                            </div>
                        </div> -->
                    </div>
                </div>
                <br><br><br><br><br><br><br><br>
            </div>
            <div class="modal-footer">
                <div class="row text-center" style="width: 100%;">
                    <!-- <div class="col-4">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                    </div> -->
                    <div class="col-6">
                        <button onclick="$('#comment').focus();window.location.href='#label-comment'" class="btn btn-primary"><i class="fas fa-comment"></i></button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // add comment
    function addComment() {
        var comment = $('#comment').val();
        var id_komentar = $('#id-artikel').text();
        $.ajax({
            url: '/jobseeker/comment',
            data: {
                komentar: comment,
                id_komentar: id_komentar
            },
            method: 'get',
            dataType: 'json',
            success: function(u) {
                $('#comment').val('');
            }
        });
    }

    function tampilkomen(e) {
        var data_koment = e.getAttribute('data-koment');
        $.ajax({
            url: '/jobseeker/koment',
            data: {
                data_koment: data_koment
            },
            method: 'get',
            dataType: 'json',
            success: function(f) {
                $('#modal_name').text(f.name);
                $('#modal_picture').attr('src', '/backend/images/artikel/' + f.foto_video);
                $('.modal_pp').attr('src', '/backend/images/faces/' + f.profile_picture);
                $('.modal_pp').attr('title', f.name);
                $('#modal_subject').text(f.subject);
                $('#modal_description').html(f.description);
                $('#id-artikel').text(f.id_artikel);

                // untuk realtime komentar
                $(document).ready(function() {
                    selesay();
                })
            }
        });
    }

    function selesay() {
        const stop = setInterval(function() {
            update();
            // selesay();
        }, 2000);
        const tombol = document.getElementById('stop_interval');
        tombol.addEventListener('click', function() {
            clearInterval(stop);
            // alert('selesay');
        });
    }

    function update() {
        var ia = $('#id-artikel').text();
        $.ajax({
            url: '/jobseeker/koments',
            data: {
                data_koment: ia
            },
            method: 'get',
            dataType: 'json',
            success: function(g) {
                if (g != null) {
                    // console.log(g);
                    $('.ulang').remove();
                    for (var h = 0; h < g.length; h++) {
                        if (g[h].user_id == <?= user()->id ?>) {
                            $('#load_komentar').append(`
                                <div class="row mt-2 ulang">
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-12" style="text-align: right;">
                                                <h4>` + g[h].name + `</h4>
                                            </div>
                                            <div class="col-12" style="text-align: right;">
                                                <h5>` + g[h].comment + `</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <img style="border-radius: 50%;float: left;" width="40px" height="40px" src="/backend/images/faces/` + g[h].profile_picture + `" alt="">
                                    </div>
                                </div>
                            `)
                        } else {
                            $('#load_komentar').append(`
                                <div class="row mt-2 ulang">
                                    <div class="col-2 text-center">
                                        <img style="border-radius: 50%;float: right;" width="40px" height="40px" src="/backend/images/faces/` + g[h].profile_picture + `" alt="">
                                    </div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>` + g[h].name + `</h4>
                                            </div>
                                            <div class="col-12">
                                                <h5>` + g[h].comment + `</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)
                        }
                    };
                }
            }
        });
    }
</script>
@endsection