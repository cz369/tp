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
			}
			// var_dump($result);
			var_dump($user);
			
		} else {
			$this->display();
		}
		
		
		
	}
}




