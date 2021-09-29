@extends('layouts.master')
@section('titles', "Danh sách các y tá")
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
        z-index: 9999;
	}
	#textarea-input{
		resize: none;
		height: 40px;
	}
</style>
<table class="table">
	<tr>
		<td align="right" colspan="8">
			<button class="btn btn-primary fas fa-pencil-alt" style="color: white;" onclick="show()"></button>
		</td>
	</tr>
	<tr>
		<th scope="col" style="text-align: center;">Họ và Tên</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Địa chỉ</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Điện thoại</th>
		<th scope="col" style="text-align: center;">Email</th>
		<th></th>
	</tr>
		<tbody>
			@foreach ($array_list as $nurse)
			<tr>
				<td align="center">
					{{$nurse->full_name}}
				</td>
				<td align="center">
					{{ $age = date_diff(date_create($nurse->birthday), date_create('now'))->y}}
				</td>
				<td align="center">
					{{$nurse->address}}
				</td>
				<td align="center">
					@php
					if ($nurse->gender==1){
						echo "Nam";
					}else {
						echo "Nữ";
					}
					@endphp
				</td>
				<td align="center">
					{{$nurse->phone}}
				</td>
				<td align="center">
					{{$nurse->email}}
				</td>
				<th scope="col" align="center" style="text-align: right;">
				<button class="btn btn-success fas fa-edit" style="color: white;" onclick="update()" nurse_id = "{{$nurse->nurse_id}}"></button>

				<a href="{{ route('nurse.delete',['nurse_id' => $nurse->nurse_id]) }}" class="btn btn-danger far fa-trash-alt" style="color: white;"></a>
				</th>
			</tr>
			@endforeach
			<br>
	{{-- <input type="search" placeholder="search..." name="search" value="{{ $search }}" style="float:right;border-radius: 10px;">
	<button type="submit"></button> --}}
</tbody>
</table>

<div id="form_insert" style="display: none ;">
	    <div class="card"  >
		<div class="card-header" align="center" style="height: 50px;">
			<div class="row form-group">
 			    <div class="col-12 col-md-11"><strong>Cập nhật nhân sự bộ phận y tá</strong></div>
                <div class="col-12 col-md-1"><input type="reset" align="right" value=" X " onclick="hiden()" style="background-color: red;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('nurse.process_insert') }}" id="routes" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ</label></div>
					<div class="col-12 col-md-9">
						<input type="hidden" id="nurse_id" name="nurse_id" class="form-control">
						<input type="text" id="first_name" name="first_name" placeholder="Nhập Họ (chỉ được nhập các chữ cái)" class="form-control">{{ $errors->first('first_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9"><input type="text" id="last_name" name="last_name" placeholder="Nhập Tên (chỉ được nhập các chữ cái)" class="form-control">{{ $errors->first('last_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày sinh</label></div>
					<div class="col-12 col-md-9"><input type="date" id="birthday" name="birthday" placeholder="Text" class="form-control"  >{{ $errors->first('birthday') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
					<div class="col-12 col-md-9"><input type="text" id="phone" name="phone" placeholder="Nhập SĐT" class="form-control" >{{ $errors->first('phone') }}</div>
				</div>
				<div class="row form-group">
				<div class="col col-md-3" style="margin: auto;"><label for="select" class=" form-control-label">Chức vụ</label></div>
				<div class="col-12 col-md-9">
					<select name="competence_id" class="form-control" id="select_competence">
						@foreach ($competence as $competence)
                            @if ($competence->competence_id > 3){
                                <option value="{{ $competence->competence_id }}" @if ($competence->competence_id == 5) selected @endif>
                                    {{ $competence->competence_name }}
                                </option>
                            }
                            @endif
						@endforeach
					</select>
				</div>
			    </div>
				<div class="row form-group">
					<div class="col col-md-3"><label class=" form-control-label">Giới tính</label></div>
					<div class="col col-md-9">
						<div class="form-check-inline form-check">
							<label for="inline-radio1" class="form-check-label ">
								<input type="radio" id="inline-radio1" name="gender" value="1" class="form-check-input" @if (old('gender')==='1')checked @endif>Nam &ensp;
							</label>
							<label for="inline-radio2" class="form-check-label ">
								<input type="radio" id="inline-radio2" name="gender" value="0" class="form-check-input" @if (old('gender')==='0')checked @endif>Nữ
							</label>
						</div>
						{{ $errors->first('gender') }}
					</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
					<div class="col-12 col-md-9"><input type="text" id="email" name="email" placeholder="...@gmail.com" class="form-control">{{ $errors->first('email') }}</div>
				</div>
               	<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Địa chỉ</label></div>
					<div class="col-12 col-md-9"><textarea name="address" id="address" rows="9" placeholder="Nhập địa chỉ" class="form-control" style="height: 60px; resize: none;"></textarea>{{ $errors->first('address') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label" id="password_label">Mật khẩu</label></div>
					<div class="col-12 col-md-9"><input id="password_input" type="password" placeholder="Mật khẩu có tối thiểu 8 ký tự" class="form-control" class="form-control">{{ $errors->first('password') }}</div>
				</div>
                <div class="card-footer" align="center" >
					<button class="btn btn-success btn-sm">
					<i class="far fa-check-circle"></i> Submit</button>
		        </div>
			</form>
		</div>
	</div>
</div>
{{$array_list->appends(['search' => $search])->links()}}
@endsection

@push('js')
<script type="text/javascript" >
	jQuery(document).ready(function($) {
		$(document).on('click', '.btn.btn-success.fas.fa-edit', function (){
			var nurse_id = $(this).attr('nurse_id');
			// $("#first_name").html('');
			$.ajax({
				url: '{{ route('ajax.nurse_information') }}',
				type: 'GET',
				dataType: 'json',
				data: {nurse_id : nurse_id},
			})
			.done(function(response) {
                    $("strong").text('Cập nhật thông tin cá nhân');
					$("#routes").attr('action','{{ route('nurse.process_update') }}');
					$("#nurse_id").val(response[0]['nurse_id']);
                   	$("#first_name").val(response[0]['first_name']);
                   	$("#last_name").val(response[0]['last_name']);
                   	$("#birthday").val(response[0]['birthday']);
                   	$("#select_competence").val(response[0]['competence_id']);
                   	$("#phone").val(response[0]['phone']);
                   	$("#address").val(response[0]['address']);
                   	$("#email").val(response[0]['email']);
                   	$('input:radio[name="gender"]').filter('[value = "' + response[0]['gender'] +'" ]').attr('checked', true);
			})
		});

		$(document).on('click', '.btn.btn-primary.fas.fa-pencil-alt', function (){
			$("#routes").attr('action','{{ route('nurse.process_insert') }}');
			$("#routes").trigger("reset");
		});

	});

function show() {
    document.getElementById("form_insert").style.display = "block";
    document.getElementById("password_label").style.display = "block";
    document.getElementById("password_input").style.display = "block";
}

function update() {
    document.getElementById("form_insert").style.display = "block";
    document.getElementById("password_label").style.display = "none";
    document.getElementById("password_input").style.display = "none";
}

function hiden() {
  	document.getElementById("form_insert").style.display = "none";
}
</script>
@endpush
