// controller.js - Camada de Regras e Lógica da Aplicação
const RockController = {
    // Processa a tentativa de cadastro vinda da modal
    processarCadastro: function(dadosFormulario) {
        // Validação 1: Verificação de preenchimento da Idade
        if (isNaN(dadosFormulario.idade) || dadosFormulario.idade === null) {
            return { erro: "Por favor, informe a sua idade." };
        }

        // Validação 2: Idade mínima de 13 anos
        if (dadosFormulario.idade < 13) {
            return { erro: "É necessário ter pelo menos 13 anos para integrar o Universo do Rock." };
        }

        // Validação 3: Formato de E-mail via RegEx
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(dadosFormulario.email)) {
            return { erro: "Por favor, insira um e-mail válido (ex: nome@dominio.com)." };
        }

        // Validação 4: Formato de URL do Instagram (se preenchido)
        if (dadosFormulario.instagram && !/^https?:\/\/.+/.test(dadosFormulario.instagram)) {
            return { erro: "A URL do Instagram deve iniciar com http:// ou https://" };
        }

        // Validação 5: Verificar se aceitou os termos
        if (!dadosFormulario.termosAceitos) {
            return { erro: "Você deve aceitar os termos de uso antes de continuar." };
        }

        // Envia para persistência na camada Model
        RockDataModel.salvarUsuario(dadosFormulario);

        return { sucesso: "Cadastro realizado com sucesso! Bem-vindo ao Universo do Rock." };
    },

    // Processa o formulário de contato simples na página
    processarContato: function(dadosContato) {
        if (!dadosContato.nome || !dadosContato.mensagem) {
            return { erro: "Por favor, preencha todos os campos obrigatórios." };
        }

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(dadosContato.email)) {
            return { erro: "Por favor, informe um e-mail válido para contato." };
        }

        RockDataModel.salvarMensagemContato(dadosContato);
        return { sucesso: "Sua mensagem foi enviada aos administradores do Rock!" };
    }
};