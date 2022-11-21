<?php

namespace App\Controllers\Api;

use App\Controllers\api\ApiCoreController;

use App\Models\Category;

class CategoryController extends ApiCoreController
{
    /**
     * Get all categories.
     * 
     * Route("api/category", name="api-category-browse", methods="GET")
     */
    public function browse()
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            $categories = Category::browse();

            $this->apiResponse->responseAsArray(200, 'categories', $categories);

        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Get all anecdotes by category Id.
     * 
     * Route("api/category/{categoryId}/anecdote", name="api-category-browse-anecdotes", methods={"GET"})
     */
    public function browseAnecdotes(int $categoryId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //not table anecdote_category , refaire requete
            $checkCategoryId = $this->apiResponse->categoryIdCheckInDatabase($categoryId);

            if($checkCategoryId == true){
                $anecdotes = Category::browseAnecdotes($categoryId);

                $this->apiResponse->responseAsArray(200, 'anecdotes', $anecdotes);
            }
            
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }
}
