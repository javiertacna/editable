<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->model('usuarios_model');
	}

	public function index()
	{
		$data['usuarios'] = $this->db->query('SELECT * FROM info');
		$this->load->view('welcome_message',$data);
	}

	public function ajax()
	{
		if(isset($_POST) && count($_POST))
		{
			$action = $_POST['action'];
			unset($_POST['action']);

			if($action == "save"){
				// remove 'action' key from array, we no longer need it

				// Never ever believe on end user, he could be a evil minded
				$escapedPost = array_map('mysql_real_escape_string', $_POST);
				$escapedPost = array_map('htmlentities', $escapedPost);
				$res = $this->usuarios_model->save($escapedPost);

				if($res){
					$escapedPost["success"] = "1";
					$escapedPost["id"] = $res;
					echo json_encode($escapedPost);
				}
				else
					echo $this->usuarios_model->error("save");
			}else if($action == "del"){
				$id = $_POST['rid'];
				$res = $this->usuarios_model->delete_record($id);
				if($res)
					echo json_encode(array("success" => "1","id" => $id));
				else
					echo $this->usuarios_model->error("delete");
			}
			else if($action == "update"){

				$escapedPost = array_map('mysql_real_escape_string', $_POST);
				$escapedPost = array_map('htmlentities', $escapedPost);

				$id = $this->usuarios_model->update_record($escapedPost);
				if($id)
					echo json_encode(array_merge(array("success" => "1","id" => $id),$escapedPost));
				else
					echo $this->usuarios_model->error("update");
			}
			else if($action == "updatetd"){

				$escapedPost = array_map('mysql_real_escape_string', $_POST);
				$escapedPost = array_map('htmlentities', $escapedPost);

				$id = $this->usuarios_model->update_column($escapedPost);
				if($id)
					echo json_encode(array_merge(array("success" => "1","id" => $id),$escapedPost));
				else
					echo $this->usuarios_model->error("updatetd");
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */