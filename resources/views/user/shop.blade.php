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
              <a href="{{ route('index') }}"><img src="user/img/logo.png" alt="" /></a>
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
                ><img src="user/img/icon/user.png" alt="" /></a>
              <a href="{{ route('showcart') }}"
                ><img src="user/img/icon/cart.png" alt="" /> <span>{{ $orderCount }}</span>
                </a>
            </div>
          </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
      </div>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    @if (session()->has('message_type'))
        <div class="@if (session('message_type') === 'success') alert alert-success @else alert alert-danger @endif">
            {{ session('message') }}
        </div>
    @endif
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{route('searchProduct')}}" method="get">
                                <input type="text" name="query" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                               <ul class="nice-scroll">
                                                @foreach($categories as $item)
                                                    <li><a href="#"><?php for ($i = 0; $i < $item->level; $i++) { ?>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <?php } ?>
                                                        {{ $item->CategoryName }}</a></li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="#">0-500.000đ</a></li>
                                                    <li><a href="#">500.000đ-1.000.000đ</a></li>
                                                    <li><a href="#">1.000.000đ-2.500.000đ</a></li>
                                                    <li><a href="#">2.500.000đ-5.000.000đ</a></li>
                                                    <li><a href="#">5.000.000đ+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                 @foreach($sizes as $size)
                                                 <label for="{{$size->SizeName}}">{{$size->SizeName}}
                                                    <input type="radio" id="{{$size->SizeName}}">
                                                </label>
                                                 @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                @foreach($colors as $color)
                                                 <input type="radio" id="color{{ $color->ColorId }}" name="color" value="{{ $color->ColorId }}">
                                                <label for="color{{ $color->ColorId }}" style="background: {{ $color->ColorIllustration }};"></label>
                                                 @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">  
                        @foreach($data as $item)                    
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="/admin/upload/product/{{ $item->ProductPhoto }}">
                                    </div>
                                    <div class="product__item__text">
                                        <h6>{{ $item->ProductName }}</h6>
                                        <a href="{{ route('detail', $item->ProductId) }}" class="add-cart">Detail Product</a>
                                        <div class="rating">
                                            <i style="color: #FFBF00" class="fa fa-star"></i>
                                            <i style="color: #FFBF00" class="fa fa-star"></i>
                                            <i style="color: #FFBF00" class="fa fa-star"></i>
                                            <i style="color: #FFBF00" class="fa fa-star"></i>
                                            <i style="color: #FFBF00" class="fa fa-star"></i>
                                        </div>
                                        <h5>{{ number_format($item->Price, 0, ',', '.') }}đ</h5>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center product__pagination">
                                {{$data->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- Footer Section Begin -->
    @include ('user.layouts.MainFooter')
    <!-- Footer Section End -->

  </body>
</html>
