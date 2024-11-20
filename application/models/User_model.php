<?php
    class User_model extends CI_Model {

        public function add_user($data) {
            // Récupérer l'id_role associé au rôle, ici on assume que le rôle est passé par son nom
            $role_name = $data['role']; 
            $this->db->select('id_role');
            $this->db->from('role');
            $this->db->where('role', $role_name);
            $query = $this->db->get();
        
            $role_id = $query->row()->id_role;
            // Ajouter l'ID du rôle au tableau de données
            $data['id_role'] = $role_id;
            unset($data['role']);  // Retirer 'role' car on ne garde que 'id_role'
        
            // Insérer l'utilisateur dans la table 'user'
            $this->db->insert('user', $data);
        }
        

        public function delete_user ($id){
            $this->db->where('id', $id);
            $this->db->delete('user');

        }

        public function get_one_user ($id){
            $this->db->where('id', $id);
            $data = $this->db->get('user');
            return $data -> result();
        }

        public function update_user($data, $id) {
            // Récupérer l'ID du rôle en fonction du nom du rôle
            $role_name = $data['role'];
            $this->db->select('id_role');
            $this->db->from('role');
            $this->db->where('role', $role_name);
            $query = $this->db->get();
        
            $role_id = $query->row()->id_role;
            // Mettre à jour l'ID du rôle dans les données de l'utilisateur
            $data['id_role'] = $role_id;
            unset($data['role']);  // Retirer 'role'
        
            // Mettre à jour l'utilisateur dans la table 'user'
            $this->db->where('id', $id);
            $this->db->update('user', $data);
        }
        

        public function get_all_user() {
            $this->db->select('user.id, user.nom, user.email, user.status, role.role');
            $this->db->from('user');
            $this->db->join('role', 'user.id_role = role.id_role');  // Joindre la table 'role'
            $query = $this->db->get();
            return $query->result();
        }
        
            
       
        public function suspend_user($id) {
            $data = ['status' => 'suspendu'];
            $this->db->where('id', $id);
            $this->db->update('user', $data);
        }

        
        public function reactivate_user($id) {
            $data = ['status' => 'actif'];
            $this->db->where('id', $id);
            $this->db->update('user', $data);
        }


    }

    