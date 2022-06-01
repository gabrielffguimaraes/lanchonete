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
                                        "number": {
                                            "type": "number",
                                            "description": "Endereço",
                                            "example": "15"
                                        },
                                        "street": {
                                            "type": "string",
                                            "description": "Rua",
                                            "example": "Rua são francisco"
                                        },
                                        "district": {
                                            "type": "string",
                                            "description": "Bairro",
                                            "example": "Bangu"
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
                                        "ref": {
                                            "type": "string",
                                            "description": "Ponto de referência",
                                            "example": "ao lado da padaria"
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
				}
			},
	';