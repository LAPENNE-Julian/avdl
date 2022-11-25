<?php

namespace App\Controllers\Api;

use App\Controllers\api\ApiCoreController;
use App\Models\Anecdote;

class AnecdoteController extends ApiCoreController
{
    /**
     * Get all anecdotes with category.
     * 
     * Route("api/anecdote", name="api-anecdote-browse", methods="GET")
     */
    public function browse()
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get all anecdotes in database
            $anecdotes = Anecdote::browse();

            $this->apiResponse->responseAsArray(200, 'anecdotes', $anecdotes);
        
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Get anecdotes page (9 anecdotes by pages).
     * 
     * Route("api/anecdote/page/{Id}", name="api-anecdote-browse-page", methods="GET")
     */
    public function browsePage(int $pageNum)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get all anecdotes in database
            $anecdotes = Anecdote::browsePage($pageNum);

            $this->apiResponse->responseAsArray(200, 'anecdotes', $anecdotes);
        
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Read an anecdote by id.
     * 
     * Route("api/anecdote/[i:id]", name="read", methods="GET")
     */
    public function read(int $anecdoteId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Get all anecdotes in database
            $anecdotes = Anecdote::browse();

            $checkAnecdoteId = $this->apiResponse->checkAnecdoteId($anecdotes, $anecdoteId);

            if ($checkAnecdoteId == true) {
                //Get anecdote by id
                $anecdote = Anecdote::read($anecdoteId);

                $this->apiResponse->responseAsArray(200, 'anecdote', $anecdote);

            }

        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Get random anecdotes.
     * 
     * Route("api/anecdote/random", name="api-anecdote-random",  methods="GET")
     */
    public function random()
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $anecdoteRandomId = Anecdote::random();

            $anecdoteRandom = Anecdote::read($anecdoteRandomId->id);

            $this->apiResponse->responseAsArray(200, 'anecdote', $anecdoteRandom);
        
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Return informations of five anecdotes with the most upVote.
     *
     * Route("api/anecdote/best", name="api-anecdote-best", methods="GET")
     */
    public function best()
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            //Get 5 anecdotes with most upVote
            $bestAnecdotes = Anecdote::best();

            //If no vote
            if (empty($bestAnecdotes)) {
                $randomAnecdotes = Anecdote::randomFive();

                $this->apiResponse->responseAsArray(200, 'anecdotes', $randomAnecdotes);
                exit;
            }

            $this->apiResponse->responseAsArray(200, 'anecdotes', $bestAnecdotes);

        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }  
    }
}

