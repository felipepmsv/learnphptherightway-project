<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    public function upload()
    {
        $uploadedFiles = $_FILES['transactions'];
        $errors = [];
        foreach ($uploadedFiles['name'] as $index => $filename) {
            $filePath = STORAGE_PATH . '/' . $filename;
            if (!move_uploaded_file($uploadedFiles['tmp_name'][$index], $filePath)) {
                $errors[] = "Failed to upload file : $filename";
            }
        }
        if (empty($errors)) {
            header('Location: /transactions');
            exit;
        } else {
            echo "File upload failed:<br>";
            echo implode('<br>', $errors);
        }
    }
}
