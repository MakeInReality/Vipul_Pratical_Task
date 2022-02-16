<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('role.list-latest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 0;
        return view('role.create',compact(['action']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRole $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();
        
        return response()->json(
            [
              'success' => true,
              'message' => 'Role Added successfully'
            ]
       );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 1;
        $Role = Role::where('id',$id)->first();
        return view('role.create',compact(['action','Role']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->update([
            'name'       => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(
            [
              'success' => true,
              'message' => 'Role updated successfully'
            ]
       );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $banner = Role::where('id',$id)->delete();
        return view('role.list');
    }
}
