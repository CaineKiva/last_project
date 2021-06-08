@extends('layouts.master')
@section('titles', "Danh sách các bệnh nhân đang điều trị tại $speciallist->speciallist_name ")
@section('content')
<table class="table">
	<tr>
		<th scope="col" style="text-align: center;">Họ và Tên Bệnh nhân</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Điện thoại liên hệ</th>
		<th scope="col" style="text-align: center;">Email</th>
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
					@php
					if (!empty($patient->patient->email)) {
						echo $patient->patient->email;
					} else {
						echo "Không có email";
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
@endsection