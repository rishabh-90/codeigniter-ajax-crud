<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Store');
    }

    public function index() {
        $data['countries'] = $this->Store->getCountries();
        $this->load->view('stores', $data);
    }

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
    
    public function get_stores(){
        $city_id = $this->input->post('city_id');
        $stores = $this->Store->getStores($city_id);
        if(count($stores > 0)){
            foreach ($stores as $store){
                $data['store_id'] = $store->store_id;
                $data['inv_count'] = $store->inv_count;
                $json_city = $data;
            }
            echo json_encode($json_city);
        }
    }

    public function customer() {
        $this->load->view('customers');
    }

}
