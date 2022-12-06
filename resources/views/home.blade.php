@extends('layouts.member.member')

@section('content-body')
    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article article-style-b" style="height: 750px;">
                    <div class="article-header" style="height: 550px;">
                        <div class="article-image" style="background-image: url({{ $product->image->url }});"></div>
{{--                        <div class="article-badge">--}}
{{--                            <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> Trending</div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="article-details">
                        <div class="article-title">
                            <h2><a href="{{ route('products.show', $product) }}" style="text-decoration: none;">{{ $product->name }}</a></h2>
                        </div>
                        <div class="article-title">
                            <h2><a style="color: #f57224;">Rp. {{ number_format($product->price, 0, ',', '.') }}</a></h2>
                        </div>
                        <p><i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;{{ $product->category->name }}</p>
                        <div>
                            <ul class="list-unstyled">
                                @if ($product->reviews->isNotEmpty())
                                    <li class="media">
                                        <div class="media-body">
                                            <span>
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star" @if ($i <= $product->average_review) style="color: darkorange;" @endif></i>
                                                @endfor
                                            </span>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    <h1 class="text text-center mt-5 pt-5 mb-5">Testimonial</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
{{--                    <h4>Caption</h4>--}}
                </div>
                <div class="card-body">
                    <style>
                        /* Slideshow container */
                        .slideshow-container {
                            position: relative;
                            background: #f1f1f1f1;
                        }

                        /* Slides */
                        .mySlides {
                            display: none;
                            padding: 80px;
                            text-align: center;
                        }

                        /* Next & previous buttons */
                        .prev, .next {
                            cursor: pointer;
                            position: absolute;
                            top: 50%;
                            width: auto;
                            margin-top: -30px;
                            padding: 16px;
                            color: #888;
                            font-weight: bold;
                            font-size: 20px;
                            border-radius: 0 3px 3px 0;
                            user-select: none;
                        }

                        /* Position the "next button" to the right */
                        .next {
                            position: absolute;
                            right: 0;
                            border-radius: 3px 0 0 3px;
                        }

                        /* On hover, add a black background color with a little bit see-through */
                        .prev:hover, .next:hover {
                            background-color: rgba(0,0,0,0.8);
                            color: white;
                        }

                        /* The dot/bullet/indicator container */
                        .dot-container {
                            text-align: center;
                            padding: 20px;
                            background: #ddd;
                        }

                        /* The dots/bullets/indicators */
                        .dot {
                            cursor: pointer;
                            height: 15px;
                            width: 15px;
                            margin: 0 2px;
                            background-color: #bbb;
                            border-radius: 50%;
                            display: inline-block;
                            transition: background-color 0.6s ease;
                        }

                        /* Add a background color to the active dot/circle */
                        .active, .dot:hover {
                            background-color: #717171;
                        }

                        /* Add an italic font style to all quotes */
                        q {font-style: italic;}

                        /* Add a blue color to the author */
                        .author {color: cornflowerblue;}

                        .testimonial-stars {
                            font-size: 17px;
                        }
                    </style>

                    <div class="slideshow-container">

                        @foreach($testimonials as $testimonial)
                            <div class="mySlides" style="font-size: 25px;">
                                <div class="mb-4">
                                    <img src="{{ $testimonial->user->avatar_url }}" class="rounded-circle" alt="" style="width: 150px; height: 150px;">
                                </div>
                                <q>{{ $testimonial->description }}</q>
                                <p class="author mt-5">- {{ $testimonial->censored_username }}</p>
                                <p>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star testimonial-stars" @if ($i <= $testimonial->star) style="color: darkorange;" @endif></i>
                                    @endfor
                                </p>
                            </div>
                        @endforeach

                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>

                    <div class="dot-container">
                        @foreach($testimonials as $testimonial)
                            <span class="dot" onclick="currentSlide({{ $loop->iteration }})"></span>
                        @endforeach
                    </div>

                    <script>
                        var slideIndex = 1;
                        showSlides(slideIndex);

                        function plusSlides(n) {
                            showSlides(slideIndex += n);
                        }

                        function currentSlide(n) {
                            showSlides(slideIndex = n);
                        }

                        function showSlides(n) {
                            var i;
                            var slides = document.getElementsByClassName("mySlides");
                            var dots = document.getElementsByClassName("dot");
                            if (n > slides.length) {slideIndex = 1}
                            if (n < 1) {slideIndex = slides.length}
                            for (i = 0; i < slides.length; i++) {
                                slides[i].style.display = "none";
                            }
                            for (i = 0; i < dots.length; i++) {
                                dots[i].className = dots[i].className.replace(" active", "");
                            }
                            slides[slideIndex-1].style.display = "block";
                            dots[slideIndex-1].className += " active";
                        }

                        var interval = setInterval(function () {
                            plusSlides(1);
                        }, 4000);
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
