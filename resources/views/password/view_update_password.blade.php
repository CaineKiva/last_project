@extends('layouts.master')
@section('titles',"Thông tin User")
@section('content')
	<table class="table table-bordered">

		<tr>
			<th>Name</th>
			<td>{{ Session::get('first_name') }} {{ Session::get('last_name') }}</td>
		</tr>
		<tr>
			<th>Date</th>
			<td>{{ Session::get('date') }}</td>
		</tr>
		<tr>
			<th>Phone</th>
			<td>{{ Session::get('phone') }}</td>
		</tr>
		<tr>
			<th>Email</th>
			<td>{{ Session::get('email') }}</td>
		</tr>
		<tr>
			<th>Address</th>
			<td>{{ Session::get('address') }}</td>
		</tr>
		<tr>
			<th>Password</th>
			<td>
				<button class="btn btn-success">
					<a href="{{ route('password.view_change_password',['id' =>  Session::get('id') ]) }}" style="color: white">Update</a>
				</button>
				
			</td>
		</tr>
		
		
	</table>
	<div style="display: none;">
		<form action="" method="get" accept-charset="utf-8">
			
			Password <input type="password" name="password" value="">
			<br>
			New Password <input type="pasword" name="password" value="">
			<br>
			<button class="btn btn-success" type="submit"> Save</button>
		</form>
	</div>	
@endsection
	

@push('js')
{{-- <script type="text/javascript" >
	jQuery(document).ready(function($) {
		$('body').on('click()','#edit-post', function(){
			
		}
		
		



		
	});

</script>  --}}
@endpush
