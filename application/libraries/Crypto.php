<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Crypto {
    
    /**
     * Declare variable of Remove Character
     * Used for encryption & decryption
     *
     * @var array
     */
    protected $remove_char;

    /**
     * Declare variable of Add Character
     * Used for encryption & decryption
     *
     * @var array
     */
    protected $add_char;
    
    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->library('encryption');
        $this->remove_char  = array('+', '/', '=');
        $this->add_char     = array('-', '_', '~');
    }

    public function encode($plain_text)
    {
        $CI =& get_instance();
        $text = $CI->encryption->encrypt($plain_text);
        $encoded_text = str_replace($this->remove_char, $this->add_char, $text);
        return $encoded_text;
    }

    public function decode($cipher_text)
    {
        $CI =& get_instance();
        $text = str_replace($this->add_char, $this->remove_char, $cipher_text);
        $decode_text = $CI->encryption->decrypt($text);
        return $decode_text;
    }
    
}

/* End of file Crypto.php */
