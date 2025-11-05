<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Negotiation extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        logged_in();
        $this->load->model('Negotiation_model', 'nego');
        $this->load->library('Crypto');
    }

    /**
     * Index Function
     *
     * @return void
     */
    public function rfq_goods()
    {
        if ($this->input->is_ajax_request()) {
            $rows   = $this->nego->getNegoRfqGoodsList();
            echo json_encode($rows);
            exit;
        }
        $data['title']      = "Nego RFQ Barang";
        $data['menu']       = "Negosiasi";
        $data['submenu']    = "Nego RFQ Barang";
        $data['content']    = "negotiation_rfq_goods";
        $this->load->view('default', $data);
    }

    public function rfq_service()
    {
        $data['title']      = "Nego RFQ Jasa";
        $data['menu']       = "Negosiasi";
        $data['submenu']    = "Nego RFQ Jasa";
        $data['content']    = "negotiation_rfq_service";
        $this->load->view('default', $data);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function det_rfq_goods()
    {
        $rfq_no = $this->crypto->decode($this->uri->segment(3));
        if ($this->input->is_ajax_request()) {
            $rows   = $this->nego->getDetNegoRfqGoodsList($rfq_no);
            echo json_encode($rows);
            exit;
        }
        $data['title']      = "RFQ No : " . $rfq_no;
        $data['menu']       = "Negosiasi";
        $data['submenu']    = "Detail Negosiasi RFQ Barang";
        $data['content']    = "detail_nego_rfq_goods";
        $data['UoMs']       = $this->nego->getUoM();
        $data['currencies'] = $this->nego->getCurrency();
        $this->load->view('default', $data);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function save_negotiation()
    {
        $nomor_rfq          = $this->input->post('nomor_rfq');
        $kode_barang        = $this->input->post('kode_barang');
        $harga_satuan_nego  = str_replace('.', '', $this->input->post('harga_satuan_nego'));
        $keterangan_nego    = $this->input->post('keterangan_nego');
        
        $params = array(
            'nomor_rfq' => $nomor_rfq,
            'kode_barang' => $kode_barang
        );

        $data = array(
            'harga_satuan_nego' => $harga_satuan_nego,
            'keterangan_nego' => $keterangan_nego
        );

        $update = $this->nego->updateNegoRfq($params, $data);
        if($update > 0) {

            $response = array(
                'code'      => 0,
                'msg'       => 'Berhasil menyimpan data.',
                'status'    => 'success'
            );

        } else {

            $response = array(
                'code'      => 100,
                'msg'       => 'Gagal menyimpan data',
                'status'    => 'error'
            );

        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function save_negotiation_eqiv()
    {
        $nomor_rfq          = $this->input->post('nomor_rfq_eqiv');
        $kode_barang        = $this->input->post('kode_barang_eqiv');
        $ekuivalen          = $this->input->post('ekuivalen');
        $harga_satuan_nego  = str_replace('.', '', $this->input->post('harga_satuan_nego_eqiv'));
        $keterangan_nego    = $this->input->post('keterangan_nego_eqiv');

        $params = array(
            'nomor_rfq' => $nomor_rfq,
            'kode_barang' => $kode_barang,
            'ekuivalen' => $ekuivalen
        );

        $data = array(
            'harga_satuan_nego' => $harga_satuan_nego,
            'keterangan_nego' => $keterangan_nego
        );

        $update = $this->nego->updateNegoRfqEqiv($params, $data);
        if($update > 0) {

            $response = array(
                'code'      => 0,
                'msg'       => 'Berhasil menyimpan data.',
                'status'    => 'success'
            );

        } else {

            $response = array(
                'code'      => 100,
                'msg'       => 'Gagal menyimpan data',
                'status'    => 'error'
            );

        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get_det_nego_goods_eqiv()
    {
        $nomor_rfq      = $this->input->post('nomor_rfq');
        $kode_barang    = $this->input->post('kode_barang');
        $ekuivalen      = $this->input->post('ekuivalen');
        
        $params = array(
            'nomor_rfq' => $nomor_rfq,
            'kode_barang' => $kode_barang,
            'ekuivalen' => $ekuivalen
        );

        $result = $this->nego->getDetNegoRfqGoodsEqiv($params);
        if($result->num_rows() > 0) {

            $data       = $result->row();

            unset($params['nomor_rfq']);
            $params['nomor_quotation'] = $nomor_rfq;

            $get_files  = $this->nego->getUploadedFiles($params);
            if($get_files->num_rows() > 0) {
                $files  = $get_files->result();
                foreach ($files as $res) {
                    $res->nama_berkas = $this->crypto->encode($res->nama_berkas);
                }
            } else {
                $files = [];
            }

            $response   = array(
                'code' => 0,
                'msg' => 'SUCCESS',
                'status' => 'success',
                'data' => $data,
                'files' => $files
            );

        } else {

            $response   = array(
                'code' => 100,
                'msg' => 'FAILED',
                'status' => 'error',
                'data' => NULL
            );

        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Show / Get Additional Price data
     *
     * @return void
     */
    public function show_additional_price()
    {
        $nomor_rfq  = $this->crypto->decode($this->input->post('id'));
        $data       = $this->nego->getAdditionalPrice(['nomor_rfq' => $nomor_rfq]);
        $result     = $data->result();

        $response = array(
            'code' => 0,
            'msg' => 'Success',
            'status' => 'success',
            'data' => $result
        );

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Update Additional data
     *
     * @return void
     */
    public function save_additional_price()
    {
        $nomor_rfq          = $this->crypto->decode($this->input->post('id_rfq_other'));
        $kode_biaya         = $this->input->post('add_price_type');
        $jumlah_biaya_nego  = $this->input->post('add_price_nego');
        $keterangan         = $this->input->post('add_notes');

        $success = 0;
        for($i = 0; $i < count($kode_biaya); $i++) {

            $explode = explode("_", $kode_biaya[$i]);

            $params = [
                'nomor_rfq' => $nomor_rfq,
                'kode_biaya' => $explode[0]
            ];

            $data = [
                'jumlah_biaya_nego' => (!empty($jumlah_biaya_nego[$i])) ? str_replace('.', '', $jumlah_biaya_nego[$i]) : 0,
                'keterangan' => $keterangan
            ];

            $save = $this->nego->updateAdditionalPrice($params, $data);
            if($save > 0) {
                $success = $success + $save;
            }
        }

        if($success > 0) {

            $response = array(
                'code'      => 0,
                'msg'       => 'Berhasil menyimpan data.',
                'status'    => 'success'
            );

        } else {

            $response = array(
                'code'      => 100,
                'msg'       => 'Gagal menyimpan data',
                'status'    => 'error'
            );

        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get_uploaded_rfq_files()
    {
        $rfq_no     = $this->crypto->decode($this->input->post('val_1'));
        $ekuivalen  = (int)$this->input->post('val_2');

        $params = array('nomor_quotation' => $rfq_no, 'ekuivalen' => $ekuivalen);
        $result = $this->nego->getUploadedFiles($params);
        if ($result->num_rows() > 0) {
            $files  = $result->result();
            foreach ($files as $res) {
                $res->nama_berkas = $this->crypto->encode($res->nama_berkas);
            }

            $response   = array(
                'code'  => 0,
                'msg'   => 'SUCCESS',
                'data'  => $files
            );
        } else {

            $response   = array(
                'code'  => 100,
                'msg'   => 'NOT FOUND',
                'data'  => NULL
            );
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function download()
    {
        $this->load->helper('download');

        $filename       = $this->crypto->decode($this->uri->segment(3));
        $explode_ext    = explode(".", $filename);
        $file_name      = $explode_ext[0];
        $explode_fName  = explode("_", $file_name);
        $rfq_no         = $explode_fName[1];
        $equivalent     = $explode_fName[2];
        $sequence       = $explode_fName[3];

        $params     = array('nomor_quotation' => $rfq_no, 'ekuivalen' => $equivalent, 'urutan_berkas' => $sequence);
        $get_file   = $this->nego->getUploadedFiles($params);
        $file_data  = $get_file->row();

        force_download($file_data->nama_berkas_asli, file_get_contents($file_data->alamat_berkas . $file_data->nama_berkas));
    }

}

/* End of file Master.php */
