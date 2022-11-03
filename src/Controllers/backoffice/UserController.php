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

        //Set property user object
        $user->setImg('avatar-dafault.png');

        //check Roles value
        if($roles > 0 && $roles <= 2 ){

            $user->setRoles($roles);

        } else {

            //Redirection to edit form
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
            $this->Redirection('user/edit/' . $user->getId());
            //Post error message in the view
            $_SESSION['errorMessage'] = 'User Roles must be \'user\' or \'admin\'.';
            //stop the script
            exit;
        }

        //Clear datas html entities
        $clearPseudo = $this->ClearData($pseudo);
        $clearEmail = $this->ClearData($email);
        $clearPassword = $this->ClearData($password);

        //If pseudo is edit
        if($clearPseudo !== $user->getPseudo()){

            //Check spaces and string length
            $checkPseudo = $this->CheckPseudo($clearPseudo);

            //if pseudo edit is under 4 characters or have spaces
            if($checkPseudo == true){

                //Check if pseudo is unique in database
                $uniquePseudo = $this->CheckUniquePseudo($clearPseudo);

                if ($uniquePseudo == true) {

                    $user->setPseudo($clearPseudo);
                
                } else {

                    //Redirection to edit form
                    //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                    $this->RedirectionWithErrorMessage('user/edit/' . $user->getId(), 'Pseudo is already assign, please choose another one');

                }
                
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->RedirectionWithErrorMessage('user/edit/' . $user->getId(), 'The pseudo requires 4 characters without space');
                
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
                $this->RedirectionWithErrorMessage('user/edit/' . $user->getId(), 'Email is already register');

            }
        }

        //If password is edit
        if($clearPassword !== $user->getPassword()){

            //Check spaces and string length
            $checkPassword = $this->CheckPassword($clearPassword);

            //if password edit is under 6 characters or have spaces
            if($checkPassword == true){

                //Else hash password in database
                $user->setPassword(password_hash($clearPassword, PASSWORD_BCRYPT));
                
            } else {

                //Redirection to edit form
                //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/user/edit/' . $user->getId());
                $this->RedirectionWithErrorMessage('user/edit/' . $user->getId(), 'the password requires 6 characters without spaces');

            } 
        }
        
        //Update in database
        $user->update();

        //Redirection after edit
        $this->Redirection('user/'. $user->getId());
    }

    /**
     * Clean spaces in string
     *
     * @param string $string
     * @return bool
     */
    public static function TrimString(string $string): bool
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
     * Check string length
     *
     * @param string $string
     * @param int $number
     * @return bool
     */
    public static function CheckStringLength(string $string, int $number): bool
    {
        //if string length is under X characters
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
    public static function CheckUniquePseudo(string $string): bool
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
    public static function CheckUniqueEmail(string $string): bool
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
     * Check pseudo - spaces and length
     *
     * @param string $string
     * @return bool
     */
    public function CheckPseudo(string $string): bool
    {
        //Find spaces
        $clearPseudo = $this->TrimString($string);

        //If no spaces
        if($clearPseudo == true) {

            //check length string
            $clearPseudo = $this->CheckStringLength($string, 4);

            //if length ok
            if($clearPseudo == true) {

                return true;

            } else {

                return false;
            }

        } else {

            return false;
        }
    }

    /**
     * Check password - spaces and length
     *
     * @param string $string
     * @return bool
     */
    public function CheckPassword(string $string): bool
    {
        //Find spaces
        $clearPassword = $this->TrimString($string);

        //If no spaces
        if($clearPassword == true) {

            //check length string
            $clearPassword = $this->CheckStringLength($string, 6);

            //if length ok
            if($clearPassword == true) {

                return true;

            } else {

                return false;
            }

        } else {

            return false;
        }
    }

}