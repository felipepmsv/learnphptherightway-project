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

}
