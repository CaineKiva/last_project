@extends('layouts.master')
@section('content')

	<div class="card"  >
		<div class="card-header" >
			<strong>Sửa Môn học</strong>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('subject.process_update_subject',['id' => $subject->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf


				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Text" class="form-control" value="{{ $subject->name }}">{{ $errors->first('name') }}</div>
				</div>
					<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Thời gian học</label></div>
					<div class="col-12 col-md-9"><input type="number" id="text-input" name="time" placeholder="Text" class="form-control" value="{{ $subject->time }}">{{ $errors->first('time') }}</div>
				</div>
            
                <div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Giáo viên</label></div>
					<div class="col-12 col-md-9">
						<select name="id_teacher" class="form-control">

							@foreach ($teachers as $teacher)
								@if ($teacher->id == $subject->id_teacher )
									<option value="{{ $teacher->id}}" selected>
								    	{{ $teacher->full_name }}
								    </option>
								@else 
									<option value="{{ $teacher->id}}" >
								    	{{ $teacher->full_name }}
								    </option>
								@endif
							@endforeach
						</select>
					</div>
					
				</div>
				{{-- <div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Ngành</label></div>
					<div class="col-12 col-md-9">
						<select name="id_discipline" class="form-control">
							@foreach ($disciplines  as $discipline)
							    <option value="{{ $subject->id_discipline }}">
							    	{{ $discipline->name }}
							    </option>
							@endforeach
						</select>
					</div>
				</div> --}}
				<div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Ngành</label></div>
					<div class="col-12 col-md-9">
						<select name="id_discipline" class="form-control">

							@foreach ($disciplines as $discipline)
								@if ($discipline->id == $subject->id_discipline )
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