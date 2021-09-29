@extends('layouts.master')
@section('titles', "Danh sách các bệnh nhân đang điều trị tại $speciallist->speciallist_name ")
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
		<th scope="col" style="text-align: center;">Họ và Tên Bệnh nhân</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Điện thoại liên hệ</th>
		<th scope="col" style="text-align: center;">Tình trạng và chuẩn đoán</th>
		<th scope="col" style="text-align: center;">Bác sĩ phụ trách</th>
		<th scope="col" style="text-align: center;">Phòng bệnh</th>
	</tr>
		<tbody>
			@foreach ($array_list as $patient)
			<tr>
				<th align="center" style="text-align: center; font-weight: normal;">
					{{$patient->patient->full_name}}
				</td>
				<td align="center">
					{{ $age = date_diff(date_create($patient->patient->birthday), date_create('now'))->y}}
				</td>
				<td align="center">
					@php
					if ($patient->patient->gender==1) {
						echo "Nam";
					} else {
						echo "Nữ";
					}
					@endphp
				</td>
				<td align="center">
					{{$patient->patient->contact_phone}}
				</td>
				<td align="center">
					{{$patient->status}}
				</td>
				<td align="center">
					{{$patient->doctor->full_name}}
				</td>
				<td align="center">
					{{$patient->room}}
				</td>
                <th scope="col" align="center" style="text-align: right;">
                    <button type="button" class="btn btn-success fas fa-check" style="color: white;" onclick="show()"
                            medicalrecords_id = "{{$patient->medicalrecords_id}}"></button>
                </th>
			</tr>
			@endforeach
			<br>
	{{-- <input type="search" placeholder="search..." name="search" value="{{ $search }}" style="float:right;border-radius: 10px;">
	<button type="submit"></button> --}}
</tbody>
</table>
</div>

<div id="form_information" style="display: none ;">
    <div class="card"  >
        <div class="card-header" align="center" style="height: 50px;">
            <div class="row form-group">
                <div class="col-12 col-md-11"><strong>Thông tin bệnh nhân</strong></div>
                <div class="col-12 col-md-1"><input type="reset" align="right" value=" X " onclick="hiden()" style="background-color: red;"></div>
            </div>
        </div>
        <div class="card-body card-block" >
            <form action="{{ route('medicalrecords.discharge') }}" id="routes" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ và tên bệnh nhân</label></div>
                    <div class="col-12 col-md-9">
                        <input type="hidden" id="medicalrecords_id" name="medicalrecords_id" readonly="readonly" class="form-control">
                        <input type="hidden" id="patient_id" name="patient_id" readonly="readonly" class="form-control">
                        <input type="text" id="patient_name" readonly="readonly" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Chuyên khoa điều trị</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="speciallist_name" class="form-control" readonly="readonly"></div>
                </div>
                <div class="row form-group" id="treatment_div">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tình trạng</label></div>
                    <div class="col-12 col-md-9">
                        <select name="treatment" class="form-control" id="treatment_status">
                            <option selected="selected" value="0">Đang điều trị</option>
                            <option value="1">Xuất viện</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phòng điều trị</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="room" name="room" class="form-control"></div>
                </div>
                <div class="row form-group" id="hospitalized_day">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày nhập viện</label></div>
                    <div class="col-12 col-md-9"><input type="datetime" id="created_at" name="created_at" class="form-control" readonly="readonly"></div>
                </div>
                <div class="row form-group" id="day_in_div">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số ngày điều trị</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="day_in" class="form-control" readonly="readonly"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại liên hệ</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="phone" name="phone" class="form-control" readonly="readonly"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tinh trạng hiện tại</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="status" name="status" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Lời khuyên</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="advice" name="advice" class="form-control"></div>
                </div>
                <div class="row form-group" id="price_div">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Viện phí tính tới hôm nay</label></div>
                    <div class="col-12 col-md-9">
                        <input type="hidden" id="price" id="price" class="form-control" readonly="readonly">
                        <input type="text" id="price_vnd" class="form-control" readonly="readonly"></div>
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
            $(document).on('click', '.btn.btn-success.fas.fa-check', function (){
                var medicalrecords_id = $(this).attr('medicalrecords_id');
                console.log(medicalrecords_id);
                $.ajax({
                    url: '{{ route('ajax.patient_medicalrecords') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {medicalrecords_id : medicalrecords_id},
                })
                    .done(function(response) {
                        console.log(response)
                        today = new Date();
                        hospitalized_day_date = new Date(response[0]['created_at']);
                        hospitalized_day = new Date(response[0]['created_at']).toLocaleDateString();
                        day_in = parseInt( Number(new Date( today - hospitalized_day_date )) / Number('86400000') );
                        console.log(response[0]['medicalrecords_id']);
                        $("#medicalrecords_id").val(response[0]['medicalrecords_id']);
                        $("#patient_name").val(response[0]['first_name']+' '+response[0]['last_name']);
                        $("#speciallist_name").val(response[0]['speciallist_name']);
                        $("#created_at").val(hospitalized_day);
                        $("#room").val(response[0]['room']);
                        $("#phone").val(response[0]['phone']);
                        $("#status").val(response[0]['status']);
                        $("#advice").val(response[0]['advice']);
                        $("#day_in").val(Number(day_in) + ' ngày'+ ' ('+ '250000 đồng/ngày' +')' );
                        $("#price").val( parseFloat('250000') *  Number(day_in) );
                        $("#price_vnd").val( (parseFloat('250000') *  Number(day_in))+ ' đồng' );
                        $("#price_div").show();
                        $("#treatment_div").show();
                        $("#day_in_div").show();
                        $("#hospitalized_day").show();
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
