<?php

namespace App;

interface Renderable
{
    // Agora qualquer classe que precisar renderizar algo pode implementar este método
    public function render(): string;
}