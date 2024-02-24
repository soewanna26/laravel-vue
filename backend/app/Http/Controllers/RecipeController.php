<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RecipeController extends Controller
{
    public function index()
    {

        try {
            return Recipe::filter(
                request(['category'])
            )->paginate(6);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ], 500);
        }
    }

    public function store()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'title' => 'required',
                'description' => 'required',
                'category_id' => ['required', Rule::exists('categories', 'id')],
                'photo' => 'required',
            ]);

            if ($validator->fails()) {
                $flatterErrors = collect($validator->errors())->flatMap(function ($e, $field) {
                    return [$field => $e[0]];
                });

                return response()->json([
                    'errors' => $flatterErrors,
                    'message' => 400
                ], 400);
            }
            $recipe = new Recipe();
            $recipe->title = request('title');
            $recipe->description = request('description');
            $recipe->photo = request('photo');
            $recipe->category_id = request('category_id');
            $recipe->save();
            return response()->json([
                $recipe, 201
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ], 500);
        }
    }
    public function update($id)
    {
        try {
            $recipe = Recipe::find($id);
            if (!$recipe) {
                return response()->json([
                    'message' => 'Recipe not found',
                    'status' => '404',
                ], 404);
            }
            $validator = Validator::make(request()->all(), [
                'title' => 'required',
                'description' => 'required',
                'category_id' => ['required', Rule::exists('categories', 'id')],
                'photo' => 'required',
            ]);

            if ($validator->fails()) {
                $flatterErrors = collect($validator->errors())->flatMap(function ($e, $field) {
                    return [$field => $e[0]];
                });

                return response()->json([
                    'errors' => $flatterErrors,
                    'message' => 400
                ], 400);
            }
            $recipe->title = request('title');
            $recipe->description = request('description');
            $recipe->photo = request('photo');
            $recipe->category_id = request('category_id');
            $recipe->save();
            return response()->json([
                $recipe, 201
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ], 500);
        }
    }

    public function show($id)
    {

        try {
            $recipe = Recipe::find($id);
            if (!$recipe) {
                return response()->json([
                    'message' => 'Recipe not found',
                    'status' => '404',
                ], 404);
            }
            return response()->json([
                'data' => $recipe,
                'success' => '200'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $recipe = Recipe::find($id);
            if (!$recipe) {
                return response()->json([
                    'message' => 'Recipe not found',
                    'status' => '404',
                ], 404);
            }
            $recipe->delete();
            return response()->json([
                'data' => $recipe,
                'success' => '200'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ], 500);
        }
    }

    public function upload()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'photo' => ['required','image'],
            ]);

            if ($validator->fails()) {
                $flatterErrors = collect($validator->errors())->flatMap(function ($e, $field) {
                    return [$field => $e[0]];
                });

                return response()->json([
                    'errors' => $flatterErrors,
                    'message' => 400
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ], 500);
        }
    }
}
