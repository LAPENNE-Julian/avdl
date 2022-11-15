<?php
namespace App\Controllers;

class CoreController
{
    protected $errorController;
    protected $router;
    protected $match;

    public function __construct($router)
    {
        $this->errorController = new ErrorController();

        $this->router = $router;
        $this->match = $router->match();

        //Get router name in $match array
        $routeName = $this->match['name'];

        //Define permission list
        $acl = [
            // 'register' => no need, free access
            // 'login'  => no need, free access
            // 'logout' => no need, free access
            // 'main-home' => no need, free access

            'anecdote-browse' =>    [1,2], 
            'anecdote-read' =>    [1,2],
            'category-browse' =>    [1,2],

            //----Backoffice----//
            //Router user
            'backoffice-user-browse' =>    [2],
            'backoffice-user-read' =>      [2],
            'backoffice-user-add' =>       [2],
            'backoffice-user-add-post' =>  [2],
            'backoffice-user-edit' =>      [2],
            'backoffice-user-edit-post' => [2],
            'backoffice-user-delete' =>    [2],
            //Router anecdote
            'backoffice-anecdote-browse' =>    [2],
            'backoffice-anecdote-read' =>      [2],
            'backoffice-anecdote-add' =>       [2],
            'backoffice-anecdote-add-post' =>  [2],
            'backoffice-anecdote-edit' =>      [2],
            'backoffice-anecdote-edit-post' => [2],
            'backoffice-anecdote-delete' =>    [2],
            //Router category
            'backoffice-category-browse' =>    [2],
            'backoffice-category-read' =>      [2],
            'backoffice-category-add' =>       [2],
            'backoffice-category-add-post' =>  [2],
            'backoffice-category-edit' =>      [2],
            'backoffice-category-edit-post' => [2],
            'backoffice-category-delete' =>    [2],
        ];

        //Check if $routeName is in ACL array
        //Use array_key_exists() to check keys array
        if (array_key_exists($routeName, $acl)) {

            //Get role number allowed in array
            $authorizedRoles = $acl[$routeName];

            $this->checkAuthorization($authorizedRoles);
        }
        
        //----
        // Token anti-CSRF - RouteName list to create Token
        //-----
        $csrfTokenToCreate = [
            'register',
            'login',
            'backoffice-user-add',
            'backoffice-user-edit',
            'backoffice-anecdote-add',
            'backoffice-anecdote-edit',
            'backoffice-category-add',
            'backoffice-category-edit',
        ];

        //Check if $routeName is in csrfTokenToCreate array
        //Use array_key_exists() to check keys array
        if (in_array($routeName, $csrfTokenToCreate)) {   
            
            //Creation of a Token for input hidden in form
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        
        //----
        // RouteName list need check Token
        //-----
        $csrfTokenToCheck = [
            'register-post',
            'login-post',
            'backoffice-user-add-post',
            'backoffice-user-edit-post',
            'backoffice-anecdote-add-post',
            'backoffice-anecdote-edit-post',
            'backoffice-category-add-post',
            'backoffice-category-edit-post',
        ];

        //Check if $routeName is in csrfTokenToCheck array
        //Use array_key_exists() to check keys array
        if (in_array($routeName, $csrfTokenToCheck)) {

            //GET Token Session
            $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

            //Get Token in POST
            $postToken = filter_input(INPUT_POST, 'token');
        
            //If tokens are differents or empty
            if ($postToken != $sessionToken || empty($postToken)) {

                $this->show('error/err403');
                exit;

            } else {

                //Delete session token
                unset($_SESSION['token']); 
            }
        }

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
    public static function redirection(string $road) :void
    {
        header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/' . $road);
    }

    /**
     * Redirection with error Message
     *
     * @param string $road
     * @param string $label
     * @param string $message
     * @return void
     */
    public static function redirectionWithMessage(string $road, string $label,string $message): void
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

    public function checkAuthorization($roles = [])
    {
        //If user is connect
        if (isset($_SESSION['userRoles'])) {            
            
            //Check if the role number is in array
            if (in_array($_SESSION['userRoles'], $roles)) {
            
                return true;

            } else {

                //If user connected has not authorization
                $this->show('error/err403');
                exit;
            }

        } else {     

            //If user is not connect, Redirection to login
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/login');
            $this->redirection('login');
        }
    }

    /**
     * Find if string have spaces
     *
     * @param string $string
     * @return bool
     */
    public static function checkSpaceInString(string $string): bool
    {
        //Find space in string
        $spaces = strpos($string, ' ');

        if (is_int($spaces) === true) {

            return false;
            // echo 'il y a un espace';

        } else {

            return true;
        }
    }

    /**
     * Clear html entities in string edit 
     *
     * @param string $data
     * @return string
     */
    public function clearData(string $data) :string 
    {
        //clean data
        htmlentities(strip_tags($data));

        return $data;
    }
}