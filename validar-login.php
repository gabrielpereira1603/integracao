<?php
session_start();
include("conexao.php");

// Verifica se o formulário de criar usuário foi enviado
if (isset($_POST['criar-usuario'])) {
    $newUsername = $_POST["login"];
    $newPassword = $_POST["senha"];
    $newName = $_POST["nome"];
    $newEmail = $_POST["email"];

    // Verifica se os campos estão preenchidos
    if (empty($newUsername) || empty($newPassword) || empty($newName) || empty($newEmail)) {
        $_SESSION['error_message'] = 'Preencha todos os campos para criar um novo usuário!';
    } else {
        // Verifica se o email já está cadastrado
        $sql = "SELECT COUNT(*) AS count FROM usuario WHERE email = ?";
        $params = array($newEmail);
        $stmt = sqlsrv_query($conexao, $sql, $params);

        if ($stmt === false) {
            $errors = sqlsrv_errors();
            foreach ($errors as $error) {
                echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
                echo "Code: " . $error['code'] . "<br>";
                echo "Message: " . $error['message'] . "<br>";
            }
            exit;
        }

        $row = sqlsrv_fetch_array($stmt);
        $emailExists = $row['count'] > 0;

        if ($emailExists) {
            $_SESSION['error_message'] = 'O email já está cadastrado!';
        } else {
            // Verifica se o login já está cadastrado
            $sql = "SELECT COUNT(*) AS count FROM usuario WHERE login = ?";
            $params = array($newUsername);
            $stmt = sqlsrv_query($conexao, $sql, $params);

            if ($stmt === false) {
                $errors = sqlsrv_errors();
                foreach ($errors as $error) {
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
                    echo "Code: " . $error['code'] . "<br>";
                    echo "Message: " . $error['message'] . "<br>";
                }
                exit;
            }

            $row = sqlsrv_fetch_array($stmt);
            $loginExists = $row['count'] > 0;

            if ($loginExists) {
                $_SESSION['error_message'] = 'O login já está cadastrado!';
            } else {
                // Cria o hash da senha
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Insere o novo usuário no banco de dados
                $sql = "INSERT INTO usuario (nome, email, senha, login, codpermissao) VALUES (?, ?, ?, ?, 1)";
                $params = array($newName, $newEmail, $hashedPassword, $newUsername);
                $stmt = sqlsrv_query($conexao, $sql, $params);

                if ($stmt === false) {
                    $errors = sqlsrv_errors();
                    foreach ($errors as $error) {
                        echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
                        echo "Code: " . $error['code'] . "<br>";
                        echo "Message: " . $error['message'] . "<br>";
                    }
                    exit;
                }

                $rowsAffected = sqlsrv_rows_affected($stmt);
                if ($rowsAffected > 0) {
                    $_SESSION['success_message'] = 'Usuário criado com sucesso!';
                } else {
                    $_SESSION['error_message'] = 'Erro ao criar usuário!';
                }

                sqlsrv_free_stmt($stmt);
            }
        }
    }

    // Redireciona para a página login.php após criar o usuário ou exibir mensagens de erro
    header('Location: login.php');
    exit;
}

sqlsrv_close($conexao);

include("conexao.php");
// Verifica se o formulário de login foi enviado
if (isset($_POST['entrar'])) {
    $senha = $_POST["senha"];
    $login = $_POST["login"];

    // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    if (empty($login) || empty($senha)) {
        $_SESSION['error_message'] = 'Login ou Senha não podem estar vazios!';
        header("Location: login.php");
        exit;
    }

    $sql = "SELECT codusuario, senha, codpermissao FROM usuario WHERE login = ?";
    $params = array($login);
    $stmt = sqlsrv_query($conexao, $sql, $params);

    if ($stmt === false) {
        $_SESSION['error_message'] = 'Erro ao executar a consulta!';
        header("Location: login.php");
        exit;
    }

    $rowCount = sqlsrv_has_rows($stmt);
    if ($rowCount === true) {
        $row = sqlsrv_fetch_array($stmt);
        $codusuario = $row['codusuario'];
        $senha_hash = $row['senha'];
        $codpermissao = $row['codpermissao'];

        // Verifica a senha
        if (!password_verify($senha, $senha_hash)) {
            $_SESSION['error_message'] = 'Senha incorreta!';
            header("Location: login.php");
            exit;
        }

        $_SESSION['autenticado'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['codpermissao'] = $codpermissao;
        $_SESSION['codusuario'] = $codusuario;

        header("Location: home.php");
        exit;
    } else {
        $_SESSION['error_message'] = 'Login ou Senha incorretos!';
        header("Location: login.php");
        exit;
    }

    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conexao);
?>