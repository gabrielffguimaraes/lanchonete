<?php
$json.='"/api/client/product": {
				"get": {
					"tags": [
						"Produtos"
					],
					"description": "Retorna lista de produtos",
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

$json.='"/api/product/ingredient": {
				"post": {
					"tags": [
						"Produtos"
					],
					"description": "Adiciona ingrediente ao produto.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "ingredientId": {
                                            "type": "number",
                                            "description": "id do ingrediente",
                                            "example": "1"
                                        },
                                        "productId": {
                                            "type": "number",
                                            "description": "id do produto",
                                            "example": "1"
                                        }	
                                    },
                                    "required": [
                                        "description"
                                    ]
                                }
                            }
                        },
                        "required": true
                    },
					"responses": {},
					"security": [
						{
							"Authorization": []
						}
					]
				}
			},
	';
