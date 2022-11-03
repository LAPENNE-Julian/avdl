<?php
namespace App\Controllers;

class CoreController
{
    protected $errorController;

    public function __construct()
    {
        $this->errorController = new ErrorController();
    }
    
    public function show($templateName, $viewData = [])
    {
        extract($viewData);
        
        require_once __DIR__ . '/../Templates/layout/header.tpl.php';
        require_once __DIR__ . '/../Templates/' . $templateName . '.tpl.php';
        require_once __DIR__ . '/../Templates/layout/footer.tpl.php';
    }
}