<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    function listar_Usuarios()
	{
		try
		{
			$data = $this->db->query('SELECT * FROM info');

			if ($data->num_rows() > 0)
			{
				return $data;
			}
			else
			{
				return FALSE;
			}
		}
		catch (Exception $e)
		{
			echo "ERROR: ".$e->getMessage();
		}
	}

	function save($data)
	{
		if(count($data))
		{
			$values = implode("','", array_values($data));
			$this->db->query("insert into info (".implode(",",array_keys($data)).") values ('".$values."')");
			if(mysql_insert_id()) return mysql_insert_id();
			return 0;
		}
		else return 0;
	}

  	function delete_record($id)
  	{
		if($id)
		{
			$this->db->query("delete from info where id = $id limit 1");
			return mysql_affected_rows();
		}
  	}

  	function update_record($data)
  	{
		if(count($data))
		{
			$id = $data['rid'];
			unset($data['rid']);
			$values = implode("','", array_values($data));
			$str = "";
			foreach($data as $key=>$val){
				$str .= $key."='".$val."',";
			}
			$str = substr($str,0,-1);
			$sql = "update info set $str where id = $id limit 1";

			$res = $this->db->query($sql);

			if(mysql_affected_rows()) return $id;
			return 0;
		}
		else return 0;
  	}

  	function update_column($data)
  	{
		if(count($data))
		{
			$id = $data['rid'];
			unset($data['rid']);
			$sql = "update info set ".key($data)."='".$data[key($data)]."' where id = $id limit 1";
			$res = $this->db->query($sql);
			if(mysql_affected_rows()) return $id;
			return 0;

		}
  	}

  	function error($act)
  	{
		 return json_encode(array("success" => "0","action" => $act));
	}
}