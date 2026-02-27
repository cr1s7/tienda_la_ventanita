<?php

require_once './Model/TipoDocumentoModel.php';
require_once './Config/Database.php';

class TipoDocumentoController {
    private $db;
    private $TipoDocumentoModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->TipoDocumentoModel = new TipoDocumentoModel($this->db);
    }

    public function listaTipoDocumento() {
        return $this->TipoDocumentoModel->listar();
    }

}