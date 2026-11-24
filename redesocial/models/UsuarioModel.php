
<?php

// CADASTRAR USUÁRIO
function cadastrarUsuario($con, $dados) {

    $sql = "INSERT INTO usuarios
            (nome, username, email, senha)
            VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($sql);

    $senhaHash = password_hash(
        $dados['senha'],
        PASSWORD_DEFAULT
    );

    return $stmt->execute([
        $dados['nome'],
        $dados['username'],
        $dados['email'],
        $senhaHash
    ]);
}

// BUSCAR USUÁRIO PELO EMAIL
function buscarUsuarioPorEmail($con, $email) {

    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([$email]);

    return $stmt->fetch();
}

// BUSCAR USUÁRIO PELO USERNAME
function buscarUsuarioPorUsername($con, $username) {

    $sql = "SELECT * FROM usuarios WHERE username = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([$username]);

    return $stmt->fetch();
}
