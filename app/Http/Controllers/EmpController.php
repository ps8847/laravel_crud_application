<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Emp;

class EmpController extends Controller
{
    public function index() {
        //without paginate
        //$employees = Emp::orderBy('id' , 'DESC')->get();
        //with paginate
        $employees = Emp::orderBy('id' , 'DESC')->paginate(5);
        return view('employee.list' , ['employees' => $employees]);
    }
    public function create(){
      
        return view('employee.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);

        if($validator->passes()){

            //method 1

            $employee = new Emp();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;

            // method 2

            //to do the folliwng four lines into two lines >> go to the model and write the follwing line there :  protected $fillable = ['name' , 'email' , 'address','image'];

            //$employee = new Emp();
            //$employee->fill($request->post())->save();

            //method 3
            //Emp::create($request->post())->save();

            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName); //this will save file in a folder
                $employee->image = $newFileName;
                $employee->save();
            }
            //$employee->save();

            $request->session()->flash('success', 'Employee added successfully.');
            return redirect()->route('employees.index');
        }else{
            //return with error
            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $employee = Emp::findOrFail($id);
        //if(!$employee){
        //    abort('404');
        //}
        //dd($employee);
        return view('employee.edit' , ['employee'=>$employee]);
    }

    public function update($id , Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);

        if($validator->passes()){
            $employee = Emp::find($id);
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->save();

            if($request->image){
                $oldImage = $employee->image;
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName); //this will save file in a folder
                $employee->image = $newFileName;
                $employee->save();

                File::delete(public_path().'/uploads/employees/'.$oldImage);
            }
            
            //these two lines 
            //$request->session()->flash('success', 'Employee updated successfully.');
            //return redirect()->route('employees.index');

            //this one line 
            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        }else{
            //return with error
            return redirect()->route('employees.edit' , $id)->withErrors($validator)->withInput();
        }
    }
    public function destroy($id , Request $request){
        $employee = Emp::findOrFail($id);
        File::delete(public_path().'/uploads/employees/'.$employee->image);
        $employee->delete();

        $request->session()->flash('success' , 'Employee deleted successfully');
        return redirect()->route('employees.index');
    }
}

