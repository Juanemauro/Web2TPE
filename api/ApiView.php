<?php
class APIView {
    // Devuelve en formato JSON.
    function response($data, $status) {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        echo json_encode($data);
    }
    // Devuelve el código que se genera luego de consultar a la API
    private function requestStatus($code) {
        $status = array(
          200 => "OK",
          201 => "Created",
          404 => "Not found",
          500 => "Internal Server Error"
        );
        return (isset($status[$code]))? $status[$code] : $status[500];
    }  
}