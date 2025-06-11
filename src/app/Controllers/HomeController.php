<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index', ['foo' => 'bar']);
        //return (new View('index'))->render();
    }

    public function upload()
    {
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';

        // $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        // // Para o uso desse comando foi necessario: 
        // // 1. criar a pasta storage
        // //    mkdir storage
        // // 2. descobrir o dono do servidor web
        // //    ps aux | grep php-fpm
        // // 3. dar permissão de escrita para o servidor web
        // //    sudo chown -R www-data:www-data storage
        // // 4. dar permissão de escrita a pasta storage
        // //    sudo chmod -R 755 storage

        // move_uploaded_file(
        //     $_FILES['receipt']['tmp_name'],
        //     $filePath            
        // );

        // echo '<pre>';
        // var_dump(pathinfo($filePath));
        // echo '</pre>';
    }

}
