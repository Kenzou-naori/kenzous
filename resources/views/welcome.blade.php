@extends('template.base')

@section('content')
    <section id="banner" class="">

        <div class="sliders">
            <div class="slide_viewer">
                <div class="slide_group">
                    <div class="slide_banner" style="background-image: url('/storage/img/WEB_BENNER.png')">
                    </div>
                    <div class="slide_banner" style="background-image: url('/storage/img/WEB_BENNER1.png')">
                    </div>
                    <div class="slide_banner" style="background-image: url('/storage/img/WEB_PANJANG.png')">
                    </div>
                    <div class="slide_banner" style="background-image: url('/storage/img/WEBB.png')">
                    </div>
                </div>
                <div class="slide_buttons">
                </div>
            </div>
            <div class="directional_nav">
                <div class="previous_btn" title="Previous">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </div>
                <div class="next_btn" title="Next">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div><!-- End // .directional_nav -->
        </div><!-- End // .slider -->

    </section>


    <section id="display">
        <div class="display ">
            <svg class="editorial-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0
        58-18 88-18s
        58 18 88 18
        58-18 88-18
           58 18 88 18
           v44h-352z" />
                </defs>
                <g class="parallax1">
                    <use xlink:href="#gentle-wave" x="50" y="3" fill="#ddd5fe2d" />
                </g>
                <g class="parallax2">
                    <use xlink:href="#gentle-wave" x="50" y="0" fill="#4579e22d" />
                </g>
                <g class="parallax3">
                    <use xlink:href="#gentle-wave" x="50" y="9" fill="#3461c12d" />
                </g>
                <g class="parallax4">
                    <use xlink:href="#gentle-wave" x="50" y="6" fill="#4697e8b2" />
                </g>
            </svg>

            <div class="blog-slider container">
                <div class="blog-slider__wrp swiper-wrapper">
                    <div class="blog-slider__item swiper-slide">
                        <div class="blog-slider__img">

                            <img src="/storage/img/rs1_png_4_-removebg-preview.png" alt="">
                        </div>
                        <div class="blog-slider__content">

                            <div class="blog-slider__title">Kenzous Streering Wheel</div>
                            <div class="blog-slider__text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi
                                molestiae repellat dignissimos similique quisquam ex tempora aut earum possimus officiis
                                perferendis, rem omnis maxime ipsa laborum quis reiciendis ut numquam.</div>
                            <a href="#" class="blog-slider__button">READ MORE</a>
                        </div>
                    </div>
                    <div class="blog-slider__item swiper-slide">
                        <div class="blog-slider__img">

                            <img src="/storage/img/headset_gaming_sonata_mh90_-_fantech_-_2-removebg-preview (1).png"
                                alt="">
                        </div>
                        <div class="blog-slider__content">

                            <div class="blog-slider__title">Kenzous Headset Gaming</div>
                            <div class="blog-slider__text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi
                                molestiae repellat dignissimos similique quisquam ex tempora aut earum possimus officiis
                                perferendis, rem omnis maxime ipsa laborum quis reiciendis ut numquam.</div>
                            <a href="#" class="blog-slider__button">READ MORE</a>
                        </div>
                    </div>
                    <div class="blog-slider__item swiper-slide">
                        <div class="blog-slider__img">

                            <img src="/storage/img/mk882.png" alt="">
                        </div>
                        <div class="blog-slider__content">

                            <div class="blog-slider__title">Kenzous Keyboard Gaming</div>
                            <div class="blog-slider__text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi
                                molestiae repellat dignissimos similique quisquam ex tempora aut earum possimus officiis
                                perferendis, rem omnis maxime ipsa laborum quis reiciendis ut numquam.</div>
                            <a href="#" class="blog-slider__button">READ MORE</a>
                        </div>
                    </div>





                </div>
                <div class="blog-slider__pagination"></div>
            </div>
            <svg class="editorial-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0
           58-18 88-18s
           58 18 88 18
           58-18 88-18
           58 18 88 18
           v44h-352z" />
                </defs>
                <g class="parallax1">
                    <use xlink:href="#gentle-wave" x="50" y="3" fill="#ddd5fe2d" />
                </g>
                <g class="parallax2">
                    <use xlink:href="#gentle-wave" x="50" y="0" fill="#4579e22d" />
                </g>
                <g class="parallax3">
                    <use xlink:href="#gentle-wave" x="50" y="9" fill="#3461c12d" />
                </g>
                <g class="parallax4">
                    <use xlink:href="#gentle-wave" x="50" y="6" fill="#4697e8b2" />
                </g>
            </svg>
        </div>


    </section>


    <section class="container-sm" id="product">
        <div class="title-product">
            <h3>Weekly Recommendation</h3>
        </div>
        <div class="variable slider">

            @foreach ($products as $product)
                <div class="el-wrapper">
                    <div class="box-up">
                        <img class="img" src="{{ asset('/storage/storage/product/' . $product->image) }}  "
                            alt="" />
                        <div class="img-info">
                            <div class="info-inner">
                                <span class="p-company">{{ $product->category->category_name }}</span>
                                <span class="p-name">{{ $product->name }}</span>
                            </div>

                        </div>
                    </div>

                    <div class="box-down">
                        <div class="h-bg">
                            <div class="h-bg-inner"></div>
                        </div>

                        <a class="cart-button" href="/cart">
                            <span class="price">Rp.{{ number_format($product->price, 0, '.', '.') }},-</span>
                            <span class="add-to-cart">
                                <span class="txt">Add in cart</span>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container-sm" id="product">
        <div class="title-product">
            <h3>Weekly Recommendation</h3>
        </div>
        <div class="variable slider">

            @foreach ($products as $product)
                <div class="el-wrapper">
                    <div class="box-up">
                        <img class="img" src="{{ asset('/storage/storage/product/' . $product->image) }}"
                            alt="" />
                        <div class="img-info">
                            <div class="info-inner">
                                <span class="p-company">{{ $product->category->category_name }}</span>
                                <span class="p-name">{{ $product->name }}</span>
                            </div>

                        </div>
                    </div>

                    <div class="box-down">
                        <div class="h-bg">
                            <div class="h-bg-inner"></div>
                        </div>

                        <a class="cart-button" href="/cart">
                            <span class="price">Rp.{{ number_format($product->price, 0, '.', '.') }},-</span>
                            <span class="add-to-cart">
                                <span class="txt">Add in cart</span>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container-sm" id="product">
        <div class="title-product">
            <h3>Weekly Recommendation</h3>
        </div>
        <div class="variable slider">

            @foreach ($products as $product)
                <div class="el-wrapper">
                    <div class="box-up">
                        <img class="img" src="{{ asset('/storage/storage/product/' . $product->image) }}"
                            alt="" />
                        <div class="img-info">
                            <div class="info-inner">
                                <span class="p-company">{{ $product->category->category_name }}</span>
                                <span class="p-name">{{ $product->name }}</span>
                            </div>

                        </div>
                    </div>

                    <div class="box-down">
                        <div class="h-bg">
                            <div class="h-bg-inner"></div>
                        </div>

                        <a class="cart-button" href="/cart">
                            <span class="price">Rp.{{ number_format($product->price, 0, '.', '.') }},-</span>
                            <span class="add-to-cart">
                                <span class="txt">Add in cart</span>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <script src="{{ asset('JS/script.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        $('.sliders').each(function() {
            var $this = $(this);
            var $group = $this.find('.slide_group');
            var $slides = $this.find('.slide_banner');
            var bulletArray = [];
            var currentIndex = 0;
            var timeout;

            function move(newIndex) {
                var animateLeft, slideLeft;

                advance();

                if ($group.is(':animated') || currentIndex === newIndex) {
                    return;
                }

                bulletArray[currentIndex].removeClass('active');
                bulletArray[newIndex].addClass('active');

                if (newIndex > currentIndex) {
                    slideLeft = '100%';
                    animateLeft = '-100%';
                } else {
                    slideLeft = '-100%';
                    animateLeft = '100%';
                }

                $slides.eq(newIndex).css({
                    display: 'block',
                    left: slideLeft
                });
                $group.animate({
                    left: animateLeft
                }, function() {
                    $slides.eq(currentIndex).css({
                        display: 'none'
                    });
                    $slides.eq(newIndex).css({
                        left: 0
                    });
                    $group.css({
                        left: 0
                    });
                    currentIndex = newIndex;
                });
            }

            function advance() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    if (currentIndex < ($slides.length - 1)) {
                        move(currentIndex + 1);
                    } else {
                        move(0);
                    }
                }, 4000);
            }

            $('.next_btn').on('click', function() {
                if (currentIndex < ($slides.length - 1)) {
                    move(currentIndex + 1);
                } else {
                    move(0);
                }
            });

            $('.previous_btn').on('click', function() {
                if (currentIndex !== 0) {
                    move(currentIndex - 1);
                } else {
                    move(3);
                }
            });

            $.each($slides, function(index) {
                var $button = $('<a class="slide_btn">&bull;</a>');

                if (index === currentIndex) {
                    $button.addClass('active');
                }
                $button.on('click', function() {
                    move(index);
                }).appendTo('.slide_buttons');
                bulletArray.push($button);
            });

            advance();
        });
    </script>
    <script src="owlcarousel/owl.carousel.js"></script>
    <script>
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 5,
                },
            },
        });
    </script>
    <script src="JS/display.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"
        integrity="sha512-h5Vv+n+z0eRnlJoUlWMZ4PLQv4JfaCVtgU9TtRjNYuNltS5QCqi4D4eZn4UkzZZuG2p4VBz3YIlsB7A2NVrbww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $('.slider').slick({
            dots: true,
            infinite: true,
            speed: 600,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 3000,
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
    <script src="JS/banner.js"></script>
@endsection
