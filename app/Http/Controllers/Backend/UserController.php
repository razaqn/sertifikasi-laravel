<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function create_process(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'is_admin' => $request->is_admin,
            'password' => Hash::make($request->password)
        ]);
        
        return redirect()->route('backend.manage.user')->with('success', "The Category <strong>{$request->name}</strong> created successfully");
    }

    public function show($id = null)
    {
        if ($id == null){
            return redirect()->route('backend.manage.user')->with('error', "the ID is empty");
        } else{
            $item = User::find($id);
            return view('backend.user.show', compact('item'));
        }
    }

    public function edit($id = null)
    {
        if ($id == null){
            return redirect()->route('backend.manage.user')->with('error', "the ID is empty");
        } else{
            $item = User::find($id);
            $edit_me = false;
            return view('backend.user.edit', compact('item', 'edit_me'));
        }
    }

    public function edit_process(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        User::where('id', $request->id)->update(([
            'name'  => $request->name,
            'email'  => $request->email,
            'is_admin' => $request->is_admin,
        ]));

        if($request->password){
            request()->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            User::where('id', $request->id)->update(([
                'password' => Hash::make($request->password)
            ]));
        }

        return redirect()->route('backend.manage.user')->with('success', 'Item Edited Successfully');
    }

    public function destroy(Request $request)
    {
        $item = User::find($request->id);

        $item->delete();

        return redirect()->route('backend.manage.user')->with('success', 'Item deleted successfully');
    }

    public function show_me()
    {
        $item = User::find(auth()->user()->id);
        return view('backend.user.show', compact('item'));
    }

    public function edit_me($id = null)
    {
        $item = User::find(auth()->user()->id);
        $edit_me = true;
        return view('backend.user.edit', compact('item', 'edit_me'));
    }

    public function edit_process_me(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        User::where('id', $request->id)->update(([
            'name'  => $request->name,
            'email'  => $request->email,
        ]));

        if($request->password){
            request()->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            User::where('id', $request->id)->update(([
                'password' => Hash::make($request->password)
            ]));
        }

        return redirect()->route('backend.manage.user')->with('success', 'Item Edited Successfully');
    }
}
