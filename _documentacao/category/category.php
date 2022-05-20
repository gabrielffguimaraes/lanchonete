<?php
	$json.='"/api/category": {
				"get": {
					"tags": [
						"Categorias"
					],
					"description": "Retorna lista de categorias",
					"parameters": [],
					"responses": {},
					"security": [
						{
							"Authorization": []
						}
					]
				}
			},
	';

$json.='"/api/category/{id}": {
				"get": {
					"tags": [
						"Categorias"
					],
					"description": "Retorna categoria pelo id",
					"parameters": [
					    {
							"name": "id",
							"example": "1",
							"in": "path",
							"schema": {
								"properties": {
									"matricula": {
										"type": "string",
										"description": "id categoria.",
										"example": "1"
									}
								}
							},
							"required": true
						}
					],
					"responses": {},
					"security": [
						{
							"Authorization": []
						}
					]
				}
			},
	';