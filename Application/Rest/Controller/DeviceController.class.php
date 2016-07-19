<?php
namespace Rest\Controller;
use Think\Controller\RestController;
class DeviceController extends RestController {
	
	public function register() {
		switch ($this->_method){

	      case 'get': // get请求处理代码
	      break;
	      case 'put': // put请求处理代码
	      break;
	      case 'post': // post请求处理代码
		      if ($this->_type == 'json'){

		      	$device_info = json_decode(file_get_contents('php://input'),true);
                //var_dump($device_info);

                $Device = M('Device');
                $device_id = $device_info["device_id"];

		      	$Device->longitude = $device_info["longitude"];
		      	$Device->latitude = $device_info["latitude"];
		      	 $user = $Device->where("device_id='$device_id'")->find();
		      	 if(empty($user)) {

	                $r = $Device->data($device_info)->add();
			      	$data = '{"id":'.$r.'}';

		      	 }

		      	$this->response($data,'json');
		      }elseif($this->_type == 'xml'){
		      }
		      break;
  		}
	} 
	public function device_info () {
		switch ($this->_method){

	      case 'get': // get请求处理代码
	      break;
	      case 'put': // put请求处理代码
	      break;
	      case 'post': // post请求处理代码
	      if ($this->_type == 'json'){

	      	$device_info = json_decode(file_get_contents('php://input'),true);
	      	//var_dump($device_info);

	      	$Device = M('Device');
	      	$device_id = $device_info["device_id"];


	      	$user = $Device->where("device_id='$device_id'")->select();
	      	//var_dump($user);
	      	$this->response($user,'json');	

	      } else {
	      	$this->display();
	      }
	  }
	} 

	public function upadte_lon_lat() {
		switch ($this->_method){

	      case 'get': // get请求处理代码
	      break;
	      case 'put': // put请求处理代码
	      break;
	      case 'post': // post请求处理代码
		      if ($this->_type == 'json'){

		      	$device_info = json_decode(file_get_contents('php://input'),true);

		      	$Device = M('Device');
		      	$device_id = $device_info["device_id"];

		      	$Device->longitude = $device_info["longitude"];
		      	$Device->latitude = $device_info["latitude"];
                $r = $Device->where("device_id='$device_id'")->save();
                $data = '{"id":'.$r.'}';
		      	$this->response($data,'json');
		      }elseif($this->_type == 'xml'){
		      }
		      break;
  		}
	}


	public function user() {
		switch ($this->_method){

	      case 'get': // get请求处理代码
	      	if ($this->_type == 'json'){
		      	echo I('post.name');
		      	$data = '{"info":"yes"}';

		      	$this->response($data,'json');
		    } elseif($this->_type == 'xml'){
		    }
	      break;
	      case 'put': // put请求处理代码
	      break;
	      case 'post': // post请求处理代码
		      echo $this->_type;
		      if ($this->_type == 'json'){
		      	var_dump($_POST);
		      	echo I('post.name');
		      	$data = '{"info":"yes"}';

		      	$this->response($data,'json');
		      }elseif($this->_type == 'xml'){
		      }
		      break;
  		}
	}
}
?>
