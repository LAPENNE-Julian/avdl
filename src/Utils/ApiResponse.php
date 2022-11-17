<?php 

namespace App\Utils;

use App\Models\Anecdote;
use App\Models\Category;
use App\Models\User;

/**
 * Generate response for api
 */
class ApiResponse
{
    /**
    * Response as an Array
    */
    public function responseAsArray(int $code, $key, $message) {

        $responseAsArray = [
            'code' => $code,
            $key => $message,
        ];

        //retur JSON type with character
        header('Content-Type: application/json; charset=UTF-8', true, $responseAsArray['code']);

        echo json_encode($responseAsArray);
    }

    /**
    * Configuration for the Header response 
    */
    public function setHeader($httpMethod) {

        //Allowed method for this request
        header("Access-Control-Allow-Methods: {$httpMethod}");
        // time -> header("Access-Control-Max-Age:3600");
        //allow headers for clients parts
        header("Access-control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-Width");
        //authorize all port origin
        header('Access-Control-Allow-Origin: *');
    }

    /**
    * Check request anecdote Id in database
    */
    public function checkAnecdoteId($anecdotes, int $anecdoteId) {

        foreach($anecdotes as $anecdote) {

            $anecdoteIdinArray = $anecdote['id'];

            if ($anecdoteId == $anecdoteIdinArray) {

                return true;
            }
        }

        //Else, $anecdoteId isn't in databse, post message error
        http_response_code(404);
        echo json_encode(["message" => 'message', 'This anecdoteId isn\'t valid']);
        exit;
    }
}