<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected $model;

    /**
     * UsersController constructor.
     * @param UserRepositoryInterface $model
     */
    public function __construct(UserRepositoryInterface $model)
    {
        $this->model = $model;
    }

    public function profile()
    {
        $user = $this->model->get(auth()->id());
        return new UserResource($user);
    }

    public function updateProfile(Request $request)
    {
        $this->model->update(auth()->id(), $request->json()->all());
    }
}
