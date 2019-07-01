@extends('layouts.header')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
@if (count($errors) > 0)
    <div class="alert alert-danger">
      Thông tin không đầy đủ, bạn cần chỉnh sửa như sau:
         <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
     </div>
@endif
     <table>
      <h1> Thêm nhân viên</h1>
        @foreach($users as $user)
        <form action="{{route('employee.update',$user->id)}}" method="post">
        @csrf
         {{ method_field('PUT') }}
        <tr>
            <td>username :</td>
            <td> <input type="text" name="txtusername" value="{{$user->username}} disabled"></td>
        </tr>
        <tr>
            <td>username :</td>
            <td> <input type="hidden" name="txtusername" value="{{$user->password}}"></td>
        </tr>
        <tr>
          <td>email :</td>
              <td> <input type="email" name="txtemail" value="{{$user->email}}"/></td>
        </tr>
        <tr>
            <td>Ho ten : </td>
              <td> <input type="text" name="txtfullname" value="{{$user->fullname}}"/></td>
        </tr>
        <tr>
            <td>Dia chi: </td>
              <td> <input type="text" name="txtaddress" value="{{$user->address}}"/></td>
        </tr>
         <tr>
            <td>Giới tính: </td>
            <td><select name="txtgender">
            	@if($user->username==0)
               <option value="0" selected>Nữ</option>
               <option value="1">Nam</option>
                @else
                <option value="1" selected>Nam</option>
                <option value="0">Nữ</option>
                @endif
              </select>
            </td>
        </tr>
         <tr>
            <td>Ngày sinh: </td>
              <td> <input type="date" name="txtbirthday" value="{{$user->birthday}}"/></td>
        </tr>
         <tr>
            <td>Phòng ban: </td>
            <td>
              <select name="txtdepartment">
                @foreach($list_pb as $value_phongban)
                	@if($user->department_id==$value_phongban->id)
                	 <option value="{{$value_phongban->id}}" selected="selected">{{$value_phongban->department_name}}</option>
                	 @else
                          <option value="{{$value_phongban->id}}">{{$value_phongban->department_name}}</option>
                    @endif
                @endforeach
              </select>
            </td>
        </tr>
         <tr>
            <td>Vị trí:{{$user->permission_id}} </td>
            <td>
             <select name="txtpermission">
               @foreach($list_q as $value_quyen)
                    @if($user->permission_id==$value_quyen->id)
                	    <option value="{{$value_quyen->id}}" selected="selected" >{{$value_quyen->permission_name}}</option>
                	@else
                        <option value="{{$value_quyen->id}}" >{{$value_quyen->permission_name}}</option>
                    @endif
                @endforeach
              </select>
            </td>
        </tr>
        <tr><td></td>
            <td> <input type="submit" value="Sua" ></td>
        </tr>
    </form>
    @endforeach
    </table>

@endsection