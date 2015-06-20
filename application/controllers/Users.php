<?php
class Users extends CI_Controller{
    
    
    function dashsboard(){
        $this->template->load('adminTemplate','dashboard');
    }
    function login(){
        if(isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $pass  = md5($_POST['password']);
            $chek = $this->db->get_where('users',array('email'=>$email,'password'=>$pass  ));
            if($chek->num_rows()>0)
            {
                $sess = array('status'=>'login','email'=>$email);
                $this->session->set_userdata($sess);
                redirect('kendaraan');
            }else{
                $this->load->view('login');
            }
        }else{
                    $this->load->view('login');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect('kendaraan');
    }
}