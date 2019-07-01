@extends('layouts.app')
@section('content')
      <div class="example">
        <!-- Page Content -->
              <div class="row">
                <div class="col-sm-2">
                   <a href="{{route('department.index')}}"><h3>Danh sách Phòng ban</h3></a>
                    <ul class="list-group">
                      @foreach($list_pb as $key=>$phongban)
                         <a href="{{route('department.show',$phongban->id)}}"><li class="list-group-item">{{$phongban->department_name}}</li></a>
                      @endforeach
                     </ul>
                  <hr class="d-sm-none">
                </div>
                <div class="col-sm-10">
                  <h2>Danh sách Nhân viên bộ phận  {{$phongban->department_name }}
                  </h2>
                  <p><buuton class=""><a href="{{route('employee.create')}}">Them nhan vien</a></buuton></p>
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>username</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                 <th>Bộ phận</th>
                                 <th> Chức vụ</th>
                                <th>Xem them</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($list_nv as $nhanvien)
                              <tr>
                                <td>{{$nhanvien->username}}</td>
                                <td>{{$nhanvien->fullname}}</td>
                                <td>{{$nhanvien->email}}</td>
                                <td>{{$nhanvien->address}}</td>
                                <td>{{$nhanvien->department_id}}</td>
                                <td><a href="{{route('employee.edit',$nhanvien->id)}}"><button>Sua</button></a>
                                     <form action="{{ route('employee.destroy', $nhanvien->id) }}" class="submitDelete" method="post" onsubmit="return ConfirmDelete();" >
                                          {!! csrf_field() !!}
                                          {{ method_field('DELETE') }}
                                          <button type="submit" class="btn btn-primary">Xóa</button>
                                      </form>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                </div>
              </div>
<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }
</script>
@endsection