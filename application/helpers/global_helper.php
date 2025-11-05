<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('logged_in')) {
    function logged_in()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $logged_in  = $CI->session->userdata('logged_in');
        $first_log  = $CI->session->userdata('first_login');
        if($first_log == 1) {
            redirect('login/reset');
        } else {
            if(!$logged_in) {
                $CI->session->sess_destroy();
                redirect('welcome');
            }
        }
    }
}

if(!function_exists('first_login')) {
    function first_login()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $logged_in  = $CI->session->userdata('logged_in');
        $first_log  = $CI->session->userdata('first_login');
        if($first_log == 0 && $logged_in) {
            redirect('dashboard');
        } else {
            if(!$logged_in) {
                $CI->session->sess_destroy();
                redirect('welcome');
            }
        }
    }
}

if(!function_exists('generate_menu')) {
    function generate_menu()
    {
        $CI =& get_instance();
        $CI->load->model('Sqlite_model', 'sqlite');

        $html       = '<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">';
        $parents    = $CI->sqlite->getMenus(0);

        $uri_1      = $CI->uri->segment(1);
        $uri_2      = $CI->uri->segment(2);
        $uri        = ($uri_2 === NULL) ? $uri_1 : $uri_1 . '/' . $uri_2;
        $active     = '';
        $accordion  = '';
        foreach($parents as $parent) {
            $childs = $CI->sqlite->getMenus($parent->id);
            if(count($childs) > 0) {
                $accordion  = ($parent->uri == $uri_1) ? 'here show' : '';
                $html   .= '<div data-kt-menu-trigger="click" class="menu-item menu-accordion ' . $accordion . '">';
                $html   .= '<span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon-->
                                    <span class="svg-icon svg-icon-2">
                                        '.$parent->icon.'
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">'.$parent->name.'</span>
                                <span class="menu-arrow"></span>
                            </span>';
                $html   .= '<div class="menu-sub menu-sub-accordion menu-active-bg">';

                foreach($childs as $child) {
                    if($child->uri == $uri) {
                        $active = 'active';
                    } else {
                        $uri_3  = $CI->uri->segment(3);
                        $explode_uri_child = explode('/', $child->uri);
                        if($uri_1 == $explode_uri_child[0] && $uri_2 == 'det_' . $explode_uri_child[1] && !empty($uri_3)) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                    }
                    // $active = ($child->uri == $uri) ? 'active' : '';
                    $html   .= '<div class="menu-item">
                                    <a class="menu-link ' . $active .'" href="'.site_url($child->uri).'">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">'.$child->name.'</span>
                                    </a>
                                </div>';
                }
                $html   .= '</div>';
                $html   .= '</div>';
            } else {
                $active = ($parent->uri == $uri) ? 'active' : '';
                $html   .= '<div class="menu-item">
                                <a class="menu-link ' . $active . '" href="'.site_url($parent->uri).'">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon-->
                                        <span class="svg-icon svg-icon-2">
                                            '.$parent->icon.'
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">'.$parent->name.'</span>
                                </a>
                            </div>';
            }
        }
        $html      .= '</div>';

        return $html;
    }
}

if(!function_exists('diff_date')) {
    /**
     * Get difference between 2 dates
     *
     * @param string $date_1
     * Must be filled
     * Like End Date or Max Date
     * 
     * @param string|null $date_2
     * 
     * [optional]
     * Default value : date('Y-m-d') / Current Date.
     * 
     * @return array
     * ['years'] integer
     * ['months'] integer
     * ['days'] integer
     */
    function diff_date(string $date_1, string $date_2 = NULL)
    {
        $date_2 = ($date_2 === NULL) ? date('Y-m-d') : $date_2;
        if(strtotime($date_1) > strtotime($date_2)) {
            $diff   = abs(strtotime($date_1) - strtotime($date_2));
        } else {
            $diff   = strtotime($date_1) - strtotime($date_2);
        }

        $years  = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        return array(
            'years'     => (int)$years,
            'months'    => (int)$months,
            'days'      => (int)$days
        );
    }
}