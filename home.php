<?php
// Define o tempo limite de inatividade da sessão em 30 minutos
$session_timeout = 1800; // 1800 segundos = 30 minutos
session_set_cookie_params($session_timeout);

// Inicia a sessão
session_start();

// Verifica se a variável de sessão 'autenticado' está definida e se o valor é true
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
    $_SESSION['error_message'] = 'Para acessar essa pagina é necessário realizar o login!';
    // Redireciona o usuário de volta para a página de login ou para uma página de acesso negado
    header("Location: login.php");
    exit;
}

// Verifica se o tempo de inatividade da sessão expirou
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    // Destroi a sessão atual
    session_unset();
    session_destroy();
    // Redireciona o usuário de volta para a página de login ou para uma página de acesso negado
    header("Location: login.php");
    exit;
}
include("conexao.php");
// Atualiza o último tempo de atividade da sessão
$_SESSION['last_activity'] = time();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/home.css">
        <title>Integração Somos Dev's</title>
    </head>
    <body>
        <?php
            include("cabecario.php");
        ?>


        <?php
            include("footer.php");
        ?>
    </body>
</html>
