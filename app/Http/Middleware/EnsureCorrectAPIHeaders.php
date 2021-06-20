<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCorrectAPIHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->headers->get('accept') !== 'application/vnd.api+json'){
            return response('', 406);
        }

        $url = $request->path();

        if($request->headers->has('content-type') || $request->isMethod('POST') || $request->isMethod('PATCH')){
            if($request->header('content-type') !== 'application/vnd.api+json' && $url != 'api/user/login'){
                return response('', 415);
            }
        }

        return $this->addCorrectContentType($next($request));

    }


    /**
     * Adds content-type to the response according to JSON:API Specification
     *
     * @param Response $response
     * @return Response
     */
    private function addCorrectContentType(Response $response): Response
    {
        $response->headers->set('content-type', 'application/vnd.api+json');
        return $response;
    }
}
