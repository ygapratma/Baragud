<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Negotiation_model extends CI_Model {
    
    /**
     * Declare Negotiation Table List
     *
     * [
     *      'detail'        => 'TB_S_MST_NEGO_BARANG_DTL',
     *      'eqiv'          => 'TB_S_MST_NEGO_BARANG_EQIV',
     *      'head'          => 'TB_S_MST_NEGO_BARANG_HEAD',
     *      'attachment'    => 'TB_S_MST_NEGO_LAMPIRAN_BARANG',
     *      'additional'    => 'TB_S_MST_NEGO_BIAYA_TAMBAHAN'
     * ]
     * 
     * @var array
     */
    protected $table;
    
    /**
     * Declare vendor code
     *
     * @var string
     */
    protected $vendor_code;

    /**
     * Declare current timestamps
     *
     * @var Datetime
     */
    protected $timestamps;
    
    /**
     * Undocumented function
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = [
            'detail' => 'TB_S_MST_NEGO_BARANG_DTL',
            'eqiv' => 'TB_S_MST_NEGO_BARANG_EQIV',
            'head' => 'TB_S_MST_NEGO_BARANG_HEAD',
            'attachment' => 'TB_S_MST_NEGO_LAMPIRAN_BARANG',
            'additional' => 'TB_S_MST_NEGO_BIAYA_TAMBAHAN'
        ];
        $this->vendor_code = $this->session->userdata('kode_vendor');
        $this->timestamps = date('Y-m-d H:i:s');
        $this->load->model('Global_model', 'global');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getNegoRfqGoodsList()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length') != -1 ? $this->input->post('length') : 10;
        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);
        $field  = array(
            1 => 'nomor_rfq',
            3 => 'tanggal_rfq',
            4 => 'tanggal_jatuh_tempo',
        );

        $order_column = $field[$order_column];

        $where = " WHERE (tnego.kode_vendor = '{$this->vendor_code}' AND tnego.tanggal_jatuh_tempo >= '" . date('Y-m-d') . "') ";
        if (!empty($search['value'])) {
            $where .= " AND ";
            $where .= " (tnego.nomor_rfq LIKE '%" . $search['value'] . "%'";
            $where .= " OR tnego.tanggal_rfq LIKE '%" . $search['value'] . "%'";
            $where .= " OR tnego.tanggal_jatuh_tempo LIKE '%" . $search['value'] . "%')";
        }

        $sql        = "SELECT 
                            tnego.nomor_rfq, tnego.tanggal_rfq, tnego.tanggal_jatuh_tempo, tnego.modified_date, tnego.modified_by,
                            tl.alamat_berkas, tl.nama_berkas, tl.sudah_gabung 
                        FROM {$this->table['head']} tnego 
                        LEFT JOIN {$this->table['attachment']} AS tl ON ( tl.nomor_rfq = tnego.nomor_rfq ) {$where}";
        $query = $this->db->query($sql);
        $records_total = $query->num_rows();

        $sql_   = "SELECT  *
                    FROM    ( SELECT ROW_NUMBER() OVER ( ORDER BY tnego.nomor_rfq {$order_dir} ) AS RowNum,
                                tnego.nomor_rfq, tnego.tanggal_rfq, tnego.tanggal_jatuh_tempo, tnego.modified_date, tnego.modified_by, 
                                tl.alamat_berkas, tl.nama_berkas, tl.sudah_gabung
                            FROM      {$this->table['head']} tnego
                            LEFT JOIN {$this->table['attachment']} AS tl ON ( tl.nomor_rfq = tnego.nomor_rfq )
                            {$where} ) AS RowConstrainedResult
                    WHERE   RowNum > {$start}
                        AND RowNum < (({$start} + 1) + {$length})
                    ORDER BY RowNum";
        
        $query = $this->db->query($sql_);
        $rows_data = $query->result();
        $rows = array();
        $i = (0 + 1);

        foreach ($rows_data as $row) {
            $berkas = '';

            if ($row->nama_berkas !== NULL) {
                $berkas =
                    '<a href="' . base_url('upload_files/Dokumen_RFQ/' . $row->nama_berkas) . '" class="btn btn-icon btn-sm btn-primary me-1 mb-1" target="_blank">
                                <i class="las la-arrow-down fs-1 text-white"></i>
                            </a>';
            } else {
                $berkas = '';
            }
            $row->number                = $i;
            $row->berkas                = $berkas;
            $row->nomor_rfq             = $row->nomor_rfq;
            $row->tanggal_rfq           = date('d.M.y', strtotime($row->tanggal_rfq));
            $row->tanggal_jatuh_tempo   = date('d.M.y', strtotime($row->tanggal_jatuh_tempo));
            $row->actions               = '<a href="' . site_url('negotiation/det_rfq_goods/' . $this->crypto->encode($row->nomor_rfq)) . '" class="btn btn-icon btn-sm btn-success me-2 mb-2">
                                                <i class="fas fa-envelope-open-text"></i>
                                            </a>';
            $row->sisa_hari             = diff_date($row->tanggal_jatuh_tempo)['days'] . ' Hari';

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

    /**
     * Undocumented function
     *
     * @param string $rfq_no
     * @return void
     */
    public function getDetNegoRfqGoodsList($rfq_no = '')
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length') != -1 ? $this->input->post('length') : 10;
        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);
        $field  = array(
            1 => 'kode_barang',
            2 => 'deskripsi_barang',
            3 => 'jumlah_permintaan',
            4 => 'satuan'
        );

        $order_column = $field[$order_column];
        $where = " WHERE (tnego_det.nomor_rfq = '{$rfq_no}') ";  // Get Konfirmasi harga with konfirmasi_status = 1
        if (!empty($search['value'])) {
            $where .= " AND ";
            $where .= " (tnego_det.kode_barang LIKE '%" . $search['value'] . "%'";
            $where .= " OR tnego_det.deskripsi_barang LIKE '%" . $search['value'] . "%'";
            $where .= " OR tnego_det.jumlah_permintaan LIKE '%" . $search['value'] . "%'";
            $where .= " OR tnego_det.satuan LIKE '%" . $search['value'] . "%')";
        }

        $sql        = "SELECT tnego_det.nomor_rfq, tnego_det.kode_barang, tnego_det.deskripsi_barang, SUM(tnego_det.jumlah_permintaan) AS jumlah_permintaan,
                            tnego_det.satuan, tnego_det.deskripsi_satuan, tnego_det.mata_uang, tnego_det.harga_satuan, tnego_det.per_harga_satuan,
                            tnego_det.konversi, tnego_det.jumlah_konversi, tnego_det.satuan_konversi, tnego_det.ketersediaan_barang, tnego_det.masa_berlaku_harga,
                            tnego_det.keterangan, tnego_det.dibuat_oleh, tnego_det.modified_date, tnego_det.modified_by,
                            tnego_det.harga_satuan_nego, CAST(tnego_det.keterangan_nego AS NVARCHAR(4000)) keterangan_nego
                        FROM {$this->table['detail']} tnego_det {$where}
                        GROUP BY tnego_det.nomor_rfq, tnego_det.kode_barang, tnego_det.deskripsi_barang, tnego_det.satuan, tnego_det.deskripsi_satuan, tnego_det.mata_uang, tnego_det.harga_satuan, tnego_det.per_harga_satuan,
                        tnego_det.konversi, tnego_det.jumlah_konversi, tnego_det.satuan_konversi, tnego_det.ketersediaan_barang, tnego_det.masa_berlaku_harga,
                        tnego_det.keterangan, tnego_det.dibuat_oleh, tnego_det.modified_date, tnego_det.modified_by, tnego_det.harga_satuan_nego, CAST(tnego_det.keterangan_nego AS NVARCHAR(4000))";

        $query = $this->db->query($sql);
        $records_total = $query->num_rows();

        $sql_   = "SELECT  *
        FROM    ( SELECT    ROW_NUMBER() OVER ( ORDER BY {$order_column} {$order_dir} ) AS RowNum,
                tnego_det.nomor_rfq, tnego_det.kode_barang, tnego_det.deskripsi_barang, SUM(tnego_det.jumlah_permintaan) AS jumlah_permintaan,
        tnego_det.satuan, tnego_det.deskripsi_satuan, tnego_det.mata_uang, tnego_det.harga_satuan, tnego_det.per_harga_satuan,
        tnego_det.konversi, tnego_det.jumlah_konversi, tnego_det.satuan_konversi, tnego_det.ketersediaan_barang, tnego_det.masa_berlaku_harga,
        tnego_det.keterangan, tnego_det.dibuat_oleh, tnego_det.modified_date, tnego_det.modified_by,
        tnego_det.harga_satuan_nego, CAST(tnego_det.keterangan_nego AS NVARCHAR(4000)) keterangan_nego
                FROM {$this->table['detail']} tnego_det
                {$where}
                GROUP BY tnego_det.nomor_rfq, tnego_det.kode_barang, tnego_det.deskripsi_barang, tnego_det.satuan, tnego_det.deskripsi_satuan, tnego_det.mata_uang, tnego_det.harga_satuan, tnego_det.per_harga_satuan,
        tnego_det.konversi, tnego_det.jumlah_konversi, tnego_det.satuan_konversi, tnego_det.ketersediaan_barang, tnego_det.masa_berlaku_harga,
        tnego_det.keterangan, tnego_det.dibuat_oleh, tnego_det.modified_date, tnego_det.modified_by, tnego_det.harga_satuan_nego, CAST(tnego_det.keterangan_nego AS NVARCHAR(4000))
                ) AS RowConstrainedResult
        WHERE   RowNum > {$start}
            AND RowNum < (({$start} + 1) + {$length})
        ORDER BY RowNum";

        $query = $this->db->query($sql_);
        $rows_data = $query->result();

        $rows = array();
        $i = (0 + 1);

        foreach ($rows_data as $row) {
            $row->number                = $i;
            $row->kode_barang           = $row->kode_barang;
            $row->deskripsi_barang      = $row->deskripsi_barang;
            $row->jumlah_permintaan     = (int)$row->jumlah_permintaan;
            $row->harga_satuan_nego     = (int)$row->harga_satuan_nego;
            $row->keterangan_nego       = $row->keterangan_nego;
            $row->satuan                = trim($row->satuan);
            $row->harga_satuan          = (int)$row->harga_satuan;
            $row->konversi              = (int)$row->konversi;
            $row->ketersediaan_barang   = (int)$row->ketersediaan_barang;
            $row->deskripsi_satuan      = trim($row->deskripsi_satuan);
            $row->status                = ($row->modified_by == NULL && $row->modified_date == NULL) ? "Belum Diisi" : "Sudah Diisi";
            $btn_eqiv_1                 = '';
            $row->actions               = '<button type="button" class="rfq_form btn btn-icon btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_det_nego_rfq_goods">
                                            <i class="fas fa-envelope-open-text"></i>
                                        </button>';
            $row->actions_equivalen     = '<button type="button" class="eqiv_form_1 btn btn-icon btn-sm btn-info me-2 mb-2" id="btn_eqiv_1" ' . $btn_eqiv_1 . ' data-bs-toggle="modal" data-bs-target="#kt_modal_det_nego_rfq_goods_ekuivalen">
                                            1
                                        </button>
                                        <button type="button" class="eqiv_form_2 btn btn-icon btn-sm btn-info me-2 mb-2" id="btn_eqiv_2" ' . $this->enableEqivBtn($row->nomor_rfq, 1, $row->kode_barang) . ' data-bs-toggle="modal" data-bs-target="#kt_modal_det_nego_rfq_goods_ekuivalen">
                                            2
                                        </button>
                                        <button type="button" class="eqiv_form_3 btn btn-icon btn-sm btn-info me-2 mb-2" id="btn_eqiv_3" ' . $this->enableEqivBtn($row->nomor_rfq, 2, $row->kode_barang) . ' data-bs-toggle="modal" data-bs-target="#kt_modal_det_nego_rfq_goods_ekuivalen">
                                            3
                                        </button>
                                        <button type="button" class="eqiv_form_4 btn btn-icon btn-sm btn-info me-2 mb-2" id="btn_eqiv_4" ' . $this->enableEqivBtn($row->nomor_rfq, 3, $row->kode_barang) . ' data-bs-toggle="modal" data-bs-target="#kt_modal_det_nego_rfq_goods_ekuivalen">
                                            4
                                        </button>';

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

    public function updateNegoRfq($params = array(), $data = array())
    {   
        $data['modified_date']  = $this->timestamps;
        $data['modified_by']    = 'WEB';

        $result = $this->global->update($this->table['detail'], $params, $data);

        return $result;
    }

    public function updateNegoRfqEqiv($params = array(), $data = array())
    {
        $data['modified_date']  = $this->timestamps;
        $data['modified_by']    = 'WEB';
        
        $result = $this->global->update($this->table['eqiv'], $params, $data);

        return $result;
    }

    /**
     * Enabling Equivalent Button (1-4)
     *
     * @param string $rfq_no
     * @param integer $equivalen
     * @return String
     */
    public function enableEqivBtn(string $rfq_no, int $equivalen, string $item_code)
    {
        $enable = 'disabled';

        $params = array('nomor_rfq' => $rfq_no, 'ekuivalen' => $equivalen, 'kode_barang' => $item_code);
        $isEquivalentExists = $this->global->get_by($this->table['eqiv'], $params);
        if ($isEquivalentExists->num_rows() > 0) {
            $enable = '';
        }

        return $enable;
    }

    /**
     * Get Unit of Measure
     *
     * @return void
     */
    public function getUoM()
    {
        $query  = $this->global->get_all('TB_S_MST_SATUAN');
        $result = $query->result();
        foreach ($result as $res) {
            $res->satuan            = trim($res->satuan);
            $res->deskripsi_satuan  = utf8_encode(trim($res->deskripsi_satuan));
        }

        $array = array_filter($result, function ($value) {
            return strstr($value->satuan, '%') === false;
        });

        return $array;
    }

    /**
     * Get Currency
     *
     * @return void
     */
    public function getCurrency()
    {
        $query = $this->global->get_all('TB_S_MST_MATA_UANG');
        $result = $query->result();
        foreach ($result as $row) {
            $row->kode_uang = trim($row->kode_uang);
            $row->deskripsi = utf8_encode(trim($row->deskripsi));
        }

        return $result;
    }

    /**
     * Get Detail Negotiation Equivalent Data
     *
     * @param array $params
     * @return void
     */
    public function getDetNegoRfqGoodsEqiv($params = array())
    {
        $query = $this->global->get_by($this->table['eqiv'], $params);

        return $query;
    }

    /**
     * Get Additional Price Data
     *
     * @param array $params
     * @return object
     */
    public function getAdditionalPrice($params = [])
    {
        $query  = $this->global->get_by($this->table['additional'], $params);

        return $query;
    }

    /**
     * Update additional data into database
     *
     * @param array $params
     * @param array $data
     * @return object
     */
    public function updateAdditionalPrice($params = [], $data = [])
    {
        $query = $this->global->update($this->table['additional'], $params, $data);

        return $query;
    }

    public function getUploadedFiles($params = array())
    {
        $result = $this->global->get_by('TB_TR_QUOTATION_LAMPIRAN', $params);

        return $result;
    }
        
}

/* End of file Negotiation_model.php */
