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

    <!-- A-Service Section -->
    <section id="hero_2" class="aservice section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="aservice-list">
              <a href="#" class="info-link">
                <div class="list-img">
                  <div class="list-info">What's<br>New</div>
                  <img src="{{ asset('assets/img/about/service-1.png') }}" class="img-fluid" alt="">
                </div>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="aservice-list">
              <a href="#" class="info-link">
                <div class="list-img">
                  <div class="list-info">Talk<br>Space</div>
                  <img src="{{ asset('assets/img/about/service-2.png') }}" class="img-fluid" alt="">
                </div>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="aservice-list">
              <a href="#" class="info-link">
                <div class="list-img">
                  <div class="list-info">Let's test<br>your<br>knowledge</div>
                  <img src="{{ asset('assets/img/about/service-3.png') }}" class="img-fluid" alt="">
                </div>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="aservice-list">
              <a href="#" class="info-link">
                <div class="list-img">
                  <div class="list-info">Learning<br>Hub</div>
                  <img src="{{ asset('assets/img/about/service-4.png') }}" class="img-fluid" alt="">
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Team Section -->





    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        <p>CyberWise</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            <h3>Protect Your Digital World with Cybersecurity</h3>
            <p class="fst-italic">
            In today’s digital age, ensuring the security of your personal and business data is more important than ever. Cyber threats are constantly evolving, and staying ahead of them requires cutting-edge solutions, awareness, and proactive defense strategies.
            </p>
            <h5>Why Cybersecurity Matters</h5>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span><strong>Data Protection:</strong> Safeguard sensitive information from unauthorized access and potential theft.</span></li>
              <li><i class="bi bi-check2-all"></i> <span><strong>Business Continuity:</strong> Mitigate the risk of disruptions due to cyberattacks, ensuring your operations run smoothly.</span></li>
              <li><i class="bi bi-check2-all"></i> <span><strong>Customer Trust:</strong> Build and maintain trust with your clients by protecting their personal data and privacy.</span></li>
              <li><i class="bi bi-check2-all"></i> <span><strong>Regulatory Compliance:</strong> Stay compliant with legal regulations such as GDPR and HIPAA to avoid costly penalties.</span></li>
            </ul>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Hot Topics</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="{{ asset('assets/img/features-bg.jpg') }}" alt=""></div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            @php
                // Define the icons in an array
                $icons = ['bi-robot', 'bi-shield-slash', 'bi-fingerprint', 'bi-broadcast', 'bi-cloud-check'];
            @endphp

            @foreach($featuredThreads as $thread)
                <h3>{{ $thread['title'] }}</h3>

                @if(!empty($thread['featuredThreads']) && $thread['featuredThreads']->isNotEmpty())
                    @php
                        // Calculate the total number of featured threads
                        $totalThreads = count($thread['featuredThreads']);
                    @endphp

                    @foreach($thread['featuredThreads'] as $index => $featuredThread)
                      <div class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0 @if($index > 0 ) mt-5 @endif" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi {{ $icons[$loop->index % count($icons)] }} flex-shrink-0"></i>
                            <div>
                                <h4>{{ $featuredThread['title'] }}</h4>
                                <p>
                                    {{ $featuredThread['content'] }}
                                    @if(!empty($featuredThread['link']))
                                        <a href="{{ $featuredThread['link'] }}" class="learn-more-link">Learn More</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No featured threads available at this time.</p>
                @endif
            @endforeach
        </div>
      </div>
    </section><!-- /Features Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>our Team</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('assets/img/team/team-2.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('assets/img/team/team-3.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('assets/img/team/team-4.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>San Antonio, Santo Tomas, Batangas, PH 4234</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+63 998 884 3247</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

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

</body>

</html>