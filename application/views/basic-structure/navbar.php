<header class="main-header">
        <!-- Logo -->
        <a  href="/c3p/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>3P</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>C3P-</b>DB</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <!-- Messages: style can be found in dropdown.less-->
               <li class="dropdown info-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= img_url('apks/app_web.png') ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">Application web</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- inner menu: contains the actual data -->
                  <li>
                    <ul class="menu-navs">
                      <li><!-- start message -->
                        <a href="#">
                        <i class="fa fa-book mr-2"></i> Manuel d'utlisation (en redaction)
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                </ul>
              </li>
               <!-- Messages: style can be found in dropdown.less-->
               <li class="dropdown info-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= img_url('apks/app-android.png') ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">Application mobile</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- inner menu: contains the actual data -->
                  <li>
                    <ul class="menu-navs">
                      <li><!-- start message -->
                        <a href="#">
                        <i class="fa fa-download mr-2"></i> app 1.0.0
                        <span class="pull-right text-muted text-sm">(test)</span>
                        </a>
                      </li><!-- end message -->
                      <li><!-- start message -->
                        <a href="#">
                        <i class="fa fa-play mr-2"></i> Test en direct avec Expo Go <span class=" pull-right badge label-success ">New</span>
                        </a>
                      </li><!-- end message -->
                      <li><!-- start message -->
                        <a href="#">
                        <i class="fa fa-tablet mr-2"></i> Télécharger Expo Go
                        </a>
                      </li>
                      <li><!-- start message -->
                        <a href="#">
                        <i class="fa fa-book mr-2"></i> Manuel d'utlisation <span class=" pull-right ">(en redaction)</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= img_url('user-icon.png') ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $utilisateur['nom'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= img_url('user-icon.png') ?>" class="img-circle" alt="User Image">
                    <p>
                    <?= $utilisateur['nom'] ?>
                    <i class="fa fa-circle text-success"></i>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat" id="js-bouton-deconnexion"><i class="fa fa-sign-out mr-2" ></i>Se deconnecter</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a class="nav-link" href="/echantillonnage/" data-widget="fullscreen" href="#" role="button">
                <i class="fa fa-home"></i>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>