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
}