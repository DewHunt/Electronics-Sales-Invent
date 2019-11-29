<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\UserRoles;
use App\UserMenu;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Manage Users Role";
        $userRoles = UserRoles::orderBy('id','ASC')->get();
        return view('admin.userRole.index')->with(compact('title','userRoles'));
    }

    public function changeuserRoleStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = UserRoles::find($request->userRole_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('user-roles.index')) -> with( 'message', 'Wrong move!');
    }

    public function adduserRole()
    {
        $title = "Add User Roles";
        $formLink = "userRole.save";
        $buttonName = "Save";
        return view('admin.userRole.adduserRole')->with(compact('title','formLink','buttonName'));
    }

    public function saveuserRole(Request $request){
        $this->validation($request);

        $userRoles = UserRoles::create( [     
            'name' => $request->name,                      
            'status' => '0',             
                      
        ]);

        // $product = Product::create($request->all());

        return redirect(route('user-roles.index'))->with('msg','User Role Added Successfully');     
    }

    public function edituserRole($id)
    {
        $title = "Edit User Role";
        $formLink = "userRole.update";
        $buttonName = "Update";
        $userRoles = UserRoles::where('id',$id)->first();
        return view('admin.userRole.updateuserRole')->with(compact('title','formLink','buttonName','userRoles'));
    }
   
    public function updateuserRole(Request $request){
        $this->validate(request(), [          
            'name' => 'required',
        ]);

        $userroleId = $request->userroleId;

        $userRoles = UserRoles::find($userroleId);

        $userRoles->update( [
            'name' => $request->name,                     
        ]);

        return redirect(route('user-roles.index'))->with('msg','User Role Updated Successfully');     
    }

    public function deleteUserRole(Request $request)
    {
        UserRoles::where('id',$request->userRoleId)->delete();
    }


    public function validation(Request $request)
    {
        $this->validate(request(), [  
            'name' => 'required',

        ]);
    }

    public function permission($id)
    {
        $title = "User Permission";
        $formLink = "userRole.permissionUpdate";
        $buttonName = "Update";
        $userMenus = UserMenu::orderBy('id','ASC')->where('menuStatus',1)->get();
        $userRoles = UserRoles::where('id',$id)->first();
        return view('admin.userRole.userRolePermission')->with(compact('title','formLink','buttonName','userRoles','userMenus'));
    }

    public function permissionUpdate(Request $request){
        $userroleId = $request->userroleId;
        $userRoles = UserRoles::find($userroleId);
       
            $usermenus = implode(',', $request->usermenu);
        
        if(@$request->usermenuAction){
            $usermenuAction = implode(',', @$request->usermenuAction);
        }else{
            $usermenuAction = '';
        }
        $userRoles->update( [
            'permission' => @$usermenus,                     
            'actionPermission' => @$usermenuAction,                     
        ]);

        return redirect(route('user-roles.index'))->with('msg','User Role Permission Updated Successfully');     
    }
}
