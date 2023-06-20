<?php

namespace App\Hateoas;

use App\Models\Produtos;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class ProdutosHateoas
{
    use CreatesLinks;

    public function self(Produtos $produtos): ?Link
    {
        return $this->link('produtos.show', ['id' => $produtos->id]);
    }

    public function index(): ?Link
    {
        return $this->link('produtos.index');
    }

    public function store(): ?Link
    {
        return $this->link('produtos.store');
    }

    public function update(Produtos $produtos): ?Link
    {
        return $this->link('produtos.update', ['id' => $produtos->id]);
    }

    public function destroy(Produtos $produtos): ?Link
    {
        return $this->link('produtos.destroy', ['id' => $produtos->id]);
    }
}
