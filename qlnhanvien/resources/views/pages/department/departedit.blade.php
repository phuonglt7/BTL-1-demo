
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
        @foreach($list_pb as $value_phongban)
        <form action="{{route('department.update',$value_phongban->id)}}" method="post">
        @csrf
         {{ method_field('PUT') }}
            <tr>
                	   <td>Phòng ban :</td>
                     <td> <input type="text" name="txtdepartment" value="{{$value_phongban->department_name}}" /></td>
        </tr>

        <tr><td></td>
            <td> <input type="submit" value="Sua" ></td>
        </tr>
    </form>
    @endforeach
    </table>
