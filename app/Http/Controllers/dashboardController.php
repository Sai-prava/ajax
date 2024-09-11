<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class dashboardController extends Controller
{
    public function index()
    {
        $alldata = Student::all();
        return view('student.index', compact('alldata'));
    }
    public function store(Request $request)
    {

        $request->validate([
            "name" => "required",
            "email" => "required",
            "number" => "required",
            "address" => "required",
            "description" => "required",
        ]);
        $storedata = new Student();
        $storedata->name = $request->name;
        $storedata->email = $request->email;
        $storedata->number = $request->number;
        $storedata->address = $request->address;
        $storedata->description = $request->description;
        $storedata->save();

        return redirect()->route('student.index');
    }
    public function edit($id)
    {
        $editdata = Student::find($id);
        $alldata = Student::all();
        return view('student.index', compact('editdata', 'alldata'));
    }
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "number" => "required",
            "address" => "required",
            "description" => "required",
        ]);

        $updatedata = Student::find($request->id);
        $updatedata->name = $request->name;
        $updatedata->email = $request->email;
        $updatedata->number = $request->number;
        $updatedata->address = $request->address;
        $updatedata->description = $request->description;
        $updatedata->save();

        return redirect()->route('student.index');
    }
    public function delete($id){
        $deletedata = Student::find($id);
        $deletedata->delete();

        return redirect()->back();
    }
    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file');

        $import = new UsersImport();
        Excel::import($import, $file);

        $columns = $import->getColumns();

        return redirect()->back()->with('success', 'Excel file imported successfully.');

    }
}
