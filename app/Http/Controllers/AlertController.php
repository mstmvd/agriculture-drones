<?php

namespace App\Http\Controllers;

use App\Actions\Alert\AlertBatchStoreAction;
use App\Actions\Alert\AlertBatchUpdateAction;
use App\Actions\Alert\AlertDestroyAction;
use App\Actions\Alert\AlertStoreAction;
use App\Http\Requests\Alert\AlertStoreBatchRequest;
use App\Http\Requests\Alert\AlertStoreRequest;
use App\Http\Requests\Alert\AlertUpdateRequest;
use App\Http\Resources\Alert\AlertResource;
use App\Http\Resources\ResponseCollection;
use App\Models\Alert;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class AlertController extends Controller
{
    /**
     * @return ResponseCollection
     */
    public function index(): ResponseCollection
    {
        return new ResponseCollection(AlertResource::class, Alert::query());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AlertStoreRequest $request
     * @param AlertStoreAction $action
     * @return AlertResource
     */
    public function store(AlertStoreRequest $request, AlertStoreAction $action): AlertResource
    {
        return new AlertResource($action->execute($request->toDTO()));
    }

    /**
     * Store multiple alerts at same time
     *
     * @param AlertStoreBatchRequest $request
     * @param AlertBatchStoreAction $action
     * @return ResponseCollection
     */
    public function batchStore(AlertStoreBatchRequest $request, AlertBatchStoreAction $action): ResponseCollection
    {
        return new ResponseCollection(AlertResource::class, $action->execute($request->toDTO()));
    }

    /**
     * Display the specified resource.
     *
     * @param string $alert
     * @return AlertResource
     */
    public function show(string $alert): AlertResource
    {
        $alert = Cache::get($alert, Alert::query()->find($alert));
        return new AlertResource($alert);
    }

    /**
     * @param AlertUpdateRequest $request
     * @param AlertBatchUpdateAction $action
     * @return JsonResponse
     */
    public function batchUpdate(AlertUpdateRequest $request, AlertBatchUpdateAction $action): JsonResponse
    {
        return response()->json(['message' => 'Update success ', 'data' => ['count' => $action->execute($request->toDTO())]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Alert $alert
     * @param AlertDestroyAction $action
     * @return JsonResponse
     */
    public function destroy(Alert $alert, AlertDestroyAction $action): JsonResponse
    {
        $action->execute($alert);
        return response()->json(['message' => 'Delete success', 'data' => null]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function batchDestroy(): JsonResponse
    {
        /** @var Alert[] $alerts */
        $alerts = Alert::query()->get();
        $count = count($alerts);
        foreach ($alerts as $alert) {
            Cache::forget($alert->id);
            $alert->delete();
        }
        return response()->json(['message' => 'Delete success ', 'data' => ['count' => $count]]);
    }
}
