<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employes = Employe::get();
        return view('backend.employe.index', compact('employes'));
    }

    public function create()
    {
        $departments = Department::get();
        return view('backend.employe.create', compact('departments'));
    }

    public function create_process(Request $request)
    {
        request()->validate([
            'image'         => 'required|max:2048|mimes:jpg,jpeg,png',
            'department_id' => 'required',
            'fullname'      => 'required',
            'slug'          => 'required',
            'hp'            => 'required|numeric',
            'cv'            => 'required',
            'address'       => 'required'
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image/employes'), $image);

        Employe::create([
            'image'         => $image,
            'department_id' => $request->department_id,
            'fullname'      => $request->fullname,
            'slug'          => $request->slug,
            'hp'            => $request->hp,
            'cv'            => $request->cv,
            'address'       => $request->address,
        ]);
        
        return redirect()->route('backend.manage.employe')->with('success', "The Employe <strong>{$request->fullname}</strong> created successfully");
    }

    public function show($id = null)
    {
        if ($id == null){
            return redirect()->route('backend.manage.employe')->with('error', "the ID is empty");
        } else{
            $item = Employe::find($id);
            if(!$item){
                return redirect()->route('backend.manage.employe')->with('error', "the ID is undefined");
            }
            return view('backend.employe.show', compact('item'));
        }
    }

    public function edit($id = null)
    {
        if ($id == null){
            return redirect()->route('backend.manage.employe')->with('error', "the ID is empty");
        } else {
            $item = Employe::find($id);
            $departments = Department::get();
            if(!$item){
                return redirect()->route('backend.manage.employe')->with('error', "the ID is undefined");
            }
            return view('backend.employe.edit', compact('item', 'departments'));
        }
    }

    public function edit_process(Request $request)
    {
        request()->validate([
            'image'         => 'max:2048|mimes:jpg,jpeg,png',
            'department_id' => 'required',
            'fullname'      => 'required',
            'slug'          => 'required',
            'hp'            => 'required|numeric',
            'cv'            => 'required',
            'address'       => 'required'
        ]);

        $old_image = Employe::find($request->id);

        if($request->image) {
            if (public_path('image/employes/'. $old_image->image))
                unlink(public_path('image/employes/'.$old_image->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image/employes'), $image);
            
            Employe::where('id', $request->id)->update(([
                'image' => $image
            ]));
        }

        Employe::where('id', $request->id)->update(([
            'department_id' => $request->department_id,
            'fullname'      => $request->fullname,
            'slug'          => $request->slug,
            'hp'            => $request->hp,
            'cv'            => $request->cv,
            'address'       => $request->address,
        ]));

        return redirect()->route('backend.manage.employe')->with('success', 'Item Edited Successfully');
    }

    public function destroy(Request $request)
    {
        $item = Employe::find($request->id);
        
        if (public_path('image/employes/'. $item->image))
            unlink(public_path('image/employes/'.$item->image));

        $item->delete();

        return redirect()->route('backend.manage.employe')->with('success', 'Item deleted successfully');
    }
}
