
@extends('layouts.master')
@section('titles',"Lớp")
@section('content')
	
	<table class="table">
	<tr>
		<th >Id</th>
		<th scope="col">Tên lớp</th>
		<th scope="col">Ngành</th>
		<th></th>
		<th></th>
	</tr>
	<tbody>
		@foreach ($array_list as $class)
		<tr>
			<th >
				{{$class->id}}
			</td>
			<td>
				{{$class->name}} 
			</td>
			
			<td>
				{{$class->discipline->name}} 
			</td>
			{{-- <td>
				<a href="{{ route('class.delete',['id' => $class->id]) }}">
					Delete
				</a>
			</td>

			<td>
				<a href="{{ route('class.view_update_class',['id' => $class->id]) }}">
					Update
				</a>
			</td>
 --}}
		</tr>

		@endforeach
		<br>
	</tbody>
</table>
	
{{$array_list->appends(['search' => $search])->links()}}
@endsection
