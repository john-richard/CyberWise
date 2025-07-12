	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="{{ asset('storage/' . $user->avatar) }}" alt="User-Profile-Image">
						<div class="user-details">
							<span>{{ $user->username }}</span>
							<div id="more-details">Admin<i class="fa fa-chevron-down m-l-5"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
							<li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
							<li class="list-group-item"><a href="#logout" class="logoutBtn"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
						</ul>
					</div>
				</div>
				
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Users</label>
					</li>
					<li class="nav-item">
					    <a href="{{ route('admin.users') }}?type=admin" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Admin</span></a>
					</li>
                    <li class="nav-item">
					    <a href="{{ route('admin.users') }}?type=member" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Member</span></a>
					</li>

                    <li class="nav-item pcoded-menu-caption">
						<label>Community</label>
					</li>
					<li class="nav-item">
					    <a href="{{ route('admin.threads') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Threads</span></a>
					</li>
                    <li class="nav-item">
					    <a href="{{ route('admin.featured-thread') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-trending-up"></i></span><span class="pcoded-mtext">Featured</span></a>
					</li>

                    <li class="nav-item pcoded-menu-caption">
						<label>Knowledge Challenge</label>
					</li>
                    <li class="nav-item">
					    <a href="{{ route('admin.learning-hub') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Learning Hub</span></a>
					</li>
					<li class="nav-item">
					    <a href="{{ route('admin.knowledge') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-cloud-lightning"></i></span><span class="pcoded-mtext">Test Your Knowledge</span></a>
					</li>                   
				</ul>
				
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->