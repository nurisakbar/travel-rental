<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $transaksi = $this->transaksi_model->get_all();
        $sql = "SELECT t.*,p.pelanggan_nama,s.sopir_nama,k.kendaraan_platnomor,k.kendaraan_foto
                FROM transaksi as t,pelanggan as p,sopir as s,kendaraan as k
                WHERE t.sopir_id=s.sopir_id and t.pelanggan_id=p.pelanggan_id and t.kendaraan_id=k.kendaraan_id";
        $transaksi = $this->db->query($sql)->result();
        $data = array(
            'transaksi_data' => $transaksi
        );

        $this->template->load('adminTemplate', 'transaksi_list', $data);
    }
    
    function cetak(){
        $sql = "SELECT t.*,p.pelanggan_nama,s.sopir_nama,k.kendaraan_platnomor,k.kendaraan_foto
                FROM transaksi as t,pelanggan as p,sopir as s,kendaraan as k
                WHERE t.sopir_id=s.sopir_id and t.pelanggan_id=p.pelanggan_id and t.kendaraan_id=k.kendaraan_id";
        $data['transaksi'] = $this->db->query($sql)->result();
        $this->load->view('transaksi_cetak',$data);
    }

    function hitungHari($mulai, $selesai) {
        $now = strtotime($mulai);
        $selesai = strtotime($selesai);
        $datediff = $now - $selesai;
        $result = floor($datediff / (60 * 60 * 24));
        return $result;
    }

    function hitungTotal($overTime, $jmlHari, $kendaraanID) {
        /// get harga
        $total = 0;
        $price = $this->db->get_where('tarif', array('kendaraan_id' => $kendaraanID))->row_array();
        $total = $total + ($overTime * $price['tarif_perhari']);
        $total = $total + ($overTime * $price['tarif_overtime']);
        return $total;
    }

    function selesai($id) {
        $id = $this->uri->segment(3);
        $transaksi = $this->db->query("select * from transaksi where transaksi_id='$id'");
        if ($transaksi->num_rows()>0) {
            $transaksi = $transaksi->row_array();
            // over pinjam atau tidak ?
            $countDay = $this->hitungHari(date("Y-m-d"), $transaksi['transaksi_tglselesai']);
            $isOver = substr($countDay, 0, 1);
            $jml = substr($countDay, 0, 1);
            $jmlHari = substr($this->hitungHari($transaksi['transaksi_tglmulai'], $transaksi['transaksi_tglselesai']), 1, 4);
            if ($isOver == '+') {
                // overload
                $this->db->where('transaksi_id', $id);
                $this->db->update('transaksi', array(
                    'transaksi_tglovertime' => waktu(),
                    'transaksi_hari' => $jmlHari,
                    'transaksi_hariovertime' => 0,
                    'transaksi_total' => $this->hitungTotal($jml, $jmlHari, $transaksi['kendaraan_id']),
                    'transaksi_status' => 'selesai'
                ));
            } else {
                // tidak
                $total = $this->hitungTotal($jml, $jmlHari, $transaksi['kendaraan_id']);
                $this->db->where('transaksi_id', $id);
                $this->db->update('transaksi', array(
                    'transaksi_tglovertime' => waktu(),
                    'transaksi_hari' => $jmlHari,
                    'transaksi_hariovertime' => $jml,
                    'transaksi_total' => $total,
                    'transaksi_status' => 'selesai'
                ));
            }
        }
        $this->changeStatusDriver('bebas');
        redirect('transaksi');
    }

    function changeStatusDriver($status) {
        // update kendaraan setatus jadi bebas
        $this->db->where('kendaraan_id', $this->input->post('kendaraan_id', TRUE));
        $this->db->update('kendaraan', array('kendaraan_status' => $status));
        // update status supir jadi bebas
        $this->db->where('sopir_id', $this->input->post('sopir_id', TRUE));
        $this->db->update('sopir', array('sopir_status' => $status));
    }

    public function read($id) {
        //$row = $this->transaksi_model->get_by_id($id);
        $sql = "SELECT t.*,p.pelanggan_nama,s.sopir_nama,k.kendaraan_platnomor,k.kendaraan_foto
                FROM transaksi as t,pelanggan as p,sopir as s,kendaraan as k
                WHERE t.sopir_id=s.sopir_id and t.pelanggan_id=p.pelanggan_id 
                and t.kendaraan_id=k.kendaraan_id and t.transaksi_id='$id'";
        $row = $this->db->query($sql)->row_array();
        if ($row) {
            $data = array(
                'transaksi_id' => $row['transaksi_id'],
                'pelanggan_id' => $row['pelanggan_nama'],
                'sopir_id' => $row['sopir_nama'],
                'kendaraan_id' => $row['kendaraan_platnomor'],
                'transaksi_tglmulai' => $row['transaksi_tglmulai'],
                'transaksi_tglselesai' => $row['transaksi_tglselesai'],
                'transaksi_hari' => $row['transaksi_hari'],
                'transaksi_tglovertime' => $row['transaksi_tglovertime'],
                'transaksi_hariovertime' => $row['transaksi_hariovertime'],
                'transaksi_total' => $row['transaksi_total'],
                'transaksi_status' => $row['transaksi_status'],
            );
            $this->template->load('adminTemplate', 'transaksi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/create_action'),
            'transaksi_id' => set_value('transaksi_id'),
            'pelanggan_id' => set_value('pelanggan_id'),
            'sopir_id' => set_value('sopir_id'),
            'kendaraan_id' => set_value('kendaraan_id'),
            'transaksi_tglmulai' => set_value('transaksi_tglmulai'),
            'transaksi_tglselesai' => set_value('transaksi_tglselesai'),
            'transaksi_hari' => set_value('transaksi_hari'),
            'transaksi_tglovertime' => set_value('transaksi_tglovertime'),
            'transaksi_hariovertime' => set_value('transaksi_hariovertime'),
            'transaksi_total' => set_value('transaksi_total'),
            'transaksi_status' => set_value('transaksi_status'),
        );
        $this->template->load('adminTemplate', 'transaksi_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'pelanggan_id' => $this->input->post('pelanggan_id', TRUE),
                'sopir_id' => $this->input->post('sopir_id', TRUE),
                'kendaraan_id' => $this->input->post('kendaraan_id', TRUE),
                'transaksi_tglmulai' => waktu(),
                'transaksi_tglselesai' => $this->input->post('transaksi_tglselesai', TRUE),
                    //'transaksi_hari' => $this->input->post('transaksi_hari',TRUE),
                    //'transaksi_tglovertime' => $this->input->post('transaksi_tglovertime',TRUE),
                    //'transaksi_hariovertime' => $this->input->post('transaksi_hariovertime',TRUE),
                    //'transaksi_total' => $this->input->post('transaksi_total',TRUE),
                    //'transaksi_status' => $this->input->post('transaksi_status',TRUE),
            );

            $this->transaksi_model->insert($data);
            $this->changeStatusDriver('jalan');
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi'));
        }
    }

    public function update($id) {
        $row = $this->transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
                'transaksi_id' => set_value('transaksi_id', $row->transaksi_id),
                'pelanggan_id' => set_value('pelanggan_id', $row->pelanggan_id),
                'sopir_id' => set_value('sopir_id', $row->sopir_id),
                'kendaraan_id' => set_value('kendaraan_id', $row->kendaraan_id),
                'transaksi_tglmulai' => set_value('transaksi_tglmulai', $row->transaksi_tglmulai),
                'transaksi_tglselesai' => set_value('transaksi_tglselesai', $row->transaksi_tglselesai),
                'transaksi_hari' => set_value('transaksi_hari', $row->transaksi_hari),
                'transaksi_tglovertime' => set_value('transaksi_tglovertime', $row->transaksi_tglovertime),
                'transaksi_hariovertime' => set_value('transaksi_hariovertime', $row->transaksi_hariovertime),
                'transaksi_total' => set_value('transaksi_total', $row->transaksi_total),
                'transaksi_status' => set_value('transaksi_status', $row->transaksi_status),
            );
            $this->template->load('adminTemplate', 'transaksi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('transaksi_id', TRUE));
        } else {
            $data = array(
                'pelanggan_id' => $this->input->post('pelanggan_id', TRUE),
                'sopir_id' => $this->input->post('sopir_id', TRUE),
                'kendaraan_id' => $this->input->post('kendaraan_id', TRUE),
                'transaksi_tglmulai' => $this->input->post('transaksi_tglmulai', TRUE),
                'transaksi_tglselesai' => $this->input->post('transaksi_tglselesai', TRUE),
                'transaksi_hari' => $this->input->post('transaksi_hari', TRUE),
                'transaksi_tglovertime' => $this->input->post('transaksi_tglovertime', TRUE),
                'transaksi_hariovertime' => $this->input->post('transaksi_hariovertime', TRUE),
                'transaksi_total' => $this->input->post('transaksi_total', TRUE),
                'transaksi_status' => $this->input->post('transaksi_status', TRUE),
            );

            $this->transaksi_model->update($this->input->post('transaksi_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));
        }
    }

    public function delete($id) {
        $row = $this->transaksi_model->get_by_id($id);

        if ($row) {
            $this->transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    function _rules() {
        $this->form_validation->set_rules('pelanggan_id', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('sopir_id', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('kendaraan_id', ' ', 'trim|required|numeric');
        //$this->form_validation->set_rules('transaksi_tglmulai', ' ', 'trim|required');
        $this->form_validation->set_rules('transaksi_tglselesai', ' ', 'trim|required');
        //$this->form_validation->set_rules('transaksi_hari', ' ', 'trim|required');
        //$this->form_validation->set_rules('transaksi_tglovertime', ' ', 'trim|required');
        //$this->form_validation->set_rules('transaksi_hariovertime', ' ', 'trim|required|numeric');
        //$this->form_validation->set_rules('transaksi_total', ' ', 'trim|required|numeric');
        //$this->form_validation->set_rules('transaksi_status', ' ', 'trim|required');
        //$this->form_validation->set_rules('transaksi_id', 'transaksi_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */