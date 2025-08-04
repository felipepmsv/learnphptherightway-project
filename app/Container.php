<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\Container\NotFoundException;
use Psr\Container\ContainerInterface;
use App\Exceptions\Container\ContainerException;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        // Metodo GET modificado para Autowiring

        if ($this->has($id))
        {
            $entry = $this->entries[$id];

            // Retorna o serviço instanciado        
            return $entry($this);
        }

        return $this->resolve($id);

        
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

    public function resolve(string $id)
    {
        // Reflection API

        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);

        if(! $reflectionClass->isInstantiable()) {
            throw new ContainerException('Class "' . $id . '" is not instantiable');
        }


        // 2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();

        if(! $constructor) {
            // If there is no constructor
            // we can create an instance without dependencies
            return new $id;
        }


        // 3. Inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();

        if(! $parameters) {
            // If there are no constructor parameters
            // we can create an instance without dependencies
            return new $id;
        }


        // 4. If the constructor parameter is a class then try to resolve it using the container

        // A function aqui recebe um parâmetro 
        // do tipo \ReflectionParameter
        // pois o método getParameters() retorna 
        // um array de objetos \ReflectionParameter!!!
        $dependencies = array_map(
            function(\ReflectionParameter $param) use ($id) {
                $name = $param->getName();
                $type = $param->getType();

                if(! $type) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint'
                    );
                }

                // Por conta da classe \ReflectionType ter se tornado abstrata
                // a partir do PHP 8.0, precisamos verificar se o tipo é uma instância de 
                // ReflectionUnionType...
                if ($type instanceof \ReflectionUnionType) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"'
                    );
                }

                // ... ou ReflectionIntersectionType (segundo MINHA pesquisa)
                if ($type instanceof \ReflectionIntersectionType) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because of intersection type for param "' . $name . '"'
                    );
                }

                if ($type instanceof \ReflectionNamedType && ! $type->isBuiltin()) {
                    // If the type is not a built-in type
                    // we can resolve it using the container
                    return $this->get($type->getName());
                }

                throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because invalid param "' . $name . '"'
                );

            }, 
            $parameters
        );

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
