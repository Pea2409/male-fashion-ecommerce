<!DOCTYPE html>
<html lang="zxx">
  @include ('user.layouts.meta')

  <body>
    <!-- Header Section Begin -->
    @include ('user.layouts.MainHeader')
    <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3">
            <div class="header__logo">
              <a href="{{ route('index') }}"><img src="/user/img/logo.png" alt="" /></a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <nav class="header__menu mobile-menu">
              <ul>
                <li ><a href="{{ route('index') }}">Home</a></li>
                <li class="active"><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li ><a href="{{ route('contact') }}">Contacts</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="header__nav__option">
              <a href="#" 
                ><img src="/user/img/icon/user.png" alt="" /></a>
              <a href="{{ route('showcart') }}"
                ><img src="/user/img/icon/cart.png" alt="" /> <span>{{ $orderCount }}</span>
                </a>
            </div>
          </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
    <!-- Header Section End -->

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
      <div class="product__details__pic">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="product__details__breadcrumb">
                <a href="{{ route('index') }}">Home</a>
                <a href="{{ route('shop') }}">Shop</a>
                <span>Product Details</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-3">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    data-toggle="tab"
                    href="#tabs-1"
                    role="tab"
                  >
                        <div
                            class="product__thumb__pic set-bg"
                            data-setbg="/admin/upload/product/{{$product->ProductPhoto}}"
                        ></div>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6 col-md-9">
              <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                  <div class="product__details__pic__item">
                    <img style="height: 500px" 
                    src="/admin/upload/product/{{$product->ProductPhoto}}" alt="" />
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="product__details__content">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <div class="product__details__text">
                <form action="{{ route('add_cart', $product->ProductId) }}" method="post">
                  @csrf
                    
                <h4>{{$product->ProductName}}</h4>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <span> - 5 Reviews</span>
                </div>
                <h3>{{ number_format($product->Price, 0, ',', '.') }}đ</h3>
                <p>
                  {{$product->ProductDescription}}
                </p>
                <div class="product__details__option">
                  <div class="product__details__option__size">
                    <span>Size:</span>
                     @foreach($sizes as $size)
                      <label
                      >{{$size->SizeName}}
                      <input type="radio" name="size" value="{{$size->SizeId}}" />
                    </label>
                    @endforeach
                    
                  </div>
                  <div class="product__details__option__color">
                    <span>Color:</span>
                    @foreach($colors as $color)
                        <input type="radio" id="color{{ $color->ColorId }}" name="color" value="{{ $color->ColorId }}">
                        <label for="color{{ $color->ColorId }}" style="background: {{ $color->ColorIllustration }};"></label>
                    @endforeach
                </div>
                </div>
                <div class="product__details__cart__option">
                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" name="quantity" value="1" />
                    </div>
                  </div>
                  <input type="submit" class="primary-btn" value="Add to cart">
                </div>
                </form>
              </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="product__details__tab">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      data-toggle="tab"
                      href="#tabs-5"
                      role="tab"
                      >Description</a
                    >
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tabs-5" role="tabpanel">
                    <div class="product__details__tab__content">
                      <p class="note">
                        Nam tempus turpis at metus scelerisque placerat nulla
                        deumantos solicitud felis. Pellentesque diam dolor,
                        elementum etos lobortis des mollis ut risus. Sedcus
                        faucibus an sullamcorper mattis drostique des commodo
                        pharetras loremos.
                      </p>
                      <div class="product__details__tab__content__item">
                        <h5>Products Infomation</h5>
                        <p>
                          A Pocket PC is a handheld computer, which features
                          many of the same capabilities as a modern PC. These
                          handy little devices allow individuals to retrieve and
                          store e-mail messages, create a contact file,
                          coordinate appointments, surf the internet, exchange
                          text messages and more. Every product that is labeled
                          as a Pocket PC must be accompanied with specific
                          software to operate the unit and must feature a
                          touchscreen and touchpad.
                        </p>
                        <p>
                          As is the case with any new technology product, the
                          cost of a Pocket PC was substantial during it’s early
                          release. For approximately $700.00, consumers could
                          purchase one of top-of-the-line Pocket PCs in 2003.
                          These days, customers are finding that prices have
                          become much more reasonable now that the newness is
                          wearing off. For approximately $350.00, a new Pocket
                          PC can now be purchased.
                        </p>
                      </div>
                      <div class="product__details__tab__content__item">
                        <h5>Material used</h5>
                        <p>
                          Polyester is deemed lower quality due to its none
                          natural quality’s. Made from synthetic materials, not
                          natural like wool. Polyester suits become creased
                          easily and are known for not being breathable.
                          Polyester suits tend to have a shine to them compared
                          to wool and cotton suits, this can make the suit look
                          cheap. The texture of velvet is luxurious and
                          breathable. Velvet is a great choice for dinner party
                          jacket and can be worn all year round.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tabs-6" role="tabpanel">
                    <div class="product__details__tab__content">
                      <div class="product__details__tab__content__item">
                        <h5>Products Infomation</h5>
                        <p>
                          A Pocket PC is a handheld computer, which features
                          many of the same capabilities as a modern PC. These
                          handy little devices allow individuals to retrieve and
                          store e-mail messages, create a contact file,
                          coordinate appointments, surf the internet, exchange
                          text messages and more. Every product that is labeled
                          as a Pocket PC must be accompanied with specific
                          software to operate the unit and must feature a
                          touchscreen and touchpad.
                        </p>
                        <p>
                          As is the case with any new technology product, the
                          cost of a Pocket PC was substantial during it’s early
                          release. For approximately $700.00, consumers could
                          purchase one of top-of-the-line Pocket PCs in 2003.
                          These days, customers are finding that prices have
                          become much more reasonable now that the newness is
                          wearing off. For approximately $350.00, a new Pocket
                          PC can now be purchased.
                        </p>
                      </div>
                      <div class="product__details__tab__content__item">
                        <h5>Material used</h5>
                        <p>
                          Polyester is deemed lower quality due to its none
                          natural quality’s. Made from synthetic materials, not
                          natural like wool. Polyester suits become creased
                          easily and are known for not being breathable.
                          Polyester suits tend to have a shine to them compared
                          to wool and cotton suits, this can make the suit look
                          cheap. The texture of velvet is luxurious and
                          breathable. Velvet is a great choice for dinner party
                          jacket and can be worn all year round.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tabs-7" role="tabpanel">
                    <div class="product__details__tab__content">
                      <p class="note">
                        Nam tempus turpis at metus scelerisque placerat nulla
                        deumantos solicitud felis. Pellentesque diam dolor,
                        elementum etos lobortis des mollis ut risus. Sedcus
                        faucibus an sullamcorper mattis drostique des commodo
                        pharetras loremos.
                      </p>
                      <div class="product__details__tab__content__item">
                        <h5>Products Infomation</h5>
                        <p>
                          A Pocket PC is a handheld computer, which features
                          many of the same capabilities as a modern PC. These
                          handy little devices allow individuals to retrieve and
                          store e-mail messages, create a contact file,
                          coordinate appointments, surf the internet, exchange
                          text messages and more. Every product that is labeled
                          as a Pocket PC must be accompanied with specific
                          software to operate the unit and must feature a
                          touchscreen and touchpad.
                        </p>
                        <p>
                          As is the case with any new technology product, the
                          cost of a Pocket PC was substantial during it’s early
                          release. For approximately $700.00, consumers could
                          purchase one of top-of-the-line Pocket PCs in 2003.
                          These days, customers are finding that prices have
                          become much more reasonable now that the newness is
                          wearing off. For approximately $350.00, a new Pocket
                          PC can now be purchased.
                        </p>
                      </div>
                      <div class="product__details__tab__content__item">
                        <h5>Material used</h5>
                        <p>
                          Polyester is deemed lower quality due to its none
                          natural quality’s. Made from synthetic materials, not
                          natural like wool. Polyester suits become creased
                          easily and are known for not being breathable.
                          Polyester suits tend to have a shine to them compared
                          to wool and cotton suits, this can make the suit look
                          cheap. The texture of velvet is luxurious and
                          breathable. Velvet is a great choice for dinner party
                          jacket and can be worn all year round.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
      <div class="container">
      </div>
    </section>
    <!-- Related Section End -->

    <!-- Footer Section Begin -->
    @include ('user.layouts.MainFooter')
    <!-- Footer Section End -->
  </body>
</html>
