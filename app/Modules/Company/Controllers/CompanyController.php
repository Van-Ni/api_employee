<?php 
namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Services\CompanyService;
use App\Modules\Company\Requests\CompanyRequest;
use App\Modules\Company\Requests\DestroyCompanyRequest;

class CompanyController extends Controller {
    private $companyService;
    public function __construct(
        CompanyService $companyService
    ){
        $this->companyService = $companyService;
    }
    /**
     * get company list
     * @return Response
     */
    public function list(){
        return $this->companyService->list();
    }
    /**
     * get company by id
     * @param $id
     * @return Response
     */
    public function getById($id){
        return $this->companyService->getById($id);
    }
    /**
     * create company 
     * @param CompanyRequest $request
     * @return Response
     */
    public function create(CompanyRequest $request) {
        return $this->companyService->create($request);
    }
    /**
     * Update company 
     * @param CompanyRequest $request
     * @param $id
     * @return Response
     */
    public function update(CompanyRequest $request, $id) {
        return $this->companyService->update($request,$id);
    }
    /**
     * Delete company 
     * @param $id
     */
    public function delete($id){
        return $this->companyService->delete($id);
    }
    /**
     * 
     * Delete multiple companies 
     * @param DestroyCompanyRequest $request
     */
    public function destroy(DestroyCompanyRequest $request){
        return $this->companyService->destroy($request);
    }
}
?>