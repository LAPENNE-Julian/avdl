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
}