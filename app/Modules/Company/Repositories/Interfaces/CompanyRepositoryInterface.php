<?php 

namespace App\Modules\Company\Repositories\Interfaces;

interface CompanyRepositoryInterface{
    
    public function list();
    public function getById($id);
    public function create($validated);
    public function update($validated, $id);
    public function delete($id);
    public function destroy($validated);
}

?>