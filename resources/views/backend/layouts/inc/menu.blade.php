<!-- Menu Start -->
<div class="menu-container flex-grow-1">
    <ul id="menu" class="menu">
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <i data-cs-icon="shop" class="icon" data-cs-size="18"></i>
          <span class="label">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#categorie" data-href="#">
            <i class="fas fa-vector-square"></i> <span class="label ms-2">Categories</span>
        </a>
        <ul id="categorie">
            <li>
                <a href="{{ route('category.index') }}">
                    <span class="label">Category List</span>
                </a>
            </li>
            <li>
                <a href="{{ route('category.create') }}">
                    <span class="label">Create New Category</span>
                </a>
            </li>
        </ul>
      </li>
      <li>
        <a href="#testimonial" data-href="#">
            <i class="fas fa-comments"></i> <span class="label ms-2">Testimonials</span>
        </a>
        <ul id="testimonial">
            <li>
                <a href="{{ route('testimonial.index') }}">
                    <span class="label">Testimonial List</span>
                </a>
            </li>
            <li>
                <a href="{{ route('testimonial.create') }}">
                    <span class="label">Create New Testimonial</span>
                </a>
            </li>
        </ul>
      </li>
      <li>
        <a href="#products" data-href="#">
            <i class="fab fa-product-hunt"></i> <span class="label ms-2">Products</span>
        </a>
        <ul id="products">
            <li>
                <a href="{{ route('product.index') }}">
                    <span class="label">Product List</span>
                </a>
            </li>
            <li>
                <a href="{{ route('product.create') }}">
                    <span class="label">Create New Product</span>
                </a>
            </li>
        </ul>
      </li>
      <li>
        <a href="#cupons" data-href="#">
            <i class="fas fa-tag"></i> <span class="label ms-2">Coupons</span>
        </a>
        <ul id="cupons">
          <li>
            <a href="{{ route('coupon.index') }}">
              <span class="label">Coupon List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('coupon.create') }}">
              <span class="label">Create New Coupon</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#orders" data-href="{{ route('order.list') }}">
          <i data-cs-icon="cart" class="icon" data-cs-size="18"></i>
          <span class="label">Orders</span>
        </a>
        <ul id="orders">
          <li>
            <a href="{{ route('order.list') }}">
              <span class="label">List</span>
            </a>
          </li>
          <li>
            <a href="Orders.Detail.html">
              <span class="label">Detail</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#customers" data-href="{{ route('customer.list') }}">
          <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
          <span class="label">Customers</span>
        </a>
        <ul id="customers">
          <li>
            <a href="{{ route('customer.list') }}">
              <span class="label">List</span>
            </a>
          </li>
          <li>
            <a href="Customers.Detail.html">
              <span class="label">Detail</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#postcomments" data-href="{{ route('post_comment.index') }}">
            <i class="fas fa-comment"></i> <span class="label ms-2">Comments</span>
        </a>
        <ul id="postcomments">
          <li>
            <a href="{{ route('post_comment.index') }}">
              <span class="label">List</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="label">Detail</span>
            </a>
          </li>
        </ul>
    </li>
    <li>
        <a href="#blogs" data-href="#">
            <i class="fas fa-blog"></i>
          <span class="label">Blogs</span>
        </a>
        <ul id="blogs">
            <li>
                <a href="#post_category" data-href="#">
                    <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                    <span class="label">Post Category</span>
                  </a>
                <ul id="post_category">
                    <li>
                        <a href="{{ route('post_category.index') }}">
                            <span class="label">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="label">Create New</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#post_subcategory" data-href="#">
                    <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                    <span class="label">Post Subcategory</span>
                  </a>
                <ul id="post_subcategory">
                    <li>
                        <a href="{{ route('post_subcategory.index') }}">
                            <span class="label">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="label">Create New</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#post" data-href="#">
                    <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                    <span class="label">Blog Post</span>
                  </a>
                <ul id="post">
                    <li>
                        <a href="{{ route('post.index') }}">
                            <span class="label">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="label">Create New Post</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>
        <a href="#messages" data-href="#">
            <i class="fas fa-envelope"></i> <span class="label ms-2">Message</span>
        </a>
        <ul id="messages">
            <li>
                <a href="{{ route('message.index') }}">
                    <span class="label">Message List</span>
                </a>
            </li>
            <li>
                <a href="">
                    <span class="label">Comming Soon</span>
                </a>
            </li>
        </ul>
    </li>
      <li>
        <a href="#storefront" data-href="Storefront.html">
          <i data-cs-icon="screen" class="icon" data-cs-size="18"></i>
          <span class="label">Storefront</span>
        </a>
        <ul id="storefront">
          <li>
            <a href="Storefront.Home.html">
              <span class="label">Home</span>
            </a>
          </li>
          <li>
            <a href="Storefront.Filters.html">
              <span class="label">Filters</span>
            </a>
          </li>
          <li>
            <a href="Storefront.Categories.html">
              <span class="label">Categories</span>
            </a>
          </li>
          <li>
            <a href="Storefront.Detail.html">
              <span class="label">Detail</span>
            </a>
          </li>
          <li>
            <a href="Storefront.Cart.html">
              <span class="label">Cart</span>
            </a>
          </li>
          <li>
            <a href="Storefront.Checkout.html">
              <span class="label">Checkout</span>
            </a>
          </li>
          <li>
            <a href="Storefront.Invoice.html">
              <span class="label">Invoice</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="Shipping.html">
          <i data-cs-icon="shipping" class="icon" data-cs-size="18"></i>
          <span class="label">Shipping</span>
        </a>
      </li>
      <li>
        <a href="Discount.html">
          <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
          <span class="label">Discount</span>
        </a>
      </li>
      <li>
        <a href="Settings.html">
          <i data-cs-icon="gear" class="icon" data-cs-size="18"></i>
          <span class="label">Settings</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- Menu End -->
