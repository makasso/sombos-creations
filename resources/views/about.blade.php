@extends('layouts.main')
@section('title', 'About Us')
@section('meta_description', 'Learn about Sombos Creations — our mission to bring authentic African fashion to the world. Dresses, jewelry, accessories crafted with passion.')
@section('og_title', 'About Us — Sombos Creations')
@section('og_description', 'Our mission is to bring authentic African fashion to the world. Dresses, jewelry, accessories crafted with passion.')

@section('content')
    <section class="tf-slideshow about-us-page position-relative">
        <div class="banner-wrapper">
            <img class=" ls-is-cached lazyloaded" src="images/slider/about-banner-01.jpg" data-src="images/slider/about-banner-01.jpg" alt="image-collection">
            <div class="box-content text-center">
                <div class="container">
                    <div class="text text-white">Achieve Your Fitness Goals,  <br class="d-xl-block d-none"> Embrace African Elegance!</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Story Section -->
    <section class="about-story">
        <div class="container">
            <!-- Intro -->
            <div class="about-intro text-center">
                <span class="about-label">Who We Are</span>
                <h2 class="about-headline">We are Sombos Creations</h2>
                <p class="about-subtext">
                    Welcome to Sombo's Creations — where timeless African elegance meets contemporary fashion, offering a curated selection of clothing, jewelry, and accessories that embody the beauty and diversity of Africa.
                </p>
                <div class="about-divider"></div>
            </div>

            <!-- Story Block: Image Left, Text Right -->
            <div class="about-block">
                <div class="about-block-image">
                    <img src="{{ asset('images/about.png') }}" alt="Sombos Creations founder">
                    <span class="about-image-tag">Est. 2015</span>
                </div>
                <div class="about-block-content">
                    <span class="about-label">Our Story</span>
                    <h3>A Legacy of African Elegance</h3>
                    <p>Founded in 2015 by Brenda, Sombo's Creations was born from a deep love for fashion and a passion for preserving the beauty of African style. Brenda has always been drawn to classic pieces that could be worn season after season, while still making a bold and meaningful statement.</p>
                    <p>With a vision to fill the gap in the market, Brenda created a brand dedicated to authentic African clothing and accessories that celebrate culture. Today, Sombo's Creations continues to grow, staying true to its mission of bringing timeless African fashion to women everywhere.</p>
                    <blockquote class="about-quote">"We believe fashion is more than clothing — it is a reflection of who you are."</blockquote>
                </div>
            </div>

            <!-- Mission Block: Text Left, Image Right -->
            <div class="about-block">
                <div class="about-block-content">
                    <span class="about-label">Our Mission</span>
                    <h3>Empowering Through Fashion</h3>
                    <p>At <strong>Sombo's Creations</strong>, our mission is to celebrate and promote African culture through fashion and design. We are dedicated to creating elegant, high-quality pieces that empower women to embrace their confidence and God-given beauty.</p>
                    <p>With a commitment to excellence, we offer unique creations that tell stories of creativity and inspire a deep connection to Africa — through purpose and grace.</p>
                    <div class="about-motto">
                        <span class="motto-icon">✦</span>
                        <div>
                            <span class="motto-label">Our Motto</span>
                            <em>"Creativity in design and integrity in service"</em>
                        </div>
                    </div>
                </div>
                <div class="about-block-image">
                    <img src="{{ asset('images/collections/collection-30.jpg') }}" alt="African fashion collection">
                </div>
            </div>
        </div>
    </section>
    <!-- /About Story Section -->


    <section class="flat-spacing-12">
        <div class="container">
            <div class="flat-title text-center wow fadeInUp" data-wow-delay="0s">
                <h3 class="title">Our Craftsmanship</h3>
                <p class="sub-title text_black-2">A glimpse into our handcrafted African-inspired pieces</p>
            </div>
            <div class="masonry-grid">
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/1.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/2.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/3.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/4.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/5.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/6.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/7.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/8.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/2.1.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/3.1.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/4.1.jpg') }}" alt="Handcrafted piece">
                </div>
                <div class="masonry-item">
                    <img src="{{ asset('images/collections/hats/5.1.jpg') }}" alt="Handcrafted piece">
                </div>
            </div>
        </div>
    </section>


    <section class="pb-5">
        <div class="container">
            <div class="bg_grey-2 radius-10 flat-wrap-iconbox">
                <div class="flat-title lg">
                    <span class="title fw-5">Quality is our priority</span>
                    <div>
                        <p class="sub-title text_black-2">Our talented stylists have put together outfits that are perfect for the season.</p>
                        <p class="sub-title text_black-2">They've variety of ways to inspire your next fashion-forward look.</p>
                    </div>
                </div>
                <div class="flat-iconbox-v3 lg">
                    <div class="wrap-carousel wrap-mobile">
                        <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                            <div class="swiper-wrapper wrap-iconbox lg">
                                <div class="swiper-slide">
                                    <div class="tf-icon-box text-center">
                                        <div class="icon">
                                            <i class="icon-materials"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title">High-Quality Materials</div>
                                            <p class="text_black-2">Crafted with precision and excellence, our activewear is meticulously engineered using premium materials to ensure unmatched comfort and durability.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tf-icon-box text-center">
                                        <div class="icon">
                                            <i class="icon-design"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title">Laconic Design</div>
                                            <p class="text_black-2">Simplicity refined. Our activewear embodies the essence of minimalistic design, delivering effortless style that speaks volumes.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tf-icon-box text-center">
                                        <div class="icon">
                                            <i class="icon-sizes"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title">Various Sizes</div>
                                            <p class="text_black-2">Designed for every body and anyone, our activewear embraces diversity with a wide range of sizes and shapes, celebrating the beauty of individuality.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('styles')
    <style>
        /* === About Story Section === */
        .about-story {
            padding: 80px 0 60px;
        }

        /* Intro */
        .about-intro {
            max-width: 700px;
            margin: 0 auto 60px;
        }
        .about-label {
            display: inline-block;
            font-family: 'Playfair Display', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--text-2);
            margin-bottom: 16px;
        }
        .about-headline {
            font-family: 'Playfair Display SC', sans-serif;
            font-size: 38px;
            line-height: 1.2;
            font-weight: 400;
            margin-bottom: 20px;
        }
        .about-subtext {
            font-size: 16px;
            line-height: 1.8;
            color: var(--text);
            max-width: 580px;
            margin: 0 auto;
        }
        .about-divider {
            width: 60px;
            height: 2px;
            background: var(--main);
            margin: 30px auto 0;
        }

        /* Blocks */
        .about-block {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            margin-bottom: 70px;
        }

        /* Block Image */
        .about-block-image {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }
        .about-block-image img {
            width: 100%;
            height: 504px;
            object-fit: cover;
            object-position: top center;
            display: block;
            border-radius: 12px;
            transition: transform 0.5s ease;
        }
        .about-block-image:hover img {
            transform: scale(1.03);
        }
        .about-image-tag {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: var(--main);
            color: var(--white);
            font-family: 'Playfair Display SC', sans-serif;
            font-size: 13px;
            letter-spacing: 2px;
            padding: 8px 18px;
            border-radius: 4px;
        }

        /* Block Content */
        .about-block-content {
            padding: 10px 0;
        }
        .about-block-content h3 {
            font-family: 'Playfair Display SC', sans-serif;
            font-size: 26px;
            line-height: 1.3;
            margin-bottom: 20px;
        }
        .about-block-content p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text);
            margin-bottom: 14px;
        }

        /* Quote */
        .about-quote {
            margin: 24px 0 0;
            padding: 20px 24px;
            border-left: 3px solid var(--main);
            background: var(--bg-2);
            font-family: 'Playfair Display', sans-serif;
            font-style: italic;
            font-size: 16px;
            line-height: 1.6;
            color: var(--main);
            border-radius: 0 8px 8px 0;
        }

        /* Motto */
        .about-motto {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 24px;
            padding: 18px 22px;
            background: var(--bg-2);
            border-radius: 8px;
        }
        .about-motto .motto-icon {
            font-size: 22px;
            color: var(--main);
        }
        .about-motto .motto-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-2);
            margin-bottom: 4px;
        }
        .about-motto em {
            font-family: 'Playfair Display', sans-serif;
            font-size: 15px;
            color: var(--main);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .about-story {
                padding: 50px 0 30px;
            }
            .about-headline {
                font-size: 28px;
            }
            .about-block {
                grid-template-columns: 1fr;
                gap: 30px;
                margin-bottom: 50px;
            }
            .about-block-image img {
                height: 360px;
            }
            .about-block-content h3 {
                font-size: 22px;
            }
        }

        /* === Masonry === */
        .masonry-grid {
            columns: 4;
            column-gap: 12px;
        }
        .masonry-item {
            break-inside: avoid;
            margin-bottom: 12px;
            border-radius: 8px;
            overflow: hidden;
        }
        .masonry-item img {
            width: 100%;
            display: block;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .masonry-item:hover img {
            transform: scale(1.05);
        }
        @media (max-width: 992px) {
            .masonry-grid {
                columns: 3;
            }
        }
        @media (max-width: 768px) {
            .masonry-grid {
                columns: 2;
            }
        }
    </style>
@endpush
