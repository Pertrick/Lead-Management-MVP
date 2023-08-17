<?php

namespace App\Http\Resources\Api\Traits;

use Illuminate\Http\Response;

trait ResponseStatusCodeTrait
{
       /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
       return  match($request->method()){
            $request->isMethod('GET'),  $request->isMethod('PUT') =>  $response->setStatusCode(Response::HTTP_OK),
            $request->isMethod('POST') =>  $response->setStatusCode(Response::HTTP_CREATED),
            $request->isMethod('DELETE') =>  $response->setStatusCode(Response::HTTP_NO_CONTENT),
            default =>  parent::withResponse($request, $response)
        };
        
    }
}
