# Documentação da API - DrumHero

O sistema utiliza um _Front Controller_ (`index.php`) para gerir as rotas. Abaixo estão os principais _endpoints_ lógicos da aplicação.

---

## 1. Autenticação (Login)

- **Método HTTP:** `POST`
- **URL:** `/index.php?rota=processar_login`
- **Descrição:** Autentica um utilizador administrador e cria a sessão segura.
- **Parâmetros (Body):**
  - `email` (string, required): E-mail do utilizador.
  - `senha` (string, required): Palavra-passe em texto limpo.
  - `csrf_token` (string, required): Token de segurança anti-CSRF.
- **Respostas:**
  - `302 Found`: Redireciona para `/index.php?rota=home` em caso de sucesso.
  - `302 Found`: Redireciona para o login com mensagem de erro na sessão caso falhe.

## 2. Terminar Sessão (Logout)

- **Método HTTP:** `GET`
- **URL:** `/index.php?rota=logout`
- **Descrição:** Destrói a sessão atual e remove o acesso administrativo.
- **Respostas:**
  - `302 Found`: Redireciona para a página inicial pública.

---

## 3. Listar Lendas (Read)

- **Método HTTP:** `GET`
- **URL:** `/index.php?rota=home`
- **Descrição:** Retorna a página inicial com a grelha de bateristas carregada a partir da base de dados.
- **Respostas:**
  - `200 OK`: HTML renderizado com os dados.

## 4. Adicionar Nova Lenda (Create)

- **Método HTTP:** `POST`
- **URL:** `/index.php?rota=processar_cadastro`
- **Descrição:** Insere um novo baterista na base de dados. (Requer Autenticação).
- **Parâmetros (Body):**
  - `nome` (string, required): Nome do baterista.
  - `banda` (string, required): Banda principal.
  - `equipamento` (string, required): Equipamento de destaque.
  - `descricao` (string, required): História do baterista.
- **Respostas:**
  - `302 Found`: Redireciona para a home em caso de sucesso.
  - `401/403`: Redireciona para o login se o utilizador não estiver autenticado.

## 5. Atualizar Lenda (Update)

- **Método HTTP:** `POST`
- **URL:** `/index.php?rota=processar_edicao`
- **Descrição:** Atualiza os dados de um baterista existente. (Requer Autenticação).
- **Parâmetros (Body):**
  - `id` (int, required): ID único do baterista.
  - `nome`, `banda`, `equipamento`, `descricao` (strings, required).
- **Respostas:**
  - `302 Found`: Redireciona para a home após a atualização.

## 6. Apagar Lenda (Delete)

- **Método HTTP:** `GET`
- **URL:** `/index.php?rota=deletar_baterista&id={id}`
- **Descrição:** Remove um baterista do acervo através do seu ID. (Requer Autenticação).
- **Parâmetros (URL / Query String):**
  - `id` (int, required): ID do baterista a apagar.
- **Respostas:**
  - `302 Found`: Redireciona para a home após exclusão.
