<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::available()->orderBy('created_at')->get();

        return $data;
    }


    public function create(ProductCreateRequest $request)
    {
        $validated = $request->validated();

        try {
            $product = new Product();
            $product->article = $validated['article'];
            $product->name = $validated['name'];
            $product->status = $validated['status'];
            $product->data = $validated['data'];
            $product->save();

            return response(new ProductResource($product), 201);
        } catch (Throwable $e) {
            return response('Ошибка при создании продукта', 400);
        }
    }

    public function delete(int $id)
    {
        try {
            Product::findOrFail($id)->delete();
            return response('Продукт с id=' . $id . ' удален', 200);
        } catch (Throwable $e) {
            return response('Не удалось удалить продукт', 400);
        }
    }

    public function show(int $id)
    {
        try {
            return new ProductResource(Product::findOrFail($id));
        } catch (Throwable $e) {
            return response('Не удалось найти продукт', 400);
        }
    }

    public function showAll()
    {
        try {
            return ProductResource::collection(Product::all());
        } catch (Throwable $e) {
            return response('Что-то пошло не так. Попробуйте позже', 400);
        }
    }

    public function update(ProductUpdateRequest $request)
    {
        $validated = $request->validated();

        try {
            $product = Product::findOrFail($validated['id']);

            $product->name = $validated['name'];
            $product->data = $validated['data'];
            $product->status = $validated['status'];

            if ($request->user()->permissionUpdateArticle()) {
                if (!Product::where('article', $validated['article'])->count()) {
                    $product->article = $validated['article'];
                } else {
                    return response('Этот артикул уже занят', 400);
                }
            }

            $product->save();

            return response(new ProductResource($product), 200);
        } catch (Throwable $e) {
            return response('Произошла ошибка при изменениии продукта', 400);
        }
    }
}
