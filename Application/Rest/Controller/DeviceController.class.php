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
		      	$user_info = json_decode(file_get_contents('php://input'),true);

                $Device = M('Device');
                $r = $Device->data($user_info)->add();
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
