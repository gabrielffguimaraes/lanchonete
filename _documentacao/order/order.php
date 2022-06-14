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

$json.='"/api/order/{order_id}/status/{status}": {
				"post": {
					"tags": [
						"Pedidos"
					],
					"description": "Muda o status do pedido",
					"parameters": [
					    {
							"name": "order_id",
							"in": "path",
							"type": "number",
							"required": true
						},
						{
							"name": "status",
							"in": "path",
							"type": "number",
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
$json.='"/api/order/frete/{cep}": {
				"get": {
					"tags": [
						"Pedidos"
					],
					"description": "Calcula preço do frete",
					"parameters": [
					    {
							"name": "cep",
							"in": "path",
							"type": "string",
							"required": true,
							"example": "77024772"
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

