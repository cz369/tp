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



	public function upload_image () {
		$base_path = "C:/Wnmp/html/tp"."/picture/"; // 接收文件目录
		$target_path = $base_path . basename ( $_FILES ['Filedata']['name']); 

		if (move_uploaded_file ( $_FILES ['Filedata']['tmp_name'], $target_path )) {  
			$data["device_Id"] = $_POST['DeviceID'];
			$data["path"] = $_FILES ['Filedata']['name'];
			$data["photo_date"] = date("Y-m-d H:i:s",time());
			$picture = M('picture');
            // $picture->device_id = $_POST['DeviceID'];
            // $picture->path = $_FILES ['Filedata']['name'];
            // $picture->photo_date = date("Y-m-d H:i:s",time());

            // var_dump($data);
            // var_dump($picture);
            $result = $picture->data($data)->add();
            var_dump($result);

            var_dump( $picture->_sql () );

                
		    $array = array (  
		            "code" => "1",  
		            "message" => $_FILES ['Filedata'] ['name']   
		    );  
		    echo json_encode ( $array );  
		} else {  
		    $array = array (  
		            "code" => "0",  
		            "message" => "There was an error uploading the file, please try again!" . $_FILES ['Filedata'] ['error']   
		    );  
		    echo json_encode ( $array );  
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
