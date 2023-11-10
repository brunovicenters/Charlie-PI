let containerNum = 1;

function adicionarImagem() {
  const containerImagens = document.getElementById("containerImagens");
  const newImg = document.createElement("div");
  newImg.setAttribute("id", `newImg${containerNum}`);
  newImg.classList.add(
    "d-flex",
    "position-relative",
    "justify-content-between"
  );
  containerImagens.appendChild(newImg);
  const novoInput = document.createElement("input");
  novoInput.classList.add("form-control", "col-md-12", "mt-2", "mb-3", "pe-5");
  novoInput.type = "url";
  novoInput.name = "imagem[]";
  newImg.appendChild(novoInput);
  const novoBotao = document.createElement("button");
  novoBotao.setAttribute("type", "button");
  novoBotao.classList.add(
    "btn",
    "border-0",
    "position-absolute",
    "end-0",
    "mt-2"
  );
  novoBotao.setAttribute("onclick", `fecharCampo(newImg${containerNum})`);
  novoBotao.innerHTML = '<i class="bi bi-x-square"></i>';
  newImg.appendChild(novoBotao);
  containerNum++;
}

function fecharCampo(idCampo) {
  const campoDeletar = document.getElementById(idCampo.id);
  campoDeletar.remove();
}
