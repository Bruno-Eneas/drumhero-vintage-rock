// js/view.js - Camada de Apresentação e Manipulação do DOM
document.addEventListener("DOMContentLoaded", function () {
    
    // ==========================================================================
    // 1. REFERÊNCIAS DOS ELEMENTOS DA INTERFACE
    // ==========================================================================
    const modal = document.getElementById("modalCadastro");
    const btnAbrir = document.getElementById("btnAbrirModal");
    const btnFechar = document.querySelector(".btn-fechar");
    const formModal = document.getElementById("meuFormulario");
    const formContato = document.getElementById("formContatoDireto");

    const inputNome = document.getElementById("modal-nome");
    const inputSenha = document.getElementById("modal-senha");
    const btnToggleSenha = document.getElementById("btnToggleSenha");
    const barForcaSenha = document.getElementById("barForcaSenha");
    const textoForcaSenha = document.getElementById("textoForcaSenha");

    // ==========================================================================
    // 2. GERENCIAMENTO DE ABERTURA E FECHAMENTO DA MODAL
    // ==========================================================================
    if (btnAbrir) {
        btnAbrir.onclick = function () {
            modal.style.display = "block";
        };
    }

    if (btnFechar) {
        btnFechar.onclick = function () {
            modal.style.display = "none";
        };
    }

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    // ==========================================================================
    // 3. VALIDAÇÕES E COMPORTAMENTOS DOS CAMPOS DA MODAL
    // ==========================================================================

    // Restrição no Campo Nome: Bloqueia números e caracteres especiais em tempo real
    if (inputNome) {
        inputNome.addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-Zà-úÀ-Ú\s]/g, "");
        });
    }

    // Alternar Visibilidade da Senha (Botão de Olhinho)
    if (btnToggleSenha && inputSenha) {
        btnToggleSenha.addEventListener("click", function () {
            const tipoAtual = inputSenha.getAttribute("type");
            if (tipoAtual === "password") {
                inputSenha.setAttribute("type", "text");
                btnToggleSenha.textContent = "🙈";
            } else {
                inputSenha.setAttribute("type", "password");
                btnToggleSenha.textContent = "👁️";
            }
        });

        // Feedback Visual da Força da Senha
        inputSenha.addEventListener("input", function () {
            const senha = this.value;

            const temTamanho = senha.length >= 8;
            const temMaiuscula = /[A-Z]/.test(senha);
            const temNumero = /[0-9]/.test(senha);

            if (senha.length === 0) {
                barForcaSenha.style.width = "0%";
                textoForcaSenha.textContent = "Insira uma senha forte.";
                textoForcaSenha.style.color = "var(--cor-texto-secundario)";
            } else if (temTamanho && temMaiuscula && temNumero) {
                barForcaSenha.style.width = "100%";
                barForcaSenha.style.backgroundColor = "#2e7d32";
                textoForcaSenha.textContent = "Senha Forte!";
                textoForcaSenha.style.color = "#2e7d32";
            } else {
                barForcaSenha.style.width = "50%";
                barForcaSenha.style.backgroundColor = "#ff9800";
                textoForcaSenha.textContent = "Senha fraca (Exige: 8+ letras, 1 maiúscula e 1 número).";
                textoForcaSenha.style.color = "#ff9800";
            }
        });
    }

    // ==========================================================================
    // 4. SUBMISSÃO DE FORMULÁRIOS (INTEGRAÇÃO COM O CONTROLLER)
    // ==========================================================================

    // Submissão do Formulário de Cadastro (Modal)
    if (formModal) {
        formModal.addEventListener("submit", function (e) {
            e.preventDefault();

            const campoIdade = document.getElementById("modal-idade").value;

            // Coleta os dados digitados na interface
            const dadosFormulario = {
                nome: inputNome ? inputNome.value : "",
                senha: inputSenha ? inputSenha.value : "",
                idade: campoIdade !== "" ? parseInt(campoIdade) : null,
                email: document.getElementById("modal-email").value,
                instagram: document.getElementById("modal-instagram").value,
                sobre: document.getElementById("modal-sobre").value,
                termosAceitos: document.getElementById("modal-termos").checked,
                genero: document.querySelector('input[name="genero"]:checked')?.value || 'Não informado',
                pais: document.getElementById("modal-pais").value,
                nascimento: document.getElementById("modal-nascimento").value,
                cor: document.getElementById("modal-cor").value,
                dataCadastro: new Date().toISOString()
            };

            // Envia para o Controller tratar a regra de negócio
            const resultado = RockController.processarCadastro(dadosFormulario);

            if (resultado.erro) {
                alert(resultado.erro);
            } else {
                alert(resultado.sucesso);
                formModal.reset();
                if (barForcaSenha) barForcaSenha.style.width = "0%";
                if (textoForcaSenha) {
                    textoForcaSenha.textContent = "Insira uma senha forte.";
                    textoForcaSenha.style.color = "var(--cor-texto-secundario)";
                }
                modal.style.display = "none";
            }
        });
    }

    // Submissão do Formulário Direto de Contato
    if (formContato) {
        formContato.addEventListener("submit", function (e) {
            e.preventDefault();

            const dadosContato = {
                nome: document.getElementById("contato-nome").value,
                email: document.getElementById("contato-email").value,
                subgenero: document.getElementById("subgenero-favorito").value,
                mensagem: document.getElementById("mensagem").value
            };

            const resultado = RockController.processarContato(dadosContato);

            if (resultado.erro) {
                alert(resultado.erro);
            } else {
                alert(resultado.sucesso);
                formContato.reset();
            }
        });
    }
});