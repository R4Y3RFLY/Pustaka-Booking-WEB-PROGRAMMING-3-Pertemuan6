<?php
class Home extends CI_Controller
{
 function __construct()
 {
 parent::__construct();
    $this->load->model(['ModelBuku', 'ModelUser', 'ModelBooking']);
 }
 public function index()
 {
   $data = [
   'judul' => "Katalog Buku",
   'buku' => $this->ModelBuku->getBuku()->result(),
   ];
 if ($this->session->userdata('email')) {
   $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
   $data['user'] = $user['nama'];
   $this->load->view('templates/templates-user/header', $data);
   $this->load->view('buku/daftarbuku', $data);
   $this->load->view('templates/templates-user/modal');
   $this->load->view('templates/templates-user/footer', $data);
 } else {
   $data['user'] = 'Pengunjung';
   $this->load->view('templates/templates-user/header', $data);
   $this->load->view('buku/daftarbuku', $data);
   $this->load->view('templates/templates-user/modal');
   $this->load->view('templates/templates-user/footer', $data);
 }
 }

 public function detailBuku()
 {
   $id = $this->uri->segment(3);
   $data['id'] = $this->uri->segment(3);
   $data['user'] = "Pengunjung";
   $data['title'] = "Detail Buku";
   $data['buku'] = $this->ModelBuku->joinKategoriBuku($id)->row_array();

   $this->load->view('templates/templates-user/header', $data);
   $this->load->view('buku/detail_buku',$data);
   $this->load->view('templates/templates-user/modal');
   $this->load->view('templates/templates-user/footer');
 }

}
