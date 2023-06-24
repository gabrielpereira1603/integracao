<link rel="stylesheet" href="assets/css/cabecario.css">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<header>

<nav class="navbar navbar-expand-lg navbar-light " data-aos="fade-up">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/img/fiveicon.png" alt="Logo" width="150"  class="d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
               
                <li class="nav-item"><a class="nav-link" href="menu.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sistemas Web
                    </a>
                    
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="manutencaolabs.php">Sistema De Manutenções - Unifunec</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Gestão Hospital - AugeCare</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="http://localhost/paracatu/login.php" target="_blank">Sistema De Pedidos - Paracatu</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sistemas Desktop
                    </a>
                    
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Gestão De Vendas e Estoque - Unifunec</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sistema De Previsão Do Tempo - Somos Dev's</a></li>
                    </ul>
                </li>
                
                <li class="nav-item"><a class="nav-link" href="#">Sobre Nós</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Dúvidas</a></li>
                <li class="nav-item">
                    <form method="post" action="logout.php">
                        <button type="submit" class="btn btn-link nav-link" onclick="return confirm('Deseja sair?')">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


</header>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>