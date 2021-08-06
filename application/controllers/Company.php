<?php
 
class Company extends CI_Controller
 
{
    public function index()
    {
        $this->load->view('company/header');
        $this->load->view('company/index');
        $this->load->view('company/footer');
    }
    public function contact()
    {
        $this->load->view('company/contact');
        $this->load->view('company/footer');
    }
}