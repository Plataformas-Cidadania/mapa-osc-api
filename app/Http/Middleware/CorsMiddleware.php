<?php

/**
 * Location: /app/Http/Middleware
 */
namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, x-csrf-token'
        ];

        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        //////////////////////////////////////////////////////////////
        //BLOCO ALTERADO EM FUNÇÃO DA AUTENTICAÇÃO COM PASSPORT QUE UTILIZA UM RESPONSE DIFERENTE
        //DESTA FORMA SÃO COLOCADAS AS CODINDIÇÕES PARA VERIFICAR QUAL RESPONSE ESTÁ SENDO UTILIZADO.

        /*foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }*/

        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';

        if($response instanceof $IlluminateResponse) {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }
            return $response;
        }

        if($response instanceof $SymfonyResopnse) {
            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }
            return $response;
        }
        //////////////////////////////////////////////////////////////


        return $response;
    }
}
