<?php

//Rishabh Aggarwal rishabh.aggarwal@dal.ca

class Stores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Store');
    }
    //Root and list of countries was passed to controller
    public function index() {
        $data['countries'] = $this->Store->getCountries();
        $this->load->view('stores', $data);
    }
    
    //Get City after selecting country
    public function get_cities() {
        $country_id = $this->input->post('country_id');
        $citieis = $this->Store->getCities($country_id);
        if (count($citieis) > 0) {
            $data = array();
            foreach ($citieis as $city) {
                $data['value'] = $city->city_id;
                $data['label'] = $city->city;
                $json[] = $data;
            }
            echo json_encode($json);
        }
    }
    //Get All Stores on City
    public function get_stores() {
        $city_id = $this->input->post('city_id');
        $stores = $this->Store->getStores($city_id);
        if (count($stores > 0)) {
            foreach ($stores as $store) {
                $data['store_id'] = $store->store_id;
                $data['inv_count'] = $store->inv_count;
                $json_city = $data;
            }
            echo json_encode($json_city);
        }
    }
    //List all customers for that store
    public function customers($store_id) {

        $data['customers'] = $this->Store->getCustomers($store_id);
        $data['city_country'] = $this->Store->storeDetails($store_id);
        $this->load->view('customers', $data);
    }

    //Record of Single Customer by ID Details
    public function get_customer($id, $store_id) {
        $data = $this->Store->getCustomer($id, $store_id);
        echo json_encode($data);
    }
    
    //Update Customer
    public function customer_update() {
        $customer_id = $this->input->post('customer_id');
        $customer_first = $this->input->post('customer_firstname');
        $customer_last = $this->input->post('customer_lastname');
        $customer_active = $this->input->post('customer_active');

        $this->Store->updateCustomer($customer_id, $customer_first, $customer_last, $customer_active);
        echo json_encode(array("status" => TRUE));
    }

    //Delete Customer
    public function delete_customer($id) {

        $this->Store->deleteCustomer($id);
        echo json_encode(array("status" => TRUE));
    }
    
    // Controller for Adding Customer and Passing it two model
    public function add_customer() {
        $storeid = $this->input->post('store_id');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $active = $this->input->post('active');
        $addressid = $this->input->post('addressid');


        $this->Store->addCustomer($storeid, $firstname, $lastname, $active,$addressid);
        echo json_encode(array("status" => TRUE));
    }

}
