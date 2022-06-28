<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
*    @OA\Info(
*       title="Shopping List API",
*       version="1.0.0",
*       description="Shopping List is a simple project to manage shopping lists via API REST.<br>This is allow shopping list to be created, updated and deleted using request in JSON format and standard HTTP verbs.<br>Bellow, you can check the docs out and learn how to use.",
*    )
*    @OA\SecurityScheme(
*       type="http",
*       scheme="bearer",
*       securityScheme="bearerAuth"
*    )
*    @OA\Tag(
*       name="Authentication"
*    )
*    @OA\Tag(
*       name="Shopping Lists"
*    )
*    @OA\Tag(
*       name="Products"
*    )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
