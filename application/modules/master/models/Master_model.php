<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{

    /**
     * Declare table name
     * 
     * @var string
     */
    protected $table;

    protected $vendor_id;

    public function __construct()
    {
        parent::__construct();
        $this->table        = "TB_S_MST_VENDOR";
        $this->vendor_id    = $this->session->userdata('kode_vendor');
    }

    public function getAllVendor()
    {
        $vendor = $this->session->userdata('kode_vendor');
        $start = $this->input->post('start');
        $length = $this->input->post('length') != -1 ? $this->input->post('length') : 10;
        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);
        $field  = array(
            1 => 'kode_vendor',
            2 => 'nama_perusahaan',
            3 => 'tanggal_registrasi',
            4 => 'email_perusahaan',
            5 => 'alamat_perusahaan',
            6 => 'no_telepon'
        );

        $order_column = $field[$order_column];
        $where = " WHERE kode_vendor = '{$vendor}'";
        if (!empty($search['value'])) {
            $where .= " AND (kode_vendor LIKE '%" . $search['value'] . "%'";
            $where .= " OR nama_perusahaan LIKE '%" . $search['value'] . "%'";
            $where .= " OR tanggal_registrasi LIKE '%" . $search['value'] . "%'";
            $where .= " OR email_perusahaan LIKE '%" . $search['value'] . "%'";
            $where .= " OR alamat_perusahaan LIKE '%" . $search['value'] . "%'";
            $where .= " OR no_telepon LIKE '%" . $search['value'] . "%')";
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
                        AND RowNum < ({$start} + {$length})
                    ORDER BY RowNum";
        // $sql_ .= " ORDER BY " . $order_column . " {$order_dir}";
        // $sql_ .= " LIMIT {$length} OFFSET {$start}";

        $query = $this->db->query($sql_);
        $rows_data = $query->result();

        $rows = array();
        $i = (0 + 1);

        foreach ($rows_data as $row) {
            $row->kode_vendor           = $row->kode_vendor;
            $row->number                = $i;
            $row->nama_perusahaan       = $row->nama_perusahaan;
            $row->tanggal_registrasi    = date('d M y', strtotime($row->tanggal_registrasi));
            $row->email_perusahaan      = $row->email_perusahaan;
            $row->alamat_perusahaan     = $row->alamat_perusahaan;
            $row->no_telepon            = $row->no_telepon;
            $row->actions               = '<a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2"><i class="fas fa-envelope-open-text"></i></a>';
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
     * Get Detail Vendor Data
     * sent to Vendor Profile Page
     *
     * @return void
     */
    public function getVendorData()
    {
        $sql    = " SELECT
                        vendor.*,
                        province.nama provinsi,
                        country.nama negara
                    FROM
                        TB_S_MST_VENDOR vendor
                    LEFT JOIN
                        TB_S_MST_PROVINSI province ON (vendor.kode_provinsi = province.kode_provinsi)
                    LEFT JOIN
                        TB_S_MST_NEGARA country ON (vendor.kode_negara = country.kode_negara)
                    WHERE
                        vendor.kode_vendor = '{$this->vendor_id}'";
        $query  = $this->db->query($sql);
        $row    = $query->row();
        foreach ($row as $key => $value) {
            $row->$key  = ($value === NULL || (trim($value) === '')) ? '-' : trim($value);
        }

        return $row;
    }

    /**
     * Get Vendor Detail Password
     * For Validation before change password
     *
     * @param String $id
     * @return void
     */
    public function getUserDetail($id)
    {
        $sql    = "SELECT * FROM TB_S_MST_PENGGUNA WHERE kode_vendor = '{$id}'";
        $query  = $this->db->query($sql);

        return $query->row();
    }

    /**
     * Change User Password Method
     *
     * @param array $params
     * @param array $data
     * @return void
     */
    public function changeUserPassword($params = array(), $data = array())
    {
        $this->load->model('Global_model', 'global');
        $result  = $this->global->update('TB_S_MST_PENGGUNA', $params, $data);

        return $result;
    }
}

/* End of file Master_model.php */
