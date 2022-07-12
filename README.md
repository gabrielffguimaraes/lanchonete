# Lanchonete
Projeto de e-commmerce com tema de lanchonete , feita com PHP , utilizando micro framework slim , middlewares e orientação a objetos.

# Objetivo

* implementar uma solução e-commerce utilizando PHP e orientação a objeto
* trabalhar com rotas e authenticação (Basic auth) 
* modelar as entidades e praticar os conceitos de código limpo como por exemplo reuso de códigos .
* nivelar acesso com roles de acesso nivel admin , client  e publico para as rotas.

# Link

<a href="https://aplicativotech.com.br/arquivos/lanchonete/">Preview do projeto </a> 

# Install
para instalar o projeto localmente é necessário : 

* rodar o arquivo db.txt no console (MySQL)
* colocar o projeto no localhost
* caso altere o nome da pasta ou queira mudar o pathEnviroment siga a configuração abaixo :

em :
lanchonete/app/enviroments.php

```
$enviroments =  [
    "url" => "http://localhost/lanchonete/",
    "baseUrl" => "/lanchonete/",
    "baseHttp" => "http://localhost/lanchonete/api/",
    "authorization" => Auth::credentials(),
    "name" => $_SESSION["name"] ?? ""
];
```

# Rotas

para acessar como administrador vá até a rota `localhost/lanchonete/management/login`
por padrao como administrador está configurado login: admin e senha : admin


