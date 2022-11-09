<?php

namespace App\Controllers\backoffice;

use App\Controllers\CoreController;
use App\Models\Anecdote;
use App\Models\Category;

class AnecdoteController extends CoreController
{
    public function browse()
    {
        //Get anecdotes in database
        $anecdotesList = Anecdote::findAll();

        $this->show('/backoffice/anecdote/browse', [
            'anecdotes' => $anecdotesList,
        ]);
    }

    public function read($id)
    {
        //Get anecdote by id
        $anecdote = Anecdote::find($id);

        if($anecdote == null){
 
            $this->errorController->err404();

        } else {

            $this->show('/backoffice/anecdote/read', [
                'anecdote' => $anecdote,
            ]);
        }
    }

    public function edit($id)
    {
        //Get all categories
        $categories = Category::findAll();

        //Get anecdote by id
        $anecdote = Anecdote::find($id);

        if($anecdote == null){
 
            $this->errorController->err404();

        } else {

            $this->show('/backoffice/anecdote/form', [
                'anecdote' => $anecdote,
                'categories' => $categories,
            ]);
        }
    }

    public function editPost($anecdoteId)
    {
        //Get anecdote by id
        $anecdote = Anecdote::find($anecdoteId);

        //Get input values
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $content = filter_input(INPUT_POST, 'content');
        // $img = filter_input(INPUT_POST, 'img');
        $source = filter_input(INPUT_POST, 'source', FILTER_VALIDATE_URL);
        $category1 = filter_input(INPUT_POST, 'category-1');
        $category2 = filter_input(INPUT_POST, 'category-2');
        $category3 = filter_input(INPUT_POST, 'category-3');

        //Clear datas html entities
        $clearTitle = $this->ClearData($title);
        $clearDescription = $this->ClearData($description);
        $clearContent = $this->ClearData($content);
        $clearSource = $this->ClearData($source);

        $clearCategories = $this->CheckClearCategory($category1, $category2, $category3);

        if($clearCategories == true){

            //Check categories are unique
            $categories = $this->CheckUniqueCategoryValue($category1, $category2, $category3);
        
            extract($categories);

            //If category selected value = 0, set category null
            $categoryValue1 = $this->SetNullCategory($c1);
            $categoryValue2 = $this->SetNullCategory($c2);
            $categoryValue3 = $this->SetNullCategory($c3);
            
            //Set category
            $anecdote->setCategory1($categoryValue1);
            $anecdote->setCategory2($categoryValue2);
            $anecdote->setCategory3($categoryValue3);

        } else {

            //Post error message in the view and redirection to edit form
            // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote/edit/'. $anecdote->getId());
            $this->RedirectionWithMessage('anecdote/edit/'. $anecdote->getId(), 'errorMessage', 'Please choose 3 differents categories or null');
        }

        //Set property anecdote object
        $anecdote->setTitle($clearTitle);
        $anecdote->setDescription($clearDescription);
        $anecdote->setContent($clearContent);
        $anecdote->setsource($clearSource);
        
        //Update anecdote in database 
        $anecdote->update();

        //Redirection after edit
        //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote/'. $anecdote->getId());
        $this->Redirection('anecdote/' .  $anecdote->getId());
    }

    /**
     * Set category null for value 0
     *
     * @param int $categoryValue
     * @return null
     */
    protected static function SetNullCategory($categoryValue){

        if($categoryValue == 0){

             return $categoryValue = null;

        } else {

            return $categoryValue;
        }
    }

    /**
     * Clear category value
     *
     * @param int|null|string $categoryValue
     * @return null|bool
     */
    protected function ClearCategoryData($categoryValue){

        //Check if category value is an integer
        $categoryIsInteger = is_numeric($categoryValue);

        if($categoryIsInteger == true && $categoryValue !== 0){

            $category = Category::find($categoryValue);

            if($category !== null || $category !== false) {

                return $category->getId();

            } else {

                return false;
            }
        }
    }

    /**
     * Check Clear category value not return false
     *
     * @param int|bool $category
     * @return 
     */
    protected function CheckClearCategory($category1, $category2, $category3){

        $clearCategory1 = $this->ClearCategoryData($category1);
        $clearCategory2 = $this->ClearCategoryData($category2);
        $clearCategory3 = $this->ClearCategoryData($category3);

        if($clearCategory1 !== false || $clearCategory1 == 0 
        && $clearCategory2 !== false || $clearCategory2 == 0
        && $clearCategory3 !== false || $clearCategory3 == 0) {

            return true;

        } else {

            return false;
        }
    }

    /**
     * Removes duplicate category values
     *
     * @param int|null $category1
     * @param int|null $category2
     * @param int|null $category3
     * @return array
     */
    protected function CheckUniqueCategoryValue($category1, $category2, $category3){

        if ($category1 == $category2) {

            $category2 = 0;
        }

        if ($category1 == $category3) {

            $category3 = 0;
        }

        if ($category2 == $category3) {

            $category3 = 0;
        }

        $array = [
            'c1' => $category1,
            'c2' => $category2,
            'c3' => $category3,
        ];

        return $array;
    }
}