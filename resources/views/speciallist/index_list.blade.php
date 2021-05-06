@extends('layouts.master')
@section('content')
<table class="table">
	<tr>
		<th scope="col" style="text-align: center;">Tên Chuyên Khoa</th>
		<th scope="col" style="text-align: center;">Danh sách các bác sĩ trực thuộc khoa</th>
	</tr>
	    <tbody>
			@foreach ($array_list as $speciallist)
			<tr>
				<td align="center">
					{{$speciallist->speciallist_name}}
				</td>
				<th scope="col" align="center" style="text-align: center;">
				    <a href="{{ route('speciallist.doctor_list',['speciallist_id' => $speciallist->speciallist_id]) }}" class="btn btn-success fas fa-edit" style="color: white;"></a>
			    </th>
			</tr>
			@endforeach
			<br>
	{{-- <input type="search" placeholder="search..." name="search" value="{{ $search }}" style="float:right;border-radius: 10px;">
	<button type="submit"></button> --}}

</tbody>
</table>
@endsection