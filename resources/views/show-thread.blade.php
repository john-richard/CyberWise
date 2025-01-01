<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cyberwise | Show our Discussions</title>
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

  <link rel="stylesheet" href="{{ asset('assets/css/show-thread.css') }}">

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

    <!-- Contact Section -->
    <section id="posts" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Community</h2>
        <p>
          @if (is_null($thread) || isset($thread['error']))
            Start a discussion
          @else
            {{ $thread->categories->name }}
          @endif
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @csrf
        @if (is_null($thread) || isset($thread['error']))
          <div class="row gy-4">
            <div class="col-lg-4">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-folder-x flex-shrink-0"></i>
                <div>
                  <h3>No Thread Found</h3>
                  <p>Looks like there aren't any threads available right now. Feel free to start a new discussion in the community page!</p>
                </div>
              </div><!-- End Info Item -->
            </div>
          </div>
        @else
          <div class="row gy-4">
            <div class="col-lg-4">
              <div class="info-item d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="flex-shrink-0 me-3">
                  <img src="{{ asset('storage/' . $thread->user->avatar) }}" class="img-fluid rounded-circle" width="50" alt="User">
                </div>
                <div>
                  <h5>{{ $thread->user->username }}</h5>
                  <p class="text-muted small">Posted: {{ $thread->time_ago }}</p>
                </div>
              </div><!-- End Info Item -->
            </div>

            <div class="col-lg-8">
              <div class="p-4 shadow-sm">
                <h4 class="mb-3">{{ $thread->title }}</h4>
                <p>{{ $thread->content }}</p>

                @if ($thread->posts)

                <div id="commentsList" class="list-group mb-4">
                  @foreach ($thread->posts as $post)
                    <div id="comment_{{ $post['id'] }}" class="list-group-item d-flex mb-3" style="border: var(--bs-list-group-border-width) solid var(--bs-list-group-border-color);">
                      <div class="flex-shrink-0 me-3 align-self-start">
                        <img src="{{ asset('storage/' . $post['avatar']) }}" class="img-fluid rounded-circle" width="50" alt="User">
                      </div>
                      <div>
                        <h5 class="mb-1">{{ $post['username'] }}</h5>
                        <p class="mb-1">{{ $post['content'] }}</p>
                        <small class="text-muted">{{ $post['time_ago'] }}</small>
                      </div>
                    </div><!-- End Post -->
                  @endforeach
                </div><!-- End Posts -->

                @endif

                <!-- Replies Section -->
                <div class="replies-container" id="replies-container-{{ $thread->id }}">
                  <div class="replies-list mb-4">
                    <!-- Dynamically load replies here -->
                  </div>

                  <!-- Reply Textarea -->
                  <div class="mb-3">
                    <textarea class="form-control" id="reply-textarea-{{ $thread->id }}" placeholder="Write a reply..." rows="3"></textarea>
                  </div>
                  <button class="btn btn-primary submit-reply" data-thread-id="{{ $thread->id }}">Submit Reply</button>
                </div>
              </div><!-- End Card -->
            </div>
          </div>
        @endif
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
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/home.js') }}"></script>

  <script src="{{ asset('assets/js/thread.js') }}"></script>

</body>

</html>