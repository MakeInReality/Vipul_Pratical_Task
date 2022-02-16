<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EmployeeRegistrationRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('role')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('employee.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 0;
        $roles =  Role::latest()->get();
        $Employee = new Employee();
        return view('employee.create',compact(['action','roles','Employee']));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRegistrationRequest $request)
    {

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->role_id = $request->input('role_id');
        $employee->email = $request->input('email');
        $employee->address = $request->input('address');
        $employee->phone_number = $request->input('phone_number');
        $employee->status = $request->input('status');
        $employee->gender = $request->input('gender');
        $employee->save();
        $lastInsertId = $employee->id;

        if($request->file('profile_pic')) {

            $folderPath = "/public/employee/" . $lastInsertId;
     
            if (!is_dir($folderPath)) {
                    File::makeDirectory($folderPath, $mode = 0777, true, true);
             }
    
            $filename = str_replace(" ","_",$request->profile_pic->getClientOriginalName());
            $file = $request->file('profile_pic')->storeAs($folderPath, $filename);
            employee::find($lastInsertId)->update(['profile_pic'=>$filename]);


        }

        return response()->json(
            [
              'success' => true,
              'message' => 'Employee Added successfully'
            ]
       );

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 1;
        $Employee = Employee::where('id',$id)->first();
        $roles =  Role::latest()->get();
        return view('employee.create',compact(['action','Employee','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $Employee = Employee::where('id', $id)->update([
            'name'       => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'status' => $request->status,
            'gender' => $request->gender,
        ]);

        if($request->file('profile_pic')) {

            $folderPath = "/public/employee/" . $id;

            $path = storage_path($folderPath);
            if(File::exists($path)) {
                File::delete($path);
            }
     
            if (!is_dir($folderPath)) {
                    File::makeDirectory($folderPath, $mode = 0777, true, true);
             }
    
            $filename = str_replace(" ","_",$request->profile_pic->getClientOriginalName());
            $file = $request->file('profile_pic')->storeAs($folderPath, $filename);
            employee::find($id)->update(['profile_pic'=>$filename]);


        }

        return response()->json(
            [
              'success' => true,
              'message' => 'Employee updated successfully'
            ]
       );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id',$id)->delete();
        return view('employee.list');
    }
}
