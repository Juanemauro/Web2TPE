<html lang="en">
<head>
    <base href="{BASE_URL}">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>{$titulo}</title>
</head>
<body>
    <div class="contenedor">
        <div class="logo"><img src="images/logo.png" alt="El Azuleño" class="logo"></div>
        <div class="navbar">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Pedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showFaq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary">{$usuario}</button>
                    </li>                    
                    <li class="nav-item">
                        <a href="logout" class="btn btn-primary">Logout</a>
                    </li>
                </ul>
            </div>
            </nav>
        </div>
