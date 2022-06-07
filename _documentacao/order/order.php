<?php
$json.='"/api/order": {
				"post": {
					"tags": [
						"Pedidos"
					],
					"description": "Cria ordem do pedido.",
					"parameters": [],
					"requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "address_id": {
                                            "type": "number",
                                            "description": "id endereço",
                                            "example": "1"
                                        },
                                        "cart": {
                                            "type": "array",
                                            "description": "Produtos",
                                            "example": [
                                                {
                                                    "id": 1,
                                                    "quantity": 2,
                                                    "price": "20.00",
                                                    "ingredient" : [ 1 , 2 , 3]
                                                }
                                            ]
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
				"get": {
					"tags": [
						"Pedidos"
					],
					"description": "Lista ordem de pedidos",
					"parameters": [],
					"responses": {},
					"security": [
						{
							"Authorization": []
						}
					]
				},
			},
	';
