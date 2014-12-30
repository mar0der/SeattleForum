<?php

class Admin_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function userList() {

        return $this->db->select('SELECT userid, username, role FROM users');
    }

    public function userSingleList($userid) {
        return $this->db->select('SELECT userid, username, role FROM users WHERE userid = :userid', array(':userid' => $userid));
    }

    public function create($data) {
        $this->db->insert('users', array(
            'username' => $data['username'],
            'password' => Hash::create('sha256', $data['password'], Config::getValue("salt")),
            'role' => $data['role']
        ));
    }

    public function editSave($data) {
        $data['password'] = Hash::create('sha256', $data['password'], Config::getValue("salt"));
        $this->db->update('users', $data, "`userid` = {$data['userid']}");
    }

    public function delete($userid) {
        $result = $this->db->select('SELECT role FROM users WHERE userid = :userid', array(':userid' => $userid));
        //@TODO: change this owner to a variable from config
        if ($result[0]['role'] == 'owner')
            return false;
        $this->db->delete('users', "userid = '$userid'");
    }

}
