<?php 

function is_logged_in(){
    $cek = get_instance();
    if(!$cek->session->userdata('email')){
        redirect('auth/login');
    }
}

?>