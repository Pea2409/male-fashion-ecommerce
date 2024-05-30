    <!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
      <div class="offcanvas__option">
        <div class="offcanvas__links">
          @if(session()->has('user'))
              <span class="text-light" >Hello, {{ session('user')->Fullname }}</span>
              <a href="{{ route('signout') }}" style="font-size: 15px; margin-left: 5px">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              </a>
            @else
            <a href="{{ route('signup') }}">Sign up</a>
            <a href="{{ route('login') }}">Login</a>
          @endif
        </div>
      </div>
      <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"
          ><img src="user/img/icon/search.png" alt=""
        /></a>
        <a href="#"><img src="user/img/icon/heart.png" alt="" /></a>
        <a href="#"><img src="user/img/icon/cart.png" alt="" /> <span>0</span></a>
        <div class="price">$0.00</div>
      </div>
      <div id="mobile-menu-wrap"></div>
      <div class="offcanvas__text">
        <p>Thank you for visiting my shop</p>
      </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-7">
              <div class="header__top__left">
                <p>Thank you for visiting my shop</p>
              </div>
            </div>
            
            <div class="col-lg-6 col-md-5">
              <div class="header__top__right">
                  <div class="header__top__links">
                      @if(session()->has('user'))
                          <span class="text-light" >Hello, {{ session('user')->Fullname }}</span>
                          <a href="{{ route('signout') }}" style="font-size: 15px; margin-left: 5px">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                          </a>
                      @else
                          <a href="{{ route('signup') }}">Sign up</a>
                          <a href="{{ route('login') }}">Login</a>
                      @endif
                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>
     
    </header>