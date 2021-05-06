@extends('layouts.master')
@section('titles',"Thông tin")
@section('content')

{{-- <a href="{{ route('students.view_insert_students') }}">
	Add	

</a> --}}

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
			<td>
				<a href="{{ route('course.delete',['id' => $course->id]) }}">
					Delete
				</a>
			</td>

			<td>
				<a href="{{ route('course.view_update_course',['id' => $course->id]) }}">
					Update
				</a>
			</td>

		</tr>
	@endforeach
	<br>
	</tbody>
</table>
{{$array_list->appends(['search' => $search])->links()}}
@endsection