
<?php

require_once __DIR__ . "/../models/UsuarioModel.php";

// CADASTRAR USUÁRIO
function cadastrar($con) {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    $nome = trim($_POST["nome"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if (
        $nome === "" ||
        $username === "" ||
        $email === "" ||
        $senha === ""
    ) {
        return "Preencha todos os campos.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "E-mail inválido.";
    }

    if (buscarUsuarioPorEmail($con, $email)) {
        return "Este e-mail já está cadastrado.";
    }

    if (buscarUsuarioPorUsername($con, $username)) {
        return "Este nome de usuário já está em uso.";
    }

    $dados = [
        "nome" => $nome,
        "username" => $username,
        "email" => $email,
        "senha" => $senha
    ];

    cadastrarUsuario($con, $dados);

    return true;
}

// REALIZAR LOGIN
function login($con) {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    $usuario = buscarUsuarioPorEmail($con, $email);

    if (
        !$usuario ||
        !password_verify($senha, $usuario["senha"])
    ) {
        return "E-mail ou senha incorretos.";
    }

    

    session_regenerate_id(true);

   $_SESSION["usuario_id"] = $usuario["id"];
   $_SESSION["usuario_nome"] = $usuario["nome"];
   $_SESSION["usuario_username"] = $usuario["username"];

    return true;
}
