@extends('frontend.layouts.master')

@section('frontendtitle') About Page @endsection

@section('frontend_content')
   @include('frontend.layouts.inc.breadcrumb', ['pagename' => 'About'])
     <!-- about-area start -->
     <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-wrap text-center">
                        <h3>Welcome Our Store! </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi hic amet repellendus assumenda voluptatem iste. In exercitationem aliquam eligendi sint quidem natus eum aliquid laboriosam id adipisci excepturi voluptas, eaque, doloribus corporis ducimus ut suscipit alias ad! Quidem vel sint quasi fugit officiis aliquam, provident suscipit veritatis sunt amet! Rem maxime amet quo laudantium deleniti quia ipsum delectus, nesciunt dignissimos debitis incidunt sed nisi earum cumque assumenda, voluptatibus, laborum harum perspiciatis ut magnam sunt. Facere, recusandae impedit. Nisi iste, officiis?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci nesciunt alias, commodi mollitia inventore sequi ea eveniet repellat ut eius, et architecto reiciendis sapiente, quas pariatur, soluta quod fugit id quae excepturi doloribus corporis eligendi cumque ipsum! Praesentium cum maxime unde ad repudiandae sed quisquam, numquam iusto, odio voluptatem facere. Saepe, ipsam deleniti, aliquid sequi nihil nisi dolores obcaecati odit eaque repellendus voluptas, minima velit. Quibusdam eos, laboriosam doloremque ut.</p>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam doloremque optio accusantium, hic mollitia, quas ex molestiae, explicabo ratione est maiores dignissimos blanditiis quo aut sint id rerum ea laudantium placeat veniam maxime reiciendis. Deserunt rerum, quibusdam, repellendus mollitia deleniti itaque! Porro delectus quod, rem veniam nesciunt expedita distinctio officia optio minus officiis qui voluptatem nostrum explicabo quasi rerum quos repellat inventore quaerat fugit ad cum excepturi harum itaque. Harum, molestias odit dolores quos velit voluptatem dolor architecto corrupti vero.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about-area end -->
    <!-- best-seller product-area start -->
<div class="product-area product-area-2">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Best Seller</h2>
                    <img src="{{ asset('assets/frontend') }}/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @foreach ($bestSellers as $bestSeller)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <img src="{{ asset('uploads/products') }}/{{ $bestSeller->product->product_image }}" alt="">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{ route('single.product', ['slug' => $bestSeller->product->slug]) }}"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="single-product.html">{{ $bestSeller->product->name }}</a></h3>
                        <p class="pull-left">${{ $bestSeller->product->product_price }}</p>
                        <ul class="pull-right d-flex">
                            @for ($i = 0; $i < $bestSeller->product->product_rating; $i++ )
                            <li><i class="fa fa-star"></i></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </li>
            @endforeach
            {{-- <div class="col-12 text-center d-flex justify-content-center">
                <div class="py-3">
                    {{ $bestSellers->links() }}
                </div>
            </div> --}}

        </ul>
    </div>
</div>
<!-- best-seller product-area end -->
@endsection
