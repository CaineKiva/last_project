@extends('layouts.master')
@section('titles', "Danh sách các bác sĩ")
@section('content')

<table class="table">
	<tr>
		<th >Id</th>
		<th scope="col" style="text-align: center;">Tên</th>
		<th scope="col" style="text-align: center;">Tuổi</th>
		<th scope="col" style="text-align: center;">Địa chỉ</th>
		<th scope="col" style="text-align: center;">Giới tính</th>
		<th scope="col" style="text-align: center;">Điện thoại</th>
		<th scope="col" style="text-align: center;">Email</th>
		<th></th>
		<th></th>
	</tr>
		<tbody>
			@foreach ($array_list as $doctor)
			<tr>
				<th align="center">
					{{$doctor->doctor_id}}
				</td>
				<td align="center">
					{{$doctor->full_name}}
				</td>
				<td align="center">
					{{ $age = date_diff(date_create($doctor->date), date_create('now'))->y}}
				</td>
				<td align="center">
					{{$doctor->address}}
				</td>
				<td align="center">
					@php
					if ($doctor->gender==1){
						echo "Nam";
					}else {
						echo "Nữ";
					}
					@endphp	
				</td>
				<td align="center">
					{{$doctor->phone}}
				</td>
				<td align="center">
					{{$doctor->email}}
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