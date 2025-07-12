<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cyberwise | Build a Safer and Smarter Online Community</title>
  <meta name="description" content="online community, safe online space, smarter online connections, Cyberwise platform, community building, secure web services, online safety tools, tech-savvy community, social interaction, digital innovation">
  <meta name="keywords" content="online community, social networking, safe online space, secure communication, Cyberwise, social interaction, smart communities, privacy-focused platform, online safety, digital security, safe web services, community-building, user protection, trusted platform">

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
  <link rel="icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">  

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}">

  <!-- Main CSS File -->
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

  <!-- =======================================================
  * Template Name: Gp
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Updated: Aug 15 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">CW</h1>
        <span>.</span>
      </a>

      <x-navigation />

      <div style="display: none;" id="greeting"></div>
      <a class="btn-getstarted" href="{{ route('login') }}#user-login" id="joinCommunityBtn">Login</a>
      
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{ asset('assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

      <div class="container">

        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-xl-6 col-lg-8">
            <h2>CyberWise<span>.</span></h2>
            <p>Building a safer, smarter online community</p>
            <a class="btn-join" href="{{ route('community') }}#posts" id="joinCommunityBtn">Join our community</a>
          </div>
          
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Features Section -->
    <section id="features" class="features contact section">

      <!-- Section Title -->
      <div class="container aos-init aos-animate section-title" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-6">
            <h2>Features</h2>
            <p>Learning Hub</p>
          </div>

          <div class="col-lg-6 d-flex justify-content-end">

            <form class="php-email-form" data-aos="fade-up" data-aos-delay="200" id="searchHub" name="searchHub">
              <div class="row gy-4">
                <div class="col-md-8">
                  <input value="{{ $filters['search'] ?? '' }}" type="text" class="form-control" name="searchFilter" id="searchFilter" placeholder="Search term" required >
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                  <button class="btn btn-primary mb-2" type="submit" id="searchButton" disabled>
                      <span class="spinner-border spinner-border-sm" role="status"></span>
                      Loading...
                  </button>
                </div>
              </div>
            </form>
            
          </div>
        </div>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <!-- <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="{{ asset('assets/img/learning-hub.png') }}" alt=""></div> -->
          <div class="col-lg-12 order-2 order-lg-1 content">
            @php
                // Define the icons in an array
                $icons = ['bi-robot', 'bi-shield-slash', 'bi-fingerprint', 'bi-broadcast', 'bi-cloud-check'];
            @endphp

              <!-- <h3>{{ $threadTitle}}</h3> -->

              @if($featuredThreads->isEmpty())
                <p>No featured threads available at this time.</p>
              @else
                @foreach ($featuredThreads as $index => $featuredThread)
                  <div style="margin-bottom: 15px;" class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0 @if($index > 0 ) mt-5 @endif" data-aos="fade-up" data-aos-delay="200">
                      <i class="bi {{ $featuredThread->icon ? $featuredThread->icon : 'bi-robot' }} flex-shrink-0"></i>
                      <div>
                          <h4>{{ $featuredThread->title }}</h4>
                          <p>
                              {{ $featuredThread->content }}
                              @if(!empty($featuredThread->link))
                                  <a href="{{ $featuredThread->link }}" class="learn-more-link">Learn More</a>
                              @endif
                          </p>
                      </div>
                  </div>
                @endforeach
              @endif
        </div>
      </div>
    </section><!-- /Features Section -->

  </main>

  <x-footer />

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/home.js') }}"></script>
  <script src="{{ asset('assets/js/learning-hub.js') }}"></script>

</body>

</html>