
<?php

session_start();

require_once "config.php";

require_once "controllers/UsuarioController.php";
require_once "controllers/PublicacaoController.php";

require_once "routes/rotas.php";

executarRota($con);

