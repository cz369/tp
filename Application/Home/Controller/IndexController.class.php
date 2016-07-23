<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		if (IS_POST) {  
			$name=$_POST['username'];
			$password=$_POST['password'];

		    //echo $name;
			$db=M('user');

			$user=$db->where("username='$name' && password='$password'")->find();

			//$result = $db->where('username='.$name.' AND password='.$password)->fetchSql(true)->find();
			if (!empty($user)) {
				$this->success('登录成功', 'index');
				// $this->success("ss", 'test');
			} else {
				$this->error("用户或密码错误！");  
			}
			// var_dump($result);
			//var_dump($user);
			
		} else {
			$this->display();

		}
	} 
	public function login() {
		if (IS_POST) {  

			$name=$_POST['username'];
			$password=$_POST['password'];
			$submit=$_POST['checkbox'];

			session('session_name','$name'); 
			session('session_password','$passwords'); 
			if ($submit == 'remember-me') {
				session('session_auto_login','yes');	
			}
			$db=M('user');
			$user=$db->where("username='$name' && password='$password'")->find();
			

			if (!empty($user)) {
				$this->success('登录成功', 'index');
			} else {
				var_dump($user);
				$this->error("密码不对", "login");
			}
		} else {
			// $session_auto_login = session('session_auto_login');
			// if ($session_auto_login === "yes") {
			// 	$session_name = session('session_name');
			// 	$session_password = session('session_password');
				
			// 	$db=M('user');
			// 	$user = $db->where("username='$session_name' && password='$session_password'")->find();
			// 	if (!empty($user)) {
			// 		$this->success('index');	
			// 	}
			// } else {
			// 	$this->display();
			// }

			$this->display();
		
		}
	}

	public function need_photo(){
		if (IS_POST) {
			$device_id=$_POST['device_id'];
			$db=M('device');
			$db->device_need_photo = 1;
			$db->where("device_id='$device_id'")->save();
			$photo->M('picture');
			$photo->where("device_id='$device_id'")->getField('path');
			$this->ajaxReturn($photo);

		}
	}

	public function loginout(){

		$this->success('退出成功','index');
	}

	public function device_info_save(){
		if (IS_POST) {
			$device_id=$_POST['device_id'];

			$db=M('device');

			//$db->device_photo_size=$_POST['device_photo_size'];
			//$db->device_photo_quality=$_POST['device_photo_quality'];
			$db->device_photo_starttime=$_POST['device_photo_starttime'];
			// $db->device_photo_endtime=$_POST['device_photo_endtime'];
			// $db->device_frequency=$_POST['device_frequency'];

			$db->where("device_id='$device_id'")->save();
			
			
		} else {
			$this->display();
		}
	}	
	public function test() {
		$select = M('device');
		$date = $select->where("device_id='node.text'")->select();
		//var_dump($date);
		$this->assign("date", $date);

		$g=M('group');
		$group= $g->select();
		// var_dump($group);

		// foreach ($group as $key => $value) {
		// 	echo $value["group_name"]."<br/>";
		// }
		$this->assign("group", $group);
		$this->display();

	}

	public function update_auto_photo() {
		if (IS_GET) {
			$device_id = $_GET['device_id'];
			$checked = $_GET['checked'];

			var_dump($checked);
			var_dump($device_id);
			//判断如果是设备则查询
			// if ($device_id) {
			// 	$device = M('device');
			// 	$device->device_photo_auto
			// 	$data = $device->where("device_id=$device_id")->select();

			// 	$this->ajaxReturn($data);
			// }
		} else {
			$this->display();
		}
	}	

	public function device_info() {
		if (IS_GET) {
			$device_id = $_GET['device_id'];
			//判断如果是设备则查询
			if ($device_id) {
				$device = M('device');
				$data = $device->where("device_id=$device_id")->select();

				$this->ajaxReturn($data);
			}
		} else {
			$this->display();
		}
	}	
	public function device_status() {
		if (IS_GET) {
			$device_id = $_GET['device_id'];
			if($device_id) {
				$po=M('picture');
				$photo = $po->where("device_id = '$device_id'")->order('id desc')->limit(5)->select();
				//var_dump($photo);
				if (!empty($photo)) {
					$j = 0;
					
					foreach ($photo as $key => $value) {
						$photo[$j]["path"] = "http://139.129.167.13:8888/".$photo[$j]["path"];						
						$j++;
					}
				}
				
			}
			$this->ajaxReturn($photo);
			
		} else {
			$this->display();
		}

	}


	public function group() {
		if (IS_GET) {
			$g=M('group');
			$group= $g->select();
			$group_data=array();
			$i = 0;
			foreach ($group as $key => $value) {
				$group_data[$i][text] = $value["group_name"];

				//处理设备
				$g_id = $value["id"];
				$device = M('device');
				$devices = $device->where("device_group = $g_id")->select();
				if (!empty($devices)) {
					$j = 0;
					$device_data=array();
					foreach ($devices as $key => $value) {
						$device_data[$j][text] = $value["device_id"];
						$group_data[$i][nodes] = $device_data;
						$j++;
					}
				}
				$i++;
			}

			$this->ajaxReturn($group_data);
		} else {
			$this->display();
		}
		
	}
}






