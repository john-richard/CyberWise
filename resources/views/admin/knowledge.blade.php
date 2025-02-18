<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cyberwise Test Your Knowledge | Build a Safer and Smarter Online Community</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <style>
        .tooltip-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip-container:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
            transform: translate(-50%, -10px);
        }

        .tooltip-text {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.75);
            color: #fff;
            text-align: center;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.875rem;
            line-height: 1.2;
            white-space: pre-wrap;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            transform: translate(-50%, 0);
            bottom: 100%; /* Position above */
            left: 50%;
            z-index: 10;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('dbassets/css/style.css') }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <x-admin-navigation :user="$user" />
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">

        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="{{ route('home') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
                <img src="{{ asset('assets/img/logo-icon.png') }}" alt="" class="logo-thumb">
            </a>
            <a href="{{ route('home') }}" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="icon feather icon-bell"></i>
                            <span class="badge badge-pill badge-danger">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="dbassets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="dbassets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="dbassets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="dbassets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="img-radius" alt="User-Profile-Image">
                                <span>{{ $user->username }}</span>
                                <a href="#logout" class="dud-logout logoutBtn" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
				
			
	</header>
	<!-- [ Header ] end -->
	
	

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Test Your Knowledge</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Test Your Knowledge</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="form-inline" id="searchKnowledge" name="searchKnowledge">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="search" class="sr-only">Search</label>
                                            <input value="{{ $filters['search'] ?? '' }}" type="text" class="form-control" name="searchFilter" id="searchFilter" placeholder="Search term" required >
                                        </div>
                                        <!-- <button type="submit" class="btn  btn-primary mb-2">Search</button> -->
                                        <button class="btn btn-primary mb-2" type="button" id="searchButton" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"></span>
                                            Loading...
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addNewModal" data-whatever="@getbootstrap">Add New <i class="feather mr-2 icon-plus-circle"></i></button>

                                    <div class="modal fade text-left" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addNewModalLabel">Create New Entry</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="createKnowledgeForm" name="createKnowledgeForm">
                                                        <div class="form-group">
                                                            <label for="knowledgeCategory">Categories</label>
                                                            <select class="form-control" id="knowledgeCategory" name="knowledgeCategory">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="knowledgeTitle" class="col-form-label">Question:</label>
                                                            <input type="text" class="form-control" name="knowledgeTitle" id="knowledgeTitle" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label">Choices:</label>
                                                            <div id="choicesContainer">
                                                                <div class="input-group mb-2 choice-group">
                                                                    <input type="text" class="form-control" name="knowledgeChoices[]" required>
                                                                    <div class="input-group-text">
                                                                        <input type="radio" class="correct-answer" name="correctAnswer" value="0">
                                                                    </div>
                                                                    <button type="button" class="btn btn-danger ms-2 remove-choice" onclick="this.parentElement.remove(); updateRadioValues();">Remove</button>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-success mt-2" id="addChoice">Add Choice</button>
                                                        </div>


                                                    </form>
                                                    <div id="error-message" style="color: red; display: none;"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" name="submitCreateKnowledgeForm" id="submitCreateKnowledgeForm">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Test Your Knowledge</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="chk-option">
                                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                        <input type="checkbox" class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </div>
                                                Title
                                            </th>
                                            <th>Choices</th>
                                            <th>Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($featuredThreads->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">No featured thread available</td>
                                            </tr>
                                        @else
                                            @foreach ($featuredThreads as $featuredThread)
                                                @php
                                                    $metadata = json_decode($featuredThread->metadata, true);
                                                    $choices = $metadata['choices'] ?? [];
                                                    $correctAnswer = $metadata['answer'] ?? '';
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="chk-option">
                                                            <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                        </div>
                                                        <div class="d-inline-block align-middle">
                                                            <div class="d-inline-block">
                                                                <h6>
                                                                    <a href="{{ $featuredThread->link }}" class="learn-more-link">
                                                                        {{ $featuredThread->title }}
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @foreach ($choices as $key => $choice)
                                                            @if ($key == $correctAnswer)
                                                                <strong>{{ strtoupper($key) }}. {{ $choice }}</strong><br>
                                                            @else
                                                                {{ strtoupper($key) }}. {{ $choice }}<br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {!! $featuredThread->status 
                                                            ? '<strong style="color: #29b765;">Active</strong>' 
                                                            : '<strong style="color: #e74c3c;">Inactive</strong>' !!}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="text-muted small text-center align-self-center">
                                                            <span class="d-none d-sm-inline-block">
                                                                <a 
                                                                    data-whatever="@getbootstrap"
                                                                    data-toggle="modal" 
                                                                    data-target="#addNewModal" 
                                                                    data-thread-id="{{ $featuredThread->featured_thread_id }}"
                                                                    data-title="{{ $featuredThread->title }}" 
                                                                    data-metadata="{{ $featuredThread->metadata }}" 
                                                                    data-category-id="{{ $featuredThread->category_id ?? '' }}">
                                                                    <i class="far fa-edit text-c-yellow"></i>
                                                                </a>
                                                            </span>
                                                            <span class="comment-btn">
                                                                <a 
                                                                    data-whatever="@getbootstrap"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteModal"
                                                                    data-thread-id="{{ $featuredThread->featured_thread_id }}">
                                                                    <i class="far fa-trash-can ml-2 text-c-red"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- Pagination Links --}}
                                            <tr>
                                                <td colspan="4"> {{ $featuredThreads->links() }} </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Thread</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-0">You are about to delete this entry. Do you want to proceed?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <!-- Include a data-thread-id attribute to hold the thread ID -->
                                                <button type="button" id="confirmDelete" class="btn btn-primary">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->

    <!-- Required Js -->
    <script src="{{ asset('dbassets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('dbassets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dbassets/js/pcoded.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('dbassets/js/plugins/apexcharts.min.js') }}"></script>


    <!-- custom-chart js -->
    <script src="{{ asset('dbassets/js/pages/dashboard-main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/knowledge.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
</body>

</html>
