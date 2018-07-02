<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 6/7/2018
 * Time: 10:00 AM
 */
class LangSwitch extends CI_Controller
{

    public function __construct() {

        parent::__construct();

    }

    function switchLang($language = "") {


        $language=$_POST['language'];
        $language = ($language != "") ? $language : "english";

        $this->session->set_userdata('site_lang', $language);

        redirect($_SERVER['HTTP_REFERER']);

    }


}