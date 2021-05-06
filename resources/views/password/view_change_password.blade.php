@extends('layouts.master')
@section('content')

<div class="card"  >
	<div class="card-header" >
		<strong>Thay đổi mật khẩu</strong> 
	</div>
	<div class="card-body card-block" >
		<form action="{{ route('password.process_change_password',['id'=> Session::get('id')]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			<div class="row form-group">
				<div class="col col-md-3"><label for="text-input" class=" form-control-label">Mật khẩu hiện tại</label></div>
				<div class="col-12 col-md-9"><input type="password" id="text-input" name="password" placeholder="Text" class="form-control" value="{{ old('password') }}">{{ $errors->first('password') }}</div>
			</div>
			<div class="row form-group">
				<div class="col col-md-3"><label for="text-input" class=" form-control-label">Mật khẩu mới</label></div>
				<div class="col-12 col-md-9"><input type="password" id="text-input" name="new_password" placeholder="Text" class="form-control" value="{{ old('new_password') }}">{{ $errors->first('new_password') }}</div>
			</div>
			<div class="row form-group">
				<div class="col col-md-3"><label for="text-input" class=" form-control-label">Xác nhận mật khẩu mới</label></div>
				<div class="col-12 col-md-9"><input type="password" id="text-input" name="confirm_password" placeholder="Text" class="form-control" value="{{ old('confirm_password') }}">{{ $errors->first('confirm_password') }}</div>
			</div>
			<button type="submit" class="btn btn-primary btn-sm" >
				<i class="fa fa-dot-circle-o"></i> Submit
			</button>
			<button type="reset" class="btn btn-danger btn-sm">
				<i class="fa fa-ban"></i> Reset
			</button>

		</form>
	</div>

</div>


@endsection