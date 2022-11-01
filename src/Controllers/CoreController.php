<?php
namespace App\Controllers;

class CoreController
{
    
    public function show($templateName, $viewData = [])
    {
        extract($viewData);
        
        require_once __DIR__ . '/../Templates/layout/header.tpl.php';
        require_once __DIR__ . '/../Templates/' . $templateName . '.tpl.php';
        require_once __DIR__ . '/../Templates/layout/footer.tpl.php';
    }
}