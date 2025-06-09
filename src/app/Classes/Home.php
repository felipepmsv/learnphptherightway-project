<?php

declare(strict_types=1);

namespace App\Classes;

class Home
{
    public function index(): string
    {
        return <<<FORM
        <form action="/upload" method="post" enctype="multipart/form-data">            
            <input type="file" name="receipt[]" />
            <input type="file" name="receipt[]" />
            <button type="submit">Upload</button>
        </form>
        FORM;
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
