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
        // $clearCategory1 = $this->ClearData($category1);
        // $clearCategory2 = $this->ClearData($category2);
        // $clearCategory3 = $this->ClearData($category3);

        //Set property anecdote object
        $anecdote->setTitle($clearTitle);
        $anecdote->setDescription($clearDescription);
        $anecdote->setContent($clearContent);
        $anecdote->setsource($clearSource);
        $anecdote->setCategory1($category1);
        $anecdote->setCategory2($category2);
        $anecdote->setCategory3($category3);
        
        //Update anecdote in database 
        $anecdote->update();

        //Redirection after edit
        //header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/backoffice/anecdote/'. $anecdote->getId());
        $this->Redirection('anecdote/' .  $anecdote->getId());
    }
}