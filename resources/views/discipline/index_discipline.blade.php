@extends('layouts.master')
@section('content')



<table class="table">
	<tr>
		<th >Id</th>
		<th>Name</th>
		<th>Tiêu đề</th>
		
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
			
		</tr>
	@endforeach
	<br>
	</tbody>
</table>
{{$array_list->appends(['search' => $search])->links()}}
@endsection