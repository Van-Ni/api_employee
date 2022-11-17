<?php

namespace App\Modules\Employee\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getByCompanyId($id);
    public function getById($id);
    public function create($validated);
    public function update($validated, $id);
    public function delete($id);
    public function destroy($validated);
}