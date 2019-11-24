<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Admin;
use App\UserRoles;
use App\ShowroomSetup;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Manage Users";
        $users = Admin::orderBy('name','asc')->get();
        return view('admin.users.index')->with(compact('title','users'));
    }

    public function adduser()
    {
        $title = "Add New User";
        $userRoles = UserRoles::orderBy('name','ASC')->get();
        $showrooms = ShowroomSetup::orderBy('name','ASC')->get();
        return view('admin.users.add')->with(compact('title','userRoles','showrooms'));
    }

    public function saveuser(Request $request)
    {
        $this->validation($request);

        $showroomId = implode(',', $request->showrooms);

        if (isset($request->userImage))
        {
            $userImage = \App\HelperClass::UploadImage($request->userImage,'admins','public/uploads/admin_images/');
        }
        else
        {
            $userImage = "";
        }

        $users = Admin::create( [           
            'role' => $request->role,     
            'showroomId' => $showroomId,     
            'name' => $request->name,           
            'username' => $request->username,           
            'image' => $userImage,           
            'email' => $request->email,           
            'password' => bcrypt($request->password),             
            'status' => '0',                      
        ]);

        // $product = Product::create($request->all());

        return redirect(route('user.index'))->with('msg','User Added Successfully');     
    }

    public function edituser($id)
    {
        $title = "Edit User";
        $userRoles = UserRoles::orderBy('name','ASC')->get();
        $showrooms = ShowroomSetup::orderBy('name','ASC')->get();
        $users = Admin::where('id',$id)->first();
        return view('admin.users.edit')->with(compact('title','users','userRoles','showrooms'));
    }
   
    public function updateuser(Request $request)
    {
        $this->validate(request(), [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',            
        ]);

        $userId = $request->userId;
        $showroomId = implode(',', $request->showrooms);

        if (isset($request->userImage))
        {
            $userImage = \App\HelperClass::UploadImage($request->userImage,'admins','public/uploads/admin_images/');
        }
        else
        {
            $userImage = $request->previousUserImage;
        }

        $users = Admin::find($userId);

        $users->update( [           
            'role' => $request->role,     
            'showroomId' => $showroomId,     
            'name' => $request->name,           
            'username' => $request->username,           
            'image' => $userImage,           
            'email' => $request->email,                
        ]);

        // $product = Product::create($request->all());

        return redirect(route('user.index'))->with('msg','User Updated Successfully');     
    }

    public function password($id)
    {
        $title = "Change Paaword";
        $users = Admin::where('id',$id)->first();
        return view('admin.users.changePassword')->with(compact('title','users'));
    }

    public function passwordChange(Request $request)
    {
        $this->validate(request(), [
            'password' => 'required',
            
        ]);
        $userId = $request->userId;

        $users = Admin::find($userId);

        $users->update( [               
            'password' => bcrypt($request->password),                
        ]);

        // $product = Product::create($request->all());

        return redirect(route('user.index'))->with('msg','Password Changed Successfully');     
    }

    // public function userProfile($id){
    //     $users = Admin::where('id',$id)->first();
    //     $userRoles = UserRoles::where('id',$users->role)->first();
    //     return view('admin.users.profile')->with(compact('users','userRoles'));
    // }

    // public function changeUserStatus(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $data = Admin::find($request->user_id);
    //         $data->status = $data->status ^ 1;
    //         $data->update();
    //         print_r(1);       
    //         return;
    //     }
    //     return redirect(route('users.index')) -> with( 'message', 'Wrong move!');
    // }

    public function changeUserStatus(Request $request)
    {
        $userId = $request->userId;

        $userInfo = Admin::where('id',$userId)->first();

        $users = Admin::find($userId);

        if ($userInfo->status == 0)
        {
            $users->update( [               
                'status' => 1,                
            ]);
        }
        else
        {
            $users->update( [               
                'status' => 0,                
            ]);
        }
    }

    public function deleteUser(Request $request)
    {
        Admin::where('id',$request->userId)->delete();
    }

    public function userProfile(Request $request)
    {
        $name = "";
        $user = Admin::select('admins.*','user_roles.name as userRoleName')
            ->join('user_roles','user_roles.id','=','admins.role')
            // ->join('tbl_showroom','tbl_showroom.id','=','admins.showroomId')
            ->where('admins.id',$request->userId)
            ->first();
        $showrooms = explode(',', $user->showroomId);
        $showroomName = ShowroomSetup::select('name')
            ->whereIn('id',$showrooms)
            ->get();

        $loop = count($showroomName);

        foreach ($showroomName as $value)
        {
            if ($loop == 1)
            {
                $name .= $value->name;
            }
            else
            {
                $name .= $value->name.", ";
                $loop--;
            }
        }

        $data = ['user'=>$user,'name'=>$name];
        return $data;
    }


    public function validation(Request $request)
    {
        $this->validate(request(), [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);
    }
}
