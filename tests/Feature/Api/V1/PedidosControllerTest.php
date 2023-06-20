<?php

namespace Tests\Feature\Api\V1;

use App\Models\Clientes;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidosControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPedidosV1Endpoint(): void
    {
        $response = $this->get('/api/v1/pedidos');
        $response->assertStatus(200);
    }

    public function testGetPedidosV1EndpointJson(): void
    {
        $response = $this->getJson('/api/v1/pedidos');
        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson([]);
    }

    public function testGetPedidosEndpointPaginatedWithFiveItens()
    {
        $clientes = Clientes::factory(5)->create();
        $produtos = Produtos::factory(5)->create();
        $pedidos = Pedidos::factory(5)->create();

        $response = $this->getJson('/api/v1/pedidos');
        $response->assertStatus(200);
        $response->assertJsonCount(5, '0.data');
    }

    public function testGetPedidosEndpointWithIdReturnOne()
    {
        $clientes = Clientes::factory(5)->create();
        $produtos = Produtos::factory(5)->create();
        $pedidos = Pedidos::factory(5)->create();

        $response = $this->getJson('/api/v1/pedidos/1');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'codigo_do_cliente',
            'codigo_do_produto',
            "produto" => [
                "id",
                "nome",
                "preco",
                "imagem",
                "deleted_at",
                "created_at",
                "updated_at",
            ],
            "cliente" => [
                "id",
                "nome",
                "email",
                "telefone",
                "nascimento",
                "rua",
                "numero",
                "complemento",
                "bairro",
                "cep",
                "deleted_at",
                "created_at",
                "updated_at"
            ],
            '_links' => [
                '*' => [
                    'rel',
                    'type',
                    'href'
                ]
            ]
        ]);
    }

    function testGetPedidosEndpointJsonFormat()
    {
        $clientes = Clientes::factory(5)->create();
        $produtos = Produtos::factory(5)->create();
        $pedidos = Pedidos::factory(5)->create();

        $response = $this->getJson('/api/v1/pedidos');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'current_page',
            0 => [
                'data' => [
                    '*' => [
                        'id',
                        'codigo_do_cliente',
                        'codigo_do_produto',
                        '_links' => [
                            '*' => [
                                'rel',
                                'type',
                                'href'
                            ]
                        ]
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active'
                    ]
                ],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ],
        ]);
    }

}
