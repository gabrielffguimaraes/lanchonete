<?php
$json.='"/api/ingredient": {
				"get": {
					"tags": [
						"Ingredientes"
					],
					"description": "Retorna lista de ingredientes",
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
						"Ingredientes"
					],
					"description": "Adiciona ingrediente.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "description": {
                                            "type": "string",
                                            "description": "Nome da ingrediente",
                                            "example": "Salmão"
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
						"Ingredientes"
					],
					"description": "Atualiza ingrediente",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "id": {
                                            "type": "integer",
                                            "description": "Id da ingrediente",
                                            "example": "1"
                                        },
                                        "description": {
                                            "type": "string",
                                            "description": "Nome da ingrediente",
                                            "example": "Salmão"
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

$json.='"/api/ingredient/{id}": {
				"get": {
					"tags": [
						"Ingredientes"
					],
					"description": "Retorna ingrediente pelo id",
					"parameters": [
					    {
							"name": "id",
							"example": "1",
							"in": "path",
							"schema": {
								"properties": {
									"matricula": {
										"type": "string",
										"description": "id ingrediente.",
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
