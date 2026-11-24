
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "../config.php";
require_once "../models/PublicacaoModel.php";
require_once "../models/CurtidaModel.php";

$publicacoes = listarPublicacoes($con);
$usuario_id = $_SESSION["usuario_id"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>RedeSocial</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f3f5f9;
    color: #263247;
}

/* CABEÇALHO */

header {
    height: 75px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 6%;
    box-shadow: 0 2px 10px #0000000d;
}

.logo {
    font-size: 27px;
    font-weight: bold;
    color: #2874d0;
}

header a {
    background: #2874d0;
    color: white;
    padding: 11px 20px;
    border-radius: 8px;
    text-decoration: none;
}

/* ESTRUTURA */

.container {
    max-width: 1250px;
    margin: 35px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 220px minmax(0, 650px) 240px;
    gap: 25px;
    align-items: start;
}

/* MENU */

.menu, .informacoes {
    background: white;
    padding: 22px;
    border-radius: 13px;
}

.menu h3, .informacoes h3 {
    margin-bottom: 18px;
}

.menu a {
    display: block;
    padding: 13px;
    color: #596579;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 5px;
}

.menu a:hover {
    background: #eaf2ff;
    color: #2874d0;
}

/* BOAS-VINDAS */

.boas-vindas {
    margin-bottom: 25px;
}

.boas-vindas h2 {
    font-size: 25px;
    margin-bottom: 8px;
}

.boas-vindas p, .informacoes p {
    color: #8490a3;
    font-size: 14px;
    line-height: 1.6;
}

/* CARTÕES */

.card {
    background: white;
    border-radius: 13px;
    padding: 23px;
    margin-bottom: 20px;
    box-shadow: 0 3px 12px #00000008;
}

.card h3 {
    margin-bottom: 17px;
}

/* PUBLICAÇÃO */

textarea {
    width: 100%;
    height: 110px;
    border: 1px solid #e1e5eb;
    border-radius: 9px;
    padding: 15px;
    resize: vertical;
    font-family: Arial;
    font-size: 15px;
    outline: none;
}

textarea:focus {
    border-color: #2874d0;
}

.rodape-formulario {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}

.contador {
    font-size: 12px;
    color: #8490a3;
}

.botao {
    background: #2874d0;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 22px;
    font-weight: bold;
    cursor: pointer;
}

.botao:hover {
    background: #1756a5;
}

/* POST */

.post-topo {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 45px;
    height: 45px;
    background: #e4efff;
    color: #2874d0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-weight: bold;
    font-size: 19px;
}

.nome {
    font-weight: bold;
    font-size: 15px;
}

.username {
    color: #8490a3;
    font-size: 12px;
    margin-top: 5px;
}

.data {
    margin-left: auto;
    color: #8490a3;
    font-size: 11px;
}

.conteudo {
    margin: 22px 0;
    line-height: 1.7;
    overflow-wrap: anywhere;
}

.post-rodape {
    border-top: 1px solid #edf0f4;
    padding-top: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.curtir {
    background: #edf4ff;
    color: #2874d0;
    border: none;
    padding: 10px 17px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

.curtir:hover {
    background: #dceaff;
}

.vazio {
    text-align: center;
    color: #8490a3;
}

/* RESPONSIVIDADE */

@media(max-width: 950px) {
    .container {
        grid-template-columns: 190px minmax(0, 1fr);
    }

    .informacoes {
        display: none;
    }
}

@media(max-width: 650px) {
    .container {
        display: block;
        margin-top: 20px;
        padding: 0 12px;
    }

    .menu {
        display: none;
    }

    header {
        padding: 0 18px;
    }

    .data {
        display: none;
    }
}
</style>

</head>

<body>

<header>
    <div class="logo">RedeSocial.</div>

    <a href="../api.php?rota=sair" id="sair">Sair</a>
</header>

<div class="container">

    <aside class="menu">
        <h3>Menu principal</h3>

        <a href="feed.php">🏠 Início</a>
        <a href="feed.php">👤 Meu perfil</a>
        <a href="#publicacoes">📰 Publicações</a>
    </aside>

    <main>

        <section class="boas-vindas">
            <h2>
                Olá,
                <?php echo htmlspecialchars($_SESSION["usuario_nome"]); ?>!
            </h2>

            <p>Compartilhe ideias e interaja com a comunidade.</p>
        </section>

        <section class="card">

            <h3>Criar publicação</h3>

            <form action="../api.php?rota=publicar" method="POST">

                <textarea
                    id="conteudo"
                    name="conteudo"
                    maxlength="2000"
                    placeholder="O que você está pensando?"
                    required
                ></textarea>

                <div class="rodape-formulario">

                    <span class="contador" id="contador">0/2000</span>

                    <button class="botao" type="submit">
                        Publicar
                    </button>

                </div>

            </form>

        </section>

        <h3 id="publicacoes" style="margin-bottom:18px;">
            Feed de publicações
        </h3>

        <?php if (count($publicacoes) > 0): ?>

            <?php foreach ($publicacoes as $publicacao): ?>

                <?php
                $totalCurtidas = contarCurtidas($con, $publicacao["id"]);

                $jaCurtiu = verificarCurtida(
                    $con,
                    $usuario_id,
                    $publicacao["id"]
                );
                ?>

                <article class="card">

                    <div class="post-topo">

                        <div class="avatar">
                            <?php
                            echo strtoupper(substr($publicacao["nome"], 0, 1));
                            ?>
                        </div>

                        <div>
                            <div class="nome">
                                <?php echo htmlspecialchars($publicacao["nome"]); ?>
                            </div>

                            <div class="username">
                                @<?php echo htmlspecialchars($publicacao["username"]); ?>
                            </div>
                        </div>

                        <span class="data">
                            <?php echo htmlspecialchars($publicacao["data_publicacao"]); ?>
                        </span>

                    </div>

                    <p class="conteudo">
                        <?php echo nl2br(htmlspecialchars($publicacao["conteudo"])); ?>
                    </p>

                    <div class="post-rodape">

                        <span>
                            ❤️ <?php echo $totalCurtidas; ?> curtidas
                        </span>

                        <form action="../api.php?rota=curtir" method="POST">

                            <input
                                type="hidden"
                                name="publicacao_id"
                                value="<?php echo (int)$publicacao["id"]; ?>"
                            >

                            <button type="submit" class="curtir">
                                <?php echo $jaCurtiu ? "❤️ Curtido" : "♡ Curtir"; ?>
                            </button>

                        </form>

                    </div>

                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="card vazio">
                <h3>Nenhuma publicação encontrada.</h3>
                <p>Seja o primeiro a compartilhar!</p>
            </div>

        <?php endif; ?>

    </main>

    <aside class="informacoes">

        <h3>Sobre a RedeSocial</h3>

        <p>
            Um espaço para compartilhar ideias,
            conhecer pessoas e interagir com a comunidade.
        </p>

        <br>

        <h3>Minha conta</h3>

        <p>
            @<?php echo htmlspecialchars($_SESSION["usuario_username"]); ?>
        </p>

    </aside>

</div>

<script>

// CONTADOR DE CARACTERES

const campo = document.getElementById("conteudo");
const contador = document.getElementById("contador");

campo.addEventListener("input", function() {
    contador.textContent = campo.value.length + "/2000";
});

// CONFIRMAR SAÍDA

document.getElementById("sair").addEventListener("click", function(event) {
    if (!confirm("Deseja realmente sair da sua conta?")) {
        event.preventDefault();
    }
});

</script>

</body>
</html>
