<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employe;

class FrontendController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        $allcount = [];
        foreach ($departments as $depart){
            $counts = Employe::where('department_id', $depart->id)->get();
            $allcount[] = count($counts);
        }
        return view('frontend.index', compact('departments', 'allcount'));
    }

    public function department($slug = null)
    {
        $department = Department::where('slug', $slug)->first();
        if(!$department){
            return redirect()->route('frontend.home')->with('error', "the SLUG is undefined");
        }
        $employes = Employe::where('department_id', $department->id)->get();
        return view('frontend.department', compact('department', 'employes'));
    }

    public function employe($slug = null)
    {
        $employe = Employe::where('slug', $slug)->first();
        if(!$employe){
            return redirect()->route('frontend.home')->with('error', "the SLUG is undefined");
        }
        return view('frontend.employe', compact('employe'));
    }
}
