<?php

namespace App\Controllers\backoffice;

use App\Controllers\RegistrationController;
use App\Models\User;

class UserController extends RegistrationController
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
        $imgPath = $this->imgPathGenerator($imgName, 'jpg');
        $user->setImg($imgPath);

        //Check Role value
        if($roles == 2 ){

            $user->setRoles(2);

        } else {

            //Default 1 => user role
            $user->setRoles(1);
        }

        //Clear datas html entities
        $clearPseudo = $this->clearData($pseudo);
        $clearEmail = $this->clearData($email);
        $clearPassword = $this->clearData($password);

        //If pseudo is edit
        if($clearPseudo !== $user->getPseudo()){

            //Check spaces in string and min-length 4 characters
            $checkPseudo = $this->checkString($clearPseudo, 4);

            //If string is under 4 characters or have spaces
            if($checkPseudo == true){

                //Check if new pseudo is unique in database
                $uniquePseudo = $this->checkUniquePseudo($clearPseudo);

                if ($uniquePseudo == true) {

                    $user->setPseudo($clearPseudo);
                
                } else {

                    //Redirection to edit form
                    //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                    $this->redirectionWithMessage('backoffice/user/edit/' . $user->getId(), 'errorMessage', 'Pseudo is already assign, please choose another one');

                }
                
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->redirectionWithMessage('backoffice/user/edit/' . $user->getId(), 'errorMessage', 'The pseudo requires 4 characters without space');
                
            }
        }

        //If Email is edit
        if($clearEmail !== $user->getEmail()){

            //Check if Email is unique in database
            $uniqueEmail = $this->checkUniqueEmail($clearEmail);

            if ($uniqueEmail == true) {

                $user->setEmail($clearEmail);
            
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->redirectionWithMessage('backoffice/user/edit/' . $user->getId(), 'errorMessage', 'Email is already register');

            }
        }

        //If password is edit
        if($clearPassword !== $user->getPassword()){

            //Check spaces and string min-length 6 characters
            $checkPassword = $this->checkString($clearPassword, 6);

            //if password edit is under 6 characters or have spaces
            if($checkPassword == true){

                //Else hash password in database
                $user->setPassword(password_hash($clearPassword, PASSWORD_BCRYPT));

            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->redirectionWithMessage('backoffice/user/edit/' . $user->getId(), 'errorMessage', 'The password requires 6 characters without spaces');

            } 
        }
        
        //Update in database
        $user->update();

        //Redirection after edit
        $this->redirection('backoffice/user/'. $user->getId());
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

        //Check Role value
        if($roles == 2){

            $user->setRoles(2);

        } else {

            //Default 1 => user role
            $user->setRoles(1);
        }

        //Clear datas html entities
        $clearPseudo = $this->clearData($pseudo);
        $clearEmail = $this->clearData($email);
        $clearPassword = $this->clearData($password);

        //Check spaces in string and min-length 4 characters
        $checkPseudo = $this->checkString($clearPseudo, 4);

        //If have 4 characters and haven't spaces
        if($checkPseudo == true){

            //Check if new pseudo is unique in database
            $uniquePseudo = $this->checkUniquePseudo($clearPseudo);

            if ($uniquePseudo == true) {

                $user->setPseudo($clearPseudo);
            
            } else {

                //Redirection to add form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/add';
                $this->redirectionWithMessage('backoffice/user/add', 'errorMessage', 'Pseudo is already assign, please choose another one');

            }
            
        } else {
            
            //Redirection to add form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/add';
            $this->redirectionWithMessage('backoffice/user/add', 'errorMessage','The pseudo requires 4 characters without space');
        }

        
        //Check if Email is unique in database
        $uniqueEmail = $this->checkUniqueEmail($clearEmail);

        if ($uniqueEmail == true) {

            $user->setEmail($clearEmail);
        
        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/add';
            $this->redirectionWithMessage('backoffice/user/add', 'errorMessage', 'Email is already register');

        }

        //Check spaces and string min-length 6 characters
        $checkPassword = $this->checkString($clearPassword, 6);

        //if password edit is under 6 characters or have spaces
        if($checkPassword == true){

            //Else hash password in database
            $user->setPassword(password_hash($clearPassword, PASSWORD_BCRYPT));

        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/add';
            $this->redirectionWithMessage('backoffice/user/add', 'errorMessage', 'The password requires 6 characters without spaces');

        } 

        //Set Image default
        $imgName = 'avatar-default';
        $imgPath = $this->imgPathGenerator($imgName, 'jpg');
        $user->setImg($imgPath);

        // Set Image
        // $imgName = $this->ImgNameGenerator($clearPseudo);
        // $imgPath = $this->ImgPathGenerator($imgName, 'jpg');
        // $user->setImg($imgPath);

        //Insert in database 
        $user->insert();

        // Post success message and redirection after insert
        // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user');
        $this->redirectionWithMessage('backoffice/user', 'successMessage', 'the user => id : ' . $user->getId() . ' created successfully');
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
            $this->redirection('backoffice/user');
        }
    }

    /**
     * Image name generator
     *
     * @param string $userName
     * @return string
     */
    protected static function imgNameGenerator(string $userName): string
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
    protected static function imgPathGenerator(string $imgName, string $imgType): string
    {
        //get http host
        $server = $_SERVER['HTTP_HOST'];
        //set the url of the user image
        //default avatar -> '/uploads/default-avatar.jpg'
        $userImageUrl = 'http://' . $server . '/uploads' . '/' . $imgName . '.' . $imgType;

        return $userImageUrl;
    }
}