@extends('frontend.template.frontend')

@section('content')
    <!-- bradcam_area  -->
  <div class="bradcam_area bradcam_bg_1">
      <div class="container">
          <div class="row">
              <div class="col-xl-12">
                  <div class="bradcam_text">
                      <h3>single blog</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--/ bradcam_area  -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="/backend/images/artikel/{{ $artikel->foto_video }}" alt="" width="100%">
                  </div>
                  <div class="blog_details">
                     <h2>{{ $artikel->subject }}
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><i class="fa fa-user"></i>{{ $artikel->created_at }}</li>
                        <li><a href="#comment"><i class="fa fa-comments"></i>0 Comment</a></li>
                     </ul>
                     <div class="excert">
                        {!! $artikel->description !!}
                     </div>
                  </div>
               </div>
               <div class="navigation-top">
                  <div class="d-sm-flex justify-content-between text-center">
                     <div class="col-sm-4 text-center my-2 my-sm-0">
                        <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                     </div>
                     <ul class="social-icons">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?text=Share+this+post&url=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/sharing/share-offsite/?mini=true&url=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://telegram.me/share/url?url=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-telegram"></i></a></li>
                        <li><a href="https://wa.me/?text=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-whatsapp"></i></a></li>
                     </ul>
                  </div>
                  <div class="navigation-area">
                     <div class="row">
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                           @if($artikel_sebelumnya != null)
                           <div class="thumb">
                              <a href="/articel/{{ $artikel_sebelumnya->id }}">
                                 <img class="img-fluid" src="/backend/images/artikel/{{ $artikel_sebelumnya->foto_video }}" alt="" style="width: 60px; height:60px; object-fit:cover;">
                              </a>
                           </div>
                           <div class="arrow">
                              <a href="/articel/{{ $artikel_sebelumnya->id }}">
                                 <span class="lnr text-white ti-arrow-left"></span>
                              </a>
                           </div>
                           <div class="detials">
                              <p>Prev Post</p>
                              <a href="/articel/{{ $artikel_sebelumnya->id }}">
                                 <h4>{{ $artikel_sebelumnya->subject }}</h4>
                              </a>
                           </div>
                           @endif
                        </div>
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                           @if($artikel_setelahnya != null)
                           <div class="detials">
                              <p>Next Post</p>
                              <a href="/articel/{{ $artikel_setelahnya->id }}">
                                 <h4>{{ $artikel_setelahnya->subject }}</h4>
                              </a>
                           </div>
                           <div class="arrow">
                              <a href="/articel/{{ $artikel_setelahnya->id }}">
                                 <span class="lnr text-white ti-arrow-right"></span>
                              </a>
                           </div>
                           <div class="thumb">
                              <a href="/articel/{{ $artikel_setelahnya->id }}">
                                 <img class="img-fluid" src="/backend/images/artikel/{{ $artikel_setelahnya->foto_video }}" alt="" style="width: 60px; height:60px; object-fit:cover;">
                              </a>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               <div class="blog-author">
                  <div class="media align-items-center">
                     <img src="/backend/images/faces/{{ $artikel->user->jobseekerDetail->profile_picture }}" alt="" style="object-fit: cover">
                     <div class="media-body">
                        <a href="#">
                           <h4>{{ $artikel->user->name }}</h4>
                        </a>
                        <p>{{ $artikel->user->jobseekerDetail->bio }}</p>
                     </div>
                  </div>
               </div>
               <div class="comments-area" id="comment">
                  <h4>0 Comments</h4>
                  @foreach ($komentars as $komentar)
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="/backend/images/faces/{{ $komentar->user->jobseekerDetail->profile_picture }}" alt="" style="width:70px; height:70px; object-fit:cover;">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 {{ $komentar->comment }}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{ $komentar->user->name }}</a>
                                    </h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                 </div>
                                 <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <div class="follow">
                     <h4>Follow Us On</h4>
                     <div class="row">
                        <div class="col-6 mb-3">
                              <a href="https://www.youtube.com/c/LokerProgrammer" class="btn btn-danger w-100">
                                 <i class="fa fa-youtube text-light"></i>
                                 <span class="text-light ml-2">Youtube</span>
                              </a>
                        </div>
                        <div class="col-6 mb-3">
                              <a href="https://www.instagram.com/loker.programmer/" class="btn btn-danger w-100" style="background-color: #AF1975!important">
                                 <i class="fa fa-instagram text-light"></i>
                                 <span class="text-light ml-2">Instagram</span>
                              </a>
                        </div>
                     </div> 
                  </div>
                  <div class="postingan mt-3">
                     <h4>Latest Post</h4>
                     @foreach ($latest_post as $post)
                     <div class="card mb-3">
                        <div class="card-header">
                           {{ $post->subject }}
                        </div>
                        <div class="card-body">
                           <div class="image">
                              <img src="/backend/images/artikel/{{ $post->foto_video }}" alt="" width="100%" class="rounded" style="max-height: 200px; object-fit:cover">
                           </div>
                           <div class="teks">
                              {!! Str::words($artikel->description,20); !!}
                           </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                           <a href="/artikel/{{ $post->id }}" class="btn btn-primary ms-auto" style="color: white!important">Read More</a>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
           </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
@endsection
