<?php

namespace App\Controllers;

class ErrorController {
    /**
     * Error 404
     *
     * @return void
     */
    public function err404() {
        
        header('HTTP/1.0 404 Not Found');
        
        require_once __DIR__ . '/../Templates/layout/header.tpl.php';
        require_once __DIR__ . '/../Templates/error/err404.tpl.php';
        require_once __DIR__ . '/../Templates/layout/footer.tpl.php';
    }
}