<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentsController extends Controller
{
    /**
     * @var StudentRepositoryInterface
     */
    private $model;

    public function __construct(StudentRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'student_number' => 'required'
        ]);

        $request->request->add(['code' => 'student_number']);

        $this->model->create( $request->all() );
    }

    public function addByParent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'student_number' => 'required|unique:students'
        ]);

        $request->request->add(['code' => 'student_number']);

        $request->request->add(['user_id' => auth()->id()]);

        $student = $this->model->create( $request->json()->all() );

        return new StudentResource($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return StudentResource
     */
    public function show($id)
    {
        $student = $this->model->get($id);

        return new StudentResource($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->request->add(['code' => 'student_number']);

        $this->model->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
