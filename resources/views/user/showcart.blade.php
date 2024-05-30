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
                <li><a href="{{ route('shop') }}">Shop</a></li>
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
              <h4>Shopping Cart</h4>
              <div class="breadcrumb__links">
                <a href="{{ route('index') }}">Home</a>
                <a href="{{ route('shop') }}">Shop</a>
                <span>Shopping Cart</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="shopping__cart__table">
              <table>
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $item)
                  <tr>
                    <td class="product__cart__item">
                      <div class="product__cart__item__pic">
                        <img style="height: 100px;" src="/admin/upload/product/{{ $item->ProductPhoto }}" alt="" />
                      </div>
                      <div class="product__cart__item__text">
                        <h6>{{$item->ProductName}} <span>&nbsp; Size: {{$item->size->SizeName}} Màu: {{$item->color->ColorName}}</span></h6>
                        <h5>{{ number_format($item->SalePrice, 0, ',', '.') }}đ</h5>
                      </div>
                    </td>
                    <td class="quantity__item">
                      <div class="quantity">
                        <div class="pro-qty-2">
                          <input type="quantity" value="{{$item->Quantity}}" />
                        </div>
                      </div>
                    </td>
                    <td class="cart__price">
                      {{ number_format($item->SalePrice * $item->Quantity, 0, ',', '.') }}đ
                    <td class="cart__close">
                      <a href="{{route('delete_cart', $item->OrderId)}}"><i class="fa fa-close"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="continue__btn">
                  <a href="{{route('shop')}}">Continue Shopping</a>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="continue__btn update__btn">
                  <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="cart__discount">
              <h6>Discount codes</h6>
              <form action="#">
                <input type="text" placeholder="Coupon code" />
                <button type="submit">Apply</button>
              </form>
            </div>
            <div class="cart__total">
              <h6>Cart total</h6>
              <ul>
                <li>Total 
                  <?php $total= 0 ?>
                  @foreach($orders as $item)
                      <?php
                        $total += ($item->SalePrice * $item->Quantity); 
                      ?>
                  @endforeach
                   <span>{{ number_format($total, 0, ',', '.') }}đ</span>  
              </ul>
              <a href="#" class="primary-btn">Proceed to checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Footer Section Begin -->
    @include ('user.layouts.MainFooter')
    <!-- Footer Section End -->
  </body>
</html>
