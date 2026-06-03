<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AngoLaw</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <?php

  # gerir paginas e rotas
  if (isset($_GET['pagina']) && $_GET['pagina'] == 'Auth') {
    include_once 'paginas/auth.php';
  } else if (isset($_GET['pagina']) && $_GET['pagina'] == 'Administrador') {
    include_once 'paginas/main.php';
  } else if (isset($_GET['pagina']) && $_GET['pagina'] == 'Advogado') {
    include_once 'paginas/main.php';
  } else if (isset($_GET['pagina']) && $_GET['pagina'] == 'Cliente') {
    include_once 'paginas/main.php';
  } else {
    include_once 'paginas/inicio.php';
  }

  ?>

</body>

</html>