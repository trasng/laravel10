<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $data = Category::select('id', 'name')->get();
        // dd($data);
        return view('Admin.categories.index', compact('data'));
    }

    public function create(){
        return view('Admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('message', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {

        $data = Category::find($id);
        if (!$data) {
            return view('404');
        }
        return view('Admin.categories.update', compact('data'));
    }

    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        Category::where('id', $id)->update($data);
        return redirect()->route('admin.categories.index')->with('message', 'Cập nhật danh mục thành công');
    }

    public function destroy(string $id)
    {
        $data = Category::where('id', $id)->delete();
        if (!$data) {
            return view('404');
        }
        return redirect()->route('admin.categories.index')->with('message', 'Xóa danh mục thành công');
    }

}
