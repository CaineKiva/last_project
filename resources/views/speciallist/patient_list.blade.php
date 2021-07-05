@extends('layouts.master')
@section('titles', "Danh sách các bệnh nhân đang điều trị tại $speciallist->speciallist_name ")
@section('content')
<table class="table">
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
			</tr>
			@endforeach
			<br>
	{{-- <input type="search" placeholder="search..." name="search" value="{{ $search }}" style="float:right;border-radius: 10px;">
	<button type="submit"></button> --}}
</tbody>
</table>
{{$array_list->appends(['search' => $search])->links()}}
@endsection