<?php

namespace App\Controllers;

class AnecdoteController extends CoreController
{
    public function browse()
    {
        $this->show('anecdote/browse', [
            
        ]);
    }

    public function read($id)
    {
        $this->show('anecdote/read', [
            
        ]);
    }

    public function random()
    {
        $this->show('anecdote/read', [
            
        ]);
    }

    public function best()
    {
        $this->show('anecdote/browse', [
            
        ]);
    }

    public function bestRead()
    {
        $this->show('anecdote/read', [
            
        ]);
    }
}