@extends('layouts.master')
@section('content')
	
	<div class="card"  >
		<div class="card-header" >
			<strong>Thêm sinh viên</strong> 
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('students.process_insert_students') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9">
						<p class="form-control-static">name</p>
					</div>
				</div> --}}
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="first_name" placeholder="Text" class="form-control" value="{{ old('first_name') }}">{{ $errors->first('first_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" placeholder="Text" class="form-control" value="{{ old('last_name') }}">{{ $errors->first('last_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày sinh</label></div>
					<div class="col-12 col-md-9"><input type="date" id="text-input" name="date" placeholder="Text" class="form-control" value="{{ old('date') }}">{{ $errors->first('date') }}</div>
				</div>
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Level</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="level" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
				</div> --}}
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
					<div class="col-12 col-md-9"><input type="tex" id="text-input" name="phone" placeholder="Text" class="form-control" value="{{ old('phone') }}">{{ $errors->first('phone') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
					<div class="col-12 col-md-9"><input type="text" id="email-input" name="email" placeholder="Nhập Email" class="form-control" value="{{ old('email') }}">{{ $errors->first('email') }}</div>
				</div>
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tài khoản</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="user" placeholder="Text" class="form-control"><small class="form-text text-muted"></small></div>
				</div> --}}
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label">Mật khẩu</label></div>
					<div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Password" class="form-control"><small class="help-block form-text">Please enter a complex password</small></div>
				</div> --}}

				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Địa chỉ</label></div>
					<div class="col-12 col-md-9"><textarea name="address" id="textarea-input" rows="9" placeholder="Content..." class="form-control">{{ old('address') }}</textarea>{{ $errors->first('address') }}</div>
				</div>
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
					<div class="col-12 col-md-9">
						<select name="select" id="select" class="form-control">
							<option value="0">Please select</option>
							<option value="1">Option #1</option>
							<option value="2">Option #2</option>
							<option value="3">Option #3</option>
						</select>
					</div>
				</div> --}}


				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="disabledSelect" class=" form-control-label">Disabled Select</label></div>
					<div class="col-12 col-md-9">
						<select name="disabledSelect" id="disabledSelect" disabled="" class="form-control">
							<option value="0">Please select</option>
							<option value="1">Option #1</option>
							<option value="2">Option #2</option>
							<option value="3">Option #3</option>
						</select>
					</div>
				</div> --}}

				{{-- <div class="row form-group">
					<div class="col col-md-3"><label class=" form-control-label">Radios</label></div>
					<div class="col col-md-9">
						<div class="form-check">
							<div class="radio">
								<label for="radio1" class="form-check-label ">
									<input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">Option 1
								</label>
							</div>
							<div class="radio">
								<label for="radio2" class="form-check-label ">
									<input type="radio" id="radio2" name="radios" value="option2" class="form-check-input">Option 2
								</label>
							</div>
							<div class="radio">
								<label for="radio3" class="form-check-label ">
									<input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 3
								</label>
							</div>
						</div>
					</div>
				</div> --}}
				<div class="row form-group">
					<div class="col col-md-3"><label class=" form-control-label">Giới tính</label></div>
					<div class="col col-md-9">
						<div class="form-check-inline form-check">
							<label for="inline-radio1" class="form-check-label ">
								<input type="radio" id="inline-radio1" name="gender" value="1" class="form-check-input" @if (old('gender')==='1')checked @endif>Nam
							</label>
							<label for="inline-radio2" class="form-check-label ">
								<input type="radio" id="inline-radio2" name="gender" value="0" class="form-check-input" @if (old('gender')==='0')checked @endif>Nữ
							</label>
							{{ $errors->first('gender') }}
							{{-- <label for="inline-radio3" class="form-check-label ">
								<input type="radio" id="inline-radio3" name="inline-radios" value="option3" class="form-check-input">Three
							</label> --}}
						</div>
					</div>
				</div>
				
				
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="file-input" class=" form-control-label">File input</label></div>
					<div class="col-12 col-md-9"><input type="file" id="file-input" name="file-input" class="form-control-file"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="file-multiple-input" class=" form-control-label">Multiple File input</label></div>
					<div class="col-12 col-md-9"><input type="file" id="file-multiple-input" name="file-multiple-input" multiple="" class="form-control-file"></div>
				</div> --}}
				
					<button type="submit" class="btn btn-primary btn-sm" >
						<i class="fa fa-dot-circle-o"></i> Submit
					</button>
					<button type="reset" class="btn btn-danger btn-sm">
						<i class="fa fa-ban"></i> Reset
					</button>
				
			</form>
		</div>
		{{-- <div class="card-footer">
			
		</div> --}}
	</div>
	

@endsection
