{include 'templates/header.tpl'}
<div class="slide">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/Untitled.jpg" alt="First slide">
        </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/Untitled.jpg" alt="Second slide">
            </div>
        <div class="carousel-item">
                <img class="d-block w-100" src="images/Untitled.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>
<div class="pedidos"><a href="showPedidos"><img src="images/pedidos.jpg" alt="Pedidos" class="pedidos"></a></div>
<div class="productos"><a href="showProductos"><img src="images/productos.jpg" alt="Productos" class="pedidos"></a></div>
{include 'templates/footer.tpl'}