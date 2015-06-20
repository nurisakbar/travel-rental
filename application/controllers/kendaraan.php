<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kendaraan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kendaraan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kendaraan = $this->kendaraan_model->get_all();

        $data = array(
            'kendaraan_data' => $kendaraan
        );

        $this->template->load('adminTemplate','kendaraan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->kendaraan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kendaraan_id' => $row->kendaraan_id,
		'kendaraan_platnomor' => $row->kendaraan_platnomor,
		'kendaraan_merk' => $row->kendaraan_merk,
		'kendaraan_tipe' => $row->kendaraan_tipe,
		'kendaraan_tahunrakit' => $row->kendaraan_tahunrakit,
		'kendaraan_seat' => $row->kendaraan_seat,
		'kendaraan_foto' => $row->kendaraan_foto,
		'kendaraan_fasilitas' => $row->kendaraan_fasilitas,
		'kendaraan_status' => $row->kendaraan_status,
	    );
            $this->template->load('adminTemplate','kendaraan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kendaraan'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kendaraan/create_action'),
	    'kendaraan_id' => set_value('kendaraan_id'),
	    'kendaraan_platnomor' => set_value('kendaraan_platnomor'),
	    'kendaraan_merk' => set_value('kendaraan_merk'),
	    'kendaraan_tipe' => set_value('kendaraan_tipe'),
	    'kendaraan_tahunrakit' => set_value('kendaraan_tahunrakit'),
	    'kendaraan_seat' => set_value('kendaraan_seat'),
	    'kendaraan_foto' => set_value('kendaraan_foto'),
	    'kendaraan_fasilitas' => set_value('kendaraan_fasilitas'),
	    'kendaraan_status' => set_value('kendaraan_status'),
	);
        $this->template->load('adminTemplate','kendaraan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kendaraan_platnomor' => $this->input->post('kendaraan_platnomor',TRUE),
		'kendaraan_merk' => $this->input->post('kendaraan_merk',TRUE),
		'kendaraan_tipe' => $this->input->post('kendaraan_tipe',TRUE),
		'kendaraan_tahunrakit' => $this->input->post('kendaraan_tahunrakit',TRUE),
		'kendaraan_seat' => $this->input->post('kendaraan_seat',TRUE),
		'kendaraan_foto' => $this->input->post('kendaraan_foto',TRUE),
		'kendaraan_fasilitas' => $this->input->post('kendaraan_fasilitas',TRUE),
		'kendaraan_status' => $this->input->post('kendaraan_status',TRUE),
	    );
            
        
            $this->kendaraan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kendaraan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->kendaraan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kendaraan/update_action'),
		'kendaraan_id' => set_value('kendaraan_id', $row->kendaraan_id),
		'kendaraan_platnomor' => set_value('kendaraan_platnomor', $row->kendaraan_platnomor),
		'kendaraan_merk' => set_value('kendaraan_merk', $row->kendaraan_merk),
		'kendaraan_tipe' => set_value('kendaraan_tipe', $row->kendaraan_tipe),
		'kendaraan_tahunrakit' => set_value('kendaraan_tahunrakit', $row->kendaraan_tahunrakit),
		'kendaraan_seat' => set_value('kendaraan_seat', $row->kendaraan_seat),
		'kendaraan_foto' => set_value('kendaraan_foto', $row->kendaraan_foto),
		'kendaraan_fasilitas' => set_value('kendaraan_fasilitas', $row->kendaraan_fasilitas),
		'kendaraan_status' => set_value('kendaraan_status', $row->kendaraan_status),
	    );
            $this->template->load('adminTemplate','kendaraan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kendaraan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kendaraan_id', TRUE));
        } else {
            $data = array(
		'kendaraan_platnomor' => $this->input->post('kendaraan_platnomor',TRUE),
		'kendaraan_merk' => $this->input->post('kendaraan_merk',TRUE),
		'kendaraan_tipe' => $this->input->post('kendaraan_tipe',TRUE),
		'kendaraan_tahunrakit' => $this->input->post('kendaraan_tahunrakit',TRUE),
		'kendaraan_seat' => $this->input->post('kendaraan_seat',TRUE),
		'kendaraan_foto' => $this->input->post('kendaraan_foto',TRUE),
		'kendaraan_fasilitas' => $this->input->post('kendaraan_fasilitas',TRUE),
		'kendaraan_status' => $this->input->post('kendaraan_status',TRUE),
	    );

            $this->kendaraan_model->update($this->input->post('kendaraan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kendaraan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->kendaraan_model->get_by_id($id);

        if ($row) {
            $this->kendaraan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kendaraan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kendaraan'));
        }
    }

    function _rules() 
    {
	$this->form_validation->set_rules('kendaraan_platnomor', ' ', 'trim|required');
	$this->form_validation->set_rules('kendaraan_merk', ' ', 'trim|required');
	$this->form_validation->set_rules('kendaraan_tipe', ' ', 'trim|required');
	$this->form_validation->set_rules('kendaraan_tahunrakit', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('kendaraan_seat', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('kendaraan_foto', ' ', 'trim|required');
	$this->form_validation->set_rules('kendaraan_fasilitas', ' ', 'trim|required');
	$this->form_validation->set_rules('kendaraan_status', ' ', 'trim|required');

	$this->form_validation->set_rules('kendaraan_id', 'kendaraan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kendaraan.php */
/* Location: ./application/controllers/Kendaraan.php */