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
$json.='"/api/client/product/{id}": {
				"get": {
					"tags": [
						"Produtos"
					],
					"description": "Retorna produto pelo id",
					"parameters": [
					    {
							"name": "id",
							"example": "1",
							"in": "path",
							"schema": {
								"properties": {
									"id": {
										"type": "number",
										"description": "id produto.",
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
                                        "ingredient_id": {
                                            "type": "number",
                                            "description": "id do ingrediente",
                                            "example": "1"
                                        },
                                        "product_id": {
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
$json.='"/api/product": {
				"post": {
					"tags": [
						"Produtos"
					],
					"description": "Adiciona produto.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "category": {
                                            "type": "number",
                                            "description": "categoria do produto",
                                            "example": "1"
                                        },
                                        "description": {
                                            "type": "number",
                                            "description": "descrição do produto",
                                            "example": "Camiseta azul"
                                        },	
                                        "price": {
                                            "type": "number",
                                            "description": "preço do produto",
                                            "example": "20.00"
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