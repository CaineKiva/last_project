@extends('layouts.master')
@section('titles',"Sửa thông tin lớp")
@section('content')

<div class="card"  >
	
	<div class="card-body card-block" >
		<form action="{{ route('class.process_update_class',['id' => $class->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf


			<div class="row form-group">
				<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
				<div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Text" class="form-control" value="{{ $class->name }}">{{ $errors->first('name') }}</div>
			</div>
			
			
			
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Khóa</label></div>
				<div class="col-12 col-md-9">
					<select name="id_course" class="form-control">

						@foreach ($courses as $course)
						@if ($course->id == $class->id_course )
						<option value="{{ $course->id}}" selected>
							{{ $course->name }}
						</option>
						@else 
						<option value="{{ $course->id}}" >
							{{ $course->name }}
						</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Ngành</label></div>
				<div class="col-12 col-md-9">
					<select name="id_discipline" class="form-control">

						@foreach ($disciplines as $discipline)
						@if ($discipline->id == $class->id_discipline )
						<option value="{{ $discipline->id}}" selected>
							{{ $discipline->name }}
						</option>
						@else 
						<option value="{{ $discipline->id}}" >
							{{ $discipline->name }}
						</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>



			<button type="submit" class="btn btn-primary btn-sm" >
				<i class="fa fa-dot-circle-o"></i> Submit
			</button>
			<button type="reset" class="btn btn-danger btn-sm">
				<i class="fa fa-ban"></i> Reset
			</button>

		</form>
	</div>

</div>


@endsection