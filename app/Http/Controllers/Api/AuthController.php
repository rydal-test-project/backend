<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

class AuthController extends Controller
{

    /**
     *
     */
    public function getUser(): UserResource
    {
        return UserResource::make(Auth::user());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $clientId = 2;
        $data = array_merge($request->only(['password']), [
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => Client::find($clientId)->secret,
            'username' => $request->email
        ]);

        $request = Request::create('oauth/token', 'POST', $data);

        return app()->handle($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function refresh(Request $request)
    {
        $clientId = 2;
        $data = array_merge($request->only(['password']), [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => $clientId,
            'client_secret' => Client::find($clientId)->secret,
            'scope' => '',
        ]);

        $request = Request::create(route('oauth/token/refresh '), 'POST', $data);

        return app()->handle($request);
    }
}
