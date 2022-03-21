@extends('layouts.fe')

@section('title')
    Products - Online Store
@endsection

@section('content')
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>All Product</h4>
                </div>
            </div>

        </div>
        <div class="row property__gallery">
            @foreach ($products as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="product__item">
                    <a href="{{ route('detail', $item->slug) }}">
                        <img src="{{ Storage::url($item->cover) }}" class="product__item__pic set-bg" data-setbg="{{ Storage::url($item->cover) }}">
                    </a>

                        <ul class="product__hover">
                            <li><a href="{{ Storage::url($item->cover) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>

                    <div class="product__item__text">
                        <h6><a href="#">Buttons tweed blazer</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->


@endsection
