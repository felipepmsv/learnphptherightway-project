<?php

declare(strict_types=1);

namespace App;

use App\Exception\RouteNotFoundException;

class App
{
    private static DB $db;

    public function __construct(protected Router $router, protected array $request, protected Config $config)
    {
        static::$db = new DB($config->db ?? []); // Inicializa a conexão com o banco de dados
    }    

    public static function db(): DB
    {
        return static::$db;
    }
    

    public function run()
    {
        try
        {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        }
        catch (RouteNotFoundException)
        {   
            http_response_code(404); // Define o código de status HTTP 404    
            echo \App\View::make('error/404'); // Renderiza a view de erro 404   
        }        
    }
}
