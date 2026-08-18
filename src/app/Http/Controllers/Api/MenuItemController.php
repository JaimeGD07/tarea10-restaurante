<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;

class MenuItemController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(MenuItem::all());
    }

    public function store(StoreMenuItemRequest $request): JsonResponse
    {
        $menuItem = MenuItem::create($request->validated());

        return response()->json($menuItem, 201);
    }

    public function show(MenuItem $menuItem): JsonResponse
    {
        return response()->json($menuItem);
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem): JsonResponse
    {
        $menuItem->update($request->validated());

        return response()->json($menuItem);
    }

    public function destroy(MenuItem $menuItem): JsonResponse
    {
        $menuItem->delete();

        return response()->json(null, 204);
    }

    public function byCategory(string $category): JsonResponse
    {
        $items = MenuItem::where('category', $category)->get();

        return response()->json($items);
    }
}
