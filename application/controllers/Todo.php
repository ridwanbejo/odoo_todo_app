<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common');

		// config
		$this->ripcord_config = array(
									'url' => 'http://localhost:8069',
									'db' => 'inzpire2',
									'username' => 'admin',
									'password' => 'inzpire2',
								);
		require_once('./application/libraries/ripcord/ripcord.php');
	}

	public function get_uid()
	{
		$common = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/common");
		$uid = $common->authenticate(
										$this->ripcord_config['db'], 
										$this->ripcord_config['username'], 
										$this->ripcord_config['password'], 
										array()
									);
		return $uid;
	}

	public function index()
	{
		$uid = $this->get_uid();
		$models = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/object");

		$results = $models->execute_kw(
										$this->ripcord_config['db'],
										$uid,
										$this->ripcord_config['password'],
										'todo_app.todo_app',
										'search_read',
										array(
												array(
													array('active', '=', True),
												)
											),
										array(
												'fields'=>array('id', 'name', 'is_done', 'active', 'create_date', 'write_date'), 
											)
									);
		$this->load->view('todo/index', array('todos'=>$results));
	}

	public function add()
	{
		$this->load->view('todo/add');
	}

	public function create()
	{
		$uid = $this->get_uid();
		$models = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/object");
		$is_done = ($this->input->post('is_done') == 1 ? True :  False);
		$is_active = ($this->input->post('is_active') == 1 ? True : False);
		$id = $models->execute_kw(
									$this->ripcord_config['db'], 
									$uid,
									$this->ripcord_config['password'],
								    'todo_app.todo_app', 'create',
								    array(
								    		array('name'=>$this->input->post('task')),
								    		array('is_done'=> $is_done),
								    		array('active'=> $is_active),
								    	)
								  );

		redirect(site_url('todo/index'));
	}

	public function edit($id)
	{
		$uid = $this->get_uid();
		$models = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/object");
		$result = $models->execute_kw(
										$this->ripcord_config['db'],
										$uid,
										$this->ripcord_config['password'],
									    'todo_app.todo_app', 
									    'read',
									    array((int) $id), 
									    array(
												'fields'=>array('id', 'name', 'is_done', 'active', 'create_date', 'write_date'), 
											)
								    );

		$this->load->view('todo/edit', array('task' => $result));
	}

	public function update()
	{
		$uid = $this->get_uid();
		$models = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/object");
		$is_done = ($this->input->post('is_done') == 1 ? True :  False);
		$is_active = ($this->input->post('is_active') == 1 ? True : False);
		$result = $models->execute_kw(
										$this->ripcord_config['db'],
										$uid,
										$this->ripcord_config['password'],
									    'todo_app.todo_app', 
									    'write',
									    array(
									    		array( (int) $this->input->post('id') ), 
									    		array(
									    				'is_done'=>$is_done,
									    				'active'=>$is_active,
									    				'name'=>$this->input->post('task'),
									    			)
									    )
								    );
		redirect(site_url('todo/index'));
	}

	public function delete($id)
	{
		$uid = $this->get_uid();
		$models = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/object");
		$result = $models->execute_kw(
										$this->ripcord_config['db'],
										$uid,
										$this->ripcord_config['password'],
									    'todo_app.todo_app', 
									    'unlink',
									    array(array((int) $id))
								    );

		redirect(site_url('todo/index'));
	}

	public function set_done($id, $done)
	{
		$uid = $this->get_uid();
		$models = ripcord::client($this->ripcord_config['url']."/xmlrpc/2/object");
		$done = ($done == 1 ? True : False);
		$result = $models->execute_kw(
										$this->ripcord_config['db'],
										$uid,
										$this->ripcord_config['password'],
									    'todo_app.todo_app', 
									    'write',
									    array(
									    		array( (int) $id ), 
									    		array('is_done'=>$done)
									    )
								    );
		redirect(site_url('todo/index'));
	}	
}
