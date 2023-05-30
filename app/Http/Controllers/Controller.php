<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Exceptions\HttpResponseException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
	* Emite uma excessão generica.
	*/
	public static function emitException($message, $code = 500, $title = 'Error')
	{
		throw new HttpResponseException(response()->json([ 
            'success' => false, 
            'message' => $title, 
            'data' => ['msg' => $message]
        ], $code)); 
	}
}
