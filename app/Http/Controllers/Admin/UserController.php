<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class UserController extends Controller
{
    public function index()
    {
        $data = User::select('id', 'last_name','name', 'birth_date', 'phone', 'email', 'image')->get();
        // dd($data);
        return view('Admin.users.index', compact('data'));
    }

    public function create(){
        return view('Admin.users.create');
    }

    public function store(UserRequest $request)
    {
        try
        {
            $data = [];
            if ($request->hasFile('image')) {
                $path = $request->image->store('user', 'public');
                $data['image'] = Storage::url($path);
            }
            $data = [
                'last_name'  => $request->last_name,
                'name'       => $request->name,
                'birth_date' => $request->birth_date,
                'image'      => $data['image'],
                'phone'      => $request->phone,
                'email'      => $request->email,
            ];
            DB::beginTransaction();
            User::create($data);
            DB::commit();
            return redirect()->route('admin.users.index')->with('message', 'Thêm user thành công');
        }catch(\Exception $e){
            if (isset($data['image']) && File::exists(public_path($data['image']))) {
                unlink(public_path($data['image']));
            }
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'line :' . $e->getLine());
            return redirect()->route('admin.users.index')->with('error', 'Thêm user thất bại!');
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        if (!$data) {
            return redirect()->route('admin.users.index')->with('error', 'User không tồn tại');
        }
        return view('Admin.users.update', compact('data'));
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.categories.index')->with('error', 'User không tồn tại');
        }
        try {
            $data = [];
            if ($request->hasFile('image')) {
                $path = $request->image->store('user', 'public');
                $data['image'] = Storage::url($path);
            }else{
                $data['image'] = $user->image;
            }
            $data = [
                'last_name'  => $request->last_name,
                'name'       => $request->name,
                'birth_date' => $request->birth_date,
                'image'      => $data['image'],
                'phone'      => $request->phone,
                'email'      => $request->email,
            ];
            DB::beginTransaction();
            User::where('id', $id)->update($data);
            if ($request->hasFile('image')) {
                if ($user->image) {
                    if (File::exists(public_path($user->image))) {
                        unlink(public_path($user->image));
                    }
                }
            }
            DB::commit();
            return redirect()->route('admin.users.index')->with('message', 'Cập nhật user thành công!');
        } catch (\Exception $e) {
            if (isset($data['image']) && File::exists(public_path($data['image']))) {
                unlink(public_path($data['image']));
            }
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'line :' . $e->getLine());
            return redirect()->route('admin.users.index')->with('error', 'Cập nhật user Thất bại!');
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User không tồn tại!');
        }
        try{
            DB::beginTransaction();
            $user->delete();
            if ($user->image) {
                if (File::exists(public_path($user->image))) {
                    unlink(public_path($user->image));
                }
            }
            DB::commit();
            return redirect()->route('admin.users.index')->with('message', 'Xóa user thành công!');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'line :' . $e->getLine());
            return redirect()->route('admin.users.index')->with('message', 'Xóa user thất bại!');
        }
    }

}
