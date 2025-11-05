<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    /**
     * Declare Table Name
     * 
     * @var string
     */
    protected $table;
    protected $table_vendor;
    protected $pass;

    public function __construct()
    {
        parent::__construct();
        $this->table = "TB_S_MST_PENGGUNA";
        $this->table_vendor = "TB_S_MST_VENDOR";
        $this->pass = "";
    }
    
    /**
     * GetLogin Function
     * 
     * Get User Login data
     *
     * @param String $username
     * @param String $password
     * @return array
     */
    public function getLogin($username, $password)
    {
        $sql    = "SELECT * FROM {$this->table} WHERE kode_vendor = '{$username}'"; 
        $query  = $this->db->query($sql);
        if($query->num_rows() > 0) {

            $login_data = $query->row();
            
            // Check if Vendor Blocked
            if($login_data->deletion == 1) {

                $response = [
                    'code'  => 200,
                    'msg'   => 'Maaf, User Anda diblokir'
                ];

            } else {

                $this->pass = ($login_data->first_login == 1) ? md5($login_data->sandi) : $login_data->sandi;

                if($password == $this->pass) {

                    // Get Vendor Data
                    $vendor_data    = [];
                    $sql_vendor     = "SELECT * FROM {$this->table_vendor} WHERE [kode_vendor] ='{$username}'";
                    $query_vendor   = $this->db->query($sql_vendor);
                    if($query_vendor->num_rows() > 0){
                        $vendor_data = $query_vendor->row();
                    }

                    // Set Session
                    $user_session   = [
                        'kode_vendor'   => rtrim($login_data->kode_vendor),
                        'nama'          => rtrim($login_data->nama),
                        'first_login'   => $login_data->first_login,
                        'logged_in'     => TRUE,
                        'email'         => rtrim($vendor_data->email_perusahaan),
                        'kode_negara'   => rtrim($vendor_data->kode_negara)
                    ];

                    $this->session->set_userdata($user_session);
                    $response = [
                        'code'  => 0,
                        'msg'   => 'Berhasil login',
                        'data'  => site_url('dashboard')
                    ];

                } else {

                    $response = [
                        'code'  => 400,
                        'msg'   => 'Password yang Anda masukkan, salah!'
                    ];

                }

            }

        } else {

            $response = [
                'code'  => 400,
                'msg'   => 'Username tidak ditemukan'
            ];

        }

        return $response;
    }

    /**
     * ResetPassword function
     *
     * @param String $vendor_id
     * @param String $new_password
     * @param String $confirm_password
     * @return array
     */
    public function resetPassword($vendor_id, $new_password, $confirm_password)
    {
        if($new_password != $confirm_password) {
            $response = [
                'code'  => 200,
                'msg'   => 'Password Baru dan Konfirmasi Password tidak sama'
            ];
        } else {

            $sql    = "UPDATE {$this->table} SET sandi = '".md5($new_password)."', first_login = 0, modified_date = current_timestamp WHERE kode_vendor = '{$vendor_id}'";
            $query  = $this->db->query($sql);

            if($this->db->affected_rows() > 0) {
                $this->session->sess_destroy();
                $response = [
                    'code'  => 0,
                    'msg'   => 'Berhasil reset password. Silahkan melakukan login.'
                ];
            } else {
                $response = [
                    'code'  => 100,
                    'msg'   => 'Gagal reset password'
                ];
            }

        }

        return $response;
    }

    /**
     * Getting Vendor Email
     *
     * @param String $vendor_code
     * @param String $vendor_mail
     * @return void
     */
    public function getUserMail($vendor_code, $vendor_mail)
    {
        $sql    = "SELECT
                        a.deletion,
                        a.kode_vendor,
                        b.nama_perusahaan,
                        b.email_perusahaan
                    FROM
                        TB_S_MST_PENGGUNA a
                    JOIN
                        TB_S_MST_VENDOR b ON (a.kode_vendor = b.kode_vendor and a.kode_vendor='{$vendor_code}')";
        $query  = $this->db->query($sql);
        if($query->num_rows() > 0) {

            $vendor_data = $query->row();
            if($vendor_data->deletion == 1) {

                $response   = array(
                    'code'  => 200,
                    'msg'   => 'Maaf, akun Anda diblokir. Silahkan hubungi Administrator.'
                );

            } else {

                if($vendor_data->email_perusahaan == $vendor_mail) {

                    $new_password   = '123456';
                    $sql_update     = "UPDATE TB_S_MST_PENGGUNA SET sandi = '".md5($new_password)."', modified_date = current_timestamp, modified_by = 'WEB' WHERE kode_vendor = '{$vendor_code}'";
                    $query_update   = $this->db->query($sql_update);

                    if($this->db->affected_rows() > 0) {

                        $vendor_data->sandi = $new_password;

                        $response   = array(
                            'code'  => 0,
                            'msg'   => 'SUCCESS',
                            'data'  => $vendor_data
                        );

                    } else {

                        $response   = array(
                            'code'  => 300,
                            'msg'   => 'Gagal mereset password'
                        );

                    }

                } else {

                    $response   = array(
                        'code'  => 100,
                        'msg'   => 'Email yang Anda masukkan tidak terdaftar.'
                    );

                }

            }
            
        } else {

            $response   = array(
                'code'  => 100,
                'msg'   => 'Maaf, Kode Vendor / Email tidak ditemukan'
            );

        }

        return $response;
    }
}

/* End of file Login_model.php */
