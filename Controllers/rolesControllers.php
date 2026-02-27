<?php

require_once './Model/rolesModel.php';
require_once './Config/Database.php';

class roles {
    private $db;
    private $rolesModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rolesModel = new rolesModel($this->db);
    }

    public function listaRoles() {
        return $this->rolesModel->getroles();
    }
}