// model.js - Camada de Acesso a Dados (Data Layer)
const RockDataModel = {
    // Busca os cadastros salvos no localStorage
    obterUsuarios: function() {
        const dados = localStorage.getItem("rock_usuarios_cadastrados");
        return dados ? JSON.parse(dados) : [];
    },

    // Salva um novo cadastro
    salvarUsuario: function(usuario) {
        const usuarios = this.obterUsuarios();
        usuarios.push(usuario);
        localStorage.setItem("rock_usuarios_cadastrados", JSON.stringify(usuarios));
        return { sucesso: true };
    },

    // Busca mensagens do formulário de contato direto
    obterMensagensContato: function() {
        const dados = localStorage.getItem("rock_mensagens_contato");
        return dados ? JSON.parse(dados) : [];
    },

    // Salva uma mensagem de contato
    salvarMensagemContato: function(mensagem) {
        const mensagens = this.obterMensagensContato();
        mensagens.push(mensagem);
        localStorage.setItem("rock_mensagens_contato", JSON.stringify(mensagens));
        return { sucesso: true };
    }
};