<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -----------------------------------------------------
| PRODUCT NAME: ZAL - ISP MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR: ONEZEROART TEAM
| -----------------------------------------------------
| EMAIL: support@onezeroart.com
| -----------------------------------------------------
| COPYRIGHT: RESERVED BY ONEZEROART.COM
| -----------------------------------------------------
| AUTHOR PORTFOLIO: https://codecanyon.net/user/onezeroart/portfolio
| -----------------------------------------------------
| WEBSITE: http://onezeroart.com
| -----------------------------------------------------
*/
use PEAR2\Net\RouterOS;
class Network extends CI_Controller {

    function __construct() {
        parent::__construct();
        isLogin();
        isKena();
        $this->load->model('main');
    }

    public function index() {

        try {
            $data['ipaddresses'] = mkUtil()->setMenu('/ip address')->getAll();
            $data['interfaces'] = mkUtil()->setMenu('/interface')->getAll();            
        } catch (Exception $e) {
            $data['error'] =  $e->getMessage();
        }

        $this->load->view('header');
        $this->load->view('network', $data);
        $this->load->view('footer');
    }


    //add new ip address
    public function addIpAddress() {

        $this->form_validation->set_rules('interface', 'Interface Name', 'trim|required');
        $this->form_validation->set_rules('address', 'IP Address', 'trim|required');
        if ($this->form_validation->run()) {
            
            try {
                $util = new RouterOS\Util(
                    $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
                );

                $util->setMenu('/ip address');
                $return = $util->add(
                    array(
                        'interface' => $this->input->post('interface'),
                        'address' => $this->input->post('address'),
                        )
                );

                if ($return) {
                    $this->session->set_flashdata('success', 'IP Successfully Added');
                    redirect('network/', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Opps! Something Wrong');
                    redirect('network/', 'refresh');
                }
                
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
                redirect('network/', 'refresh');
            }

        }else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('network/', 'refresh');
        }
    }



    //delete ip address
    public function deleteIpAddress($ipaddress){
        try {

            $util = new RouterOS\Util(
                $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
            );


            $enableRequest = new RouterOS\Request('/ip/address/remove');
            $enableRequest->setArgument('numbers', '*' . $ipaddress);
            $client->sendSync($enableRequest);

            // //if user connection type api hotshot then do this
            // $printRequest = new RouterOS\Request('/ip/address/print');
            // $printRequest->setArgument('.proplist', '.id');
            // $printRequest->setQuery(RouterOS\Query::where('address', $ipaddress));
            // $apiID = $client->sendSync($printRequest)->getProperty('.id');
            // //$id now contains the ID of the entry we're targeting

            // if($apiID){
            //     $enableRequest = new RouterOS\Request('/ip/address/remove');
            //     $enableRequest->setArgument('numbers', $ipaddress);
            //     $client->sendSync($enableRequest);

            //     $this->session->set_flashdata('success', 'IP Address Successfully Deleted');
            //     redirect('network/', 'refresh');
            // }

            // $this->session->set_flashdata('error', 'Opps! User Not Found on NAS.');
            redirect('network/', 'refresh');


        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
            $this->session->set_flashdata('error', $data['error']);
            redirect('network/', 'refresh');
        }
    }

    //update mikrotik info
    public function update() {
        $data = array();
        $data['mkipadd'] = $this->input->post('mkipadd');
        $data['mkuser'] = $this->input->post('mkuser');
        $data['mkpassword'] = $this->input->post('mkpassword');
        $this->db->where('id', 1);
        $true = $this->db->update('settings', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect('network', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('network', 'refresh');
        }
    }


}
