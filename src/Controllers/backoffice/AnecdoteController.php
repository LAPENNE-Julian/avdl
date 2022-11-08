<?php

namespace App\Controllers\backoffice;

use App\Controllers\CoreController;
use App\Models\Anecdote;

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

        //Get all former categories of the anecdote
        $categoriesAnecdote = Anecdote::getCategoryAnecdote($id);

        if($anecdote == null){
 
            $this->errorController->err404();

        } else {

            $this->show('/backoffice/anecdote/read', [
                'anecdote' => $anecdote,
                'categoriesAnecdote' => $categoriesAnecdote,
            ]);
        }
    }
}