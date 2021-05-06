@extends('layouts.master')
@section('content')
<table class="table">
	<tr>
		<th >Id</th>
		<th scope="col">Tên môn học</th>
		<th scope="col">Thời gian(buổi)</th>
		
		<th scope="col">Ngành</th>
		<th></th>
		<th></th>
	</tr>
	<tbody>
		@foreach ($array_list as $subject)
		<tr>
			<th >
				{{$subject->id}}
			</td>
			<td>
				{{$subject->name}} 
			</td>
			<td>
				{{$subject->time}} 
			</td>
			
			<td>
				{{ $subject->discipline	->name }}
			 	
			</td>
			<td>
				<a href="{{ route('subject.delete',['id' => $subject->id]) }}">
					Delete
				</a>
			</td>

			<td>
				<a href="{{ route('subject.view_update_subject',['id' => $subject->id]) }}">
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