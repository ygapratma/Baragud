
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Confirmation_model extends CI_Model
{

    /**
     * Declare table name
     * 
     * @var string
     */
    protected $table;

    protected $vendor_code;

    public function __construct()
    {
        parent::__construct();
        $this->table        = "TB_S_MST_KONFIRMASI";
        $this->vendor_code  = $this->session->userdata('kode_vendor');
    }

    public function getConfirmationPriceList()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length') != -1 ? $this->input->post('length') : 10;
        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);
        $field  = array(
            1 => 'kode_konfirmasi',
            2 => 'tanggal_kirim',
            3 => 'kode_vendor',
            4 => 'nama_vendor',
            5 => 'harga_po_terakhir',
            6 => 'mata_uang_po_terakhir',
            7 => 'nomor_pr',
            8 => 'item_pr',
            9 => 'kode_material',
            10 => 'deskripsi',
            11 => 'jumlah',
            12 => 'harga',
            13 => 'mata_uang',
            14 => 'satuan',
            15 => 'konfirmasi_status',
            16 => 'jumlah_tersedia',
            17 => 'jumlah_inden',
            18 => 'lama_inden',
            19 => 'pesan_ulang',
            20 => 'modified_date',
            21 => 'modified_by',
            22 => 'status',
            23 => 'status_harga'
        );

        $order_column = $field[$order_column];
        $where = " WHERE (konfirmasi_status = '1' AND kode_vendor = '{$this->vendor_code}' AND tanggal_kirim = '" . date('Y-m-d') . "') ";  // Get Konfirmasi harga with konfirmasi_status = 1
        $where = " WHERE (konfirmasi_status = '1' AND kode_vendor = '{$this->vendor_code}' AND tanggal_kirim = '" . date('Y-m-d') . "') AND (flag_kirim is null or flag_kirim = 0)";  // Get Konfirmasi harga with konfirmasi_status = 1; add validation flag_kirim = 1 not display
        if (!empty($search['value'])) {
            $where .= " AND ";
            $where .= " (kode_konfirmasi LIKE '%" . $search['value'] . "%'";
            $where .= " OR kode_vendor LIKE '%" . $search['value'] . "%'";
            $where .= " OR nama_vendor LIKE '%" . $search['value'] . "%'";
            $where .= " OR nomor_pr LIKE '%" . $search['value'] . "%'";
            $where .= " OR kode_material LIKE '%" . $search['value'] . "%'";
            $where .= " OR deskripsi LIKE '%" . $search['value'] . "%')";
        }

        $sql        = "SELECT * FROM {$this->table}{$where}";

        $query = $this->db->query($sql);
        $records_total = $query->num_rows();

        $sql_   = "SELECT  *
                    FROM    ( SELECT    ROW_NUMBER() OVER ( ORDER BY {$order_column} {$order_dir} ) AS RowNum, *
                            FROM      {$this->table}
                            {$where}
                            ) AS RowConstrainedResult
                    WHERE   RowNum > {$start}
                        AND RowNum < (({$start} + 1) + {$length})
                    ORDER BY RowNum";
        // $sql_ .= " ORDER BY " . $order_column . " {$order_dir}";
        // $sql_ .= " LIMIT {$length} OFFSET {$start}";

        $query = $this->db->query($sql_);
        $rows_data = $query->result();

        $rows = array();
        $i = (0 + 1);

        foreach ($rows_data as $row) {
            $row->number                = $i;
            $row->kode_konfirmasi   = $row->kode_konfirmasi;
            $row->tanggal_kirim     = date('d M y', strtotime($row->tanggal_kirim));
            $row->kode_vendor       = $row->kode_vendor;
            $row->nama_vendor       = $row->nama_vendor;
            $row->harga_po_terakhir = (int)$row->harga_po_terakhir;
            $row->mata_uang_po_terakhir = $row->mata_uang_po_terakhir;
            $row->nomor_pr          = $row->nomor_pr;
            $row->item_pr           = $row->item_pr;
            $row->kode_material     = $row->kode_material;
            $row->deskripsi         = utf8_encode($row->deskripsi);
            $row->deskripsi_material= utf8_encode($row->deskripsi_material);
            $row->jumlah            = (int)$row->jumlah;
            $row->harga             = (int)$row->harga;
            $row->mata_uang         = $row->mata_uang;
            $row->satuan            = $row->satuan;
            $row->konfirmasi_status = $row->konfirmasi_status;
            $row->jumlah_tersedia   = (int)$row->jumlah_tersedia;
            $row->jumlah_inden      = (int)$row->jumlah_inden;
            $row->lama_inden        = (int)$row->lama_inden;
            $row->pesan_ulang       = $row->pesan_ulang;
            $row->modified_date     = ($row->modified_date == NULL) ? $row->modified_date : date('d M y', strtotime($row->modified_date));
            $row->modified_by       = $row->modified_by;
            // $row->actions           = '<a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2"><i class="fas fa-envelope-open-text"></i></a>';
            $btn_disabled           = (($row->modified_by == NULL && $row->modified_date == NULL) || ($row->flag_kirim == NULL)) ? '' : 'disabled';
            $row->actions           = '<button type="button" class="btn btn-icon btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_confirmation" '. $btn_disabled .'><i class="fas fa-envelope-open-text"></i></button>';
            // $row->actions           = '<a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_confirmation"><i class="fas fa-envelope-open-text"></i></a>';
            $row->status            = ($row->modified_by == NULL && $row->modified_date == NULL) ? "Belum Konfirmasi" : "Sudah Konfirmasi";
            if ($row->modified_by == NULL && $row->modified_date == NULL) {
                $row->status_harga      = "";
            } else if ($row->pesan_ulang == 1) {
                $row->status_harga      = "HARGA SESUAI";
            } else if (($row->modified_by != NULL && $row->modified_date != NULL) && $row->pesan_ulang == 0) {
                $row->status_harga      = "HARGA TIDAK SESUAI";
            }
            $rows[] = $row;
            $i++;
        }

        return array(
            'draw' => $draw,
            'recordsTotal' => $records_total,
            'recordsFiltered' => $records_total,
            'data' => $rows,
        );
    }

    public function getRequestPriceList()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length') != -1 ? $this->input->post('length') : 10;
        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);
        $field  = array(
            1 => 'kode_konfirmasi',
            2 => 'tanggal_kirim',
            3 => 'kode_vendor',
            4 => 'nama_vendor',
            5 => 'harga_po_terakhir',
            6 => 'mata_uang_po_terakhir',
            7 => 'nomor_pr',
            8 => 'item_pr',
            9 => 'kode_material',
            10 => 'deskripsi',
            11 => 'jumlah',
            12 => 'harga',
            13 => 'mata_uang',
            14 => 'satuan',
            15 => 'konfirmasi_status',
            16 => 'jumlah_tersedia',
            17 => 'jumlah_inden',
            18 => 'lama_inden',
            19 => 'pesan_ulang',
            20 => 'modified_date',
            21 => 'modified_by',
            22 => 'status',
            23 => 'status_harga'
        );

        $order_column = $field[$order_column];
        $where = " WHERE (konfirmasi_status = '2' AND kode_vendor = '{$this->vendor_code}' AND tanggal_kirim = '" . date('Y-m-d') . "') ";  // Get Konfirmasi harga with konfirmasi_status = 2
        $where = " WHERE (konfirmasi_status = '2' AND kode_vendor = '{$this->vendor_code}' AND tanggal_kirim = '" . date('Y-m-d') . "') AND (flag_kirim is null or flag_kirim = 0)";  // Get Konfirmasi harga with konfirmasi_status = 2; add validation flag_kirim = 1 not display
        if (!empty($search['value'])) {
            $where .= " AND ";
            $where .= " (kode_konfirmasi LIKE '%" . $search['value'] . "%'";
            $where .= " OR kode_vendor LIKE '%" . $search['value'] . "%'";
            $where .= " OR nama_vendor LIKE '%" . $search['value'] . "%'";
            $where .= " OR nomor_pr LIKE '%" . $search['value'] . "%'";
            $where .= " OR kode_material LIKE '%" . $search['value'] . "%'";
            $where .= " OR deskripsi LIKE '%" . $search['value'] . "%')";
        }

        $sql        = "SELECT * FROM {$this->table}{$where}";

        $query = $this->db->query($sql);
        $records_total = $query->num_rows();

        $sql_   = "SELECT  *
                    FROM    ( SELECT    ROW_NUMBER() OVER ( ORDER BY {$order_column} {$order_dir} ) AS RowNum, *
                            FROM      {$this->table}
                            {$where}
                            ) AS RowConstrainedResult
                    WHERE   RowNum > {$start}
                        AND RowNum < (({$start} + 1) + {$length})
                    ORDER BY RowNum";
        // $sql_ .= " ORDER BY " . $order_column . " {$order_dir}";
        // $sql_ .= " LIMIT {$length} OFFSET {$start}";

        $query = $this->db->query($sql_);
        $rows_data = $query->result();

        $rows = array();
        $i = (0 + 1);

        foreach ($rows_data as $row) {
            $row->number                = $i;
            $row->kode_konfirmasi       = $row->kode_konfirmasi;
            $row->tanggal_kirim         = date('d M y', strtotime($row->tanggal_kirim));
            $row->kode_vendor           = $row->kode_vendor;
            $row->nama_vendor           = $row->nama_vendor;
            $row->harga_po_terakhir     = (int)$row->harga_po_terakhir;
            $row->mata_uang_po_terakhir = $row->mata_uang_po_terakhir;
            $row->nomor_pr              = $row->nomor_pr;
            $row->item_pr               = $row->item_pr;
            $row->kode_material         = $row->kode_material;
            $row->deskripsi             = utf8_encode($row->deskripsi);
            $row->deskripsi_material    = utf8_encode($row->deskripsi_material);
            $row->jumlah                = (int)$row->jumlah;
            $row->harga                 = ($row->modified_by == NULL && $row->modified_date == NULL) ? 0 : (int)$row->harga;
            $row->mata_uang             = ($row->modified_by == NULL && $row->modified_date == NULL) ? '' : trim($row->mata_uang);
            $row->satuan                = $row->satuan;
            $row->konfirmasi_status     = $row->konfirmasi_status;
            $row->jumlah_tersedia       = (int)$row->jumlah_tersedia;
            $row->jumlah_inden          = (int)$row->jumlah_inden;
            $row->lama_inden            = (int)$row->lama_inden;
            $row->pesan_ulang           = $row->pesan_ulang;
            $row->modified_date         = ($row->modified_date == NULL) ? $row->modified_date : date('d M y', strtotime($row->modified_date));
            $row->modified_by           = $row->modified_by;
            $btn_disabled               = (($row->modified_by == NULL && $row->modified_date == NULL) || ($row->flag_kirim == NULL)) ? '' : 'disabled';
            $row->actions               = '<button type="button" class="btn btn-icon btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_confirmation" '. $btn_disabled .'><i class="fas fa-envelope-open-text"></i></button>';
            $row->status                = ($row->modified_by == NULL && $row->modified_date == NULL) ? "Belum Konfirmasi" : "Sudah Konfirmasi";
            if ($row->harga == 0 || ($row->modified_by == NULL && $row->modified_date == NULL)) {
                $row->status_harga      = "";
            } else if ($row->harga_po_terakhir == $row->harga) {
                $row->status_harga      = "HARGA SAMA";
            } else if ($row->harga_po_terakhir > $row->harga) {
                $row->status_harga      = "HARGA TURUN";
            } else if ($row->harga_po_terakhir < $row->harga) {
                $row->status_harga      = "HARGA NAIK";
            }
            $rows[] = $row;
            $i++;
        }

        return array(
            'draw' => $draw,
            'recordsTotal' => $records_total,
            'recordsFiltered' => $records_total,
            'data' => $rows,
        );
    }

    public function update($params = array(), $data = array())
    {
        $this->load->model('Global_model', 'global');
        $query  = $this->global->update($this->table, $params, $data);

        return $query;
    }

    public function sendConfirmation($status = 0)
    {
        $sql = "SELECT * FROM TB_S_MST_KONFIRMASI WHERE
                kode_vendor = '{$this->vendor_code}' AND konfirmasi_status = {$status} AND 
                modified_by IS NOT NULL AND modified_date IS NOT NULL AND flag_kirim IS NULL"; 
        // All Data have filled or not filled update flag_kirim = 1; 2022-08-09; as request Mr. Lukman
        $sql = "SELECT * FROM TB_S_MST_KONFIRMASI WHERE
                kode_vendor = '{$this->vendor_code}' AND konfirmasi_status = {$status} AND tanggal_kirim = '" . date('Y-m-d') . "' AND (flag_kirim is null or flag_kirim = 0)";
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0) {

            $sql_ = "UPDATE TB_S_MST_KONFIRMASI SET flag_kirim = 1 WHERE
                    kode_vendor = '{$this->vendor_code}' AND konfirmasi_status = {$status} AND 
                    modified_by IS NOT NULL AND modified_date IS NOT NULL AND flag_kirim IS NULL";
            // All Data have filled or not filled update flag_kirim = 1; 2022-08-09; as request Mr. Lukman
            $sql_ = "UPDATE TB_S_MST_KONFIRMASI SET flag_kirim = 1 WHERE
                    kode_vendor = '{$this->vendor_code}' AND konfirmasi_status = {$status} AND 
                    tanggal_kirim = '" . date('Y-m-d') . "' AND (flag_kirim is null or flag_kirim = 0)";
            
            $query_ = $this->db->query($sql_);

            return $this->db->affected_rows();

        } else {

            return 0;
            
        }
    }
}

/* End of file Master_model.php */
