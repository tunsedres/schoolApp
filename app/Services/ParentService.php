<?php


namespace App\Services;


use App\Repositories\StudentRepositoryInterface;

class ParentService
{

    /**
     * @var StudentRepositoryInterface
     */
    private $model;

    public function __construct(StudentRepositoryInterface $model)
    {
        $this->model = $model;
    }

    public function updateStudentParentByCode($user, $code)
    {
        return $this->model->updateParent($user, $code);
    }

}
