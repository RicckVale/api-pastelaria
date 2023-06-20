<?php

namespace Api\V1;

use App\Models\Produtos;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use NumberFormatter;
use Tests\TestCase;

class ProdutosModelTest extends TestCase
{

    use RefreshDatabase;

    public function testProdutoCreateAndValidateInsertedData()
    {
        $data = [
            'nome' => 'Pastel X',
            'preco' => 1.01,
            'imagem' => 'xpto.png'
        ];

        $produto = new Produtos();

        $produto = $produto->create($data);

        $this->assertInstanceOf(Produtos::class, $produto);

        $this->assertEquals($data['nome'], $produto->nome);

        $fmt = numfmt_create('pt_BR', NumberFormatter::CURRENCY);
        $this->assertEquals(numfmt_format_currency($fmt, $data['preco'], "BRL"), $produto->preco);

        $this->assertEquals($data['imagem'], $produto->imagem);
    }

    public function testProdutoCriateWithFactory()
    {
        $produto = Produtos::factory(1)->createOne();

        $this->assertInstanceOf(Produtos::class, $produto);
    }

    public function testProdutoCriate()
    {
        $data = [
            'nome' => 'Pastel X',
            'preco' => 1.01,
            'imagem' => 'xpto.png'
        ];

        $produto = Produtos::create($data);

        $this->assertInstanceOf(Produtos::class, $produto);
        $this->assertDatabaseHas('produtos', $data);
    }

    public function testProdutoSoftDelete()
    {
        $produto = Produtos::factory()->create();

        $produto->delete();

        $this->assertSoftDeleted('produtos', ['id' => $produto->id]);
    }

    public function testProdutoSearchById()
    {
        $produto = Produtos::factory()->create();

        $produtoEncontrado = Produtos::find($produto->id);

        $this->assertInstanceOf(Produtos::class, $produtoEncontrado);
        $this->assertEquals($produto->id, $produtoEncontrado->id);
    }

    public function testProdutoUpdateNome()
    {
        $produto = Produtos::factory()->create();

        $novoNome = 'Pastel Y';
        $produto->nome = $novoNome;
        $produto->save();

        $this->assertEquals($novoNome, $produto->nome);
    }

    public function testProdutoUpdatePreco()
    {
        $produto = Produtos::factory()->create();

        $novoPreco = 1.01;
        $produto->preco = $novoPreco;
        $produto->save();

        $produtoAtualizado = Produtos::find($produto->id);

        $fmt = numfmt_create('pt_BR', NumberFormatter::CURRENCY);
        $this->assertEquals(numfmt_format_currency($fmt, $novoPreco, "BRL"), $produtoAtualizado->preco);
    }

    public function testProdutoUpdateimagem()
    {
        $produto = Produtos::factory()->create();

        $novaimagem = 'pastely.png';
        $produto->imagem = $novaimagem;
        $produto->save();

        $this->assertEquals($novaimagem, $produto->imagem);
    }

    public function testProdutoRequiredFieldNome()
    {
        $this->expectException(QueryException::class);

        $produto = new Produtos([
            // 'nome' => 'John Doe',
            'preco' => 1.01,
            'imagem' => 'xpto.png'
        ]);
        $produto->save();
    }

    public function testProdutoRequiredFieldPreco()
    {
        $this->expectException(QueryException::class);

        $produto = new Produtos([
            'nome' => 'John Doe',
//            'preco' => 1.01,
            'imagem' => 'xpto.png'
        ]);
        $produto->save();
    }

    public function testProdutoRequiredFieldimagem()
    {
        $this->expectException(QueryException::class);

        $produto = new Produtos([
            'nome' => 'John Doe',
            'preco' => 1.01,
//            'imagem' => 'xpto.png'
        ]);
        $produto->save();
    }

}

