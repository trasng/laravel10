<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::select('id', 'name', 'image')->get();
        // dd($data);
        return view('Admin.categories.index', compact('data'));
    }

    public function create(){
        return view('Admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try
        {
            $data = [];
            if ($request->hasFile('image')) {
                $path = $request->image->store('category', 'public');
                $data['image'] = Storage::url($path);
            }

            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $data['image'],
            ];
            DB::beginTransaction();
            Category::create($data);
            DB::commit();
            return redirect()->route('admin.categories.index')->with('message', 'Thêm danh mục thành công');
        }catch(\Exception $e){
            if (isset($data['image']) && File::exists(public_path($data['image']))) {
                unlink(public_path($data['image']));
            }
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'line :' . $e->getLine());
            return redirect()->route('admin.categories.index')->with('error', 'Thêm danh mục thất bại!');
        }
    }

    public function edit($id)
    {
        $data = Category::find($id);
        if (!$data) {
            return redirect()->route('admin.categories.index')->with('error', 'Danh mục không tồn tại');
        }
        return view('Admin.categories.update', compact('data'));
    }

    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Danh mục không tồn tại');
        }
        try {
            $data = [];
            if ($request->hasFile('image')) {
                $path = $request->image->store('category', 'public');
                $data['image'] = Storage::url($path);
            }else{
                $data['image'] = $category->image;
            }
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $data['image'],
            ];
            DB::beginTransaction();
            Category::where('id', $id)->update($data);
            if ($request->hasFile('image')) {
                if ($category->image) {
                    if (File::exists(public_path($category->image))) {
                        unlink(public_path($category->image));
                    }
                }
            }
            DB::commit();
            return redirect()->route('admin.categories.index')->with('message', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            if (isset($data['image']) && File::exists(public_path($data['image']))) {
                unlink(public_path($data['image']));
            }
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'line :' . $e->getLine());
            return redirect()->route('admin.categories.index')->with('error', 'Cập nhật danh mục Thất bại!');
        }
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Danh mục không tồn tại!');
        }
        try{
            DB::beginTransaction();
            $category->delete();
            if ($category->image) {
                if (File::exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                }
            }
            DB::commit();
            return redirect()->route('admin.categories.index')->with('message', 'Xóa danh mục thành công!');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'line :' . $e->getLine());
            return redirect()->route('admin.categories.index')->with('message', 'Xóa danh mục thất bại!');
        }
    }

}
