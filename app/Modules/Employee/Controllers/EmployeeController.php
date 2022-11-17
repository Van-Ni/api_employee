<?php

namespace App\Modules\Employee\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Employee\Requests\DestroyEmployeeRequest;
use App\Modules\Employee\Requests\EmployeeRequest;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;

class EmployeeController extends Controller
{
    private $employeeService;
    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    /**
     * get employees by company
     * @param $id
     * @return Response
     */
    public function getByCompanyId($id)
    {
        return $this->employeeService->getByCompanyId($id);
    }
    /**
     * get employee by id
     * @param $id
     * @return Response
     */
    public function getById($id)
    {
        return $this->employeeService->getById($id);
    }
    /**
     * create employee
     * @param EmployeeRequest $request
     * @return Response
     */
    public function create(EmployeeRequest $request)
    {
        return $this->employeeService->create($request);
    }
    /**
     * update employee
     * @param EmployeeRequest $request
     * @param $id
     * @return Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        return $this->employeeService->update($request, $id);
    }
    /**
     * delete employee
     * @param $id
     */
    public function delete($id)
    {
        return $this->employeeService->delete($id);
    }
    public function destroy(DestroyEmployeeRequest $request)
    {
        return $this->employeeService->destroy($request);
    }
}
