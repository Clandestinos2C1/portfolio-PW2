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

Cookies e Sessions são utilizados para armazenar dados entre requisições em aplicações web, porém funcionam de maneiras diferentes.


### Onde os dados são armazenados

### Cookies
- São armazenados **no navegador do usuário (cliente)**  
- Ficam salvos no dispositivo do usuário  

### Sessions
- São armazenadas **no servidor**  
- O navegador guarda apenas um identificador da sessão (geralmente um cookie chamado `PHPSESSID`)  


## 🔒 Segurança

### Cookies
- Menos seguros  
- Podem ser acessados e modificados pelo usuário  
- Estão mais vulneráveis a ataques como manipulação de dados  

### Sessions
- Mais seguras  
- Os dados ficam no servidor, sem acesso direto do usuário  
- Mesmo assim, dependem de boas práticas (ex: uso de HTTPS, proteção contra roubo de sessão)  



## ⚙️ Quando usar cada um

### Cookies
São mais adequados para:
- Armazenar preferências do usuário (tema, idioma)
- Dados não sensíveis  
- Informações que precisam persistir mesmo após fechar o navegador  

### Sessions
São mais adequadas para:
- Controle de login/autenticação  
- Dados sensíveis  
- Informações temporárias durante a navegação  



## ✅ Conclusão

A principal diferença está no local de armazenamento e na segurança.  

- **Cookies** → simples e persistentes, porém menos seguros  
- **Sessions** → mais seguras e controladas, ideais para dados importantes  

Na prática, aplicações modernas utilizam **sessions junto com cookies**, combinando praticidade e segurança.

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

