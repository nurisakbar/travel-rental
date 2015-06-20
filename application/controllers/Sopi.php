<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sopi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('sopi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $sopi = $this->sopi_model->get_all();

        $data = array(
            'sopi_data' => $sopi
        );

        $this->template->load('adminTemplate','sopir_list', $data);
    }

    public function read($id) 
    {
        $row = $this->sopi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'sopir_id' => $row->sopir_id,
		'sopir_alamat' => $row->sopir_alamat,
		'sopir_nama' => $row->sopir_nama,
		'sopir_telpon' => $row->sopir_telpon,
		'sopir_ktp' => $row->sopir_ktp,
		'sopir_sim' => $row->sopir_sim,
		'sopir_status' => $row->sopir_status,
	    );
            $this->template->load('adminTemplate','sopir_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sopi'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sopi/create_action'),
	    'sopir_id' => set_value('sopir_id'),
	    'sopir_alamat' => set_value('sopir_alamat'),
	    'sopir_nama' => set_value('sopir_nama'),
	    'sopir_telpon' => set_value('sopir_telpon'),
	    'sopir_ktp' => set_value('sopir_ktp'),
	    'sopir_sim' => set_value('sopir_sim'),
	    'sopir_status' => set_value('sopir_status'),
	);
        $this->template->load('adminTemplate','sopir_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'sopir_alamat' => $this->input->post('sopir_alamat',TRUE),
		'sopir_nama' => $this->input->post('sopir_nama',TRUE),
		'sopir_telpon' => $this->input->post('sopir_telpon',TRUE),
		'sopir_ktp' => $this->input->post('sopir_ktp',TRUE),
		'sopir_sim' => $this->input->post('sopir_sim',TRUE),
		'sopir_status' => $this->input->post('sopir_status',TRUE),
	    );

            $this->sopi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sopi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->sopi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sopi/update_action'),
		'sopir_id' => set_value('sopir_id', $row->sopir_id),
		'sopir_alamat' => set_value('sopir_alamat', $row->sopir_alamat),
		'sopir_nama' => set_value('sopir_nama', $row->sopir_nama),
		'sopir_telpon' => set_value('sopir_telpon', $row->sopir_telpon),
		'sopir_ktp' => set_value('sopir_ktp', $row->sopir_ktp),
		'sopir_sim' => set_value('sopir_sim', $row->sopir_sim),
		'sopir_status' => set_value('sopir_status', $row->sopir_status),
	    );
            $this->template->load('adminTemplate','sopir_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sopi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('sopir_id', TRUE));
        } else {
            $data = array(
		'sopir_alamat' => $this->input->post('sopir_alamat',TRUE),
		'sopir_nama' => $this->input->post('sopir_nama',TRUE),
		'sopir_telpon' => $this->input->post('sopir_telpon',TRUE),
		'sopir_ktp' => $this->input->post('sopir_ktp',TRUE),
		'sopir_sim' => $this->input->post('sopir_sim',TRUE),
		'sopir_status' => $this->input->post('sopir_status',TRUE),
	    );

            $this->sopi_model->update($this->input->post('sopir_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sopi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->sopi_model->get_by_id($id);

        if ($row) {
            $this->sopi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sopi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sopi'));
        }
    }

    function _rules() 
    {
	$this->form_validation->set_rules('sopir_alamat', ' ', 'trim|required');
	$this->form_validation->set_rules('sopir_nama', ' ', 'trim|required');
	$this->form_validation->set_rules('sopir_telpon', ' ', 'trim|required');
	$this->form_validation->set_rules('sopir_ktp', ' ', 'trim|required');
	$this->form_validation->set_rules('sopir_sim', ' ', 'trim|required');
	$this->form_validation->set_rules('sopir_status', ' ', 'trim|required');

	$this->form_validation->set_rules('sopir_id', 'sopir_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Sopi.php */
/* Location: ./application/controllers/Sopi.php */