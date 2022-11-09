<?php

namespace App\Controllers\backoffice;

use App\Controllers\CoreController;
use App\Models\User;

class UserController extends CoreController
{
    public function browse()
    {
        $usersList = User::findAll();

        $this->show('backoffice/user/browse', [
            'users' => $usersList,
            
        ]);
    }

    public function read($id)
    {
        //Get user by id
        $user = User::find($id);

        if($user == null){
 
            $this->errorController->err404();

        } else {

                $this->show('backoffice/user/read', [
                'user' => $user,
            ]);
        }
    }

    public function edit($id)
    {
        //Get user by id
        $user= User::find($id);

        if($user == null){
 
            $this->errorController->err404();

        } else {

                $this->show('backoffice/user/form', [
                'user' => $user,
            ]);
        }
    }

    public function editPost($id)
    {
        //Get user by id
        $user = User::find($id);

        //Get input values
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        // $img = filter_input(INPUT_POST, 'img');
        $roles = filter_input(INPUT_POST, 'roles', FILTER_VALIDATE_INT);

        //--Set property user object

        //Set Image default
        $imgName = 'avatar-default';
        $imgPath = $this->ImgPathGenerator($imgName, 'jpg');
        $user->setImg($imgPath);

        //check Roles value
        if($roles > 0 && $roles <= 2 ){

            $user->setRoles($roles);

        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'User Roles must be \'user\' or \'admin\'.');
            //stop the script
            exit;
        }

        //Clear datas html entities
        $clearPseudo = $this->ClearData($pseudo);
        $clearEmail = $this->ClearData($email);
        $clearPassword = $this->ClearData($password);

        //If pseudo is edit
        if($clearPseudo !== $user->getPseudo()){

            //Check spaces in string and min-length 4 characters
            $checkPseudo = $this->CheckString($clearPseudo, 4);

            //If string is under 4 characters or have spaces
            if($checkPseudo == true){

                //Check if new pseudo is unique in database
                $uniquePseudo = $this->CheckUniquePseudo($clearPseudo);

                if ($uniquePseudo == true) {

                    $user->setPseudo($clearPseudo);
                
                } else {

                    //Redirection to edit form
                    //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                    $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'Pseudo is already assign, please choose another one');

                }
                
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'The pseudo requires 4 characters without space');
                
            }
        }

        //If Email is edit
        if($clearEmail !== $user->getEmail()){

            //Check if Email is unique in database
            $uniqueEmail = $this->CheckUniqueEmail($clearEmail);

            if ($uniqueEmail == true) {

                $user->setEmail($clearEmail);
            
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'Email is already register');

            }
        }

        //If password is edit
        if($clearPassword !== $user->getPassword()){

            //Check spaces and string min-length 6 characters
            $checkPassword = $this->CheckString($clearPassword, 6);

            //if password edit is under 6 characters or have spaces
            if($checkPassword == true){

                //Else hash password in database
                $user->setPassword(password_hash($clearPassword, PASSWORD_BCRYPT));
                
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'The password requires 6 characters without spaces');

            } 
        }
        
        //Update in database
        $user->update();

        //Redirection after edit
        $this->Redirection('user/'. $user->getId());
    }

    public function add()
    {
        //Create new user object
        $this->show('backoffice/user/form', [
            'user' => new User(),
        ]);
    }

    public function addPost()
    {
        //Create new object user
        $user = new User();

        //Get input values
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        // $img = filter_input(INPUT_POST, 'img');
        $roles = filter_input(INPUT_POST, 'roles', FILTER_VALIDATE_INT);

        //check Roles value
        if($roles > 0 && $roles <= 2 ){

            $user->setRoles($roles);

        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->RedirectionWithMessage('user/edit/', 'errorMessage','User Roles must be \'user\' or \'admin\'.');
            //stop the script
            exit;
        }

        //Clear datas html entities
        $clearPseudo = $this->ClearData($pseudo);
        $clearEmail = $this->ClearData($email);
        $clearPassword = $this->ClearData($password);


        //Check spaces in string and min-length 4 characters
        $checkPseudo = $this->CheckString($clearPseudo, 4);

        //If string is under 4 characters or have spaces
        if($checkPseudo == true){

            //Check if new pseudo is unique in database
            $uniquePseudo = $this->CheckUniquePseudo($clearPseudo);

            if ($uniquePseudo == true) {

                $user->setPseudo($clearPseudo);
            
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'Pseudo is already assign, please choose another one');

            }
            
        } else {
            
            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage','The pseudo requires 4 characters without space');
        }

        
        //Check if Email is unique in database
        $uniqueEmail = $this->CheckUniqueEmail($clearEmail);

        if ($uniqueEmail == true) {

            $user->setEmail($clearEmail);
        
        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->RedirectionWithMessage('user/edit/' . $user->getId(), 'errorMessage', 'Email is already register');

        }

        //Check spaces and string min-length 6 characters
        $checkPassword = $this->CheckString($clearPassword, 6);

        //if password edit is under 6 characters or have spaces
        if($checkPassword == true){

            //Else hash password in database
            $user->setPassword(password_hash($clearPassword, PASSWORD_BCRYPT));
            
        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->RedirectionWithMessage('user/add/', 'errorMessage', 'The password requires 6 characters without spaces');

        } 

        //Set Image default
        $imgName = 'avatar-default';
        $imgPath = $this->ImgPathGenerator($imgName, 'jpg');
        $user->setImg($imgPath);

        // Set Image
        // $imgName = $this->ImgNameGenerator($clearPseudo);
        // $imgPath = $this->ImgPathGenerator($imgName, 'jpg');
        // $user->setImg($imgPath);

        //Insert in database 
        $user->insert();

        // Post success message and redirection after insert
        // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user');
        $this->RedirectionWithMessage('user', 'successMessage', 'the user => id : ' . $user->getId() . ' created successfully');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if($user == null){
 
            $this->errorController->err404();

        } else {

            //Delete user
            $user->delete();

            //Redirection after delete
            // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user');
            $this->Redirection('user');
        }
    }

    /**
     * Image name generator
     *
     * @param string $userName
     * @return string
     */
    protected static function ImgNameGenerator(string $userName): string
    {
        // To lowercase
        $clearName = strtolower($userName);
        
        $trimCharacters = array('&', '#', '"', '\'', '{', '[', '(', '|', '`', '\\', '_', '^', '@', ')', ']', '=', '+', '}', ',', ';', '.', ':', '/', '!', '§', '°', '¨', '£', '$', 'ø', '*', '%', 'ù', '`');
        // Replace Trim Characters selection by '-'
        $imgNameWithoutTrimCharacters = str_replace($trimCharacters , "-", $clearName);
        
        $accents = array('é', 'è');
        // Replace accents (é-è) to e
        $imgName = str_replace($accents , "e", $imgNameWithoutTrimCharacters);
         
        return $imgName;
    }

    /**
     * Image path generator
     *
     * @param string $imgName
     * @param string $imgType
     * @return string
     */
    protected static function ImgPathGenerator(string $imgName, string $imgType): string
    {
        //get http host
        $server = $_SERVER['HTTP_HOST'];
        //set the url of the user image
        //default avatar -> '/assets/uploads/default-avatar.jpg'
        $userImageUrl = 'http://' . $server . '/assets/uploads' . '/' . $imgName . '.' . $imgType;

        return $userImageUrl;
    }

    /**
     * Check string length
     *
     * @param string $string
     * @param int $number
     * @return bool
     */
    protected static function CheckStringLength(string $string, int $number): bool
    {
        //if string length is under $number characters
        if(strlen($string) < $number ){

            return false;

        } else {

            return true;
        }
    }

    /**
     * Check if Pseudo is unique in database
     *
     * @param string $string
     * @return bool
     */
    protected static function CheckUniquePseudo(string $string): bool
    {
        if (User::findByPseudo($string) == null) {

            //yes unique 
            return true;

        } else {

            //no, the pseudo already exist
            return false;
        }  
    }

    /**
     * Check if Email is unique in database
     *
     * @param string $string
     * @return bool
     */
    protected static function CheckUniqueEmail(string $string): bool
    {
        if (User::findByEmail($string) == null) {

            //yes unique 
            return true;

        } else {

            //no, the pseudo already exist
            return false;
        }  
    }

    /**
     * Check string - spaces and length
     *
     * @param string $string
     * @return bool
     */
    protected function CheckString(string $string, int $number): bool
    {
        //Find spaces
        $clearString = $this->CheckSpaceInString($string);

        //If no spaces
        if($clearString == true) {

            //check length string
            $clearString = $this->CheckStringLength($string, $number);

            //if the length is respected return -> true
            //Or return  -> false
            return $clearString;

        } else {

            return false;
        }
    }
}