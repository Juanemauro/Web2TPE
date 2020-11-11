<?php
require_once './Models/ComentariosModel.php';
require_once 'ApiController.php';
require_once './Models/PedidosModel.php';

class ComentariosController extends ApiController {
    // CONSTRUCTOR  
    function __construct() {
        parent::__construct();
        $this->comentariosModel = new ComentariosModel();
        $this->pedidosModel = new PedidosModel();
        $this->apiView = new APIView();
    }
    // OBTENER COMENTARIOS
    function getComentarios($params = null) {
        $comentarios = $this->comentariosModel->getComentarios();
        $this->apiView->response($comentarios, 200);
    }
    // OBTENER UN COMENTARIO DETERMINADO POR EL ID
    function getComentariosPedido($params = null) {
        $id = $params[':ID']; 
        $id_pedido = $this->pedidosModel->getPedido($id);
        if (!empty($id_pedido)){ // Verifico que exista el pedido con ese id
            $comentarios = $this->comentariosModel->getComentariosBypedido($id);
            $this->apiView->response($comentarios, 200); // Verifico que exista el comentario
            
            //if (!empty($comentarios)){
            //    $this->apiView->response($comentarios, 200); // Verifico que exista el comentario
            //}else{
            //    $this->apiView->response($comentarios, 200);
            //}
        }else{
            $this->apiView->response("El pedido con id=$id no existe.", 404);
        }        
    }
    // BORRAR UN COMENTARIO SEGÚN SU ID
    function borrarComentario($params = null) {
        $id = $params[':ID'];
        $result = $this->comentariosModel->borrarComentario($id);
        if($result > 0)
            $this->apiView->response("El comentario con el id=$id fue eliminado.", 200);
        else
            $this->apiView->response("El comentario con el id=$id no existe.", 404);
    }
    // AGREGAR COMENTARIO
    function agregarComentario($params = null){
        $body = $this->getData();
        $idComentario = $this->comentariosModel->insertComentario($body->texto, $body->puntaje, $body->id_usuario, $body->id_pedido, $body->id_usuario);
        if(!empty($idComentario)) // verifica si existe el comentario
            $this->apiView->response($this->comentariosModel->getComentario($idComentario), 201);
        else
            $this->apiView->response("El comentario no se pudo insertar.", 404);
    }
    // ACTUALIZAR COMENTARIO -> no hay que implementarlo
    function updateComentario($params = null){
        $id = $params[':ID'];
        $body = $this->getData();
        $comentario = $this->comentariosModel->getComentario($id);
        if (empty($comentario)) {
            $this->apiView->response("El comentario con el id=$id no existe.", 404);
        }else{
            $result = $this->comentariosModel->updateComentario($id, $body->texto, $body->puntaje);
            if($result > 0)
                $this->apiView->response($this->comentariosModel->getComentario($id), 200);
            else
                $this->apiView->response("El comentario con el id=$id no fue actualizado.", 204);
        }
    }
}