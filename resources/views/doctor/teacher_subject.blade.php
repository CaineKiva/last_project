@extends('layouts.master')
@section('titles',"Thông tin môn dạy")
	
@section('content')
<table class="table">
	<tr>
		<th scope="col" style="text-align: center; width: 20%" >Môn</th>
		<th scope="col" style="text-align: center;">Giáo viên</th>
		

		
	</tr>

		<tbody>
			@foreach ($subjects as $subject)
			<tr>
				<td>{{ $subject->name}}</td>
				<td>
					@foreach ($subject_teacher as $each)	
						@if ($each->id_subject==$subject->id)
							
								{{ $each->teacher->full_name }} , 
							
						@endif
					@endforeach
				</td>
			</tr>

			@endforeach
		</tbody>
</table>
{{-- {{$subject_teacher->appends(['search' => $search])->links()}} --}}
@endsection


			
	