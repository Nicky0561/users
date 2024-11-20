
<?php
class Role_model extends CI_Model {

public function get_all_roles() {
    $query = $this->db->get('role');
    return $query->result();
}
}
