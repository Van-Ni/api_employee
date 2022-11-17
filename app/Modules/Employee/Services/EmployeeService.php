<?php

namespace App\Modules\Employee\Services;

use App\Helpers\TransformerResponse;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeService implements EmployeeServiceInterface
{

    private $transformerResponse;
    private $employeeRepository;
    public function __construct(
        TransformerResponse $transformerResponse,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->transformerResponse = $transformerResponse;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * get employees by company
     * @param $id
     * @return Response
     */
    public function getByCompanyId($id)
    {
        try {
            $employees = $this->employeeRepository->getByCompanyId($id);

            return $this->transformerResponse->response(
                false,
                [
                    'employees' => $employees,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * get employee by id
     * @param $id
     * @return Response
     */
    public function getById($id)
    {
        try {
            $employee = $this->employeeRepository->getById($id);

            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * create employee
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        try {
            $validated = $request->validated();
            $employee = $this->employeeRepository->create($validated);

            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_CREATED,
                TransformerResponse::CREATE_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * update employee
     * @param $request
     * @param $id
     * @return Response
     */
    // update employee
    public function update($request, $id)
    {
        try {
            $validated = $request->validated();
            $employee = $this->employeeRepository->update($validated, $id);

            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::UPDATE_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * delete employee
     * @param $id
     */
    public function delete($id)
    {
        try {
            $this->employeeRepository->delete($id);
            return $this->transformerResponse->response(
                false,
                [],
                TransformerResponse::HTTP_OK,
                TransformerResponse::DELETE_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * delete multiple employees
     * @param  $request
     */
    public function destroy($request)
    {
        try {
            $validated = $request->validated();
            $this->employeeRepository->destroy($validated['listCheck']);
            return $this->transformerResponse->response(
                false,
                [],
                TransformerResponse::HTTP_OK,
                TransformerResponse::DELETE_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        } 
    }
}
