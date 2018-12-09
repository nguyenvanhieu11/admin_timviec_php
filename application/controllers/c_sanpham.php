<?php
/**
 * Created by PhpStorm.
 * User: Savvycom
 * Date: 6/17/2018
 * Time: 12:11 AM
 */

class C_sanpham extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('M_sanpham');
    }

    public function index($page=0){
        $this->load->library('pagination');
        //+ Cấu hình chỉ ra url được sử dụng trong các liên kết trang
        $config['base_url'] = site_url('c_sanpham/index');
        //+ Cấu hình tổng số dòng cần phân trang
        $config['total_rows'] = $this->db->count_all('san_pham');
        //+ Cấu hình xác định số dòng được hiển thị trong mỗi trang
        $config['per_page'] = 10 ;
        //+ Cấu hình các dùng link phân trang của bootstrap
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="text-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        //$config['first_link'] = true;
        //$config['last_link'] = true;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data["phantrang"]= $this->pagination->create_links();
        $data["product"]=$this->M_sanpham->getAllsanpham($config['per_page'],$page);
        $this->template->load('master_layout','connects','sanpham/v_sanpham',$data);
    }

    public function delete($id){
        $this->M_sanpham->delete($id);
        redirect(site_url('c_sanpham'));
    }
}