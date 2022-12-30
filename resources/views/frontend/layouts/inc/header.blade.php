<!-- header-area start -->
<header class="header-area">
    <div class="header-top bg-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <ul class="d-flex header-contact">
                        <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                        <li><i class="fa fa-envelope"></i> youremail@gmail.com</li>
                    </ul>
                </div>
                <div class="col-md-6 col-12">
                    <ul class="d-flex account_login-area">
                        @php
                            $profile = \App\Models\Profile::where('user_id', Auth::id())->first();
                        @endphp
                        @auth()
                        <li>
                            @if ($profile)
                            <a href="javascript:void(0);"><img src="{{ asset('uploads/users') }}/{{ $profile->user_image }}"
                                class="img-fluid rounded-circle mr-2" alt="" style="width:20px; height:20px;"> My Account <i class="fa fa-angle-down"></i></a>
                            @else
                            <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                            @endif

                            <ul class="dropdown_style">

                                <li><a href="{{ route('profile.index') }}">profile Setting</a></li>
                                <li><a href="{{ route('shopping.card') }}">Cart</a></li>
                                <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                <li><a href="{{ route('wish.list') }}">wishlist</a></li>
                                <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @endauth
                        @guest()
                        <li><a href="{{ route('login.page') }}">Login</a></li>
                        <li><a href="{{ route('register.page') }}">Register</a></li>
                        @endguest

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="fluid-container">
            <div class="row">
                <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/frontend') }}/images/logo.png" alt="">
                    </a>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <nav class="mainmenu">
                        <ul class="d-flex">
                            <li class="active"><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li>
                                <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="{{ route('shop.page') }}">Shop Page</a></li>
                                    <li><a href="{{ route('shopping.card') }}">Shopping cart</a></li>
                                    <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                    <li><a href="{{ route('wish.list') }}">Wishlist</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Pages <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="{{ route('shopping.card') }}">Shopping cart</a></li>
                                    <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                    <li><a href="{{ route('wish.list') }}">Wishlist</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Blog <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="{{ route('blog.page') }}">blog Page</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                    <ul class="search-cart-wrapper d-flex">
                        <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                        <li>
                            @php
                                $numberOfCartProduct = \Gloudemans\Shoppingcart\Facades\Cart::count();
                            @endphp
                            @if ($numberOfCartProduct >= 1)
                            <a href="javascript:void(0);"><i class="flaticon-like"></i>
                                <span>{{ $numberOfCartProduct }}</span>
                            </a>
                            @else
                            <a href="javascript:void(0);"><i class="flaticon-like"></i>

                            </a>
                            @endif

                            <ul class="cart-wrap dropdown_style">
                                @php
                                    $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
                                    $total_price = \Gloudemans\Shoppingcart\Facades\Cart::subtotal();
                                @endphp
                                @foreach ($carts as $cart)
                                <li class="cart-items">
                                    <div class="cart-img">
                                        <img src="{{ asset('uploads/products') }}/{{ $cart->options->product_image }}" alt=""
                                        style="width: 60px; height: 60px;">
                                    </div>
                                    <div class="cart-content">
                                        <a href="{{ route('shopping.card') }}">{{ $cart->name }}</a>
                                        <span>QTY : {{ $cart->qty }}</span>
                                        <p>${{  $cart->price }}</p>
                                        <td class="remove">
                                            <a href="{{ route('remove_from.cart', ['cart_id' => $cart->rowId]) }}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </div>
                                </li>
                                @endforeach

                                <li>Subtotal: <span class="pull-right">${{ $total_price }}</span></li>
                                <a class="btn btn-danger w-100 mt-4" href="{{ route('checkout.page') }}">Checkout</a>
                            </ul>
                        </li>
                        <li>
                            @php
                                $numberOfCartProduct = \Gloudemans\Shoppingcart\Facades\Cart::count();
                            @endphp
                            @if ($numberOfCartProduct >= 1)
                            <a href="javascript:void(0);"><i class="flaticon-shop"></i>
                                <span>{{ $numberOfCartProduct }}</span>
                            </a>
                            @else
                            <a href="javascript:void(0);"><i class="flaticon-shop"></i>

                            </a>
                            @endif

                            <ul class="cart-wrap dropdown_style">
                                @php
                                    $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
                                    $total_price = \Gloudemans\Shoppingcart\Facades\Cart::subtotal();
                                @endphp
                                @foreach ($carts as $cart)
                                <li class="cart-items">
                                    <div class="cart-img">
                                        <img src="{{ asset('uploads/products') }}/{{ $cart->options->product_image }}" alt=""
                                        style="width: 60px; height: 60px;">
                                    </div>
                                    <div class="cart-content">
                                        <a href="{{ route('shopping.card') }}">{{ $cart->name }}</a>
                                        <span>QTY : {{ $cart->qty }}</span>
                                        <p>${{  $cart->price }}</p>
                                        <td class="remove">
                                            <a href="{{ route('remove_from.cart', ['cart_id' => $cart->rowId]) }}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </div>
                                </li>
                                @endforeach

                                <li>Subtotal: <span class="pull-right">${{ $total_price }}</span></li>
                                <a class="btn btn-danger w-100 mt-4" href="{{ route('checkout.page') }}">Checkout</a>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                    <div class="responsive-menu-tigger">
                        <a href="javascript:void(0);">
                    <span class="first"></span>
                    <span class="second"></span>
                    <span class="third"></span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- responsive-menu area start -->
        <div class="responsive-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-block d-lg-none">
                        <ul class="metismenu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li class="sidemenu-items">
                                <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('shop.page') }}">Shop Page</a></li>
                                    <li><a href="{{ route('shopping.card') }}">Shopping cart</a></li>
                                    <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                    <li><a href="{{ route('wish.list') }}">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items">
                                <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                                <ul aria-expanded="false">
                                  <li><a href="about.html">About Page</a></li>
                                  <li><a href="{{ route('shopping.card') }}">Shopping cart</a></li>
                                  <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                  <li><a href="{{ route('wish.list') }}">Wishlist</a></li>
                                  <li><a href="faq.html">FAQ</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items">
                                <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('blog.page') }}">Blog</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- responsive-menu area start -->
    </div>
</header>
<!-- header-area end -->
