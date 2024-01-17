<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 10/4/18
 * Time: 8:26 PM
 */

namespace English\Http\Controllers\API;

use English\Http\Repositories\CrazyCourseRepository;
use English\Http\Resources\MasterResource;
use English\Http\Services\API\CrazyCourseService;

/**
 * Class CrazyCourseAPIController
 * @package English\Http\Controllers\API
 */
class CrazyCourseAPIController
{

    /**
     * @var CrazyCourseRepository
     */
    private $service;

    /**
     * CrazyCourseAPIController constructor.
     * @param CrazyCourseService $service
     */
    public function __construct(CrazyCourseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $data = $this->service->index();

            return new MasterResource($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * @param $id
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = $this->service->show($id, auth('api')->id());

            return new MasterResource($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }
}
