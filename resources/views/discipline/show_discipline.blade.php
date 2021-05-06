@extends('layouts.master')
@section('content')



<table class="table">
	<tr>
		<th >Id</th>
		<th>Name</th>
		<th></th>
		<th></th>
	</tr>
	<tbody>
	@foreach ($array_list as $discipline)
		<tr>
			<th >
				{{$discipline->id}}
			</td>
			<td>
				{{$discipline->name}}
			</td>
			<td>
				{{$discipline->name_collapse}}
			</td>
			<td>
				<a href="{{ route('discipline.delete',['id' => $discipline->id]) }}">
					Delete
				</a>
			</td>

			<td>
				<a href="{{ route('discipline.view_update_discipline',['id' => $discipline->id]) }}">
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