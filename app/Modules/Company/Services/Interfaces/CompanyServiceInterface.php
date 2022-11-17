<?php 
namespace App\Modules\Company\Services\Interfaces;

interface CompanyServiceInterface{
    public function list();
    public function getById($id);
    public function create($request);
    public function update($request,$id);
    public function delete($id);
    public function destroy($request);
}

