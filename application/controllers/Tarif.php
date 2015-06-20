<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tarif_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        //$tarif = $this->tarif_model->get_all();
        $sql = "SELECT t.*,k.kendaraan_platnomor,k.kendaraan_foto
                FROM tarif as t,kendaraan as k 
                WHERE t.kendaraan_id=k.kendaraan_id";
        $tarif = $this->db->query($sql)->result();
        $data = array(
            'tarif_data' => $tarif
        );
        $this->template->load('adminTemplate','tarif_list', $data);
    }

    public function read($id) 
    {
        $row = $this->tarif_model->get_by_id($id);
        if ($row) {
            $data = array(
		'tarif_id' => $row->tarif_id,
		'kendaraan_id' => $row->kendaraan_id,
		'tarif_perhari' => $row->tarif_perhari,
		'tarif_overtime' => $row->tarif_overtime,
	    );
            $this->template->load('adminTemplate','tarif_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tarif'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tarif/create_action'),
	    'tarif_id' => set_value('tarif_id'),
	    'kendaraan_id' => set_value('kendaraan_id'),
	    'tarif_perhari' => set_value('tarif_perhari'),
	    'tarif_overtime' => set_value('tarif_overtime'),
	);
        $this->template->load('adminTemplate','tarif_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kendaraan_id' => $this->input->post('kendaraan_id',TRUE),
		'tarif_perhari' => $this->input->post('tarif_perhari',TRUE),
		'tarif_overtime' => $this->input->post('tarif_overtime',TRUE),
	    );

            $this->tarif_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tarif'));
        }
    }
    
    public function update($id) 
    {
        //$row = $this->tarif_model->get_by_id($id);
        $sql = "SELECT t.*,k.kendaraan_platnomor,k.kendaraan_foto
                FROM tarif as t,kendaraan as k 
                WHERE t.kendaraan_id=k.kendaraan_id and t.tarif_id='$id'";
        $row = $this->db->query($sql)->row_array();
                
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tarif/update_action'),
		'tarif_id' => set_value('tarif_id', $row->tarif_id),
		'kendaraan_id' => set_value('kendaraan_id', $row->kendaraan_platnomor),
		'tarif_perhari' => set_value('tarif_perhari', $row->tarif_perhari),
		'tarif_overtime' => set_value('tarif_overtime', $row->tarif_overtime),
	    );
            $this->template->load('adminTemplate','tarif_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tarif'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('tarif_id', TRUE));
        } else {
            $data = array(
		'kendaraan_id' => $this->input->post('kendaraan_id',TRUE),
		'tarif_perhari' => $this->input->post('tarif_perhari',TRUE),
		'tarif_overtime' => $this->input->post('tarif_overtime',TRUE),
	    );

            $this->tarif_model->update($this->input->post('tarif_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tarif'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->tarif_model->get_by_id($id);

        if ($row) {
            $this->tarif_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tarif'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tarif'));
        }
    }

    function _rules() 
    {
	$this->form_validation->set_rules('kendaraan_id', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('tarif_perhari', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('tarif_overtime', ' ', 'trim|required|numeric');

	$this->form_validation->set_rules('tarif_id', 'tarif_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tarif.php */
/* Location: ./application/controllers/Tarif.php */