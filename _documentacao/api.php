<?php
$json='{
		"openapi": "3.0.1",
		"info": {
			"title": "Lanchonete",
			"description": "Documentação de homologação.",
			"termsOfService": "",
			"contact": {
				"email": "ramongarcia@assim.com.br"
			},
			"license": {
				"name": "Apache 2.0",
				"url": "http://www.apache.org/licenses/LICENSE-2.0.html"
			},
			"version": "1.0.0"
		},
		"servers": [
			{
				"url": "http://localhost/lanchonete/",
				"description": "Homologação"
			},
			{
				"url": "http://localhost/lanchonete/",
				"description": "Produção"
			}
		],
		"tags": [
			{
				"name": "Usuários",
				"description": "Endpoints Usuários"
			},
			{
				"name": "Categorias",
				"description": "Endpoints Categorias"
			},
			{
				"name": "Produtos",
				"description": "Endpoints produtos"
			},
			{
				"name": "Endereço",
				"description": "Endpoints endereços"
			}
		],
		"paths": {
    ';
  
	/*APIs de Exemplo*/
	include("./client/register.php");
    include("./client/address.php");
    include("./category/category.php");
    include("./ingredient/ingredient.php");
    include("./product/product.php");
	//include("./usuario/testeGet.php");

	
$json.='},
		"components": {
			"securitySchemes": {
				"Authorization": {
					"type": "http",
					"scheme": "basic",
					"description": "Token de autenticação."
				}
			}
		},
		"security": [
			{
				"Authorization":[]
			}
		]
	}';
echo $json;
