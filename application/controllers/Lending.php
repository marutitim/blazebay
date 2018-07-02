<?php
class Lending extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http:/example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();
        // load the pdo for db connection
        $this->pdo = $this->load->database('pdo', true);
        $this->load->model('Lending_model');
    }

    public function index(){
        $data ['inCart_count'] = "2";
        $this->load->view ( 'index', $data);
    }

    public function crude(){
        $data ['transactions'] = $this->Lending_model->getTabledata('transactions');
        $this->load->view ( 'crude', $data);
    }
    public function add(){
        $data ['users_data'] = $this->Lending_model->getTabledata('users');
        $data ['catdata'] = $this->Lending_model->getTabledata('loan_types');
        $this->load->view ( 'addrecord', $data);
    }


    public function procesadd(){
        $transactions=array(
            'user_id'=>$_POST['user'],
            'type'=>$_POST['cat'],
            'date'=>date('Y-m-d h:i:sa'),
            'amount'=>$_POST['amount']
        );
    $res=$this->Lending_model->add('transactions',$transactions);

        $data=array(
            'msg'=>'Success',
            'code'=>1
        );
        echo json_encode($data);
    }
    public function procesupdate(){
        $data ['inCart_count'] = "2";
        $this->load->view ( 'addrecord', $data);
    }

    public function checkAvailability(){
        $this->load->view ( 'ajax/populate');
    }

}