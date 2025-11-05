<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';

class Login extends CI_Controller
{

    /**
     * Construct Function
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');
    }

    /**
     * Index Function
     * 
     * Default view/route
     *
     * @return void
     */
    public function index()
    {
        $data['content']    = "login";
        $this->load->view('default_login', $data);
    }

    /**
     * Forgot Function
     * 
     * Page for forgot password
     *
     * @return void
     */
    public function forgot()
    {
        $data['content']    = "forgot";
        $this->load->view('default_login', $data);
    }

    /**
     * Do_login function
     * 
     * Action for login
     *
     * @return json
     */
    public function do_login()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $user_login = $this->login->getLogin($username, $password);

        echo json_encode($user_login, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Reset function
     * 
     * Page for reset password if user first_login
     *
     * @return void
     */
    public function reset()
    {
        first_login();
        $data['content']    = "reset";
        $this->load->view('default_login', $data);
    }

    /**
     * Do_reset
     * 
     * Action for reset password in first_login user
     *
     * @return json
     */
    public function do_reset()
    {
        $vendor_id          = $this->input->post('vendor_id');
        $new_password       = $this->input->post('new_password');
        $confirm_password   = $this->input->post('confirm_password');
        $reset_password     = $this->login->resetPassword($vendor_id, $new_password, $confirm_password);

        echo json_encode($reset_password, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Forgot Function
     * 
     * Action for vendor if forgot password
     *
     * @return void
     */
    public function do_forgot()
    {
        $vendor_id      = $this->input->post('vendor_code');
        $vendor_mail    = $this->input->post('email');

        $get_user_mail  = $this->login->getUserMail($vendor_id, $vendor_mail);
        $mail_body      = '';
        if ($get_user_mail['code'] == 0) {

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = 'smtp.office365.com';//"smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is depracated
            $mail->SMTPAuth = true;
            $mail->Username = 'baragudpl@socfindo.co.id';//'ittesting@socfindo.co.id';//'muhamad.wik@gmail.com';
            $mail->Password = 't8whFKC2@B'; //'Init123!'; //'yaqlmppkftfgqija';
            $mail->setFrom('baragudpl@socfindo.co.id', 'Baragud Socfindo');
            $mail->addAddress($get_user_mail['data']->email_perusahaan);
            $mail->Subject = 'Reset Password';
            $mail->AddEmbeddedImage('assets/media/logos/Socfindo-Logo.jpg', 'logo_socfin', 'Socfindo-Logo.jpg');
            $mail_body  = '<html><head><style>html,body { padding: 0; margin:0; }</style>
            </head><body style=""><div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
                <br><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px">
                    <tbody>
                        <tr>
                            <td align="center" valign="center" style="text-align:center; padding: 40px">
                            <img src="cid:logo_socfin" style="height: 92px" alt="logo"></td></tr><tr>
                                            <td align="left" valign="center">
                                                <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
                                                    <!--begin:Email content-->
                                                    <div style="padding-bottom: 30px; font-size: 17px;">
                                                        <p>Kepada Yth,</p>
                                                        <strong>PT. ' . $get_user_mail['data']->nama_perusahaan . '</strong>
                                                    </div>
                                                    <div style="padding-bottom: 30px">Silahkan login dengan kridensial berikut:</div>
                                                    <div style="padding-top: 40px;padding-bottom: 40px; text-align:center; background-color:#50cd89!important;border-radius: 6px">
                                                        <div style="padding-bottom: 10px; text-align:center; color:">
                                                            <strong>USERNAME</strong>
                                                            <br>
                                                            <strong style="color:#f1416c!important">' . $get_user_mail['data']->kode_vendor . '</strong>
                                                        </div>
                                                        <div style="padding-bottom: 10px; text-align:center;">
                                                            <strong>PASSWORD</strong>
                                                            <br>
                                                            <strong style="color:#f1416c!important">' . $get_user_mail['data']->sandi . '</strong>
                                                        </div>
                                                        <div style="padding-bottom: 10px; text-align:center;">
                                                            <strong>TAUTAN</strong>
                                                            <br>
                                                            <strong>baragud.socfindo.co.id</strong>
                                                        </div>
                                                    </div>
                                                    <div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>
                                                    <div style="padding-bottom: 50px; word-wrap: break-all;">
                                                        <p style="margin-bottom: 10px;">Harap menghubungi petugas kami apabila membutuhkan informasi lebih lanjut di alamat email: </p>
                                                        <a href="https://keenthemes.com/password/reset/07579ae29b6?email=max%40kt.com" rel="noopener" target="_blank" style="text-decoration:none;color: #009EF7">support@socfindo.co.id</a>
                                                    </div>
                                                    <!--end:Email content-->
                                                    <div style="padding-bottom: 10px">Hormat Kami,
                                                    <br><br><br><br>PT. Socfin Indonesia.
                                                    </div></div></td></tr><tr>
                                                        <td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
                                                            
                                                        </td>
                                                    </tr>
                                                
                                            
                                        
                                    
                                
                            
                        
                    </tbody>
                </table>
            </div><input id="ext-version" type="hidden" value="1.2.6"><input id="ext-id" type="hidden" value="ledliampejcpphmpamgpcgmodbjocnnn"></body></html>';
            $mail->msgHTML($mail_body); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            // $mail->AltBody = 'HTML messaging not supported';
            // $mail->addStringAttachment($email_data['file'], 'Slip_Gaji_'.$email_data['emp_data']['emp_salary']['nik'].'_'.$periode.'.pdf'); //Attach an image file

            if (!$mail->send()) {
                // echo "Mailer Error: " . $mail->ErrorInfo;
                $response   = array(
                    'code'      => 100,
                    'status'    => 'error',
                    'msg'       => 'Gagal mengirim email'
                );
            } else {
                // echo "Message sent!";
                $response   = array(
                    'code'      => 0,
                    'status'    => 'success',
                    'msg'       => 'Berhasil mengirim email. Silahkan cek email Anda.'
                );
            }
        } else {

            $response   = $get_user_mail;
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }
}

/* End of file Login.php */
