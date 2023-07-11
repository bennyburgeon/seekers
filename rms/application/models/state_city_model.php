<?php 

class State_city_model extends CI_Model {
     
    /**
     * This funtion will return me the result of all the states.
     * This has to be unique because the states will be repeating.
     */
    function get_unique_states() {
        $query = $this->db->query("SELECT DISTINCT state_id,state_name FROM pms_state");
         
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }
     
    function get_cities_from_state($state) {
        $query = $this->db->query("SELECT city_name FROM pms_city  WHERE state_id = '{$state}'");
         
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }
}
?>