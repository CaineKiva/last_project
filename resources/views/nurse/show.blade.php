@extends('layouts.master')
@section('titles',"Sinh viên")
@section('content')

{{-- <a href="{{ route('students.view_insert_students') }}">
	Add	

</a> --}}
 {{-- <button class="btn btn-info">
       <a href=" {{ route('students.export_excel')  }}" style="color: white"> Xuất excel</a>
   </button> --}}
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
		
			<th></th>
			{{-- <th></th> --}}
		
		

		
		</tr>

		<tbody>


			@foreach ($array_list as $students)
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
				
				{{-- <td>
				<button   class="btn btn-danger btn-sm" > 
					<i class="fa fa-ban"></i>
					<a href="{{ route('students.delete',['id' => $students->id]) }}">
					<span style="color: white">Delete</span>
				</a></button>
				
				</td> --}}

				<td>
					<button  class="btn btn-primary btn-sm">
						<i class="fa fa-dot-circle-o"></i>
						
						<a href="{{ route('students.view_update_students',['id' => $students->id]) }}">
						<span style="color: white">Update</span>
					</a>
					</button>
					
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