@extends('frontend.template.frontend')

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Blog</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach ($artikels as $artikel)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="/backend/images/artikel/{{ $artikel->foto_video }}" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>{{ $artikel->updated_at->format('d') }}</h3>
                                    <p>{{ $artikel->updated_at->format('M') }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="/articel/{{ $artikel->id }}">
                                    <h2>{{ $artikel->subject }}</h2>
                                </a>
                                <p>{!! Str::words($artikel->description,20); !!}</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i>Kategori</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i>0 Komentar</a></li>
                                </ul>
                                <div class="navigation-top">
                                    <div class="d-sm-flex justify-content-between text-center">
                                       <div class="col-sm-4 text-center my-2 my-sm-0">
                                       </div>
                                       <ul class="social-icons d-flex">
                                          <li class="mr-2"><a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-facebook"></i></a></li>
                                          <li class="mr-2"><a href="https://twitter.com/intent/tweet?text=Share+this+post&url=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-twitter"></i></a></li>
                                          <li class="mr-2"><a href="https://www.linkedin.com/sharing/share-offsite/?mini=true&url=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-linkedin"></i></a></li>
                                          <li class="mr-2"><a href="https://telegram.me/share/url?url=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-telegram"></i></a></li>
                                          <li><a href="https://wa.me/?text=http://127.0.0.1:8000/articel/{{ $artikel->id }}"><i class="fa fa-whatsapp"></i></a></li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </article>
                        @endforeach

                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Resaurant food (37)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Travel news (10)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Modern technology (03)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Product (11)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Inspiration (21)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Health Care (09)</p>
                                    </a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
