<?php namespace App\Repositories;


use App\Student;
use App\User;

class StudentRepository implements StudentRepositoryInterface
{

    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return
     */
    public function get($id)
    {
        return Student::find($id);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        return Student::with('parent')->get();
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id)
    {
        Student::destroy($id);
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
        $student = Student::find($id);
        $student->update($data);
        return $student;
    }

    public function create($data)
    {
        return Student::create($data);
    }

    public function updateParent($user, $code)
    {
        $student = Student::where('code', $code)->firstOrFail();
        $student->update(['user_id' => $user->id ]);
        return $student;
    }
}
