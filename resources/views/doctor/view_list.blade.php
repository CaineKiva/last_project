@extends('layouts.master')
@section('titles', "Danh sách bệnh nhân đang điều trị")
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
		<th scope="col" style="text-align: center;">Tình trạng</th>
		<th scope="col" style="text-align: center;">Ngày nhập viện</th>
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
				{{ date('d-m-Y', strtotime($medicalrecords->created_at)) }}
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
			<div class="col-12 col-md-11"><strong>Cập nhật bệnh án</</strong></div>
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
				<div class="row form-group" id="speciallist_div">
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
			    <div class="row form-group" id="doctor_div">
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
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phòng bệnh</label></div>
					<div class="col-12 col-md-9">
						<input type="text" id="room" name="room" placeholder="Nhập phòng bệnh" class="form-control">
					</div>
				</div>
                <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tình trạng và chuẩn đoán</label></div>
					<div class="col-12 col-md-9"><input type="text" id="status" name="status" placeholder="Chuẩn đoán" class="form-control"></div>
				</div>
				 <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Dặn dò</label></div>
					<div class="col-12 col-md-9"><input type="text" id="advice" name="advice" placeholder="Dặn dò" class="form-control"></div>
				</div>
                <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phí khám bệnh</label></div>
					<div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Nhập viện phí (Tính theo ngày)" class="form-control" value="1000"></div>
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
				$("#patient_name").val(response[0]['first_name']+' '+response[0]['last_name']);
				$("#medicalrecords_id").val(response[0]['medicalrecords_id']);
				$("#select_speciallist").val(response[0]['speciallist_id']);
				$("#select_doctor").val(response[0]['doctor_id']);
				$("#status").val(response[0]['status']);
				$("#advice").val(response[0]['advice']);
				$("#room").val(response[0]['room']);
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
