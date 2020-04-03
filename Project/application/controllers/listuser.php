<?php
class listuser extends CI_Controller {
    public function index()
    {
        $this->load->model("dede");
        $data = array(
            'user' => $this->dede->get()
        );
        $this->load->view("template/sidebar");
        $this->load->view("template/header");
        $this->load->view("ListUser/listuser", $data);
        $this->load->view("template/footer");
    }

    public function detail($id_user = 0)
    {
        $this->load->model("dede");
        $data = array('user' => $this->dede->detail($id_user));
        if (count($data["user"])<1)
            {
                redirect("listuser");
            }
        $data["user"] = $data["user"][0];
        $this->load->view("template/sidebar");
        $this->load->view("template/header");
        $this->load->view("ListUser/detail", $data);
        $this->load->view("template/footer");
    }

    public function delete($id_user)
    {
        $this->load->model("dede");
        $delete = array('user' => $this->dede->delete($id_user));
       $kembali = site_url("listuser");
       redirect($kembali);
    }
   
}