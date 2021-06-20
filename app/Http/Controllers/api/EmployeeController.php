<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeesCollection;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return EmployeesCollection
     */
    public function index(): EmployeesCollection
    {
        $employees = QueryBuilder::for(Employee::class)->allowedSorts([
            'name',
            'email',
            'created_at',
            'updated_at'
        ])->jsonPaginate();
        return new EmployeesCollection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEmployeeRequest $request
     * @return JsonResponse
     */
    public function store(CreateEmployeeRequest $request): JsonResponse
    {
        $employee = Employee::create([
            'name' => $request->input('data.attributes.name'),
            'email' => $request->input('data.attributes.email')
        ]);

        return (new EmployeeResource($employee))
            ->response()
            ->header('Location', route('employees.show', ['employee' => $employee]));
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function show(Employee $employee): EmployeeResource
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->update($request->input('data.attributes'));
        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee): Response
    {
        $employee->delete();
        return response(null, 204);
    }
}
