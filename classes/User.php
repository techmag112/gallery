<?php

class User {
    private $db, $data, $session_name, $isLoggedIn;

    public function __construct($user = null) {
        $this->db = Database::getInstance();
        $this->session_name = Config::get('session.user_session');

        if(!$user) { 
                if(Session::exists($this->session_name)) {
                    $user = Session::get($this->session_name); //id
                    if($this->find($user)) {
                        $this->isLoggedIn = true;
                    } 
                }
            } else {
                $this->find($user);
        }
    }

    public function create($fields = []) {
        $this->db->insert($this->session_name , $fields);
    }

    public function login($email = null, $password = null, $remember = false) {
        if(!$email && !$password && $this->exists()) {
            Session::put($this->session_name, $this->data()->id);
        } else {
            $user = $this->find($email);
            if($user) {
                if(password_verify($password, $this->data()->password)) {
                    Session::put($this->session_name , $this->data()->id);

                    return true;
                }
            }
        }

        return false;

    }

    public function find($field = null) {
        if(is_numeric($field)) {
            $this->data = $this->db->get($this->session_name, ['id', '=', $field])->first();
        } else {
            $this->data = $this->db->get($this->session_name, ['email', '=', $field])->first();
        }
        if($this->data) {
            return true;
        }
        return false;
    }

    public function data() {
        return $this->data;
    }

    public function isLoggenIn() {
        return $this->isLoggedIn;
    }

    public function logout() {
        Session::delete($this->session_name);
    }

    public function exists() {
      return (!empty($this->data())) ? true : false;
    }

    public function update($fields = [], $id = null) {
        if(!$id && $this->isLoggenIn()) {
            $id = $this->data()->id;
        }
        $this->db->update($this->session_name, $id, $fields);
    }

}