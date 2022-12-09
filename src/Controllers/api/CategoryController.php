<?php

namespace App\Controllers\Api;

use App\Controllers\api\ApiCoreController;
use App\Models\Anecdote;
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

    /**
     * Get category anecdotes page (9 anecdotes by page).
     * 
     * Route("api/category/{categoryId}/anecdote/page/{Id}", name="api-category-browse-anecdotes-page", methods="GET")
     */
    public function browsePage(int $categoryId, int $pageNum)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get offset with page number * 9 anecdotes
            $offset = $pageNum * 9;

            //Get all anecdotes in database
            $anecdotes = Category::browsePage($categoryId, $offset);

            $this->apiResponse->responseAsArray(200, 'anecdotes', $anecdotes);
        
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Get the number of page.
     * 
     * Route("api/category/{categoryId}/anecdote/page", name="api-category-browse-anecdote-page-number", methods="GET")
     */
    public function PageNumber($categoryId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get all anecdotes by categoryId in database
            $AllCategoryAnecdotes = Category::findAnecdotes($categoryId);

            //Get count of anecdotes in database
            $anecdotesNumber = count($AllCategoryAnecdotes) - 1 ;

            //Get number page with 9 anecdotes by pages
            $pageNumber = $anecdotesNumber / 9 ;

            //Round up result - 1 => first page = 0
            $pageNumberRound = ceil($pageNumber) - 1 ;
            
            $this->apiResponse->responseAsArray(200, 'totalPages', $pageNumberRound);
        
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }
}
