function adicionarImagem() {
  const containerImagens = document.getElementById("containerImagens");
  const novoInput = document.createElement("input");
  novoInput.classList.add("form-control", "col-md-12", "mt-2", "mb-3");
  novoInput.type = "url";
  novoInput.name = "imagem[]";
  containerImagens.appendChild(novoInput);
}
