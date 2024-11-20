<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'm_user');
    }

    public function get_all(){
        $data = $this->m_user->get_all_user();
        return $data;

    }

    public function index() {
        $data["title"] = "User";
        $data["users"] = $this->get_all();
        
        // Charger les rôles pour les afficher dans le formulaire
        $this->load->model('Role_model');
        $data['roles'] = $this->Role_model->get_all_roles();
    
        $this->load->view('old/User/home', $data);
    }
    

    public function register_user() {
        $nom = $this->input->post("nom");
        $email = $this->input->post("email");
        $role = $this->input->post("role");  // Récupérer le rôle sous forme de texte
        
        $data = [
            "nom" => $nom,
            "email" => $email,
            "role" => $role  // Passer le rôle sous forme de texte
        ];
        
        $this->m_user->add_user($data);
        redirect('/');
    }
    

    public function delete_user($id){
        $this->m_user->delete_user($id);
        redirect('/');
    }

    public function update_user($id) {
        $data = [
            "nom" => $this->input->post("nom"),
            "email" => $this->input->post("email"),
            "role" => $this->input->post("role")  // Récupérer le rôle sous forme de texte
        ];
        $this->m_user->update_user($data, $id);
        redirect('/');
    }
    

    
     public function suspend_user($id) {
        $this->m_user->suspend_user($id);
        redirect('/');
    }

 
    public function reactivate_user($id) {
        $this->m_user->reactivate_user($id);
        redirect('/');
    }
    
}
