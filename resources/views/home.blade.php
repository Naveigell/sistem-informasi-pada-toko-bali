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
@endsection
