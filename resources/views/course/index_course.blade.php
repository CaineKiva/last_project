@extends('layouts.master')
@section('titles',"Khóa")
@section('content')
<table class="table">
	<tr>
		<th >Id</th>
		<th>Tên</th>
		<th>Tên rút gọn</th>

		<th></th>
		<th></th>
	</tr>
	<tbody>
		@foreach ($array_list as $course)
		<tr>
			<th >
				{{$course->id}}
			</td>
			<td>
				{{$course->name}}
			</td>
			<td>
				{{$course->name_collapse}}
			</td>
		</tr>
		@endforeach
		<br>
	</tbody>
</table>
{{$array_list->appends(['search' => $search])->links()}}
@endsection