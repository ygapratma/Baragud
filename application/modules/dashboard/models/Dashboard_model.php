
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getDashboardData()
    {
        $graph_data = array(
            'permintaan_harga'  => 0,
            'konfirmasi_harga'  => 0
        );

        $vendor_code =   $this->session->userdata('kode_vendor');

        // Total Permintaan Harga
        $sql    = "SELECT COUNT(kode_konfirmasi) AS permintaan_harga FROM TB_S_MST_KONFIRMASI WHERE konfirmasi_status = 2 AND tanggal_kirim = '".date('Y-m-d')."' AND kode_vendor = '{$vendor_code}' AND (flag_kirim IS NULL OR flag_kirim = 0)";
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['permintaan_harga'] = (int)$result->permintaan_harga;

        // Total Konfirmasi Harga
        $sql    = "SELECT COUNT(kode_konfirmasi) AS konfirmasi_harga FROM TB_S_MST_KONFIRMASI WHERE konfirmasi_status = 1 AND tanggal_kirim = '".date('Y-m-d')."' AND kode_vendor = '{$vendor_code}' AND (flag_kirim IS NULL OR flag_kirim = 0)";
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['konfirmasi_harga'] = (int)$result->konfirmasi_harga;

        // Total RFQ Barang
        $sql    = "SELECT
                        COUNT(table_a.nomor_rfq) AS rfq_barang
                    FROM 
                        TB_S_MST_RFQ_BARANG_HEAD table_a
                    WHERE
                        table_a.kode_vendor = '{$vendor_code}' AND
                        table_a.tanggal_jatuh_tempo >= '".date('Y-m-d')."'";
        
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['rfq_barang'] = (int)$result->rfq_barang;

        // Total Nego RFQ Barang
        $sql    = "SELECT
                        COUNT(table_a.nomor_rfq) AS nego_barang
                    FROM 
                        TB_S_MST_NEGO_BARANG_HEAD table_a
                    WHERE
                        table_a.kode_vendor = '{$vendor_code}' AND
                        table_a.tanggal_jatuh_tempo >= '".date('Y-m-d')."'";
        
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['nego_barang'] = (int)$result->nego_barang;

        // Status PO
        $sql    = "SELECT COUNT(nomor_po) AS status_po_barang FROM TB_S_TR_PO_HEAD WHERE [status] = 0 AND kode_vendor = '{$vendor_code}'";
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['status_po_barang'] = (int)$result->status_po_barang;

        // Total Riwayat RFQ Barang
        $sql    = "SELECT
                        COUNT(table_a.nomor_rfq) AS rfq_barang
                    FROM 
                        TB_S_MST_RFQ_BARANG_HEAD table_a
                    WHERE
                        table_a.kode_vendor = '{$vendor_code}' AND
                        table_a.tanggal_jatuh_tempo <= '".date('Y-m-d')."'";
        
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['history_rfq_barang'] = (int)$result->rfq_barang;

        // Total Riwayat Nego RFQ Barang
        $sql    = "SELECT
                        COUNT(table_a.nomor_rfq) AS nego_barang
                    FROM 
                        TB_S_MST_NEGO_BARANG_HEAD table_a
                    WHERE
                        table_a.kode_vendor = '{$vendor_code}' AND
                        table_a.tanggal_jatuh_tempo <= '".date('Y-m-d')."'";
        
        $query  = $this->db->query($sql);
        $result = $query->row();
        $graph_data['history_nego_barang'] = (int)$result->nego_barang;

        return $graph_data;
    }

}

/* End of file Dashboard_model.php */
