<?php
namespace App\Controllers;

class CoreController
{
    protected $errorController;

    public function __construct()
    {
        $this->errorController = new ErrorController();
    }
    
    /**
     * Show templates 
     *
     * @param string $templateName
     * @param array $viewData
     * @return string
     */
    public function show($templateName, $viewData = [])
    {
        extract($viewData);
        
        require_once __DIR__ . '/../Templates/layout/header.tpl.php';
        require_once __DIR__ . '/../Templates/' . $templateName . '.tpl.php';
        require_once __DIR__ . '/../Templates/layout/footer.tpl.php';
    }

    /**
     * Redirection with id
     *
     * @param string $road
     * @param int $id
     * @return void
     */
    public static function RedirectionWithId(string $road,int $id) :void
    {
        header('Location: '. $_SERVER['HTTP_ORIGIN'] . $road . $id);
    }

    /**
     * Clear html entities in string edit 
     *
     * @param string $data
     * @return string
     */
    public static function ClearData(string $data) :string 
    {
        //clean data
        htmlentities(strip_tags($data));

        return $data;
    }
}