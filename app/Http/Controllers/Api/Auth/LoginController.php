<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Objects\Error;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class LoginController extends Controller
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

    public function login(Request $request)
    {

        $response = $this->makeAuth($request);

        if($response->getStatusCode() == 200){

            $user = $this->model->getByEmail($request->json('email'));

            return new LoginResource($user, $response->getContent());
        }

        return response()->json([
            'message' => 'Giriş bilgileriniz hatalı'], 400);

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
