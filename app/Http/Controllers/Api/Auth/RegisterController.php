<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    private $client;
    /**
     * @var UserRepositoryInterface
     */
    protected $model;

    public function __construct(UserRepositoryInterface $model)
    {
        $this->client  = Client::find(2);
        $this->model = $model;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = $this->model->create($request);

        $response = $this->makeAuth($request);

        if($response->getStatusCode() == 200){

            return new UserResource($user);
        }

    }

    /**
     * @param Request $request
     * @return array
     */
    private function makeAuth(Request $request): object
    {
        //handle login request
        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->json('email'),
            'password' => $request->json('password'),
            'scope' => '',
        ];

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return  Route::dispatch($proxy);

    }
}
