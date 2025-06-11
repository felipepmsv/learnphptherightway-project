<?php

declare(strict_types=1);

namespace App;

class View
{
    public function __construct(protected string $view, protected array $params = []) 
    {

    }

    public static function make(string $view, array $params = []): static
    {
        return new self($view, $params);
    }

    public function render(): string
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if(! file_exists($viewPath)) 
        {
            throw new ViewNotFoundException();
        }        

        // Extraindo os parâmetros para o escopo da view
        // para que possamos acessá-los diretamente
        // ao invés de usar $this->params['foo']

        extract($this->params);

        // foreach ($this->params as $key => $value) {
        //     ${$key} = $value; // cria uma variável com o nome do parâmetro (vide Variable variables)
        // }
        
        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }

    // Sobreescrevendo o método __toString,
    // para que a classe View possa ser convertida em string
    // e não seja necessário chamar o método render() explicitamente.        
    public function __toString(): string
    {
        return $this->render();
    }

    // Sobreescrevendo o método __get,
    // para que possamos acessar os parâmetros da view
    // ao invés de usar $this->params['foo']
    // na index.php
    public function __get(string $name): mixed
    {        
        return $this->params[$name] ?? null;        
    }

}
