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
}