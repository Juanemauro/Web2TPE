<?php

require_once './Models/ImagenesModel.php';
require_once './Models/PedidosModel.php';
require_once './Views/PedidosView.php';
require_once './Views/HomeView.php';

class ImagenesController {
    private $imagenesModel;
    private $pedidosView; 
    private $homeView;
    private $pedidosModel; 
    private $loggeado;
    private $admin;
    private $autenticacion;
    private $errorImagenes;

    // CONSTRUCTOR
    function __construct(){
        $this->imagenesModel = new ImagenesModel();
        $this->pedidosModel = new PedidosModel();
        $this->pedidosView = new PedidosView();
        $this->homeView = new Homeview();
        $this->autenticacion = new AutenticacionController();
        $this->loggeado = $this->autenticacion->checkLoggedIn();
        $this->admin = $this->autenticacion->checkAdmin();
        $this->errorImagenes = array();
    }

    // AGREGAR IMÁGENES 
    function verImagenesPedido($params = null){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";           
        }
        if(isset($params[':ID'])){
            $id_pedido = $params[':ID'];             
            $pedido = $this->pedidosModel->getPedido($id_pedido);
            if(!empty($pedido)){
                $imagenes = $this->imagenesModel->getImagenesPorPedido($id_pedido);
                $this->pedidosView->showImagenesPedido($id_pedido, $imagenes, $this->loggeado, $usuario, $this->admin);
            }else{
                $seccion = "Pedidos";  
                $this->homeView->showError("No existe ese pedido.", "Pedidos", $seccion, $this->loggeado, $usuario, $this->admin);
            }
        }else{
            $seccion = "a Home";  
            $this->homeView->showError("La página que intentas solicitar no existe..", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
        }                         
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
            if (!empty($imagenes)){ // Si alguna imagen no pudo subirse, esto va a tener al menos un elemento y va a mostrar el template con el error
                $seccion1 = "Editar pedido";
                $seccion2 = "imágenes del pedido";  
                $redireccion1 = BASE_URL.'editPedido/'. $id_pedido;
                $redireccion2 = BASE_URL.'verImagenes/'. $id_pedido; 
                $this->homeView->showErrorImagen("Las siguientes imágenes no pudieron cargarse: ", $imagenes, $redireccion1, $redireccion2, $seccion1, $seccion2, $this->loggeado, $usuario, $this->admin);
            }else{
                header('Location: '.BASE_URL.'verImagenes/'. $id_pedido);
            }  
        }              
    }

    // ADD IMÁGENES
    function insertarImagenes($images, $id_pedido, $loggeado, $admin, $usuario, $descripcion = ''){
        for ($i= 0; $i < sizeof($images['name']); $i++){ // for para iterar el arreglo con todas las imágenes que sube el admin
            $extension = pathinfo($images['name'][$i], PATHINFO_EXTENSION); // Obtengo la extensión de la imagen
            if ($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "JPG" || $extension == "JPEG"){
                $nombre = $images['name'][$i]; // nombre de la imagen que sube el usuario
                $nombre_tmp = $images['tmp_name'][$i]; // nombre que va a tener en la carpeta temporal     
                $imagen = $this->moverImagen($nombre, $nombre_tmp); // mover imagen a la carpeta temporal
                $this->imagenesModel->addImages($id_pedido, $imagen, $descripcion); // agregar imagen a la BDD
            }else{
                array_push($this->errorImagenes, $images['name'][$i]);
            } 
        }
        return $this->errorImagenes;  
    }

    // MOVER IMÁGENES A LA CARPETA TEMPORAL
    function moverImagen($nombre, $tmp){
        $filepath = "images/" . uniqid() . "." . strtolower(pathinfo($nombre, PATHINFO_EXTENSION));  // convertir el string a minúsculas 
        move_uploaded_file($tmp, $filepath); // mover el archivo a la ubicación -> a images con el nombre temporal generado
        return $filepath; // devuelve la ruta final de la imagen
    }

    // ELIMINAR UNA IMAGEN
    function borrarImagen($params = null){
        if ($this->loggeado){
            $usuario = $_SESSION["ALIAS"];
        }else{
            $usuario = "";           
        }
        if(isset($params[':ID'])){
            $id_imagen = $params[':ID'];
            $pedido = $this->imagenesModel->getPedidoByImagen($id_imagen); // Obtengo el pedido para redireccionar
            if ($this->admin){
                $imagen = $this->imagenesModel->getImagenById($id_imagen); // Obtengo los datos de la imagen para eliminarla de la carpeta 
                if (!empty($imagen)){
                    $_SESSION['url'] = $_SERVER['HTTP_REFERER'];
                    $this->imagenesModel->deleteImagen($id_imagen);
                    unlink($imagen->ruta); // Elimina el archivo (la imagen) de la carpeta           
                    $url_galeria = 'http://localhost/Proyectos/Web2TPE/verImagenes/'. $pedido->id_pedido;                     
                    $url_edit_pedido = 'http://localhost/Proyectos/Web2TPE/editPedido/'. $pedido->id_pedido;                    
                    if ($_SESSION['url'] == $url_galeria){
                        header('Location: ' . VERIMAGENES . $pedido->id_pedido);
                    }else if($_SESSION['url'] == $url_edit_pedido){
                        header('Location: '.EDITPEDIDO. $pedido->id_pedido);  
                    } 
                }else{
                    $seccion = "a Home"; 
                    $this->homeView->showError("Esta imagen no existe..", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
                }                
            }else{
                header('Location: '. HOME);    
            }   
        }else{
            $seccion = "a Home"; 
            $this->homeView->showError("La página que intentas solicitar no existe..", "Home", $seccion, $this->loggeado, $usuario, $this->admin);
        }                    
    }    
}