
<?php

function curtirPublicacao($con, $usuario_id, $publicacao_id) {

    $sql = "INSERT INTO curtidas (usuario_id, publicacao_id)
            VALUES (?, ?)";

    $stmt = $con->prepare($sql);

    return $stmt->execute([
        $usuario_id,
        $publicacao_id
    ]);
}

function verificarCurtida($con, $usuario_id, $publicacao_id) {

    $sql = "SELECT id FROM curtidas
            WHERE usuario_id = ? AND publicacao_id = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([$usuario_id, $publicacao_id]);

    return $stmt->fetch() !== false;
}

function contarCurtidas($con, $publicacao_id) {

    $sql = "SELECT COUNT(*) AS total
            FROM curtidas
            WHERE publicacao_id = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([$publicacao_id]);

    return $stmt->fetch()["total"];
}

function descurtirPublicacao($con, $usuario_id, $publicacao_id) {

    $sql = "DELETE FROM curtidas
            WHERE usuario_id = ? AND publicacao_id = ?";

    $stmt = $con->prepare($sql);

    return $stmt->execute([
        $usuario_id,
        $publicacao_id
    ]);
}
