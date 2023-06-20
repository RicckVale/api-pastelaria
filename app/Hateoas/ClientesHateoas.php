<?php

namespace App\Hateoas;

use App\Models\Clientes;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class ClientesHateoas
{
    use CreatesLinks;

    public function self(Clientes $clientes): ?Link
    {
        return $this->link('clientes.show', ['id' => $clientes->id]);
    }

    public function index(): ?Link
    {
        return $this->link('clientes.index');
    }

    public function store(): ?Link
    {
        return $this->link('clientes.store');
    }

    public function update(Clientes $clientes): ?Link
    {
        return $this->link('clientes.update', ['id' => $clientes->id]);
    }

    public function destroy(Clientes $clientes): ?Link
    {
        return $this->link('clientes.destroy', ['id' => $clientes->id]);
    }

}
