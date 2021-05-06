@extends('layouts.master')
@section('titles',"Sinh viên")
@section('content')

{{-- <a href="{{ route('students.view_insert_students') }}">
	Add	

</a> --}}
 
<table class="table">
	<tr>
		<th >Id</th>
		<th scope="col">Name</th>
		<th scope="col"> Age</th>
		<th scope="col">Address</th>
		<th scope="col">Gender</th>
		<th scope="col">Phone</th>
		{{-- <th scope="col">Email</th> --}}
		<th scope="col">User</th>
		
		
		

		
		</tr>

		<tbody>


			@foreach ($array_students as $students)
			<tr>
				<th >
					{{$students->id}}
				</td>
				<td>
					{{$students->full_name}}
				</td>
				<td>
				{{-- @php
					$age = date_diff(date_create($bdate), date_create('now'))->y;
					echo $age;
					@endphp --}}
					{{ $age = date_diff(date_create($students->date), date_create('now'))->y}}
				</td>

				<td>
					{{$students->address}}
				</td>
				<td>
					@php
					if ($students->gender==1){
						echo "boy";
					}else {
						echo "girl";
					}

					@endphp
					
				</td>
				<td>
					{{$students->phone}}
				</td>
				<td>
					{{$students->email}}
				</td>
				
				
				
				

			</tr>

			@endforeach
			<br>
	
</tbody>
</table>

@endsection