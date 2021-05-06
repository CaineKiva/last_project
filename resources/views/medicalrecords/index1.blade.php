@extends('layouts.master')
@section('titles',"Giáo Viên ")
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style type="text/css">
	#content{
		position: relative;
	}
	#form_insert{
		position: absolute;
		position: fixed;
		width: 60%;
        top: 0%;
	}
	#textarea-input{
		resize: none;
		height: 40px;
	}
</style>
<div id="list">
<table class="table" id="list">
	<tr>
		<td align="right" colspan="6">
			<button class="btn btn-primary fas fa-pencil-alt" style="color: white;" onclick="show()"></button>
		</td>
	</tr>
	<tr>
		<th scope="col" style="text-align: center;">Tên bệnh nhân</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Chuyên khoa</th>
		<th scope="col" style="text-align: center;">Ngày nhập viện</th>
		<th></th>
    </tr>
    <tbody>
        @foreach ($array_list as $medical)
		<tr>
			<td align="center">
				{{$doctor->full_name}}
			</td>
			<td align="center">
				   {{ $age = date_diff(date_create($doctor->birthday), date_create('now'))->y}}
			</td>
			<td align="center">
				@php
				if ($doctor->gender==1){
					echo "Nam";
				}else {
					echo "Nữ";
				}
                @endphp
			</td>
			<td align="center">
				{{$doctor->speciallist->speciallist_name}}
			</td>
			<td align="center">
				{{$doctor->phone}}
			</td>
			<td align="center">
				<a href="{{ route('doctor.delete',['doctor_id' => $doctor->doctor_id]) }}" class="btn btn-success fas fa-edit" style="color: white;"></a>
				<a href="{{ route('doctor.delete',['doctor_id' => $doctor->doctor_id]) }}" class="btn btn-danger far fa-trash-alt" style="color: white;"></a>
			</td>
		</tr>
        @endforeach
			<br>
	{{-- <input type="search" placeholder="search..." name="search" value="{{ $search }}" style="float:right;border-radius: 10px;">
	<button type="submit"></button> --}}
</tbody>
</table>
</div>
<div id="form_insert" style="display: none ;">
	    <div class="card"  >
		<div class="card-header" align="center" style="height: 50px;">
			<div class="row form-group">
			<div class="col-12 col-md-11"><strong>Thêm Bác Sĩ</</strong></div>
			<div class="col-12 col-md-1"><input type="reset" align="right" class="btn btn-danger fas fa-user" value="x" onclick="hiden()" style="color: white;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('doctor.process_insert') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="first_name" placeholder="Nhập Họ (chỉ được nhập các chữ cái)" class="form-control" value="{{ old('first_name') }}">{{ $errors->first('first_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" placeholder="Nhập Tên (chỉ được nhập các chữ cái)" class="form-control" value="{{ old('last_name') }}">{{ $errors->first('last_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày sinh</label></div>
					<div class="col-12 col-md-9"><input type="date" id="text-input" name="birthday" placeholder="Text" class="form-control"  value="{{ old('birthday') }}">{{ $errors->first('birthday') }}</div>
				</div>
			
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="phone" placeholder="Nhập SĐT" class="form-control" value="{{ old('phone') }}">{{ $errors->first('phone') }}</div>
				</div>
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
						</div>
						{{ $errors->first('gender') }}
					</div>
				</div>
				<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Chuyên khoa</label></div>
				<div class="col-12 col-md-9">
					    <select name="speciallist_id" class="form-control">
						    <option disabled selected>Chọn chuyên khoa</option>}
						    @foreach ($speciallist  as $speciallist)
						    <option value="{{ $speciallist->speciallist_id }}">
							    {{ $speciallist->speciallist_name }}
						    </option>
						    @endforeach
					    </select>
				    </div>
                </div>
			    <div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Chức vụ</label></div>
				<div class="col-12 col-md-9">
					    <select name="competence_id" class="form-control">
						    @foreach ($competence  as $competence)
						    <option value="{{ $competence->competence_id }}" @if (($competence->competence_id)==='3') selected @endif>
						        {{ $competence->competence_name }}
						    </option>
						    @endforeach
					    </select>
				    </div>
                </div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
					<div class="col-12 col-md-9"><input type="text" id="email-input" name="email" placeholder="...@gmail.com" class="form-control" value="{{ old('email') }}">{{ $errors->first('email') }}</div>
				</div>
               	<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Địa chỉ</label></div>
					<div class="col-12 col-md-9"><textarea name="address" id="textarea-input" rows="9" placeholder="Nhập địa chỉ" class="form-control">{{ old('address') }}</textarea>{{ $errors->first('address') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label">Mật khẩu</label></div>
					<div class="col-12 col-md-9"><input type="password" id="text-input" name="password" placeholder="Mật khẩu có tối thiểu 8 ký tự" class="form-control" class="form-control" value="{{ old('password') }}">{{ $errors->first('password') }}</div>
				</div>
                <div class="card-footer" align="center" >
					<button class="btn btn-success btn-sm" >
					<i class="far fa-check-circle"></i>Submit</button>
		        </div>
			</form>
		</div>
	</div>
</div>
{{$array_list->appends(['search' => $search])->links()}}
@endsection

<script type="text/javascript">
function show() {
  document.getElementById("form_insert").style.display = "block";
}

function hiden() {
  document.getElementById("form_insert").style.display = "none";
}
</script>