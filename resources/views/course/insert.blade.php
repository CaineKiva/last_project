@extends('layouts.master')
@section('titles',"Thêm Khóa")
@section('content')

<div class="card"  >
	<div class="card-header" >
		<strong>Thêm Khóa Học</strong> 
	</div>
	<div class="card-body card-block" >
		<form action="{{ route('course.process_insert_course') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf


			<div class="row form-group">
				<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên khóa học</label></div>
				<div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Text" class="form-control" value="{{ old('name') }}">{{ $errors->first('name') }}</div>
			</div>
			<div class="row form-group">
				<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên rút gọn</label></div>
				<div class="col-12 col-md-9"><input type="text" id="text-input" name="name_collapse" placeholder="Text" class="form-control" value="{{ old('name_collapse') }}">{{ $errors->first('name_collapse') }}</small></div>
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
