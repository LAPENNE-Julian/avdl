<?php

namespace App\Controllers\backoffice;

use App\Controllers\CoreController;
use App\Models\Category;

class CategoryController extends CoreController
{
    public function browse()
    {
        //Get categories in database
        $categoriesList = Category::findAll();

        $this->show('backoffice/category/browse', [
            'categories' => $categoriesList,
        ]);
    }

    public function read($id)
    {
        //Get category by id
        $category = Category::find($id);

        if($category == null){
 
            $this->errorController->err404();

        } else {

                $this->show('backoffice/category/read', [
                'category' => $category,
            ]);
        }
    }

    public function edit($id)
    {
        //Get category by id
        $category = Category::find($id);

        if($category == null){
 
            $this->errorController->err404();

        } else {

                $this->show('backoffice/category/form', [
                'category' => $category,
            ]);
        }
    }

    public function editPost($id)
    {
        //Get category by id
        $category = Category::find($id);

        //Get input values
        $name = filter_input(INPUT_POST, 'name');
        $color = filter_input(INPUT_POST, 'color');
        // $img = filter_input(INPUT_POST, 'img');

        //Clear datas html entities
        $clearName = $this->ClearData($name);
        $clearColor = $this->ClearData($color);

        //Clean spaces in category name
        $newName = $this->TrimCategoryName($clearName);
        
        //Set property category object
        $category->setName($newName);
        $category->setColor($clearColor);
        $category->setSlug($this->MakeSlugName($name));

        //Update in database
        $category->update();

        //Redirection after edit
        // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category/'. $category->getId());
        $this->RedirectionWithId('/backoffice/category/', $category->getId());
    }

    /**
     * Clean spaces in category name
     *
     * @param string $categoryName
     * @return string
     */
    public static function TrimCategoryName(string $categoryName) :string 
    {
        //Remove spaces in name edit
        $categoryNameTrim = trim($categoryName);

        //if nameTrim edit is under 2 characters
        if(strlen($categoryNameTrim) < 2 ){
            
            //Redirection to edit form
            header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category/edit/'. $category->getId());
            //Post error message in the view
            $_SESSION['errorMessage'] = 'the name requires 2 characters without space';
            //stop the script
            exit;
        }

        return $categoryNameTrim;
    }

    /**
     * Slugify the given string 
     *
     * @param string $toBeSlugged
     * @return string
     */
    public static function MakeSlugName(string $toBeSlugged) :string 
    {
        // to lowercase
        // replace ' ' by '-'
        
        $slug = $toBeSlugged;
        $slug = trim($slug);
        $slug = strtolower($slug);
        $slug = str_replace(" ", "-", $slug);

        return $slug;
    }
}