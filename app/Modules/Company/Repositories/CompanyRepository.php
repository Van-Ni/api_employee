<?php

namespace App\Modules\Company\Repositories;

use App\Modules\Company\Models\Company;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{

    /**
     * get company list
     * @return Response
     */
    public function list()
    {
        return Company::orderBy('created_at', 'desc')->get();
    }

    /**
     * get company by id
     * @param $id
     * @return Response
     */
    public function getById($id)
    {
        return Company::findOrFail($id);
    }

    /**
     * create company
     * @param $validated
     * @return Response
     */
    public function create($validated)
    {
        return Company::create($validated);
    }

    /**
     * update company
     * @param $request
     * @param $id
     * @return Response
     */
    public function update($validated, $id)
    {
        $company =  Company::findOrFail($id);
        $company->name = $validated['name'];
        $company->address = $validated['address'];
        $company->save();
        return $company;
    }

    /**
     * delete company
     * @param $id
     */
    public function delete($id)
    {
        $company =  Company::findOrFail($id);
        return $company->delete($id);
    }

    /**
     * delete multiple companies
     * @param $request
     */
    public function destroy($validated)
    {

        return Company::whereIn('id', $validated)->delete();
    }
}
