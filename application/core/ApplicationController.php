<?php

require_once 'EchantillonageController.php';



class ApplicationController extends EchantillonageController {

	public function __construct() {

		parent::__construct();



		// styles et scripts personnalises

		$this->root_states['body_classes'] = array(
			
			'hold-transition', 
			
			'skin-purple',
			
			'fixed',

			'sidebar-mini',


			

		);

		$this->root_states['default_stylesheets'] = array_merge($this->root_states['default_stylesheets'], array(

			'dataTables.bootstrap.css',

			'jquery-confirm.min.css',

			'dataTables.responsive.css',

			'dataTables.fixedHeader.min.css',

			'toastr.min.css'

		));

		$this->root_states['default_javascripts'] = array_merge($this->root_states['default_javascripts'], array(

			'jquery.dataTables.min.js',

			'dataTables.bootstrap.min.js',

			'dataTables.responsive.min.js',

			'dataTables.responsive.min.js',

			'jquery-confirm.min.js',

			'JConfirmExtension.js',

			'sweetalert2.min.js',

			'toastr.min.js'

		));

		if (empty($this->session->userdata('token'))) {

			redirect(site_url('connexion'));

		} else {

			$this->load->library('autorisation', $this->session->userdata('groupe'), 'lib_autorisation');

		}

	}

}

