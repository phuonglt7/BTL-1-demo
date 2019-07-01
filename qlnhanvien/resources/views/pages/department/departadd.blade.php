@extends('layouts.app')

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
      <h1> Thêm phong ban</h1>
        <form action="{{route('department.store')}}" method="post">
        @csrf
        {{ method_field('POST') }}
        <tr>
            <td>Phòng ban :</td>
            <td> <input type="text" name="txtdepartment"/></td>
        </tr>
        <tr><td></td>
            <td> <input type="submit" value="them" ></td>
        </tr>
    </form>
    </table>

