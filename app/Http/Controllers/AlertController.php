<?php

namespace App\Http\Controllers;

use App\Actions\Alert\AlertBatchDestroyAction;
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
        return new AlertResource(Cache::get($alert, Alert::query()->find($alert)));
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
        return response()->json(['message' => 'Delete success', 'data' => $action->execute($alert)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AlertBatchDestroyAction $action
     * @return JsonResponse
     */
    public function batchDestroy(AlertBatchDestroyAction $action): JsonResponse
    {
        return response()->json(['message' => 'Delete success ', 'data' => ['count' => $action->execute()]]);
    }
}
