<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pelanggan = $this->pelanggan_model->get_all();

        $data = array(
            'pelanggan_data' => $pelanggan
        );

        $this->template->load('adminTemplate','pelanggan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->pelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'pelanggan_id' => $row->pelanggan_id,
		'pelanggan_nama' => $row->pelanggan_nama,
		'pelanggan_alamat' => $row->pelanggan_alamat,
		'pelanggan_telpon' => $row->pelanggan_telpon,
	    );
            $this->template->load('adminTemplate','pelanggan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pelanggan/create_action'),
	    'pelanggan_id' => set_value('pelanggan_id'),
	    'pelanggan_nama' => set_value('pelanggan_nama'),
	    'pelanggan_alamat' => set_value('pelanggan_alamat'),
	    'pelanggan_telpon' => set_value('pelanggan_telpon'),
	);
        $this->template->load('adminTemplate','pelanggan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pelanggan_nama' => $this->input->post('pelanggan_nama',TRUE),
		'pelanggan_alamat' => $this->input->post('pelanggan_alamat',TRUE),
		'pelanggan_telpon' => $this->input->post('pelanggan_telpon',TRUE),
	    );

            $this->pelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->pelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pelanggan/update_action'),
		'pelanggan_id' => set_value('pelanggan_id', $row->pelanggan_id),
		'pelanggan_nama' => set_value('pelanggan_nama', $row->pelanggan_nama),
		'pelanggan_alamat' => set_value('pelanggan_alamat', $row->pelanggan_alamat),
		'pelanggan_telpon' => set_value('pelanggan_telpon', $row->pelanggan_telpon),
	    );
            $this->template->load('adminTemplate','pelanggan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pelanggan_id', TRUE));
        } else {
            $data = array(
		'pelanggan_nama' => $this->input->post('pelanggan_nama',TRUE),
		'pelanggan_alamat' => $this->input->post('pelanggan_alamat',TRUE),
		'pelanggan_telpon' => $this->input->post('pelanggan_telpon',TRUE),
	    );

            $this->pelanggan_model->update($this->input->post('pelanggan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->pelanggan_model->get_by_id($id);

        if ($row) {
            $this->pelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pelanggan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    function _rules() 
    {
	$this->form_validation->set_rules('pelanggan_nama', ' ', 'trim|required');
	$this->form_validation->set_rules('pelanggan_alamat', ' ', 'trim|required');
	$this->form_validation->set_rules('pelanggan_telpon', ' ', 'trim|required');

	$this->form_validation->set_rules('pelanggan_id', 'pelanggan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */