<?php

namespace App\Controllers\Api;

use App\Controllers\api\ApiCoreController;
use App\Models\Anecdote;
use App\Models\User;

class AnecdoteController extends ApiCoreController
{
    /**
     * Get all anecdotes with category.
     * 
     * Route("api/anecdote", name="api-anecdote-browse", methods="GET")
     */
    public function browse(int $offsetNum)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get all anecdotes in database
            $anecdotes = Anecdote::browse($offsetNum);

            $this->apiResponse->responseAsArray(200, 'anecdotes', $anecdotes);
        
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }
}

