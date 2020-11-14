<?php
require_once './Models/ImagenesModel.php';
require_once './Models/PedidosModel.php';
require_once './Views/PedidosView.php';
//require_once "/path/to/file";

class ImagenesController {
    private $imagenesModel;
    private $pedidosView; 
    private $pedidosModel; 
    private $loggeado;
    private $admin;
    private $autenticacion;

    // CONSTRUCTOR
    function __construct(){
        $this->imagenesModel = new ImagenesModel();
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->autenticacion = new AutenticacionController();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
    }

    // AGREGAR IMÁGENES 
    function verImagenesPedido($params = null){
        $id_pedido = $params[':ID'];
 
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";           
        }
        $imagenes = $this->imagenesModel->getImagenesPorPedido($id_pedido);
        $this->pedidosView->showImagenesPedido($id_pedido, $imagenes, $this->loggeado, $usuario, $this->admin);        
    }

    // INSERTAR IMÁGENES -> obtener datos de los archivos
    function agregarImagenes(){
        $id_pedido = $_POST['id_pedido']; 
        $descripcion=$_POST["descripcion"];        
        if ($this->admin){
            if ($this->loggeado){
                $usuario = $_SESSION["ALIAS"];
            }else{
                $usuario = "";           
            }
            $imagenes = $this->insertarImagenes($_FILES['image'], $id_pedido, $this->loggeado, $this->admin, $usuario, $descripcion);
            header('Location: '.BASE_URL.'verImagenes/'. $id_pedido);
        }              
    }

    // ADD IMÁGENES
    function insertarImagenes($images, $id_pedido, $loggeado, $admin, $usuario, $descripcion = ''){
        for ($i= 0; $i < sizeof($images['name']); $i++){ // for para iterar el arreglo con todas las imágenes que sube el admin
            $extension = pathinfo($images['name'][$i], PATHINFO_EXTENSION);
            if ($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "JPG" || $extension == "JPEG"){
                $nombre = $images['name'][$i]; // nombre de la imagen
                $nombre_tmp = $images['tmp_name'][$i]; // nombre para la carpeta temporal     
                $imagen = $this->moverImagen($nombre, $nombre_tmp); // mover imagen a la carpeta temporal
                $this->imagenesModel->addImages($id_pedido, $imagen, $descripcion); // agregar imagen a la BDD
            }    
        }
    }

    // MOVER IMÁGENES A LA CARPETA TEMPORAL
    function moverImagen($nombre, $tmp){
        $filepath = "images/" . uniqid() . "." . strtolower(pathinfo($nombre, PATHINFO_EXTENSION));  // convertir el string a minúsculas 
        //echo 'ruta de la imagen: '. $filepath;
        //echo '<br>';
        move_uploaded_file($tmp, $filepath); // mover el archivo a la ubicación -> imags_temp/ruta de la imagen
        //echo '<br>';
        return $filepath; // devuelve la ruta final de la imagen
    }

    // ELIMINAR UNA IMAGEN
    function borrarImagen($params = null){
        $id_imagen = $params[':ID'];
        $pedido = $this->imagenesModel->getPedidoByImagen($id_imagen); // Obtengo el pedido para redireccionar
        if ($this->admin){
            $imagen = $this->imagenesModel->getImagenById($id_imagen); // Obtengo los datos de la imagen para eliminarla de la carpeta 
            $_SESSION['url'] = $_SERVER['HTTP_REFERER']; 
            //echo $_SESSION['url'];
            //echo '<br>';
            //echo BASE_URL ;
            //echo '<br>';
            //die();           
            $this->imagenesModel->deleteImagen($id_imagen);
            unlink($imagen->ruta); // Elimina el archivo de la carpeta 
            
            //////////////   CONSULTAR ///////////////////////////////// 
            // Redirección según dónde lo elimina ----------      
            $url_galeria = 'http://localhost/Proyectos/Entrega1/verImagenes/'. $pedido->id_pedido;
            //echo $_SESSION['url'];
            //echo '<br>';
            
            $url_edit_pedido = 'http://localhost/Proyectos/Entrega1/editPedido/'. $pedido->id_pedido;
            //echo $url_edit_pedido;
            //die();

            if ($_SESSION['url'] = $url_galeria){
                header('Location: ' .BASE_URL. 'verImagenes/'. $pedido->id_pedido);
            }else if($_SESSION['url'] = $url_edit_pedido){
                header('Location: ' . BASE_URL . 'editPedido/'. $pedido->id_pedido);
            } 
        }
        header('Location: '.BASE_URL.'verImagenes/'. $pedido->id_pedido);       
    }    
}