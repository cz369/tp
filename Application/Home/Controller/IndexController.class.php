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
				$this->success('登录成功', 'test');
				// $this->success("ss", 'test');
			}
			// var_dump($result);
			var_dump($user);
			
		} else {
			$this->display();
		}
		
		
		
	}
	public function test() {
		$select = M('device');
		$date = $select->select();
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




