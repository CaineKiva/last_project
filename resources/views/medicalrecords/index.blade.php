@extends('layouts.master')
@section('titles', "Danh sách bệnh nhân")
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
		<th scope="col" style="text-align: center;">Chuyên khoa</th>
		<th scope="col" style="text-align: center;">Ngày nhập viện</th>
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
				{{ $medicalrecords->created_at }}
			</td>
			<th scope="col" align="center" style="text-align: right;">
				<a href="{{ route('medicalrecords.view_update',['medicalrecords_id' => $medicalrecords->medicalrecords_id]) }}" class="btn btn-success fas fa-edit" style="color: white;"></a>
				<a href="{{ route('medicalrecords.delete',['medicalrecords_id' => $medicalrecords->doctor_id]) }}" class="btn btn-danger far fa-trash-alt" style="color: white;"></a>
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
			<div class="col-12 col-md-11"><strong>Tạo bệnh án mới</</strong></div>
			<div class="col-12 col-md-1"><input type="reset" align="right" class="btn btn-danger fas fa-user" value="x" onclick="hiden()" style="color: white;"></div>
			</div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('medicalrecords.process_insert') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Chọn bệnh nhân</label></div>
				<div class="col-12 col-md-9">
					    <select name="patient_id" class="form-control">
						    <option disabled selected>Chọn bệnh nhân</option>}
						    @foreach ($patient  as $patient)
						    <option value="{{ $patient->patient_id }}">
							    {{ $patient->first_name }} {{ $patient->last_name }}
						    </option>
						    @endforeach
					    </select>
				    </div>
                </div>
				<div class="row form-group">
				<div class="col col-md-3" style="margin: auto;"><label for="select" class=" form-control-label">Chọn Khoa</label></div>
				<div class="col-12 col-md-9">
					<select name="speciallist_id" class="form-control" id="select_speciallist">
						<option selected="selected">Chọn Khoa</option>
						@foreach ($speciallist  as $speciallist)
						    <option value="{{ $speciallist->speciallist_id }}">
							    {{ $speciallist->speciallist_name }}
							</option>
						@endforeach
					</select>
				</div>
			    </div>
			    <div class="row form-group">
				<div class="col col-md-3" style="margin: auto;"><label for="select" class=" form-control-label">Chọn Thuốc điều trị</label></div>
				<div class="col-12 col-md-9">
					<select name="medicine_id" class="form-control" id="select_medicine">
						@foreach ($medicine  as $medicine)
						    <option value="{{ $medicine->medicine_id }}" selected>
							    {{ $medicine->medicine_name }}
							</option>
						@endforeach
					</select>
				</div>
			    </div>
			    <div class="row form-group">
			    <div class="col col-md-3" ><label for="select" class=" form-control-label">Bác Sĩ Điều trị</label></div>
			    <div class="col-12 col-md-9">
				    <select class="form-control" name="doctor_id" id="select_doctor" ></select>
			    </div>
                </div>
                <div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phí khám bệnh</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="price" placeholder="Text" class="form-control" value="{{ old('price') }}">{{ $errors->first('price') }}</div>
				</div>

				<div class="row form-group">
				<div class="col col-md-3" style="margin: auto;"><label for="select" class=" form-control-label">Tình trạng</label></div>
				<div class="col-12 col-md-9">
					    <select name="status" class="form-control">
						        <option value="1" selected>
							        bình thường
							    </option>
					    </select>
				    </div>
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
function show() {
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