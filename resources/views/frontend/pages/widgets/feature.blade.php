<!-- featured-area start -->
<div class="featured-area featured-area2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="featured-active2 owl-carousel next-prev-style">
                    @foreach ($categories as $categorie)
                    <div class="featured-wrap">
                        <div class="featured-img">
                            <img src="{{ asset('uploads/categories') }}/{{ $categorie->category_image }}" alt="">
                            <div class="featured-content">
                                <a href="{{ route('shop.page') }}">{{ $categorie->title }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!-- featured-area end -->
