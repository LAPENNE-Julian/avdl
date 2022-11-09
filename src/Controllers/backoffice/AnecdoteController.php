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

        //Check categories are unique
        $categories = $this->CheckUniqueCategoryValue($category1, $category2, $category3);

        extract($categories);

        //Set Category1
        if($c1 == 0){
            //Set category
            $anecdote->setCategory1(null);

        } else {

            $clearCategory1 = $this->ClearCategoryData($c1);

            if($clearCategory1 == false ){

                //Post error message in the view and redirection to edit form
                // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote/edit/'. $anecdote->getId());
                $this->RedirectionWithMessage('anecdote/edit/'. $anecdote->getId(), 'errorMessage', 'Please choose 3 differents categories or null');
            
            } else {

                $anecdote->setCategory1($c1);

            }
        }

        //Set Category2
        if($c2 == 0){
            //Set category
            $anecdote->setCategory2(null);

        } else {

            $clearCategory2 = $this->ClearCategoryData($c2);

            if($clearCategory2 == false ){

                //Post error message in the view and redirection to edit form
                // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote/edit/'. $anecdote->getId());
                $this->RedirectionWithMessage('anecdote/edit/'. $anecdote->getId(), 'errorMessage', 'Please choose 3 differents categories or null');
            
            } else {

                $anecdote->setCategory2($c2);

            }
        }

        //Set Category3
        if($c3 == 0){
            //Set category
            $anecdote->setCategory3(null);

        } else {

            $clearCategory3 = $this->ClearCategoryData($c3);

            if($clearCategory3 == false ){

                //Post error message in the view and redirection to edit form
                // header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote/edit/'. $anecdote->getId());
                $this->RedirectionWithMessage('anecdote/edit/'. $anecdote->getId(), 'errorMessage', 'Please choose 3 differents categories or null');
            
            } else {

                $anecdote->setCategory3($c3);

            }
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
     * Clear category value
     *
     * @param int|null|string $categoryValue
     * @return null|bool
     */
    protected function ClearCategoryData($categoryValue){

        //Check if category value is an integer
        $categoryIsInteger = is_numeric($categoryValue);

        if($categoryIsInteger == true){

            $category = Category::find($categoryValue);

            if($category !== null || $category !== false) {

                return $category->getId();

            } else {

                return false;
            }
        }
    }

    /**
     * Removes duplicate category values
     * and replace categories null at the end
     *
     * @param int|null $category1
     * @param int|null $category2
     * @param int|null $category3
     * @return array
     */
    protected function CheckUniqueCategoryValue($category1, $category2, $category3){

        //If Category1 duplicate in category2, category2 set null
        if ($category1 == $category2) {

            $category2 = 0;
        }

        //If Category1 duplicate in category3, category3 set null
        if ($category1 == $category3) {

            $category3 = 0;
        }

        //If Category2 duplicate in category3, category3 set null
        if ($category2 == $category3) {

            $category3 = 0;
        }

        //Default categories arrayto return
        $array = [
            'c1' => $category1,
            'c2' => $category2,
            'c3' => $category3,
        ];

        //In case, category1 is null, category2 is null, category3 is not null
        if ($category1 == 0 && $category2 == 0 && $category3 !== 0){

            //Default categories array change
            $array = [
                'c1' => $category3,
                'c2' => $category1,
                'c3' => $category2,
            ];
        }

        //In case, category1 is null, category2 is not null, category3 is null
        if ($category1 == 0 && $category2 !== 0 && $category3 == 0){

            //Default categories array change
            $array = [
                'c1' => $category2,
                'c2' => $category1,
                'c3' => $category3,
            ];
        }

        //In case, category1 is not null, category2 is null, category3 is not null
        if ($category1 !== 0 && $category2 == 0 && $category3 !== 0){

            //Default categories array change
            $array = [
                'c1' => $category1,
                'c2' => $category3,
                'c3' => $category2,
            ];
        }

        //In case, category1 is null, category2 is not null, category3 is not null
        if ($category1 == 0 && $category2 !== 0 && $category3 !== 0){

            //Default categories array change
            $array = [
                'c1' => $category2,
                'c2' => $category3,
                'c3' => $category1,
            ];
        }

        return $array;
    }
}