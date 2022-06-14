<?php
$json.='"/api/client/address": {
				"post": {
					"tags": [
						"Endereço"
					],
					"description": "Adiciona endereço.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "name": {
                                            "type": "string",
                                            "description": "Nome",
                                            "example": "Minha casa"
                                        },
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
$json.='"/api/client/address/{id}": {   
				"get": {
					"tags": [
						"Endereço"
					],
					"description": "Retorna endereço pelo id",
					"parameters": [
					    {
							"name": "id",
							"example": "1",
							"in": "path",
							"schema": {
								"properties": {
									"matricula": {
										"type": "string",
										"description": "id do endereço.",
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
				},
				"put": {
					"tags": [
						"Endereço"
					],
					"description": "Atualiza endereço.",
					"parameters": [
					    {
							"name": "id",
							"example": "1",
							"in": "path",
							"schema": {
								"properties": {
									"matricula": {
										"type": "string",
										"description": "id do endereço.",
										"example": "1"
									}
								}
							},
							"required": true
						}
					],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "name": {
                                            "type": "string",
                                            "description": "Nome",
                                            "example": "Minha casa"
                                        },
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
				},
				"delete": {
					"tags": [
						"Endereço"
					],
					"description": "Exclui endereço.",
					"parameters": [
					    {
							"name": "id",
							"example": "1",
							"in": "path",
							"schema": {
								"properties": {
									"matricula": {
										"type": "string",
										"description": "id do endereço.",
										"example": "1"
									}
								}
							},
							"required": true
						}
					],
					"requestBody": {},
					"responses": {},
					"security": [
						{
							"Authorization": []
						}
					]
				}
			},
	';