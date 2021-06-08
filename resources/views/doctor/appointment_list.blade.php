@extends('layouts.master')
@section('titles', "Danh sách các lịch hẹn")
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
					{{ $appointment->patient->full_name }}
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
				<button class="btn btn-success fas fa-edit" style="color: white;" onclick="update()" data-doctorid = "{{$appointment->appointment_id}}"></button>
				</th>
			</tr>
			@endforeach
			<br>
</tbody>
</table>
{{$array_list->appends(['search' => $search])->links()}}

@endsection