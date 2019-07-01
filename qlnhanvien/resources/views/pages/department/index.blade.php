@extends('layouts.app')
@section('content')
      <div class="example">
        <!-- Page Content -->
              <div class="row">
                <div class="col-sm-2">
                  <h3>DS Phòng Ban</h3>
                     <ul class="list-group">

                      @foreach($list_pb as $key=>$phongban)
                         <a href=""><li class="list-group-item">{{$phongban->department_name}}</li></a>
                      @endforeach
                     </ul>
                  <hr class="d-sm-none">
                </div>
                <div class="col-sm-10">
                  <h2>Danh sách phòng ban</h2>
                  <p><buton class=""><a href="{{route('department.create')}}">Them phong ban</a></></p>
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>username</th>
                                <th>Xem them</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($list_pb as $key=>$phongban)
                              <tr>
                                <td>{{$phongban->department_name}}</td>
                                <td><a href="{{route('department.edit',$phongban->id)}}"><button>Sua</button></a>
                                     <form action="{{ route('department.destroy', $phongban->id) }}" class="submitDelete" method="post" onsubmit="return ConfirmDelete();" >
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