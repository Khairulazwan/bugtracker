<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <div class="iq-sidebar-logo">
            <div class="top-logo">
                <a href="#" class="logo">
                    <img src="<?php echo base_url('assets/images/logo-full.png')?>" class="img-fluid" alt="">                
                    <span>Bug Tracking</span>
                </a>
            </div>
        </div>
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Bug Tracking System</h5>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                </ul>
            </nav>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light p-0">
         
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="line-menu half start"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu half end"></div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item"><a href="#" class="search-toggle iq-waves-effect text-white"><?php echo $fullname; ?></a></li>
                </ul>
            </div>
            <ul class="navbar-list">
                <li>
                    <a href="#" class="search-toggle iq-waves-effect text-white"><img src="<?php echo base_url('assets/images/user/1.jpg')?>" class="img-fluid rounded" alt="user"></a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-success p-3">
                                    <h5 class="mb-0 text-white line-height"> <?php echo $fullname; ?></h5>
                                    <span class="text-white font-size-12"> <?php echo $designation; ?></span>
                                </div>
                                <a href="#" class="iq-sub-card iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-success">
                                            <i class="ri-profile-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Edit Profile</h6>
                                            <p class="mb-0 font-size-12">Modify your personal details.</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" id="btnFullscreen" class="iq-sub-card iq-full-screen iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-success">
                                            <i class="ri-fullscreen-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Full Screen</h6>
                                            <p class="mb-0 font-size-12">View fullscreen and hide all tabs.</p>
                                        </div>
                                    </div>
                                </a>
                               
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="iq-bg-danger iq-sign-btn swalBtn" href="#" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- TOP Nav Bar END -->