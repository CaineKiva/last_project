@extends('layouts.master')
@section('titles',"Danh sách các bệnh nhân")
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
        z-index: 99;
	}
	#textarea-input{
		resize: none;
		height: 40px;
	}
</style>
<div id="list">
<table class="table" id="list">
	<tr>
		<td align="right" colspan="7">
			<button class="btn btn-primary fas fa-pencil-alt" style="color: white;" onclick="show()"></button>
		</td>
	</tr>
	<tr>
		<th scope="col" style="text-align: center;">Họ và Tên</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">SĐT liên hệ</th>
		<th scope="col" style="text-align: center;">Email</th>
		<th></th>
    </tr>
    <tbody>
        @foreach ($array_list as $patient)
		<tr>
			<td align="center">
				{{ $patient->full_name }}
			</td>
			<td align="center">
				   {{ $age = date_diff(date_create($patient->birthday), date_create('now'))->y}} tuổi
			</td>
			<td align="center">
				@php
				if ($patient->gender==1){
					echo "Nam";
				}else {
					echo "Nữ";
				}
                @endphp
			</td>
			<td align="center">
				{{ $patient->contact_phone }}
			</td>
			<td align="center">
				@php
				if ($patient->email != null){
					echo $patient->email;
				}else {
					echo "Không có email";
				}
                @endphp
			</td>
			<td align="center">
				<button class="btn btn-success fas fa-edit" style="color: white;" onclick="update()" patient_id = "{{$patient->patient_id}}"></button>
				<a href="{{ route('patient.delete',['patient_id' => $patient->patient_id]) }}" class="btn btn-danger far fa-trash-alt" style="color: white;"></a>
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
			<div class="col-12 col-md-11"><strong>Thêm Bệnh nhân</strong></div>
			<div class="col-12 col-md-1"><input type="reset" align="right" class="btn btn-danger fas fa-user" value="x" onclick="hiden()" style="color: white;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ</label></div>
					<div class="col-12 col-md-9"><input type="text" id="first_name" name="first_name" placeholder="Nhập Họ (chỉ được nhập các chữ cái)" class="form-control" value="{{ old('first_name') }}">{{ $errors->first('first_name') }}
						<input type="hidden" id="patient_id" name="patient_id" placeholder="Nhập Họ (chỉ được nhập các chữ cái)" class="form-control" value="{{ old('first_name') }}"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9"><input type="text" id="last_name" name="last_name" placeholder="Nhập Tên (chỉ được nhập các chữ cái)" class="form-control" value="{{ old('last_name') }}">{{ $errors->first('last_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày sinh</label></div>
					<div class="col-12 col-md-9"><input type="date" id="birthday" name="birthday" placeholder="Text" class="form-control"  value="{{ old('birthday') }}">{{ $errors->first('birthday') }}</div>
				</div>
			
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
					<div class="col-12 col-md-9"><input type="text" id="contact_phone" name="contact_phone" placeholder="Nhập SĐT" class="form-control" value="{{ old('contact_phone') }}">{{ $errors->first('contact_phone') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label class=" form-control-label">Giới tính</label></div>
					<div class="col col-md-9">
						<div class="form-check-inline form-check">
							<label for="inline-radio1" class="form-check-label ">
								<input type="radio" id="inline-radio1" name="gender" value="1" class="form-check-input" @if (old('gender')==='1')checked @endif>Nam &emsp;
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
					<div class="col-12 col-md-9"><input type="text" id="email" name="email" placeholder="...@gmail.com" class="form-control" value="{{ old('email') }}">{{ $errors->first('email') }}</div>
				</div>
               	<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Địa chỉ</label></div>
					<div class="col-12 col-md-9"><textarea name="address" id="address" rows="9" placeholder="Nhập địa chỉ" class="form-control" style="max-height: 120px; resize: none;">{{ old('address') }}</textarea>{{ $errors->first('address') }}</div>
				</div>
				<div class="row form-group" id="password_div">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label">Mật khẩu</label></div>
					<div class="col-12 col-md-9"><input type="password" id="password" name="password" placeholder="Mật khẩu có tối thiểu 8 ký tự" class="form-control" class="form-control" value="{{ old('password') }}">{{ $errors->first('password') }}</div>
				</div>
                <div class="card-footer" align="center" >
					<button class="btn btn-success btn-sm" onclick="show()">
					<i class="far fa-check-circle"></i> Submit</button>
		        </div>
			</form>
		</div>
	</div>
</div>
{{$array_list->appends(['search' => $search])->links()}}
@endsection

@push('js')
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('click', '.btn.btn-success.fas.fa-edit', function (){
			var patient_id = $(this).attr('patient_id');
			// $("#first_name").html('');
			$.ajax({
				url: '{{ route('ajax.patient_information') }}',
				type: 'GET',
				dataType: 'json',
				data: {patient_id : patient_id},
			})
			.done(function(response) {
				console.log(response[0]['speciallist_id']);
					$("strong").text('Cập nhật thông tin');
                   	$("#first_name").val(response[0]['first_name']);
                   	$("#last_name").val(response[0]['last_name']);
                   	$("#birthday").val(response[0]['birthday']);
                   	$("#select_speciallist").val(response[0]['speciallist_id']);
                   	$("#select_competence").val(response[0]['competence_id']);
                   	$("#contact_phone").val(response[0]['contact_phone']);
                   	$("#address").val(response[0]['address']);
                   	$("#email").val(response[0]['email']);
                   	$('input:radio[name="gender"]').filter('[value = "' + response[0]['gender'] +'" ]').attr('checked', true);
                   	$("#routes").attr('action','{{ route('patient.process_update') }}');
                   	$("#password_div").hide();
			})
		});

		$(document).on('click', '.btn.btn-primary.fas.fa-pencil-alt', function (){
			$("#routes").attr('action','{{ route('patient.process_insert') }}');
			$("#routes").trigger("reset");
		});

	});
function show() {
  document.getElementById("form_insert").style.display = "block";
}
function update() {
  document.getElementById("form_insert").style.display = "block";
}
function hiden() {
  document.getElementById("form_insert").style.display = "none";
}
</script>
@endpush