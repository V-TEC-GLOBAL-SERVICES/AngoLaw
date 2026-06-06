<?php
# controle de sessao e cache
session_cache_limiter(100);
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AngoLaw</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="estilos/all.min.css" />
  <link rel="stylesheet" href="estilos/toast.css" />
  <!-- <script src="scripts/toast.js"></script> -->
  <link rel="shortcut icon" href="Imagens/IMG_4735.PNG" type="image/x-icon">
</head>

<body>

  <script>
    // Cria o container dos Toasts na página automaticamente
    var toastContainer = document.querySelector(".toast-container") ?? document.createElement("div");
    toastContainer.className = "toast-container";
    document.body.appendChild(toastContainer);

    // Função global para chamar um Toast de qualquer lugar do sistema
    window.mostrarToast = function(mensagem, tipo = "success") {
      var toast = document.createElement("div");
      toast.className = `toast ${tipo}`;

      // Ícone simples baseado no tipo
      var icone = tipo === "success" ? "✅" : "⚠️";
      toast.innerHTML = `<span>${icone}</span> <div>${mensagem}</div>`;

      toastContainer.appendChild(toast);

      // Anima a entrada (precisa de um pequeno delay para o CSS aplicar a transição)
      requestAnimationFrame(() => {
        toast.classList.add("show");
      });

      // Remove o toast após 3.5 segundos
      setTimeout(() => {
        toast.classList.remove("show");
        // Remove o elemento do HTML depois que a animação termina
        setTimeout(() => toast.remove(), 400);
      }, 3500);
    };
  </script>

  <?php
  # incluir funcoes
  include_once 'api/connect.php';
  include_once 'api/sql.php';

  # verificar a conexao
  empty($connect) ? header("location: index.php") : '';

  # pegar os dados da sessao
  $sessao = session_id() ?? null;

  # gerir paginas e rotas
  if (isset($_GET['pagina']) && $_GET['pagina'] == 'Auth') {
    include_once 'api/query.php';
    include_once 'paginas/auth.php';
  } else if (isset($_GET['pagina'], $_SESSION[$sessao]) && $_GET['pagina'] == $_SESSION[$sessao]['acesso']) {
    include_once 'api/query.php';
    include_once 'paginas/main.php';
  } else {
    include_once 'paginas/inicio.php';
  }

  ?>

</body>

</html>