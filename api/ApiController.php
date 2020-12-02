<?php 

require_once './api/APIView.php';

abstract class ApiController {

    protected $model; // lo instancia el hijo
    protected $apiView;
    private $data; 
    
    // CONSTRUCTOR
    public function __construct() {
        $this->apiView = new APIView();
        $this->data = file_get_contents("php://input"); 
    }
    
    // Transforma a json los datos 
    function getData(){ 
        return json_decode($this->data); 
    }  
}

