<?php

namespace App\Controllers;

class CategoryController extends CoreController
{
    public function browse()
    {
        $this->show('category/browse', [
            
        ]);
    }
}