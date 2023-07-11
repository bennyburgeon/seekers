<?php 
Class Loginmodel extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('candidate_id,email, username, password');
   $this -> db -> from('pms_admin_users');
    $this -> db -> where('username', $username);
    $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
	   $_SESSION['name']=$username;
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>