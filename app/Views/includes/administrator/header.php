<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
           
            
            <?php 
             if(session('user')->username == 'admin' ){?>
            <li><a href="<?php echo base_url('Generate/Office');?>" class="nav-link nav-link-lg ion-ios-reload">
                    <i data-feather="upload-cloud"></i>
                </a>
            </li>
            <?php } ?>
           
        </ul>
    </div>

    <ul class="navbar-nav navbar-right">
       
           

            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg notification-toggle message-toggle  "><i data-feather="bell"></i>
              <span class="badge headerBadge1">
         
            
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <!-- <a href="#">Mark All As Read</a> -->
                </div>
              </div>
             
             
              <div class="dropdown-footer text-center">
                <a href="<?php echo base_url('administrator/notifications'); ?>">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>

          <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg notification-toggle message-toggle  ">
               -->
               
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="<?php echo base_url();?>/assets-panel/img/users/user-1.png" class="user-img-radious-style">
                <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello, <?php echo session('user')->username;?></div>
                <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> <?php echo session('user')->level;?>

                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url('monitoring/login/logout'); ?>"
                    class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>