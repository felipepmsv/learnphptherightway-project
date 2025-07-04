<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Router;
use PHPUnit\Framework\TestCase;
use App\Exceptions\RouteNotFoundException;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->router = new Router();
    }


    /** @test */
    public function it_registers_a_route():void
    {   
        $this->router->register('get', '/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index'],
            ],
        ];
        
        $this->assertEquals($expected, $this->router->routes());
    }
    
    /** @test */
    public function it_registers_a_get_route(): void
    {   
        $this->router->get('/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index'],
            ],
        ];
        
        $this->assertEquals($expected, $this->router->routes());        
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {
        $this->router->post('/users', ['Users', 'store']);

        $expected = [
            'post' => [
                '/users' => ['Users', 'store'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function there_are_no_routes_when_router_is_created(): void
    {
        // Aqui estamos testando se o array de rotas 
        // está vazio quando o objeto Router é criado
        $this->assertEmpty((new Router())->routes());        
    }

    /** 
     * @test 
     * @dataProvider routeNotFoundCases
     */

    // Teste para verificar a exception RouteNotFoundException
    // da classe Router
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void
    {
        // Classe anonima para simular o controlador
        // Users com o método store (o qual não existe)
        // o que vai resultar na exceção
        $users = new class() 
        {
            public function delete(): bool
            {
                return true;
            }        
        };

        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', ['Users', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    // DataProvider (declarado acima) para o teste routeNotFoundCases
    // Este método retorna um array de arrays, cada um contendo
    // um URI de solicitação e um método de solicitação que deve disparar
    // uma RouteNotFoundException
    public function routeNotFoundCases(): array
    {
        return [
            ['/users', 'put'],
            ['/invoices', 'post'],
            ['/users', 'get'],
            ['/users', 'post'],
        ];
    }

}
