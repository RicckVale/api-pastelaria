<?php

namespace Tests\Feature\Api\V1;

use App\Models\Produtos;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutosControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * Test get produtos endpoint
     */
    public function testGetProdutosEndpoint(): void
    {
        $response = $this->get('/api/v1/produtos', ['accept' => 'application/json']);
        $response->assertStatus(200);
    }

    public function testGetProdutosEndpointWithCreationFactoryData()
    {
        Produtos::factory(5)->create();
        $response = $this->getJson('/api/v1/produtos');
        $response->assertStatus(200);
        $response->assertJsonCount(5, '0.data');
    }

    public function testGetProdutosEndpointPassingIdJsonFormat()
    {
        Produtos::factory(5)->create();

        $response = $this->getJson('/api/v1/produtos/1');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'nome',
            'imagem',
            '_links' => [
                '*' => [
                    'rel',
                    'type',
                    'href'
                ]
            ]
        ]);
    }

    /**
     * Test the API endpoint for retrieving paginated list of produtos.
     *
     * @return void
     */
    public function testGetProdutosEndpointJsonFormat()
    {
        $produtos = Produtos::factory(5)->create();
        $response = $this->getJson('/api/v1/produtos');
        $response->assertStatus(200);

        // Assert the structure of the response JSON
        $response->assertJsonStructure([
            'current_page',
            0 => [
                'data' => [
                    '*' => [
                        'id',
                        'nome',
                        'imagem',
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
