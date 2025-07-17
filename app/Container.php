<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\Container\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if (! $this->has($id))
        {
            throw new NotFoundException('Class "' . $id . '" has no binding');
        }

        $entry = $this->entries[$id];

        // Retorna o serviço instanciado        
        return $entry($this);
    }

    public function has(string $id): bool
    {
        // Verifica se o serviço está registrado no contêiner
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete)
    {
        // Registra o serviço no contêiner
        $this->entries[$id] = $concrete;
    }
}
