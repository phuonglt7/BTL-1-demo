@extends('layouts.app')
@section('content')
      <div class="example">
        <!-- Page Content -->
              <div class="row">
                <div class="col-sm-2">
                   <a href="{{route('department.index')}}"><h3>DS Phòng Ban</h3></a>
                    <ul class="list-group ">
                      @foreach($list_pb as $key=>$phongban)
                         <a href="{{route('department.show',$phongban->id)}}"><li class="list-group-item">{{$phongban->department_name}}</li></a>
                      @endforeach
                     </ul>
                  <hr class="d-sm-none">
                </div>
                <div class="col-sm-10">
                  <h2>Danh sách Nhân viên</h2>
                  <p><buton class="btn btn-warning"><a href="{{route('employee.create')}}">Thêm nhân viên</a></buton></p>
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="export">
                         <a href ="{{ route('export') }}" class="btn btn-info export" id="export-button"> Export file </a>
                    </div>

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>username</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Bộ phận</th>
                                <th> Chức vụ</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($list_nv as $nhanvien)
                              <tr>
                                <td>{{$nhanvien->username}}</td>
                                <td>{{$nhanvien->fullname}}</td>
                                <td>{{$nhanvien->email}}</td>
                                <td>{{$nhanvien->address}}</td>
                                <td>
                                  @foreach($list_pb as $key=>$phongban)
                                    @if($nhanvien->department_id==$phongban->id)
                                      {{$phongban->department_name}}
                                    @endif
                                  @endforeach
                                </td>
                                <td>
                                  @foreach($list_q as $key=>$quyen)
                                    @if($nhanvien->permission_id==$quyen->id)
                                      {{$quyen->permission_name}}
                                    @endif
                                  @endforeach
                                </td>
                                <td><a href="{{route('employee.edit',$nhanvien->id)}}"><button class="btn btn-info">Sửa</button>    </a>
                                </td>
                                <td>
                                     <form action="{{ route('employee.destroy', $nhanvien->id) }}" class="submitDelete" method="post" onsubmit="return ConfirmDelete();" >
                                          {!! csrf_field() !!}
                                          {{ method_field('DELETE') }}
                                          <button type="submit" class="btn btn-primary">Xóa</button>
                                      </form>
                                </td>
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