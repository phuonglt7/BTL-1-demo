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
        <form action="{{route('employee.store')}}" method="post"enctype="multipart/form-data">
              @csrf
              {{ method_field('POST') }}
        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
        <tr>
            <td>username :</td>
            <td> <input type="text" name="txtusername"/></td>
        </tr>
        <tr>
            <td>password :</td>
            <td> <input type="text" name="txtpassword"/></td>
        </tr>
        <tr>
          <td>email :</td>
              <td> <input type="email" name="txtemail"/></td>
        </tr>
        <tr>
            <td>Ho ten : </td>
              <td> <input type="text" name="txtfullname"/></td>
        </tr>
        <tr>
            <td>Dia chi: </td>
              <td> <input type="text" name="txtaddress"/></td>
        </tr>
         <tr>
            <td>Giới tính: </td>
            <td><select name="txtgender">
               <option disabled selected >--- Lựa chọn ---</option>
               <option value="0">Nữ</option>
                <option value="1">Nam</option>
              </select>
            </td>
        </tr>
         <tr>
            <td>Ngày sinh: </td>
              <td> <input type="date" name="txtbirthday"/></td>
        </tr>
         <tr>
            <td>Phòng ban: </td>
            <td>
              <select name="txtdepartment">
               <option disabled selected >--- Lựa chọn ---</option>
                @foreach($list_pb as $value_phongban)
               <option value="{{$value_phongban->id}}">{{$value_phongban->department_name}}</option>
                @endforeach
              </select>
            </td>
        </tr>
         <tr>
            <td>Vị trí: </td>
            <td>
             <select name="txtpermission">
               <option disabled selected >--- Lựa chọn ---</option>
               @foreach($list_q as $value_quyen)
               <option value="{{$value_quyen->id}}">{{$value_quyen->permission_name}}</option>
                @endforeach
              </select>
            </td>
        </tr>
        <tr><td></td>
            <td> <input type="submit" value="them" ></td>
        </tr>
    </form>
    </table>
@endsection
