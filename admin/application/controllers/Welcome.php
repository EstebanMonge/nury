<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('welcome.php',(array)$output);
	}


	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function sections()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('sections');
			$crud->set_subject('Secciones');
			$crud->required_fields('name','sort','active');
			$crud->display_as('name','Nombre');
			$crud->display_as('sort','Orden');
			$crud->display_as('active','Activo');
			$crud->columns('name','sort','active');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function items()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('items');
			$crud->set_subject('Items');
			$crud->required_fields('name','section_id','sort','active');
			$crud->columns('name','section_id','sort','active');
			$crud->display_as('name','Nombre');
			$crud->display_as('sort','Orden');
			$crud->display_as('section_id','Sección');
			$crud->display_as('active','Activo');
			$crud->set_relation('section_id','sections','name');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}
