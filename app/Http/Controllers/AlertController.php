<?php

namespace App\Http\Controllers;

use App\Http\Requests\Alert\AlertStoreRequest;
use App\Models\Alert;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class AlertController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param AlertStoreRequest $request
     * @return JsonResponse
     */
    public function store(AlertStoreRequest $request): JsonResponse
    {
        $params = $request->all();
        /** @var Alert $alert */
        $alert = Alert::query()->create($params);
        Cache::set($alert->id, $alert);
        return response()->json(['message' => 'Store success', 'data' => $alert]);
    }

    /**
     * Display the specified resource.
     *
     * @param Alert $alert
     * @return JsonResponse
     */
    public function show(string $alert): JsonResponse
    {
        $alert = Cache::get($alert, Alert::query()->find($alert));
        return response()->json(['message' => '', 'data' => $alert]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Alert $alert
     * @return JsonResponse
     */
    public function destroy(Alert $alert): JsonResponse
    {
        $alert->delete();
        Cache::forget($alert->id);
        return response()->json(['message' => 'Delete success', 'data' => null]);
    }
}
