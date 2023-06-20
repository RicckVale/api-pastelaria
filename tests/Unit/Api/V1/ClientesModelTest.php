<?php

namespace Tests\Unit\Api\V1;

use App\Models\Clientes;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientesModelTest extends TestCase
{

    use RefreshDatabase;

    public function testClienteCreateAndValidateInsertedData()
    {
        $data = [
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
            'nascimento' => '1990-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '2º Andar',
            'bairro' => 'Central',
            'cep' => '12345',
        ];

        $cliente = new Clientes();

        $cliente = $cliente->create($data);

        $this->assertInstanceOf(Clientes::class, $cliente);
        $this->assertEquals($data['nome'], $cliente->nome);
        $this->assertEquals($data['email'], $cliente->email);
    }

    public function testClienteCreateWithFactory()
    {
        $cliente = Clientes::factory(1)->createOne();
        $this->assertInstanceOf(Clientes::class, $cliente);
    }

    public function testClienteCreate()
    {
        $clienteData = [
            'nome' => 'John Doe',
            'email' => 'johndoe@example.com',
            'telefone' => '123456789',
            'nascimento' => '1990-01-01',
            'rua' => 'Main Street',
            'numero' => '123',
            'complemento' => 'Apartment 4B',
            'bairro' => 'Central',
            'cep' => '12345-678',
        ];

        $cliente = Clientes::create($clienteData);

        $this->assertInstanceOf(Clientes::class, $cliente);
        $this->assertDatabaseHas('clientes', $clienteData);
    }

    public function testClienteUpdate()
    {
        $cliente = Clientes::factory()->create();

        $novoNome = 'João das Couves';
        $cliente->nome = $novoNome;
        $cliente->save();

        $this->assertEquals($novoNome, $cliente->nome);
    }

    public function testClienteSoftDelete()
    {
        $cliente = Clientes::factory()->create();

        $cliente->delete();

        $this->assertSoftDeleted('clientes', ['id' => $cliente->id]);
    }

    public function testClienteSearchById()
    {
        $cliente = Clientes::factory()->create();

        $clienteEncontrado = Clientes::find($cliente->id);

        $this->assertInstanceOf(Clientes::class, $clienteEncontrado);
        $this->assertEquals($cliente->id, $clienteEncontrado->id);
    }


    public function testClienteRequiredFieldNome()
    {
        $this->expectException(QueryException::class);

        $cliente = new Clientes([
            // 'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
            'nascimento' => '2000-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Central',
            'cep' => '12345',
            "cadastrado" => "2023-06-11 03:46:20",
        ]);
        $cliente->save();
    }

    public function testClienteRequiredFieldEmail()
    {
        $this->expectException(QueryException::class);

        $cliente = new Clientes([
            'nome' => 'John Doe',
//            'email' => 'john@example.com',
            'telefone' => '123456789',
            'nascimento' => '2000-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Central',
            'cep' => '12345',
            "cadastrado" => "2023-06-11 03:46:20",
        ]);
        $cliente->save();
    }

    public function testClienteRequiredFieldTelefone()
    {
        $this->expectException(QueryException::class);

        $cliente = new Clientes([
            'nome' => 'John Doe',
            'email' => 'john@example.com',
//            'telefone' => '123456789',
            'nascimento' => '2000-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Central',
            'cep' => '12345',
            "cadastrado" => "2023-06-11 03:46:20",
        ]);
        $cliente->save();
    }

    public function testClienteRequiredFieldDataDeNascimento()
    {
        $this->expectException(QueryException::class);

        $cliente = new Clientes([
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
//            'nascimento' => '2000-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Central',
            'cep' => '12345',
            "cadastrado" => "2023-06-11 03:46:20",
        ]);
        $cliente->save();
    }

    public function testClienteRequiredFieldBairro()
    {
        $this->expectException(QueryException::class);

        $cliente = new Clientes([
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
            'nascimento' => '2000-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '',
//            'bairro' => 'Central',
            'cep' => '12345',
            "cadastrado" => "2023-06-11 03:46:20",
        ]);
        $cliente->save();
    }

    public function testClienteRequiredFieldCep()
    {
        $this->expectException(QueryException::class);

        $cliente = new Clientes([
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
            'nascimento' => '2000-01-01',
            'rua' => 'Street',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Central',
//            'cep' => '12345',
            "cadastrado" => "2023-06-11 03:46:20",
        ]);
        $cliente->save();
    }

}

