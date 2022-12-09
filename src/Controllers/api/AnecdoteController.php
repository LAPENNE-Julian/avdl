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
     * Get anecdotes page (9 anecdotes by page).
     * 
     * Route("api/anecdote/page/{Id}", name="api-anecdote-browse-page", methods="GET")
     */
    public function browsePage(int $pageNum)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get offset with page number * 9 anecdotes
            $offset = $pageNum * 9;

            //Get all anecdotes in database
            $anecdotes = Anecdote::browsePage($offset);

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
     * Route("api/anecdote/page", name="api-anecdote-page-number", methods="GET")
     */
    public function PageNumber()
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            //Get all anecdotes in database
            $Allanecdotes = Anecdote::findAll();

            //Get count of anecdotes in database
            $anecdotesNumber = count($Allanecdotes) - 1 ;

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
     * Navigation to read previous of all anecdotes.
     * 
     * Route("api/anecdote/[i:id]/prev", name="api-anecdote-read-previous", methods="GET")
     */
    public function readPrevious(int $anecdoteId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Get all anecdotes in database
            $anecdotes = Anecdote::browse();

            $checkAnecdoteId = $this->apiResponse->checkAnecdoteId($anecdotes, $anecdoteId);

            if ($checkAnecdoteId == true) {
                //Get previous anecdoteId
                $previousAnecdoteId = $this->apiNavigationAnecdote->previous($anecdotes, $anecdoteId);

                $previousAnecdote = Anecdote::read($previousAnecdoteId);

                $this->apiResponse->responseAsArray(200, 'anecdote', $previousAnecdote);
            }
        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Navigation to read next of all anecdotes.
     * 
     * Route("api/anecdote/[i:id]/next", name="api-anecdote-read-next", methods="GET")
     */
    public function readNext(int $anecdoteId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Get all anecdotes in database
            $anecdotes = Anecdote::browse();

            $checkAnecdoteId = $this->apiResponse->checkAnecdoteId($anecdotes, $anecdoteId);

            if ($checkAnecdoteId == true) {
                //Get next anecdoteId
                $nextAnecdoteId = $this->apiNavigationAnecdote->next($anecdotes, $anecdoteId);

                $nextAnecdote = Anecdote::read($nextAnecdoteId);

                $this->apiResponse->responseAsArray(200, 'anecdote', $nextAnecdote);
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

    /**
     * Read an best anecdote by id.
     * 
     * Route("api/anecdote/best/[i:id]", name="api-anecdote-best-read", methods="GET")
     */
    public function bestRead(int $anecdoteId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Get 5 anecdotes with most upVote
            $bestAnecdotes = Anecdote::best();

            $checkAnecdoteId = $this->apiResponse->checkAnecdoteId($bestAnecdotes, $anecdoteId);

            if ($checkAnecdoteId == true) {
                $bestAnecdote = Anecdote::read($anecdoteId);

                $this->apiResponse->responseAsArray(200, 'anecdote', $bestAnecdote);
            }

        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Navigation to previous in for five anecdotes with the most upVote.
     * 
     * Route("api/anecdote/best/[i:id]/prev", name="api-anecdote-best-previous", methods="GET")
     */
    public function bestPrevious(int $anecdoteId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Get 5 anecdotes with most upVote
            $bestAnecdotes = Anecdote::best();

            $checkAnecdoteId = $this->apiResponse->checkAnecdoteId($bestAnecdotes, $anecdoteId);

            if ($checkAnecdoteId == true) {
                $previousBestAnecdoteId = $this->apiNavigationAnecdote->previous($bestAnecdotes, $anecdoteId);

                $previousBestAnecdote = Anecdote::read($previousBestAnecdoteId);

                $this->apiResponse->responseAsArray(200, 'anecdote', $previousBestAnecdote);
            }

        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }

    /**
     * Navigation to next in five anecdotes with the most upVote.
     * 
     * Route("api/anecdote/best/[i:id]/next", name="api-anecdote-best-next", methods={"GET"})
     */
    public function bestNext(int $anecdoteId)
    {
        $this->apiResponse->setHeader('GET');

        //check if httpMethod is correct
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Get 5 anecdotes with most upVote
            $bestAnecdotes = Anecdote::best();

            $checkAnecdoteId = $this->apiResponse->checkAnecdoteId($bestAnecdotes, $anecdoteId);

            if ($checkAnecdoteId == true) {

                $nextBestAnecdoteId = $this->apiNavigationAnecdote->next($bestAnecdotes, $anecdoteId);

                $nextBestAnecdote = Anecdote::read($nextBestAnecdoteId);

                $this->apiResponse->responseAsArray(200, 'anecdote', $nextBestAnecdote);
            }

        } else {

            //not allowed method
            http_response_code(405);
            echo json_encode(["message" => 'Method isn\'t allowed']);
        }
    }
}

