@extends('layouts.master')
@section('titles', "Danh sách các lịch hẹn")
@section('content')

<table class="table">
	<tr>
		<th scope="col" style="text-align: center;">Tên bệnh nhân</th>
		<th scope="col" style="text-align: center;">Ngày hẹn khám</th>
		<th scope="col" style="text-align: center;">Triệu chứng gặp phải</th>
		<th scope="col" style="text-align: center;">Bác sĩ phụ trách</th>
		<th scope="col" style="text-align: center;">Chuyên khoa</th>
		<th scope="col" style="text-align: center;">Phòng khám</th>
		<th></th>
		<th></th>
	</tr>
		<tbody>
			@foreach ($array_list as $appointment)
			<tr>
				<th style="text-align: center">
					{{ $appointment->patient->full_name }}
				</td>
				<td align="center">
					{{ $appointment->time }}
				</td>
				<td>
					{{$appointment->symptom}}
				</td>
				<td align="center">
					{{$appointment->doctor->full_name}}
				</td>
				<td align="center">
					{{$appointment->speciallist->speciallist_name}}
				</td>
				<td align="center">
					@php
					if ($appointment->room == null){
						echo "Chưa đặt phòng khám" ;
					}else {
						echo $appointment->room;
					}
					@endphp
				</td>
			</tr>
			@endforeach
			<br>
	{{-- <input type="search" placeholder="search..." name="search" value="{{ $search }}" style="float:right;border-radius: 10px;">
	<button type="submit"></button> --}}
</tbody>
</table>
{{$array_list->appends(['search' => $search])->links()}}
@endsection
