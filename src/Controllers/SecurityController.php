<?php

namespace App\Controllers;

use App\Models\User;

class SecurityController extends CoreController
{
    public function login()
    {
        $this->show('security/login');
    }

    public function loginPost()
    {
        $email = filter_input(INPUT_POST, 'login-email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'login-password');

        //Clear datas html entities
        $clearEmail = $this->ClearData($email);
        $clearPassword = $this->ClearData($password);

        //Find User by Email
        $user = User::findByEmail($clearEmail);

        //--->If user email is verified
        //-->if($user->isVerified() == true){

            //instanceof check if $user is an instance of User class
            //password_verify check if the password is correct
            if ($user instanceof User && password_verify($clearPassword, $user->getPassword())) {

                //add the information in $_SESSION
                // $_SESSION['userId'] = $user->getId();
                $_SESSION['userPseudo'] = $user->getPseudo();
                $_SESSION['userEmail'] = $user->getEmail();
                $_SESSION['userRoles'] = $user->getRoles();

                //Redirection to home
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/');
                $this->redirection('');
            
            } else {

                //Redirection to login and post error message in the view 
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/login');
                $this->redirectionWithMessage('login', 'errorMessage', 'incorrect identifiers');   
            }

        //-->} else {

            //Redirection to login and post error message in the view 
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/login');
            //-->$this->redirectionWithMessage('login', 'errorMessage', 'Your email isn\'t verified, please check your mails'); 
        //-->}
    }

    public function logout()
    {
        //Delete informations in $_SESSION
        //unset($_SESSION['userId']);
        unset($_SESSION['userPseudo']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userRoles']);

        //Redirection to login
        //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/login');
        $this->redirection('login');
    }
}