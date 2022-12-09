<?php
namespace App\Controllers\api;

use App\Utils\ApiNavigationAnecdote;
use App\Utils\ApiResponse;

class ApiCoreController
{
    protected $apiResponse;
    protected $apiNavigationAnecdote;
    
    
    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
        $this->apiNavigationAnecdote = new ApiNavigationAnecdote();

    }
}