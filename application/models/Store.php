<?php

/*
 * Model For Store
 * Author Rishabh Aggarwal rishabh.aggarwal@dal.ca
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
    //Get Customer Based on Storeid
    public function getCustomers($store_id) {
        $query = $this->db->query("SELECT customer.customer_id, customer.last_name, customer.first_name, customer.active, film.title FROM customer 
                                   INNER JOIN rental ON rental.customer_id=customer.customer_id 
                                   INNER JOIN inventory ON rental.inventory_id=inventory.inventory_id 
                                   INNER JOIN film ON inventory.film_id=film.film_id 
                                   WHERE customer.store_id='" . $store_id . "' 
                                   ORDER BY customer.last_name ASC");
        return $query->result();
    }
    
    //This is used for Store Details when user is passed to customers page
    public function storeDetails($store_id) {
        $query = $this->db->query("SELECT store.store_id, city.city,country.country,address.address_id FROM store
                                   INNER JOIN address ON address.address_id = store.store_id
                                   INNER JOIN city ON city.city_id = address.city_id 
                                   INNER JOIN country ON country.country_id = city.country_id
                                   WHERE store.store_id = '" . $store_id . "'");
        return $query->result();
    }

    //Get Single Customer
    public function getCustomer($customer_id, $store_id) {
        $query = $this->db->query("SELECT customer.store_id, customer.customer_id, customer.last_name, customer.first_name, customer.active, film.title FROM customer 
                                   INNER JOIN rental ON rental.rental_id=customer.customer_id 
                                   INNER JOIN inventory ON rental.inventory_id=inventory.inventory_id 
                                   INNER JOIN film ON inventory.film_id=film.film_id 
                                   WHERE customer.customer_id='" . $customer_id . "' AND customer.store_id = '" . $store_id . "'");
        return $query->row();
    }
    
    //Update Customer
    public function updateCustomer($customer_id,$customer_first,$customer_last,$customer_active) {
        $query = $this->db->query("UPDATE customer SET 
                                   customer.first_name='".$customer_first."',
                                   customer.last_name='".$customer_last."',
                                   customer.active=".$customer_active."
                                   WHERE customer.customer_id='" . $customer_id . "'"
                                   );

        return 'Success';
    }
    
    //Delete Customer
    public function deleteCustomer($customer_id) {
        
        //Need to Delete all records from corresponding tables also 
        $this->db->query("DELETE FROM `payment` WHERE `customer_id`='" . $customer_id . "'");
        $this->db->query("DELETE FROM `rental` WHERE `customer_id`='" . $customer_id . "'");
        $this->db->query("DELETE FROM `customer` WHERE `customer_id`='" . $customer_id . "'");
        
    }
    //Add New Customer
    public function addCustomer($store_id,$firstname,$lastname,$active,$addressid) {
        $this->db->query("INSERT INTO `customer`(`customer_id`,`store_id`, `first_name`, `last_name`, `active`,`address_id`,`create_date`, `last_update`) VALUES (NULL,".$store_id.",'".$firstname."','".$lastname."','".$active."',".$addressid.", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

}
