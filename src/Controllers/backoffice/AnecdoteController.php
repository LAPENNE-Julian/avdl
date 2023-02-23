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
        $clearTitle = $this->clearData($title);
        $clearDescription = $this->clearData($description);
        $clearContent = $this->clearData($content);
        $clearSource = $this->clearData($source);

        //Check categories are unique
        $categories = $this->checkUniqueCategoryValue($category1, $category2, $category3);

        $c1 = $categories['c1'];
        $c2 = $categories['c2'];
        $c3 = $categories['c3'];

        //Set Category1
        if($c1 == 0){
            //Set category
            $anecdote->setCategory1(null);

        } else {

            $clearCategory1 = $this->checkCategoryIdExist($c1);

            if($clearCategory1 == false ){
                //Set category
                $anecdote->setCategory1(null);

            } else {
                $anecdote->setCategory1($c1);

            }
        }

        //Set Category2
        if($c2 == 0){
            //Set category
            $anecdote->setCategory2(null);

        } else {

            $clearCategory2 = $this->checkCategoryIdExist($c2);

            if($clearCategory2 == false ){
                //Set category
                $anecdote->setCategory2(null);

            } else {
                $anecdote->setCategory2($c2);

            }
        }

        //Set Category3
        if($c3 == 0){

            //Set category
            $anecdote->setCategory3(null);

        } else {

            $clearCategory3 = $this->checkCategoryIdExist($c3);

            if($clearCategory3 == false ){
                //Set category
                $anecdote->setCategory3(null);

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
        $this->redirection('backoffice/anecdote/' .  $anecdote->getId());
    }

    public function add()
    {
        //Get all categories
        $categories = Category::findAll();

        //Create new anecdote object
        $this->show('/backoffice/anecdote/form', [
            'anecdote' => new Anecdote(),
            'categories' => $categories,
        ]);
    }

    public function addPost()
    {
        //Get input values
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $content = filter_input(INPUT_POST, 'content');
        // $img = filter_input(INPUT_POST, 'img');
        $source = filter_input(INPUT_POST, 'source', FILTER_VALIDATE_URL);
        $category1 = filter_input(INPUT_POST, 'category-1');
        $category2 = filter_input(INPUT_POST, 'category-2');
        $category3 = filter_input(INPUT_POST, 'category-3');

        //Create new object anecdote
        $anecdote = new anecdote();

        //Clear datas html entities
        $clearTitle = $this->clearData($title);
        $clearDescription = $this->clearData($description);
        $clearContent = $this->clearData($content);
        $clearSource = $this->clearData($source);

        //Check categories are unique
        $categories = $this->checkUniqueCategoryValue($category1, $category2, $category3);

        $c1 = $categories['c1'];
        $c2 = $categories['c2'];
        $c3 = $categories['c3'];

        //Set Category1
        if($c1 == 0){
            //Set category
            $anecdote->setCategory1(null);

        } else {

            $clearCategory1 = $this->checkCategoryIdExist($c1);

            if($clearCategory1 == false ){
                //Set category
                $anecdote->setCategory1(null);

            } else {
                $anecdote->setCategory1($c1);

            }
        }

        //Set Category2
        if($c2 == 0){
            //Set category
            $anecdote->setCategory2(null);

        } else {

            $clearCategory2 = $this->checkCategoryIdExist($c2);

            if($clearCategory2 == false ){
                //Set category
                $anecdote->setCategory2(null);

            } else {
                $anecdote->setCategory2($c2);

            }
        }

        //Set Category3
        if($c3 == 0){

            //Set category
            $anecdote->setCategory3(null);

        } else {

            $clearCategory3 = $this->checkCategoryIdExist($c3);

            if($clearCategory3 == false ){
                //Set category
                $anecdote->setCategory3(null);

            } else {
                $anecdote->setCategory3($c3);

            }
        }

        //Set property anecdote object
        $anecdote->setTitle($clearTitle);
        $anecdote->setDescription($clearDescription);
        $anecdote->setContent($clearContent);
        $anecdote->setsource($clearSource);
        // $anecdote->setWriterId($_SESSION['userId']);
        $anecdote->setWriterId(1);
        
        //Insert in database 
        $anecdote->insert();

        //Redirection after insert
        //And post success message
        //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote');
        $this->redirectionWithMessage('backoffice/anecdote', 'successMessage', 'the anecdote => id : ' . $anecdote->getId() . ' created successfully');
    }

    public function delete($id)
    {
        $anecdote = Anecdote::find($id);

        if($anecdote == null){
 
            $this->errorController->err404();

        } else {

            //Delete anecdote
            $anecdote->delete();

            //Redirection after delete
            //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote');
            $this->redirection('backoffice/anecdote');
        }
    }

    /**
    * Check category id in database
    *
    * @param int|string $categoryValue
    */
    protected function checkCategoryIdExist($categoryId){

        $category = Category::find($categoryId);

        if (!empty($category) || $category != null || $category != false) {

            return true;

        } else {

            return false;
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
    protected function checkUniqueCategoryValue($category1, $category2, $category3){

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

        //Default categories array to return
        $array = [
            'c1' => $category1,
            'c2' => $category2,
            'c3' => $category3,
        ];

        //In case, category1 is null, category2 is null, category3 is not null
        if ($category1 == 0 && $category2 == 0 && $category3 !== 0){

            //Default categories array change
            return $array = [
                'c1' => $category3,
                'c2' => $category1,
                'c3' => $category2,
            ];
        }

        //In case, category1 is null, category2 is not null, category3 is null
        if ($category1 == 0 && $category2 !== 0 && $category3 == 0){

            //Default categories array change
            return $array = [
                'c1' => $category2,
                'c2' => $category1,
                'c3' => $category3,
            ];
        }

        //In case, category1 is not null, category2 is null, category3 is not null
        if ($category1 !== 0 && $category2 == 0 && $category3 !== 0){

            //Default categories array change
            return $array = [
                'c1' => $category1,
                'c2' => $category3,
                'c3' => $category2,
            ];
        }

        //In case, category1 is null, category2 is not null, category3 is not null
        if ($category1 == 0 && $category2 !== 0 && $category3 !== 0){

            //Default categories array change
            return $array = [
                'c1' => $category2,
                'c2' => $category3,
                'c3' => $category1,
            ];
        }

        return $array;
    }
}