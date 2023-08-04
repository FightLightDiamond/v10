<?php

namespace Tutorial\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Tutorial\Http\Requests\API\LessonCreateRequest;
use Tutorial\Http\Requests\API\LessonUpdateRequest;
use Tutorial\Http\Resources\API\LessonResource;
use Tutorial\Http\Resources\API\LessonResourceCollection;
use Tutorial\Http\Services\API\LessonService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LessonAPIController extends Controller
{
    private $service;

    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }

    /**
     * Paginate
     * @group Lesson
     * @authenticated
     *
     * @queryParam id required The fund id. Example: 1
     *
     * @response {
     * "data": [
     *   {
     *    "id": 10,
     *    "created_at": "2019-09-04 10:43:47",
     *    "updated_at": "2019-09-04 10:43:47"
     *   },
     *   {
     *    "id": 9,
     *    "created_at": "2019-09-04 08:56:43",
     *    "updated_at": "2019-09-04 08:56:43"
     *   }
     *  ],
     *  "links": {
     *     "first": "{url}?page=1",
     *     "last": "{url}?page=1",
     *     "prev": null,
     *     "next": null
     *  },
     *  "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "{url}",
     *     "per_page": 10,
     *     "to": 2,
     *     "total": 2
     *   }
     * }
     */
    public function index(Request $request)
    {
        try {
            $input = $request->all();

            $data = $this->service->index($input);

            return new LessonResourceCollection($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Create
     * @group Lesson
     * @authenticated
     *
     * @bodyParam is_active int required The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function store(LessonCreateRequest $request)
    {
        try {
            $input = $request->all();

            $lesson = Cache::remember('users', 3600, function () use ($input) {
                return $this->service->store($input);
            });

            return response()->json(new LessonResource($lesson));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Show
     * @group Lesson
     * @authenticated
     *
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function show($id)
    {
        try {
            $lesson = $this->service->show($id);

            return response()->json(new LessonResource($lesson));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group Lesson
     * @authenticated
     *
     * @bodyParam is_active int optional The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function update(LessonUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $lesson = $this->service->update($input, $id);

            return response()->json(new LessonResource($lesson));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group Lesson
     * @authenticated
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function destroy($id)
    {
        try {
            $lesson = $this->service->destroy($id);

            return response()->json(new LessonResource($lesson));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
