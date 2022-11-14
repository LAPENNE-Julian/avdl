<?php

namespace App\Controllers;

class ErrorController {

    /**
     * Error 404
     *
     * @return void
     */
    public function err404() {
        
        //header('HTTP/1.0 404 Not Found');
        http_response_code(404);
        
        require_once __DIR__ . '/../Templates/layout/header.tpl.php';
        require_once __DIR__ . '/../Templates/error/err404.tpl.php';
        require_once __DIR__ . '/../Templates/layout/footer.tpl.php';
    }

    /**
     * Error 404
     *
     * @return void
     */
    public function err403() {
        
        //header('HTTP/1.0 403 Forbidden');
        http_response_code(403);
        
        require_once __DIR__ . '/../Templates/layout/header.tpl.php';
        require_once __DIR__ . '/../Templates/error/err403.tpl.php';
        require_once __DIR__ . '/../Templates/layout/footer.tpl.php';
    }
}