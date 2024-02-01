<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= img_url('user-icon.png') ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info ">
        <p id="info-login"  ><?= $utilisateur['nom'] ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
      </div>
    </div>
    
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" >
      <li class="header">MENU DE NAVIGATION</li>

      <li class="<?= route_active(array('bienvenue'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="/c3p/">
          <i class="fa fa-home "></i> <span>Accueil</span> 
        </a>
      </li>
      <?php if ($this->lib_autorisation->visualisation_autorise(1)) { ?>
      <li class="treeview <?= route_active(array('operation/gestion-operation','groupe/gestion-groupe','utilisateur/gestion-utilisateur','historique'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="#">
          <i class="fa fa-user-o"></i>
          <span>Accès d'utilisateur</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?= route_active(array('operation/gestion-operation'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
          <a href="/c3p/operation/gestion-operation.html">
            <i class="fa fa-circle-o"></i> Opérations
          </a>
          </li>
          <li class="<?= route_active(array('groupe/gestion-groupe'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
            <a href="/c3p/groupe/gestion-groupe.html"><i class="fa fa-circle-o"></i> Groupe
            </a>
          </li>
          <li class="<?= route_active(array('utilisateur/gestion-utilisateur'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
            <a href="/c3p/utilisateur/gestion-utilisateur.html"><i class="fa fa-circle-o"></i> Utilisateur
            </a>
          </li>
          <li class="<?= route_active(array('historique'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
            <a href="/c3p/historique.html"><i class="fa fa-circle-o"></i> Historique
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>
      <?php if ($this->lib_autorisation->visualisation_autorise(2)) { ?>
      <li class="treeview <?= route_active(array('pecheur/gestion-pecheur'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="/c3p/pecheur/gestion-pecheur">
          <i class="fa fa-users"></i>
          <span>Gestion de pêcheur</span>
        </a>
      </li>
      <?php } ?>
      <?php if ($this->lib_autorisation->visualisation_autorise(3)) { ?>
      <li class="treeview <?= route_active(array('technique/gestion-technique'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="/c3p/technique/gestion-technique">
          <i class="fa fa-crop"></i>
          <span>Techniques de pêche</span>
        </a>
      </li>
      <?php } ?>
      <?php if ($this->lib_autorisation->visualisation_autorise(4)) { ?>
      <li class="treeview <?= route_active(array('espece/gestion-espece'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="/c3p/espece/gestion-espece">
          <i class="fa fa-code-fork"></i>
          <span>Espèces</span>
        </a>
      </li>
      <?php } ?>
      <?php if ($this->lib_autorisation->visualisation_autorise(5)) { ?>
      <li class="treeview <?= route_active(array('taille/gestion-taille'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="/c3p/taille/gestion-taille">
          <i class="fa fa-sliders"></i>
          <span>Classe de taille</span>
        </a>
      </li>
      <?php } ?>
      <?php if ($this->lib_autorisation->visualisation_autorise(5)) { ?>
      <li class="treeview <?= route_active(array('peche/gestion-peche'), isset($active_route) && !empty($active_route) ? $active_route : '') ?>">
        <a href="/c3p/peche/gestion-peche">
          <i class="fa fa-sliders"></i>
          <span>Partie de pêche</span>
        </a>
      </li>
      <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>