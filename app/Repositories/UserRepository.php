<?php namespace App\Repositories;


use App\User;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function get($id)
    {
        return User::find($id);
    }

    public function getByEmail($email)
    {
        return User::where('email', $email)->firstOrFail();
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id)
    {
        User::destroy($id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     * @return
     */
    public function update($id, array $data)
    {
        $user = auth()->user();
        $user->update($data);
        return $user;
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->json('name'),
            'email'     => $request->json('email'),
            'password'  => bcrypt($request->json('password'))
        ]);

        return $user;
    }
}
