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
     * Redirection
     *
     * @param string $road
     * @return void
     */
    public static function Redirection(string $road) :void
    {
        header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/' . 'backoffice/'. $road);
    }

    /**
     * Redirection with error Message
     *
     * @param string $road
     * @param string $label
     * @param string $message
     * @return void
     */
    public static function RedirectionWithMessage(string $road, string $label,string $message): void
    {
        //Redirection
        CoreController::Redirection($road);
        //Post error message in the view
        $_SESSION[$label] = $message;

        if($label == 'errorMessage'){
            
            //stop the script
            exit;
        }
    }

    /**
     * Clear html entities in string edit 
     *
     * @param string $data
     * @return string
     */
    public function ClearData(string $data) :string 
    {
        //clean data
        htmlentities(strip_tags($data));

        return $data;
    }
}