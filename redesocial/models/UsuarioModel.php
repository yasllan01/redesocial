<?php
//CREATE
function inserirUsuario($con, $dados) {
    $stmt = $con->prepare(
        "INSERT INTO Usuarios (nome, username, email, senha)
         VALUES (?, ?, ?, ?))");
    $stmt -> execute([      
        $dados['nome'],
        $dados['username'],
        $dados['email'],
        $dados['senha']]);
    return $con->lastInsertId();
}
//READ
function listarUsuarios($con) {
    $stmt = $con->query("SELECT * FROM Usuarios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//UPDATE
function atualizarUsuario($con, $id, $dados) {
    $stmt = $con->prepare(
        "UPDATE Usuarios SET senha = ? WHERE id_usuario = ?");
    $stmt->execute([$dados["senha"],
                  $id]);
}
//DELETE
function removerUsuario($con, $id) {
    $stmt = $con->prepare("DELETE FROM Usuarios WHERE id_usuario = ?");
    $stmt->execute([$id]);
}
