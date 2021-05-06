@extends('layouts.master')
@section('titles',"Phân môn giáo viên")
@section('content')

<div class="card"  >
	
	<div class="card-body card-block" >
		<form action="{{ route('teacher.process_assignment_subject_teacher') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Giáo viên</label></div>
				<div class="col-12 col-md-9">
					<select name="id_teacher" class="form-control" id="select_course">
						<option disabled selected> Chọn giáo viên</option>}
						@foreach ($teachers  as $teacher)
						<option value="{{ $teacher->id }}">
							{{ $teacher->full_name }}
						</option>
						@endforeach
					</select>
				</div>

			</div>
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Môn</label></div>
				<div class="col-12 col-md-9">
					<select id="nameid" style="width: 200px" name="check[]" multiple="multiple" class="select2" required="">
						@foreach ($subjects as $subject)

							<option value="{{ $subject->id }}">
								{{ $subject->name }}
							</option>}
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

	@push('js')
	
	<script  type="text/javascript" >
		jQuery(document).ready(function($) {
			$('#nameid').select2({
				placeholder:'  Chọn môn',
				allowClear: true
			})
		});
	</script>

	@endpush
