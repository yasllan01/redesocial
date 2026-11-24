
<?php

// CRIAR PUBLICAÇÃO
function criarPublicacao($con, $usuario_id, $conteudo) {

    $sql = "INSERT INTO publicacoes
            (usuario_id, conteudo)
            VALUES (?, ?)";

    $stmt = $con->prepare($sql);

    return $stmt->execute([
        $usuario_id,
        $conteudo
    ]);
}


// LISTAR PUBLICAÇÕES
function listarPublicacoes($con) {

    $sql = "SELECT
                publicacoes.id,
                publicacoes.conteudo,
                publicacoes.data_publicacao,
                usuarios.nome,
                usuarios.username
            FROM publicacoes
            INNER JOIN usuarios
            ON publicacoes.usuario_id = usuarios.id
            ORDER BY publicacoes.data_publicacao DESC";

    $stmt = $con->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
