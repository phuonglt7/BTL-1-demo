@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                @if (count($errors) > 0)
			      <div class="alert alert-danger">
			          Thông tin đăng ký không đầy đủ, bạn cần chỉnh sửa như sau:
			          <ul>
			              @foreach ($errors->all() as $error)
			                  <li>{{ $error }}</li>
			              @endforeach
			          </ul>
			      </div>
			    @endif
                 @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('postchangepass') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mat khau cu') }}</label>
                            <div class="col-md-6">
                                <input id="password_old" type="password" name="password_old" required >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mat khau moi') }}</label>
                            <div class="col-md-6">
                                <input id="password_new" type="password" name="password_new" required >
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nhap lai mat khau') }}</label>
                            <div class="col-md-6">
                                <input id="password_new_confirm" type="password" name="password_new_confirm" required >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Doi mat khau') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
