<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.1.3/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/display.css') }}" />
    <link rel="stylesheet" href="{{ asset('CSS/store.css') }}" />
    <link rel="stylesheet" href="{{ asset('CSS/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('CSS/logres.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <link rel="shortcut icon" href="/storage/img/kenzou.png" type="image/x-icon">

    <title>Kenzou</title>
</head>
    <body>
@guest



        <nav class="nav">
            <i class="uil uil-bars navOpenBtn"></i>

            <ul class="nav-links">
                <i class="uil uil-times navCloseBtn"></i>
                <li><a href="/">HOME</a></li>
                <li><a href="/about">ABOUT</a></li>
                <li><a href="/shop">STORE</a></li>
            </ul>

            <div class="logo">
                <a href="/" class="logo"><img src="/storage/img/logo.png" alt="" /></a>
            </div>

            <div class="action">
                <i class="uil uil-search search-icon" id="searchIcon"></i>
                <form action="{{ route('shop') }}" class="search-box">
                   <i class="uil uil-search search-icon"></i>
                    <input id="search" type="text" name="search" aria-label="Product Name"
                        aria-describedby="button-search">

                </form>

                {{-- <i class="uil uil-search search-icon" id="searchIcon"></i>
                <form action="">
                <div class="search-box">

                <i class="uil uil-search search-icon"></i>
                <input id="search" type="text" name="search" aria-label="Product Name"
                aria-describedby="button-search">
            </div>
            </form> --}}
                <div class="account">
                    <div class="profile" onclick="menuToggle();">
                        <i class='bx bxs-user-circle'></i>
                    </div>
                    <div class="menu">

                        <ul>
                            {{-- <li><i class="uil uil-shopping-cart"></i><a href="">Cart</a></li> --}}
                            <li><i class="uil uil-signin"></i><a href="/login">Sign In</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
@else
@can('isUser')


        <nav class="nav">
            <i class="uil uil-bars navOpenBtn"></i>

            <ul class="nav-links">
                <i class="uil uil-times navCloseBtn"></i>
                <li><a href="/">HOME</a></li>
                <li><a href="/about">ABOUT</a></li>
                <li><a href="/shop">STORE</a></li>
            </ul>

            <div class="logo">
                <a href="/" class="logo"><img src="/storage/img/logo.png" alt="" /></a>
            </div>

            <div class="action">
                <i class="uil uil-search search-icon" id="searchIcon"></i>

                <div class="search-box">
                    <i class="uil uil-search search-icon"></i>
                    <form action="/shop">
                        <input type="text" placeholder="Search here..." name="search"/>
                    </form>
                    </div>

                <div class="account">
                    <div class="profile" onclick="menuToggle();">
                        <img src="{{ Auth::user()->image }}" draggable="false" />
                    </div>
                    <div class="menu">


                        <h3>{{ Auth ::user()->name }} <br /><span>{{ Auth ::user()->email }}</span></h3>

                        <ul>
                            {{-- <li><i class="uil uil-user-circle"></i><a href="">Profile</a></li> --}}
                            <li><i class="uil uil-shopping-cart"></i><a href="/cart">Cart</a></li>

                            <li><i class="uil uil-signout"></i><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}</a></li>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                    </div>
                </div>
            </div>
        </nav>
@elsecan('isAdmin')
<nav class="nav">
    <i class="uil uil-bars navOpenBtn"></i>

    <ul class="nav-links">
        <i class="uil uil-times navCloseBtn"></i>
        <li><a href="/">ADMIN</a></li>
        <li><a href="/about">ABOUT</a></li>
        <li><a href="/shop">STORE</a></li>
    </ul>

    <div class="logo">
        <a href="/" class="logo"><img src="/storage/img/logo.png" alt="" /></a>
    </div>

    <div class="action">
        <i class="uil uil-search search-icon" id="searchIcon"></i>

        <div class="search-box">
            <i class="uil uil-search search-icon"></i>
            <form action="/shop">
                <input type="text" placeholder="Search here..." name="search"/>
            </form>
            </div>

        <div class="account">
            <div class="profile" onclick="menuToggle();">
                <img src="{{ Auth::user()->image }}" draggable="false" />
            </div>
            <div class="menu">


                <h3>{{ Auth ::user()->name }} <br /><span>{{ Auth ::user()->email }}</span></h3>

                <ul>
                    {{-- <li><i class="uil uil-user-circle"></i><a href="">Profile</a></li> --}}


                    <li><i class="uil uil-signout"></i><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}</a></li>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
            </div>
        </div>
    </div>
</nav>
@endcan
@endguest
        @yield('content')
</div>


        <footer class="footer">

            <div class="footer__addr">
              <img src="/storage/img/Logo-white.png" class="footer__logo">

              <h2>Contact</h2>

              <address>
                Alam Tirta Lestari Jl.Flamboyan F4/17<br>

                <a class="footer__btn" href="mailto:example@gmail.com">Email Us</a>
              </address>
            </div>

            <ul class="footer__nav">

              <li class="nav__item">
                <h2 class="nav__title">Media</h2>

                <ul class="nav__ul">
                  <li>
                    <a href="#">Online</a>
                  </li>

                  <li>
                    <a href="#">Print</a>
                  </li>

                  <li>
                    <a href="#">Alternative Ads</a>
                  </li>
                </ul>
              </li>
              <li class="nav__item">
                <h2 class="nav__title">Legal</h2>

                <ul class="nav__ul">
                  <li>
                    <a href="#">Privacy Policy</a>
                  </li>

                  <li>
                    <a href="#">Terms of Use</a>
                  </li>

                  <li>
                    <a href="#">Sitemap</a>
                  </li>
                </ul>
              </li>
              <div class="social-buttons">
                <a href="https://www.facebook.com/naufal.m.z.52/" class="social-button social-button--facebook" aria-label="Facebook">
                    <i class="uil uil-facebook-f"></i>
                </a>
                <a href="#" class="social-button social-button--linkedin" aria-label="LinkedIn">
                    <i class="uil uil-linkedin-alt"></i>
                </a>
                <a href="https://www.instagram.com/naufalkenzou/" class="social-button social-button--instagram" aria-label="Instagram">
                    <i class="uil uil-instagram"></i>
                </a>
                <a href="https://github.com/Kenzou-naori" class="social-button social-button--github" aria-label="GitHub">
                    <i class="uil uil-github"></i>
                </a>
                <div class="quote">
                    <span>#GEARUP</span>
                    <span>ANDWIN</span>
                </div>
              </div>

            </ul>

            <div class="legal">
              <p>&copy; 2023 Copyright. All rights reserved.</p>

              <div class="legal__links">
                <span>Made with <span class="heart">💝</span> remotely from Anywhere</span>
              </div>
            </div>

          </footer>
        </body>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
          <script src="/JS/script.js" type="text/javascript"></script>
        <script src="/JS/display.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"
    integrity="sha512-h5Vv+n+z0eRnlJoUlWMZ4PLQv4JfaCVtgU9TtRjNYuNltS5QCqi4D4eZn4UkzZZuG2p4VBz3YIlsB7A2NVrbww=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>


<script>
    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
<script>
    function menuToggle() {
        const toggleMenu = document.querySelector(".menu");
        toggleMenu.classList.toggle("open");
    }
</script>

