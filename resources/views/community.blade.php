<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cyberwise Community | Engage, Share, and Grow Together Online</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  
  <!-- Community CSS File -->
  <link rel="stylesheet" href="{{ asset('assets/css/community.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

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
          </div>
          
        </div>

      </div>

    </section><!-- /Hero Section -->

    <section id="posts">
        <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Explore</h2>
        <p>Our Community</p>
      </div><!-- End Section Title -->
      <div class="container">
          <div class="main-body p-0">
              <div class="inner-wrapper">
                  <!-- Inner sidebar -->
                  <div class="inner-sidebar">
                      <!-- Inner sidebar header -->
                      <div class="inner-sidebar-header justify-content-center">
                          <button style="font-size: 14px;" class="btn btn-primary has-icon btn-block" type="button" data-toggle="modal" data-target="#threadModal">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                                  <line x1="12" y1="5" x2="12" y2="19"></line>
                                  <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              NEW DISCUSSION
                          </button>
                      </div>
                      <!-- /Inner sidebar header -->

                      <!-- Inner sidebar body -->
                      <div class="inner-sidebar-body p-0">
                        <div class="p-3 h-100">
                            <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon active">All Threads</a>
                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Popular this week</a>
                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Popular all time</a>
                            </nav>
                        </div>
                    </div>
                    <!-- /Inner sidebar body -->
                  </div>
                  <!-- /Inner sidebar -->

                  <!-- Inner main -->
                  <div class="inner-main">
                      <!-- Inner main header -->
                      <div class="inner-main-header">
                          <a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar"><i class="material-icons">arrow_forward_ios</i></a>
                          <select class="custom-select custom-select-sm w-auto mr-1" id="sort-filter" onchange="applySortFilter()">
                            <option value="latest" {{ $filters['sortBy'] == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="popular" {{ $filters['sortBy'] == 'popular' ? 'selected' : '' }}>Popular</option>
                            <option value="solved" {{ $filters['sortBy'] == 'solved' ? 'selected' : '' }}>Solved</option>
                            <option value="unsolved" {{ $filters['sortBy'] == 'unsolved' ? 'selected' : '' }}>Unsolved</option>
                            <option value="no-replies" {{ $filters['sortBy'] == 'no-replies' ? 'selected' : '' }}>No Replies Yet</option>
                        </select>
                          <span class="input-icon input-icon-sm ml-auto w-auto">
                              <input type="text" class="form-control form-control-sm bg-gray-200 border-gray-200 shadow-none mb-4 mt-4" placeholder="Search forum" />
                          </span>
                      </div>
                      <!-- /Inner main header -->

                      <!-- Inner main body -->

                      <!-- Forum List -->
                      <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">

                        @if($threads->isEmpty())
                            <div class="card mb-2">
                                <div class="card-body p-2 p-sm-3">
                                    <div class="media forum-item">
                                        <img src="{{ asset('assets/img/404-cat.jpg') }}" class="mr-3 rounded-circle" width="50" alt="User" />
                                        <div class="media-body">
                                            <h6>No thread available</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($threads as $thread)
       
                            <div class="card mb-2">
                                <div class="card-body p-2 p-sm-3">
                                    <div class="media forum-item">
                                        <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="{{ asset('storage/' . $thread->avatar) }}" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                                        <div class="media-body">
                                            <h6><a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body">{{ $thread->title }}</a></h6>
                                            <p class="text-secondary">
                                              {{ $thread->content }}
                                            </p>
                                            <p class="text-muted"><a href="javascript:void(0)">{{ $thread->username }}</a> posted <span class="text-secondary font-weight-bold">{{ $thread->time_ago }}</span></p>
                                        </div>
                                        <div class="text-muted small text-center align-self-center">
                                            <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> {{ $thread->views }}</span>
                                            <span class="comment-btn" data-thread-id="{{ $thread->thread_id }}"><i class="far fa-comment ml-2"></i> 3</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Replies Container -->
                            <div class="replies-container d-none" id="replies-container-{{ $thread->thread_id }}">
                                <div class="replies-list">
                                    <!-- Dynamically load replies for this thread -->
                                </div>

                                <!-- Reply Textarea -->
                                <textarea class="form-control mt-2" id="reply-textarea-{{ $thread->thread_id }}" placeholder="Write a reply..."></textarea>
                                <button class="btn btn-primary mt-2 submit-reply" data-thread-id="{{ $thread->thread_id }}">Reply</button>
                            </div>

                            @endforeach
                            {{ $threads->links() }}
                        @endif

                    </div>

                      <!-- /Forum List -->

                      <!-- Forum Detail -->
                      <div class="inner-main-body p-2 p-sm-3 collapse forum-content">
                          <a href="#" class="btn btn-light btn-sm mb-3 has-icon" data-toggle="collapse" data-target=".forum-content"><i class="fa fa-arrow-left mr-2"></i>Back</a>
                          <div class="card mb-2">
                              <div class="card-body">
                                  <div class="media forum-item">
                                      <a href="javascript:void(0)" class="card-link">
                                          <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle" width="50" alt="User" />
                                          <small class="d-block text-center text-muted">Newbie</small>
                                      </a>
                                      <div class="media-body ml-3">
                                          <a href="javascript:void(0)" class="text-secondary">Mokrani</a>
                                          <small class="text-muted ml-2">1 hour ago</small>
                                          <h5 class="mt-1">Realtime fetching data</h5>
                                          <div class="mt-3 font-size-sm">
                                              <p>Hellooo :)</p>
                                              <p>
                                                  I'm newbie with laravel and i want to fetch data from database in realtime for my dashboard anaytics and i found a solution with ajax but it dosen't work if any one have a simple solution it will be
                                                  helpful
                                              </p>
                                              <p>Thank</p>
                                          </div>
                                      </div>
                                      <div class="text-muted small text-center">
                                          <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>
                                          <span><i class="far fa-comment ml-2"></i> 3</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card mb-2">
                              <div class="card-body">
                                  <div class="media forum-item">
                                      <a href="javascript:void(0)" class="card-link">
                                          <img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="rounded-circle" width="50" alt="User" />
                                          <small class="d-block text-center text-muted">Pro</small>
                                      </a>
                                      <div class="media-body ml-3">
                                          <a href="javascript:void(0)" class="text-secondary">drewdan</a>
                                          <small class="text-muted ml-2">1 hour ago</small>
                                          <div class="mt-3 font-size-sm">
                                              <p>What exactly doesn't work with your ajax calls?</p>
                                              <p>Also, WebSockets are a great solution for realtime data on a dashboard. Laravel offers this out of the box using broadcasting</p>
                                          </div>
                                          <button class="btn btn-xs text-muted has-icon"><i class="fa fa-heart" aria-hidden="true"></i>1</button>
                                          <a href="javascript:void(0)" class="text-muted small">Reply</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /Forum Detail -->

                      <!-- /Inner main body -->
                  </div>
                  <!-- /Inner main -->
              </div>

              <!-- New Thread Modal -->
              <div class="modal fade" id="threadModal" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <form>
                              <div class="modal-header d-flex align-items-center bg-primary text-white">
                                  <h6 class="modal-title mb-0" id="threadModalLabel">New Discussion</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <div class="form-group">
                                      <label for="threadTitle">Title</label>
                                      <input type="text" class="form-control" id="threadTitle" placeholder="Enter title" autofocus="" />
                                  </div>
                                  <textarea class="form-control summernote" style="display: none;"></textarea>

                                  <div class="custom-file form-control-sm mt-3" style="max-width: 300px;">
                                      <input type="file" class="custom-file-input" id="customFile" multiple="" />
                                      <label class="custom-file-label" for="customFile">Attachment</label>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                  <button type="button" class="btn btn-primary">Post</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>


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
  <script src="{{ asset('assets/js/community.js') }}"></script>

</body>

</html>