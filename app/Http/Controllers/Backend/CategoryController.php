<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSubCategories(Request $request):JsonResponse
    {
        $data['sub_categories'] = SubCategory::where("category_id", $request->category_id)->get(["name", "id"]);

        return response()->json($data);
    }
}
