<?php
namespace App\Controllers\api;

use App\Utils\ApiResponse;

class ApiCoreController
{
    protected $apiResponse;
    
    
    public function __construct()
    {
        $this->apiResponse = new ApiResponse();

    }
}