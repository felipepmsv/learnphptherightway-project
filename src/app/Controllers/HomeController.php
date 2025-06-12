<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index', ['foo' => 'bar']);        
    }

    public function download()
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="banana.pdf"');

        // Este comando é necessario para ler o arquivo e enviá-lo ao navegador
        // por conta do buffer de saída do PHP!
        // O arquivo deve existir na pasta storage
        readfile(STORAGE_PATH . '/nome_do_arquivo_para_download.pdf'); 
        
        // Este comando é necessário para evitar que 
        // o código continue executando após o download
        exit; 

    }

    public function upload()
    {
        // Deixei comantado para não executar o upload, 
        // mas sim apenas testar o redirecionamento

        // $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        // move_uploaded_file(
        //     $_FILES['receipt']['tmp_name'],
        //     $filePath            
        // );

        header('Location: /');

        // Este comando é necessário para evitar que 
        // o código continue executando 
        // após o redirecionamento
        exit; 
    }

}
