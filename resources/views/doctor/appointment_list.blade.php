@extends('layouts.master')
@section('titles', "Danh sách các lịch hẹn")
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style type="text/css">
	#content{
		position: relative;
	}
	#form_update{
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
		<th scope="col" style="text-align: center;">Tên bệnh nhân</th>
		<th scope="col" style="text-align: center;">Ngày hẹn khám</th>
		<th scope="col" style="text-align: center;">Tình trạng</th>
		<th scope="col" style="text-align: center;">Triệu chứng gặp phải</th>
		<th scope="col" style="text-align: center;">Phòng khám</th>
		<th scope="col" style="text-align: center;">Chỉnh Sửa</th>
	</tr>
		<tbody>
			@foreach ($array_list as $appointment)
			<tr>
				<th style="text-align: center; font-weight: normal;">
					{{ $appointment->first_name }} {{ $appointment->last_name }}
				</td>
				<td align="center">
					{{ $appointment->time }}
				</td>
				<td align="center">
					@php
					if ($appointment->status==1){
						echo "Đã khám";
					}else {
						echo "Chưa khám";
					}
					@endphp	
				</td>
				<td align="center">
					{{$appointment->symptom}}
				</td>
				<td align="center">
					@php
					if ($appointment->room != null){
						echo $appointment->room;
					}else {
						echo "Chưa đặt phòng khám";
					}
					@endphp
				</td>
				<th scope="col" align="center" style="text-align: center;">
				<button class="btn btn-success fas fa-edit" style="color: white;" onclick="update()" 
				appointment_id = "{{$appointment->appointment_id}}"></button>
				<button class="btn btn-info fas fa-exchange-alt" style="color: white;" onclick="change()" 
				appointment_id = "{{$appointment->appointment_id}}"></button>
				</th>
			</tr>
			@endforeach
			<br>
</tbody>
</table>

<div id="form_update" style="display: none ;">
	    <div class="card"  >
		<div class="card-header" align="center" style="height: 50px;">
			<div class="row form-group">
			<div class="col-12 col-md-11"><strong>Đặt Phòng Khám</strong></div>
			<div class="col-12 col-md-1"><input type="reset" align="right" class="btn btn-danger fas fa-user" onclick="hiden()" style="color: white;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('appointment.process_insert') }}" id="routes" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ và tên bệnh nhân</label></div>
					<div class="col-12 col-md-9">
						<input type="hidden" id="appointment_id" name="appointment_id" readonly="readonly" class="form-control">
						<input type="hidden" id="patient_id" name="patient_id" readonly="readonly" class="form-control">
						<input type="text" id="patient_name" readonly="readonly" class="form-control"></div>
				</div>
			    <div class="row form-group" id="speciallist">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Chuyên khoa</label></div>
				<div class="col-12 col-md-9">
					<select name="speciallist_id" class="form-control" id="select_speciallist">
						<option selected="selected" value="0">Chọn Chuyên Khoa</option>
                        @foreach ($speciallist as $speciallist)
                            <option value="{{ $speciallist->speciallist_id }}">
                                {{ $speciallist->speciallist_name }}
                            </option>
                        @endforeach
                    </select>
				</div>
			    </div>
			    <div class="row form-group" id="doctor">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Bác sĩ</label></div>
				<div class="col-12 col-md-9">
					<select class="form-control" name="doctor_id" id="select_doctor">
						<option selected="selected" value="0">Chọn Bác Sĩ</option>
                        @foreach ($doctor as $doctor)
                            <option value="{{ $doctor->doctor_id }}">
                              	{{ $doctor->first_name }} {{ $doctor->last_name }}
                            </option>
                        @endforeach
                    </select>
				</div>
			    </div>
			    <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Thời gian hẹn khám</label></div>
					<div class="col-12 col-md-9"><input type="datetime-local" id="time" name="time" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phòng Khám</label></div>
					<div class="col-12 col-md-9"><input type="text" id="room" name="room" placeholder="Nhập Số Phòng Khám" class="form-control"></div>
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
			var appointment_id = $(this).attr('appointment_id');
			console.log(appointment_id);
			$.ajax({
				url: '{{ route('ajax.appointment_doctor_patient') }}',
				type: 'GET',
				dataType: 'json',
				data: {appointment_id : appointment_id},
			})
			.done(function(response) {
				console.log(response);
				$("#appointment_id").val(response[0]['appointment_id']);
				$("#patient_id").val(response[0]['patient_id']);
				$("#patient_name").val(response[0]['first_name']+' '+response[0]['last_name']);
				$("#time").val(response[0]['time'].replace(' ', 'T'));
				$("#select_speciallist").val(response[0]['speciallist_id']);
				$("#select_doctor").val(response[0]['doctor_id']);
				$("#select_doctor").val(response[0]['doctor_id']);
				$("#speciallist").hide();
				$("#doctor").hide();
			})
		});

		$(document).on('click', '.btn.btn-info.fas.fa-exchange-alt', function (){
			var appointment_id = $(this).attr('appointment_id');
			console.log(appointment_id);
			$.ajax({
				url: '{{ route('ajax.appointment_doctor_patient') }}',
				type: 'GET',
				dataType: 'json',
				data: {appointment_id : appointment_id},
			})
			.done(function(response) {
				console.log(response);
				$("strong").text('Chuyển chuyên khoa khám');
				$("#appointment_id").val(response[0]['appointment_id']);
				$("#patient_id").val(response[0]['patient_id']);
				$("#patient_name").val(response[0]['first_name']+' '+response[0]['last_name']);
				$("#time").val(response[0]['time'].replace(' ', 'T'));
				$("#speciallist").show();
				$("#doctor").show();
				$("#select_speciallist").val('0');
				$("#select_doctor").val('0');
			})
		});

		$("#select_speciallist").change(function(){
      		var speciallist_id = $(this).val();
      		$("#select_doctor").html('');
      		$.ajax({
       			url: '{{ route('ajax.doctor_speciallist') }}',
        		type: 'GET',
        		dataType: 'json',
        		data: {speciallist_id : speciallist_id},
      		})
      		.done(function(response) {
          		$(response).each(function()
          		{
                    $("#select_doctor").append(`
              			<option value='${this.doctor_id}'>
              				${this.first_name} ${this.last_name}
              			</option>`)
          		})
        })

    })
});

function update() {
    document.getElementById("form_update").style.display = "block";
}
function change() {
	document.getElementById("form_update").style.display = "block";
}

function hiden() {
  	document.getElementById("form_update").style.display = "none";
}
</script>
@endpush