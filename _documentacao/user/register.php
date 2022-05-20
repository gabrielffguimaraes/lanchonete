<?php
	$json.='
			"/api/user/register": {
						"post": {
							"tags": [
								"Usuários"
							],
							"description": "Cadastro de novos usuários",
							"requestBody": {
								"content": {
									"application/json": {
										"schema": {
											"properties": {
												"username": {
													"type": "string",
													"description": "Nome de usuário",
													"example": "carlos"
												},
												"password": {
													"type": "string",
													"description": "Senha de usuário",
													"example": "##########"
												},
												"email": {
													"type": "string",
													"description": "Endereço de email do usuário",
													"example": example@gmail.com
												},	
											},
											"required": [
												"username",
												"password",
												"email"
											]
										}
									}
								},
								"required": true
							},
							"responses": {
								
							},
							"security": [
								{
									"Authorization": []
								}
							]
						}
					},';