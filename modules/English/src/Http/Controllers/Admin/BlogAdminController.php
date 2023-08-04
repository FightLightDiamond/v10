<?php

namespace English\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use English\Http\Requests\Admin\BlogCreateRequest;
use English\Http\Requests\Admin\BlogUpdateRequest;
use English\Http\Resources\Admin\BlogResource;
use English\Http\Resources\Admin\BlogResourceCollection;
use English\Http\Services\Admin\BlogService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlogAdminController extends Controller
{
    private $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * Paginate
     *
     * @group         Blog
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
            $params = $request->all();
            $data = $this->service->index($params);

            return new BlogResourceCollection($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Create
     *
     * @group         Blog
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
     */
    public function store(BlogCreateRequest $request)
    {
        try {
            $params = $request->all();
            $blog = $this->service->store($params);

            return new BlogResource($blog);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Show
     *
     * @group         Blog
     * @authenticated
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     */
    public function show($id)
    {
        try {
            $blog = $this->service->show($id);

            return new BlogResource($blog);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update
     *
     * @group         Blog
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
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        $params = $request->all();
        try {
            $data = $this->service->update($params, $id);

            return new BlogResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Destroy
     *
     * @group         Blog
     * @authenticated
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     */
    public function destroy($id)
    {
        try {
            $data = $this->service->destroy($id);

            return new BlogResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
