<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 6/7/2018
 * Time: 10:28 AM
 */
class LanguageLoader

{

    function initialize() {

        $ci =& get_instance();

        $ci->load->helper('language');

        $siteLang = $ci->session->userdata('site_lang');

        if ($siteLang) {

            $ci->lang->load('information',$siteLang);

        } else {

            $ci->lang->load('information','english');

        }

    }

}