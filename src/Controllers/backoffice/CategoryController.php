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

        if ($newName == false) {
            
            //Post error message in the view and redirection to edit form
            // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category/edit/'. $category->getId());
            $this->RedirectionWithMessage('category/edit/'. $category->getId(), 'errorMessage', 'The name requires 2 characters without space');

        } else {

            //Set property category object
            $category->setName($newName);
            $category->setColor($clearColor);
            $category->setSlug($this->MakeSlugName($name));

            //Update in database
            $category->update();

            //Redirection after edit
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category/'. $category->getId());
            $this->Redirection('category/'. $category->getId());
        }   
    }

    public function add()
    {
        //Create new category object
        $this->show('backoffice/category/form', [
            'category' => new Category(),
        ]);
    }

    public function addPost()
    {
        //Get input values
        $name = filter_input(INPUT_POST, 'name');
        $color = filter_input(INPUT_POST, 'color');
        // $img = filter_input(INPUT_POST, 'img');

        //Create new object category
        $category = new Category();

        //Clear datas html entities
        $clearName = $this->ClearData($name);
        $clearColor = $this->ClearData($color);

        //Clean spaces in category name
        $newName = $this->TrimCategoryName($clearName);

        if($newName == false){

            //Post error message in the view and redirection to add form
            // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category/edit/'. $category->getId());
            $this->RedirectionWithMessage('category/add', 'errorMessage', 'The name requires 2 characters without space');

        } else {

            //Set property category object
            $category->setName($newName);
            $category->setColor($clearColor);
            $category->setSlug($this->MakeSlugName($name));
            
            //Insert in database 
            $category->insert();

            // Post success message and redirection after insert
            // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category');
            $this->RedirectionWithMessage('category', 'successMessage','The category : ' . $category->getName() .' => id : ' . $category->getId() . ' created successfully');
        }
    }

    public function delete($id)
    {
        //Get category by id
        $category = Category::find($id);

        if($category == null){
 
            $this->errorController->err404();

        } else {

            //Delete category
            $category->delete();

            //Redirection after delete
            // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/category');
            $this->Redirection('category');
        }
    }

    /**
     * Clean spaces in category name
     *
     * @param string $categoryName
     * @return string|bool
     */
    protected static function TrimCategoryName(string $categoryName)
    {
        //Remove first and last spaces in name edit
        $categoryNameTrim = trim($categoryName);

        //if nameTrim edit is under 2 characters
        if(strlen($categoryNameTrim) < 2 ){

            return false;
        }

        return $categoryNameTrim;
    }

    /**
     * Slugify the given string 
     *
     * @param string $toBeSlugged
     * @return string
     */
    protected static function MakeSlugName(string $toBeSlugged) :string 
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