<?php 
namespace App\Modules\Employee\Services\Interfaces;

interface EmployeeServiceInterface{
    public function getByCompanyId($id);
    public function getById($id);
    public function create($request);
    public function update($request,$id);
    public function delete($id);
    public function destroy($request);
}