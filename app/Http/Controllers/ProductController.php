<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::available()->orderBy('created_at')->get();

        return $data;
        // return view('admin.category1.index', [
        //     'data' => $data,
        //     'allCategories' => $allCategories,
        //     'parametrs' => $parametrs
        // ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRequest $request)
    {
        $validated = $request->validated();
        dd('5');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     try {
    //         $new_category = new Category1();
    //         $new_category->name = $request->name;
    //         $new_category->deposit_auction = $request->deposit_auction;
    //         // $new_category->deposit_offer = $request->deposit_offer;

    //         if (!is_null($request->parent_id)) {
    //             $new_category->parent_id = $request->parent_id;
    //         }

    //         $new_category->code = Str::slug($request->name);
    //         $new_category->save();
    //     } catch (Throwable $error) {
    //         return redirect()->back();
    //     }

    //     return redirect('/admin_panel/category1');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {

    //     $item = Category1::find($id);

    //     function getParentNames($current)
    //     {
    //         if ($current->parents == null) return $current->name;
    //         return $current->name . ' - ' . getParentNames($current->parents);
    //     }


    //     $categories = Category1::orderBy('parent_id')->get();

    //     foreach ($categories as $cat) {
    //         if ($cat->parents) {
    //             //$cat['name'] = $cat['name'] . ' - ' . $cat['id'];
    //             $cat['name'] = $cat['name'] . ' (' . getParentNames($cat->parents) . ')';
    //         }
    //     }

    //     $formData = [
    //         ['title' => 'Название', 'name' => 'name', 'tag' => 'input', 'type' => 'text', 'required' => true, 'placeholder' => 'Название', 'value' => $item['name']],
    //     ];

    //     if ($item->parent_id != null) {
    //         $formData[] = ['title' => 'Родительская категория', 'name' => 'parent_id', 'tag' => 'select', 'required' => true, 'options' => $categories, 'selected_id' => $item->parent_id, 'type' => 'select', 'placeholder' => 'Выбор'];
    //     }

    //     if ($item->parent_id == null) {
    //         $formData[] = ['title' => 'Депозит аукциона', 'name' => 'deposit_auction', 'tag' => 'input', 'required' => false, 'type' => 'text', 'placeholder' => 'Депозит аукциона', 'value' => $item['deposit_auction']];
    //         // $formData[] = ['title' => 'Депозит предложения', 'name' => 'deposit_offer', 'tag' => 'input', 'required' => false, 'type' => 'text', 'placeholder' => 'Депозит предложения', 'value' => $item['deposit_offer']];
    //     }

    //     $parametrs = [
    //         'heading' => 'Редактирование категории',
    //         'route' => 'category1',
    //     ];

    //     return view('admin.category1.edit', [
    //         'formData' => $formData,
    //         'item' => $item,
    //         'parametrs' => $parametrs
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request,  int $id)
    // {
    //     $category = Category1::find($id);

    //     try {
    //         $category->name = $request->name;
    //         $category->deposit_auction = $request->deposit_auction;
    //         // $category->deposit_offer = $request->deposit_offer;
    //         $category->parent_id = $request->parent_id;
    //         $category->code = Str::slug($request->name);
    //         $category->save();
    //     } catch (Throwable $error) {
    //         return redirect()->back();
    //     }

    //     return redirect('/admin_panel/category1');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     try {
    //         $category = Category1::find($id)->delete();
    //     } catch (Throwable $error) {
    //         return redirect()->back();
    //     }

    //     return redirect('/admin_panel/category1');
    // }
}
