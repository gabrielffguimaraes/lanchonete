<?php
$json.='"/api/client/address": {
				"post": {
					"tags": [
						"Endereço"
					],
					"description": "Adiciona ingrediente.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "cep": {
                                            "type": "number",
                                            "description": "Cep",
                                            "example": "21832-006"
                                        },
                                        "address": {
                                            "type": "string",
                                            "description": "Endereço",
                                            "example": "Rua são francisco , 322 , Realengo"
                                        },
                                        "complement": {
                                            "type": "string",
                                            "description": "Complemento",
                                            "example": "Ao lado da praça"
                                        },
                                        "city": {
                                            "type": "string",
                                            "description": "Cidade",
                                            "example": "Rio de janeiro"
                                        },
                                        "uf": {
                                            "type": "string",
                                            "description": "Estado",
                                            "example": "RJ"
                                        },
                                        "country": {
                                            "type": "string",
                                            "description": "Pais",
                                            "example": "Brazil"
                                        },
                                        "client_id": {
                                            "type": "number",
                                            "description": "Cliente",
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
				},"get": {
					"tags": [
						"Endereço"
					],
					"description": "Retorna endereços",
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
