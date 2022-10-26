<?php

namespace App\Controllers;

class AnecdoteController extends CoreController
{
    public function read($id)
    {
        $this->show('anecdote/read', [
            
        ]);
    }
}