<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\User;
use App\Department;
use App\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $quyen=Auth::id();
        $taikhoan=User::where('id',$quyen)->get();
         $list_q=Permission::all();
        if($quyen==1){
            $list_pb=Department::all();
            $list_nv=User::all();
            return view('layouts.index',compact('taikhoan','list_pb','list_nv','list_q'));
       }
       else if($quyen==2){
               $list_nv=User::where('department_id',Auth::user()->department_id)->where('permission_id','>',$quyen)->get();
                $list_pb=Department::where('id',Auth::user()->department_id)->get();
            return view('layouts.index',compact('taikhoan','list_pb','list_nv','list_q'));
       }
   }
    public function show($id){
        $quyen=Auth::id();
        $taikhoan=User::where('id',$quyen)->get();
        if($quyen==1){
            $list_nv=User::where('department_id',$id)->get();
            $list_pb=Department::all();
            $bophan= Department::select('department_name')->where('id',$id);
            return view('pages.department.show',compact('list_nv','list_pb','bophan'));
       }
       else{
            return redirect(route('employee.index'))->with('status','Ban khong co quyen thuc hien!');
       }
    }
    public function create()
    {
        $quyen=Auth::id();
        if($quyen==1){
            $list_q=Permission::all();
            $list_pb=Department::all();
       }
       else{
            $list_q=Permission::where('id','>',$quyen);
             $list_pb=Department::where('id',Auth::user()->department_id)->get();
       }
        return view('pages.add',compact('list_pb','list_q'));
    }

    public function store(Request $request){
        $status=[
            'required' => 'Trường :attribute bắt buộc nhập.',
        ];
        $niceNames = array(
            'txtdepartment'=>'phòng ban',
        );
        $validator= Validator::make($request->all(),[
            'txtusername'=>'required',
            'txtpassword'=>'required',
            'txtemail'=>'required',
            'txtfullname'=>'required',
            'txtaddress'=>'required',
            'txtgender'=>'required',
            'txtdepartment'=>'required',
            'txtpermission'=>'required',
        ],$status);
        $validator->setAttributeNames($niceNames);
        //thêm mới bảng book và thời gian khởi tạo
        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator)
                    ->withInput();
        }
        else{
        User::insert([
            'username'=>$request->input('txtusername'),
            'password'=>bcrypt($request->input('txtpassword')),
            'email'=>$request->input('txtemail'),
            'fullname'=>$request->input('txtfullname'),
            'address'=>$request->input('txtaddress'),
            'gender'=>$request->input('txtgender'),
            'department_id'=> $request->input('txtdepartment'),
            'permission_id'=>$request->input('txtpermission'),
            'count_login'=>0,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
        // quay trở lại trang danh mục sách
        return redirect(route('department.index'))->with('status','Thêm phong ban thành công!');
        }
    }

    public function edit($id)
    {
        $quyen=Auth::id();
        $user=User::where('id',$id)->get();
        if($quyen==1){
            $list_q=Permission::all();
            $list_pb=Department::all();
       }
       else{
            $list_q=Permission::where('id','>',$quyen);
             $list_pb=Department::where('id',Auth::user()->department_id)->get();
       }
        return view('pages.add',compact('list_pb','list_q'));
    }

    public function update(Request $request, $id)
    {
        $status=[
            'required' => 'Trường :attribute bắt buộc nhập.'
        ];
        $niceNames = array(
            'txtdepartment'=>'phòng ban',
        );
        $validator= Validator::make($request->all(),[
            'txtemail'=>'required',
            'txtfullname'=>'required',
            'txtaddress'=>'required',
            'txtgender'=>'required',
            'txtdepartment'=>'required',
            'txtpermission'=>'required',
        ],$status);
        $validator->setAttributeNames($niceNames);
        //thêm mới bảng book và thêm thời gian khởi tạo
        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator)
                    ->withInput();
        }
        else{
             User::where('id',$id)
            ->update([
            'email'=>$request->input('txtemail'),
            'fullname'=>$request->input('txtfullname'),
            'address'=>$request->input('txtaddress'),
            'gender'=>$request->input('txtgender'),
            'department_name'=> $request->input('txtdepartment'),
            'permission_id'=>$request->input('txtpermission'),
            'updated_at' => new \DateTime()
            ]
            );
             // quay trở lại trang danh mục sách
            return redirect(route('department.index'))->with('status','Sửa phòng ban thành công!');
        }
    }

    public function destroy($id)
    {
        // xóa sách
        User::where('id',$id)
            ->delete();
        // trở lại trang danh sách
        return redirect(route('department.index'))->with('status','Xóa phòng ban  thành công!');
    }
}
