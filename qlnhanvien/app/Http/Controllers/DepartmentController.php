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

class DepartmentController extends Controller
{

    public function index()
    {
        $quyen=Auth::id();
        $taikhoan=User::where('id',$quyen)->get();
        if($quyen==1){
            $list_pb=Department::all();
            return view('pages.department.index',compact('taikhoan','list_pb'));
       }
       else{
            return redirect(route('employee.index'))->with('status','Ban khong co quyen thuc hien!');
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
             return view('pages.department.departadd');
       }
       else{
            redirect(route('employee.index'))->with('status','Ban khong co quyen thuc hien!');
       }
    }

    public function store(Request $request){
        $status=[
            'required' => 'Trường :attribute bắt buộc nhập.',
        ];
        $niceNames = array(
            'txtdepartment'=>'phòng ban',
        );
        $validator= Validator::make($request->all(),[
            'txtdepartment'=>'required',
        ],$status);
        $validator->setAttributeNames($niceNames);
        //thêm mới bảng book và thời gian khởi tạo
        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator)
                    ->withInput();
        }
        else{
        Department::insert([
            'department_name'=> $request->input('txtdepartment'),
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
        if($quyen==1){
            $list_pb=Department::where('id',$id)->get();
            return view('pages.department.departedit', compact('list_pb'));
         }
        else{
            return redirect(route('employee.index'))->with('status','Ban khong co quyen thuc hien!');
       }
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
            'txtdepartment'=>'required',
        ],$status);
        $validator->setAttributeNames($niceNames);
        //thêm mới bảng book và thêm thời gian khởi tạo
        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator)
                    ->withInput();
        }
        else{
             Department::where('id',$id)
            ->update([
            'department_name'=> $request->input('txtdepartment'),
            'updated_at' => new \DateTime()
            ]
            );
             // quay trở lại trang danh mục sách
            return redirect(route('department.index'))->with('status','Sửa phòng ban thành công!');
        }
    }

    public function destroy($id)
    {
        //kiem tra co nhan vien ton tai 
        $user=User::where('department_id',$id)->count();
        if($user==0){
        // xóa sách
        Department::where('id',$id)
            ->delete();
        // trở lại trang danh sách
            return redirect(route('department.index'))->with('status','Xóa phòng ban  thành công!');
        }
        else{
             return redirect(route('department.index'))->with('status','phong ban nay khong the xoa!');
        }
    }
}
