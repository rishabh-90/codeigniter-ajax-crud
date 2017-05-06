<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Store extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Will return Countries from Database and will pass it to Controller
    public function getCountries() {
        $query = $this->db->query("SELECT `country_id`,`country` FROM `country`");
        return $query->result();
    }
    
    //Will return Cities from Database and will pass it two Controller
    public function getCities($country_id) {
        $query = $this->db->query("SELECT city, city_id FROM city INNER JOIN country on country.country_id=city.country_id WHERE city.country_id ='" . $country_id . "'");
        return $query->result();
    }
    
    // Will return Store ID and Count Number of Inventory for Store from Particular City and will return store_id and inv_count
    public function getStores($city_id) {
        $query = $this->db->query(
                "SELECT store.store_id,COUNT(inventory.film_id) AS inv_count FROM store
                 INNER JOIN address on store.address_id=address.address_id
                 INNER JOIN inventory ON store.store_id=inventory.store_id
                 WHERE address.city_id='" . $city_id . "'");
        return $query->result();
    }

}
