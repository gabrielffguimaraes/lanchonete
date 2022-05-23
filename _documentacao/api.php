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
			}
		],
		"paths": {
    ';
  
	/*APIs de Exemplo*/
	include("./user/register.php");
    include("./category/category.php");
    include("./ingredient/ingredient.php");
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
