@extends('layouts.master')
@section('titles',"Thêm lớp")
@section('content')

	<div class="card"  >
		
		<div class="card-body card-block" >
			<form action="{{ route('class.process_insert_class_under_srudent') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf

				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Số sinh viên mới </label></div>
					<div class="col-12 col-md-9"><input type="file" id="text-input" name="excel_student_class" placeholder="Text" class="form-control">
					</div>
				</div>

                <div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Khoá</label></div>
					<div class="col-12 col-md-9">
						<select name="id_course" class="form-control">
							@foreach ($courses  as $course)
							    <option value="{{ $course->id}}">
							    	{{ $course->name }}
							    </option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Ngành</label></div>
					<div class="col-12 col-md-9">
						<select name="id_discipline" class="form-control">
							@foreach ($disciplines  as $discipline)
							    <option value="{{ $discipline->id }}">
							    	{{ $discipline->name }}
							    </option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Nhập số lớp</label></div>
					<div class="col-12 col-md-9"><input type="number" min="1" id="text-input" name="name" placeholder="Text" class="form-control">
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
