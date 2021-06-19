@extends('layouts.master')
@section('titles', "Danh sách các lịch hẹn")
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style type="text/css">
	#content{
		position: relative;
	}
	#form_information{
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
<div id="list">
<table class="table" id="list">
	<tr>
		<th scope="col" style="text-align: center;">Họ và tên bệnh nhân</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Chuyên khoa</th>
		<th scope="col" style="text-align: center;">Ngày nhập viện</th>
		<th scope="col" style="text-align: center;">Phòng điều trị</th>
		<th scope="col" style="text-align: right;"><button class="btn btn-primary fas fa-pencil-alt" style="color: white;" onclick="show()"></button></th>
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
				{{ $medicalrecords->speciallist->speciallist_name }}
			</td>
			<td align="center">
				{{ $medicalrecords->created_at->format('d/m/Y') }}
			</td>
			<td align="center">
				{{ $medicalrecords->room }}
			</td>
			<th scope="col" align="center" style="text-align: right;">
				<button class="btn btn-primary fas fa-edit" style="color: white;" onclick="show()" 
				medicalrecords_id = "{{$medicalrecords->medicalrecords_id}}"></button>
			</th>
		</tr>
        @endforeach
		<br>
	</tbody>
</table>
</div>

<div id="form_information" style="display: none ;">
	    <div class="card"  >
		<div class="card-header" align="center" style="height: 50px;">
			<div class="row form-group">
			<div class="col-12 col-md-11"><strong>Thông tin bệnh nhân</strong></div>
			<div class="col-12 col-md-1"><input type="reset" align="right" class="btn btn-danger fas fa-user" onclick="hiden()" style="color: white;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('medicalrecords.discharge') }}" id="routes" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ và tên bệnh nhân</label></div>
					<div class="col-12 col-md-9">
						<input type="hidden" id="appointment_id" name="appointment_id" readonly="readonly" class="form-control">
						<input type="hidden" id="patient_id" name="patient_id" readonly="readonly" class="form-control">
						<input type="text" id="patient_name" readonly="readonly" class="form-control"></div>
				</div>
			    <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Chuyên khoa điều trị</label></div>
					<div class="col-12 col-md-9">
						<input type="text" id="speciallist_name" class="form-control" readonly="readonly"></div>
				</div>
			    <div class="row form-group" id="symptom_div">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày nhập viện</label></div>
					<div class="col-12 col-md-9"><input type="datetime" id="created_at" name="created_at" class="form-control"></div>
				</div>
			    <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phòng điều trị</label></div>
					<div class="col-12 col-md-9"><input type="text" id="room" name="room" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tình trạng</label></div>
					<div class="col-12 col-md-9">
						<select name="treatment" class="form-control" id="treatment_status">
						<option selected="selected" value="0">Đang điều trị</option>
						<option value="1">Xuất viện</option>
                    </select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Viện phí tính tới hôm nay</label></div>
					<div class="col-12 col-md-9"><input type="text" id="price" name="price" class="form-control" readonly="readonly"></div>
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
		$(document).on('click', '.btn.btn-primary.fas.fa-edit', function (){
			var medicalrecords_id = $(this).attr('medicalrecords_id');
			console.log(medicalrecords_id);
			$.ajax({
				url: '{{ route('ajax.patient_medicalrecords') }}',
				type: 'GET',
				dataType: 'json',
				data: {medicalrecords_id : medicalrecords_id},
			})
			.done(function(response) {
				today = new Date(); 
				hospitalized_day_date = new Date(response[0]['created_at']);
				hospitalized_day = new Date(response[0]['created_at']).toLocaleDateString();
				day_in = new Date( today - hospitalized_day_date ).getDate();
				console.log(day_in);
				console.log(hospitalized_day);
				$("#patient_name").val(response[0]['first_name']+' '+response[0]['last_name']);
				$("#speciallist_name").val(response[0]['speciallist_name']);
				$("#created_at").val(hospitalized_day);
				$("#room").val(response[0]['room'])
				$("#price").val( parseFloat('100000') *  Number(day_in) );
			})
		});

});

function show() {
    document.getElementById("form_information").style.display = "block";
}

function hiden() {
  	document.getElementById("form_information").style.display = "none";
}
</script>
@endpush