<?php

namespace App\Modules\Employee\Repositories;

use App\Modules\Employee\Models\Employee;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    /**
     * get employees by company
     * @param $id
     * @return mixed
     */
    public function getByCompanyId($id)
    {
        return Employee::where('company_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * get employee by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * create employee
     * @param  $validated
     * @return mixed
     */
    public function create($validated)
    {
        return Employee::create($validated);
    }

    /**
     * update employee
     * @param  $validated
     * @param  $id
     * @return mixed
     */
    public function update($validated, $id)
    {
        $company =  Employee::findOrFail($id);
        $company->name = $validated['name'];
        $company->email = $validated['email'];
        $company->phone_number = $validated['phone_number'];
        $company->position = $validated['position'];
        $company->company_id = $validated['company_id'];
        $company->save();
        return $company;
    }

    /**
     * delete employee
     * @param $id
     */
    public function delete($id)
    {
        $company =  Employee::findOrFail($id);
        return $company->delete($id);
    }

    /**
     * delete multiple employees
     * @param  $validated
     */
    public function destroy($validated)
    {
        return Employee::whereIn('id', $validated)->delete();
    }
}
