// Cria o container dos Toasts na página automaticamente
var toastContainer =
  document.querySelector(".toast-container") ?? document.createElement("div");
toastContainer.className = "toast-container";
document.body.appendChild(toastContainer);

// Função global para chamar um Toast de qualquer lugar do sistema
window.mostrarToast = function (mensagem, tipo = "success") {
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
