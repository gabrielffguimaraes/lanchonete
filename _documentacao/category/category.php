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
				},
				"post": {
					"tags": [
						"Categorias"
					],
					"description": "Adiciona categoria.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "description": {
                                            "type": "string",
                                            "description": "Nome da categoria",
                                            "example": "Camisas"
                                        },	
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
				},
				"put": {
					"tags": [
						"Categorias"
					],
					"description": "Atualiza categoria",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "id": {
                                            "type": "integer",
                                            "description": "Id da categoria",
                                            "example": "1"
                                        },
                                        "description": {
                                            "type": "string",
                                            "description": "Nome da categoria",
                                            "example": "Camisa"
                                        }	
                                    },
                                    "required": [
                                        "id",
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
