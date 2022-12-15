<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\User;

class RegistrationController extends CoreController
{
    public function register()
    {
        //WIP
        $this->show('error/worksite');

        //Create new user object
        // $this->show('registration/register', [
        //     'user' => new User(),
        // ]);
    } 
     
    public function registerPost(){

        //Get input values
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $repeatPassword = filter_input(INPUT_POST, 'repeatPassword');

        //Create new object user
        $user = new User();

        //---Set property user object
        //At registration the role by default is user => 1
        $user->setRoles(1);

        //Set Image default
        $user->setImg('http://' . $_SERVER['HTTP_HOST'] . '/uploads/default-avatar.jpg');


        //Clear datas html entities
        $clearPseudo = $this->clearData($pseudo);
        $clearEmail = $this->clearData($email);
        $clearPassword = $this->clearData($password);
        $clearRepeatPassword = $this->clearData($repeatPassword);

        //Check spaces in string and min-length 4 characters
        $checkPseudo = $this->checkString($clearPseudo, 4);

        //If have 4 characters and haven't spaces
        if($checkPseudo == true){

            //Check if new pseudo is unique in database
            $uniquePseudo = $this->checkUniquePseudo($clearPseudo);

            if ($uniquePseudo == true) {

                $user->setPseudo($clearPseudo);
            
            } else {

                //Redirection to register form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/register' . $user->getId());
                $this->redirectionWithMessage('register', 'errorMessage', 'Pseudo is already assign, please choose another one');

            }
            
        } else {
            
            //Redirection to register form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/register' . $user->getId());
            $this->redirectionWithMessage('register', 'errorMessage','The pseudo requires 4 characters without space');
        }
        
        //Check if Email is unique in database
        $uniqueEmail = $this->checkUniqueEmail($clearEmail);

        if ($uniqueEmail == true) {

            $user->setEmail($clearEmail);
        
        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/register';
            $this->redirectionWithMessage('register', 'errorMessage', 'Email is already register');

        }

        //Check spaces and string min-length 6 characters
        $checkPassword = $this->checkString($clearPassword, 6);

        //If have 6 characters and haven't spaces
        if($checkPassword == true){

            if($clearPassword == $clearRepeatPassword){

                //Hash password in database
                $user->setPassword(password_hash($clearPassword, PASSWORD_BCRYPT));

            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/register';
                $this->redirectionWithMessage('register', 'errorMessage', 'The repeat password is incorrect');

            }

        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->redirectionWithMessage('register', 'errorMessage', 'The password requires 6 characters without spaces');

        }
        
        //Insert new user in database 
        $user->insert();

        //Post success message and redirection
        //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/login');
        $this->redirectionWithMessage('login', 'successMessage', 'Your profil : ' . $user->getPseudo() . ' created successfully <br> please check your email and login');
    }

    /**
     * Check string length
     *
     * @param string $string
     * @param int $number
     * @return bool
     */
    protected static function checkStringLength(string $string, int $number): bool
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
    protected static function checkUniquePseudo(string $string): bool
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
    protected static function checkUniqueEmail(string $string): bool
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
    protected function checkString(string $string, int $number): bool
    {
        //Find spaces
        $clearString = $this->checkSpaceInString($string);

        //If no spaces
        if($clearString == true) {

            //check length string
            $clearString = $this->checkStringLength($string, $number);

            //if the length is respected return -> true
            //Or return  -> false
            return $clearString;

        } else {

            return false;
        }
    }
}

    

