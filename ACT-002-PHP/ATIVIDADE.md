# *Introdução a Cookies e Sessions no PHP*  
  <br>
    
# Exercícios

## Exercício 1 - Pergunta Conceitual

Explique a diferença entre **cookies e sessions** no PHP.

Em sua resposta, considere:

- onde os dados são armazenados
- quais são mais seguros
- em quais situações cada um pode ser mais adequado.
<br>

## Resposta:
<!-- ESCREVER RESPOSTA AQUI



tambem apagar comentário por favor
-->
---

## Exercício 2 — Pergunta de aplicação

Imagine que você está desenvolvendo um sistema de **loja virtual**.

Explique como cookies e sessions poderiam ser utilizados para:

- manter o usuário logado
- armazenar itens temporários no carrinho
- registrar preferências do usuário.

Justifique suas escolhas.
<br>

## Resposta:

### ❌ Cookies
Seria possível manter o usuário logado apenas com cookies, por exemplo:

- Usando um cookie com o `user_id`;
- ou utilizando um **token** de autenticação.
<br>

### Problemas:

- Cookies podem ser facilmente manipulados (são de certa forma previsíveis);
- Permite a falsificação de identidade (spoofing);
- Não existe validação no servidor.
<br>
Conclusão: Não utilizar em hipótese alguma, muito vulnerável.
<br>
<br>

### ✔️ Session + Cookies (padrão comum)

- O servidor cria uma session:
  
$_SESSION['user_id'] = 123;

<br>

- O navegador recebe um cookie com o ID da sessão:
  
cookie: PHPSESSID=abc123

<br>

- O servidor usa esse ID para recuperar os dados da session.

<br>

### ⚠️ Importante

Usar session com certeza é mais seguro que usar apenas cookies, porém não é automaticamente seguro.

Se uma pessoa má intencionada conseguir roubar o cookie (ex: via XXS ou rede insegura), ele pode facilmente se passar pelo usuário (**session hijacking**).

### Ou seja:

- **O sistema não impede o uso indevido do cookie**
- Ele apenas dificulta a falsificação, pois o ID da sessão é "aleatório"
- A segurança depende de medidas adicionais:
  
  - HTTPS
  - HttpOnly
  - Expiração de sessão
  - Regeneração de ID

