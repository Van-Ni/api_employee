<?php

namespace App\Modules\Company\Services;

use App\Helpers\TransformerResponse;
use Illuminate\Database\QueryException;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyService implements CompanyServiceInterface
{

    private $companyRepository;
    private $transformerResponse;

    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        TransformerResponse $transformerResponse,
    ) {
        $this->companyRepository = $companyRepository;
        $this->transformerResponse = $transformerResponse;
    }

    /**
     * get company list
     * @return Response
     */
    public function list()
    {
        try {
            $companies = $this->companyRepository->list();

            return $this->transformerResponse->response(
                false,
                [
                    'companies' => $companies,
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
     * get company by id
     * @param $id
     * @return Response
     */
    public function getById($id)
    {
        try {
            $company = $this->companyRepository->getById($id);

            return $this->transformerResponse->response(
                false,
                [
                    'company' => $company,
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
     * create company
     * @param $request
     * @return Response
     */
    public function create($request)
    {
        try {
            $validated = $request->validated();
            $company = $this->companyRepository->create($validated);

            return $this->transformerResponse->response(
                false,
                [
                    'company' => $company,
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
     * update company
     * @param $request
     * @param $id
     * @return Response
     */
    public function update($request, $id)
    {
        try {
            $validated = $request->validated();
            $company = $this->companyRepository->update($validated, $id);

            return $this->transformerResponse->response(
                false,
                [
                    'company' => $company,
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
     * delete company
     * @param $id
     */
    public function delete($id)
    {
        try {
            $this->companyRepository->delete($id);
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
     * delete multiple companies
     * @param $request
     */
    public function destroy($request)
    {
        try {
            $validated = $request->validated();
            $this->companyRepository->destroy($validated['listCheck']);
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
