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


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- vendor css -->
  <link rel="stylesheet" href="{{ asset('dbassets/css/style.css') }}">

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
            <p>Test Your Knowledge</p>
          </div>
        </div>
      </div><!-- End Section Title -->

      <div class="row gy-4 justify-content-center">
        @if($featuredThreads->isEmpty())
          <div class="col-lg-12 order-2 order-lg-1 content">
            <p>No featured threads available at this time.</p>
          </div>
        @else
        <div class="col-sm-6">
          <div class="card" id="cardContent">
            <div class="card-body">
              <div id="carouselKnowledge" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <form id="testKnowledgeForm" name="testKnowledgeForm">
                        @foreach ($featuredThreads as $index => $featuredThread)
                            <div class="carousel-item @if($index == 0 ) active @endif">
                                <img class="img-fluid d-block w-100" src="{{ asset('dbassets/images/slider/img-slide-1.jpg') }}" alt="First slide">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center text-center">
                                    <h4 class="text-white">{{ $featuredThread->title }}</h4>

                                    @php
                                        $metadata = json_decode($featuredThread->metadata, true);
                                        $choices = $metadata['choices'] ?? [];
                                    @endphp

                                    <fieldset class="choices-group">
                                        @foreach ($choices as $key => $choice)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" 
                                                      name="{{ $featuredThread->featured_thread_id }}" 
                                                      id="choice_{{ $featuredThread->featured_thread_id }}_{{ $key }}" 
                                                      value="{{ $key }}">
                                                <label class="form-check-label" for="choice_{{ $featuredThread->featured_thread_id }}_{{ $key }}">
                                                    {{ strtoupper($key) }}. {{ $choice }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
                
                <a class="carousel-control-prev" href="#carouselKnowledge" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselKnowledge" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>

          <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        Modal body text goes here.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

          <div class="text-center mt-4" id="knowledgeButtons">
              <button id="submitButton" type="button" class="btn btn-primary btn-large"><i class="bi bi-send mr-2"></i>Submit</button>

              <button style="display: none;" class="btn btn-primary btn-large" type="button" id="calculateButton" disabled>
                  <span class="spinner-border spinner-border-sm" role="status"></span>
                  Calculating
              </button>
          </div>
          
        </div>
        @endif
      </div>
    </section><!-- /Features Section -->

  </main>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <x-footer />

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

  <!-- Required Js -->
  <script src="{{ asset('dbassets/js/vendor-all.min.js') }}"></script>
  <script src="{{ asset('dbassets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dbassets/js/pcoded.min.js') }}"></script>

  <script src="{{ asset('assets/js/testKnowledge.js') }}"></script>

</body>

</html>