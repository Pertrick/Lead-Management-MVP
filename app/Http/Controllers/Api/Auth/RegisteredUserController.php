<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;


use App\Providers\RouteServiceProvider;
use App\Http\Requests\Api\Auth\RegistrationRequest;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(RegistrationRequest $request) : UserResource
    {
        $user = $request->createUser();

        return new UserResource($user);
    }
}
