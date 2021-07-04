@extends('layouts.master')
@section('titles', "Danh sách bệnh án")
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
		<th scope="col" style="text-align: center;">Họ và tên bệnh nhân</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Tình trạng và chuẩn đoán</th>
		<th scope="col" style="text-align: center;">Ngày xuất viện</th>
		<th scope="col" style="text-align: right;"></th>
	</tr>
	<tbody>
		@foreach ($array_list as $medicalrecords)
		<tr>
			<td align="center">
				{{$medicalrecords->patient->full_name}} 
			</td>
			<td align="center">
				{{ $age = date_diff(date_create($medicalrecords->patient->birthday), date_create('now'))->y}} tuổi
			</td>
			<td align="center">
				@php
				if ($medicalrecords->patient->gender==1){
					echo "Nam";
				}else{
					echo "Nữ";
				}
                @endphp
			</td>
			<td align="center">
				{{ $medicalrecords->status }}
			</td>
			<td align="center">
				{{ date('d-m-Y', strtotime($medicalrecords->updated_at)) }}
			</td>
			<th scope="col" align="center" style="text-align: right;">
				<button class="btn btn-success fas fa-edit" style="color: white;" onclick="update()" medicalrecords_id = "{{$medicalrecords->medicalrecords_id}}"></button>
			</th>
		</tr>
        @endforeach
		<br>
	</tbody>
</table>
</div>

<div id="form_insert" style="display: none ;">
	    <div class="card"  >
		<div class="card-header" align="center" style="height: 50px;">
			<div class="row form-group">
			<div class="col-12 col-md-11"><strong>Bệnh án của bệnh nhân</strong></div>
			<div class="col-12 col-md-1"><input type="reset" align="right" class="btn btn-danger fas fa-user" value="x" onclick="hiden()" style="color: white;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('medicalrecords.process_update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ tên bệnh nhân</label></div>
					<div class="col-12 col-md-9">
						<input type="text" id="patient_name" class="form-control" readonly="readonly">
						<input type="hidden" id="medicalrecords_id" name="medicalrecords_id" class="form-control" readonly="readonly">
					</div>
				</div>
                <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tình trạng và chuẩn đoán</label></div>
					<div class="col-12 col-md-9"><input type="text" id="status" name="status" class="form-control" readonly="readonly"></div>
				</div>
				 <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Dặn dò</label></div>
					<div class="col-12 col-md-9"><input type="text" id="advice" name="advice" class="form-control" readonly="readonly"></div>
				</div>
                <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày nhập viện</label></div>
					<div class="col-12 col-md-9"><input type="datetime" id="created_at" name="created_at" placeholder="Nhập viện phí (Tính theo ngày)" class="form-control" readonly="readonly"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày xuất viện</label></div>
					<div class="col-12 col-md-9"><input type="datetime" id="updated_at" name="updated_at" placeholder="Nhập viện phí (Tính theo ngày)" class="form-control" readonly="readonly"></div>
				</div>
                <div class="card-footer" align="center" >
					<button class="btn btn-success btn-sm" >
					<i class="far fa-check-circle"></i>Submit</button>
		        </div>
			</form>
		</div>
	</div>
</div>
@endsection


@push('js')
<script type="text/javascript" >
jQuery(document).ready(function($) {
		$(document).on('click', '.btn.btn-success.fas.fa-edit', function (){
			var medicalrecords_id = $(this).attr('medicalrecords_id');
			console.log(medicalrecords_id);
			$.ajax({
				url: '{{ route('ajax.doctor_medicalrecords') }}',
				type: 'GET',
				dataType: 'json',
				data: {medicalrecords_id : medicalrecords_id},
			})
			.done(function(response) {
				console.log(response);
				created_at = new Date(response[0]['created_at']).toLocaleDateString();
				updated_at = new Date(response[0]['updated_at']).toLocaleDateString();
				$("#patient_name").val(response[0]['first_name']+' '+response[0]['last_name']);
				$("#medicalrecords_id").val(response[0]['medicalrecords_id']);
				$("#status").val(response[0]['status']);
				$("#advice").val(response[0]['advice']);
				$("#created_at").val(created_at);
				$("#updated_at").val(updated_at);
			})
		});
});

function update() {
  document.getElementById("form_insert").style.display = "block";
}

function hiden() {
  document.getElementById("form_insert").style.display = "none";
}
</script>

@endpush
<style type="text/css">
	.form_insert{
		align-self: center;
		top: 100px;
	}
</style>