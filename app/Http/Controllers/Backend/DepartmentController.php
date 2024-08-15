<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departments = Department::get();
        return view('backend.department.index', compact('departments'));
    }

    public function create()
    {
        return view('backend.department.create');
    }

    public function create_process(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'slug' => ['required'],
        ]);

        Department::create([
            'name'  => $request->name,
            'slug'  => $request->slug,
        ]);
        
        return redirect()->route('backend.manage.department')->with('success', "The Department <strong>{$request->name}</strong> created successfully");
    }

    public function edit($id = null)
    {
        if ($id == null){
            return redirect()->route('backend.manage.department')->with('error', "the ID is empty");
        } else {
            $item = Department::find($id);
            if(!$item){
                return redirect()->route('backend.manage.department')->with('error', "the ID is undefined");
            }
            return view('backend.department.edit', compact('item'));
        }
    }

    public function edit_process(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'slug' => ['required'],
        ]);

        Department::where('id', $request->id)->update(([
            'name'  => $request->name,
            'slug'  => $request->slug,
        ]));

        return redirect()->route('backend.manage.department')->with('success', "The Department <strong>{$request->name}</strong> edited successfully");
    }

    public function destroy(Request $request)
    {
        $item = Department::find($request->id);

        $item->delete();

        return redirect()->route('backend.manage.department')->with('success', "The Department <strong>{$request->name}</strong> deleted successfully");
    }
}
