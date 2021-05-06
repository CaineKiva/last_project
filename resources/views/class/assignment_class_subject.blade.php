@extends('layouts.master')
@section('titles',"Phân lớp")
@section('content')

	<div class="card"  >
		
		<div class="card-body card-block" >
			<form action="{{ route('class.process_assignment_class_subject') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Khóa</label></div>
				<div class="col-12 col-md-9">
					<select name="id_course" class="form-control" id="select_course">
						<option disabled selected> Chọn khóa</option>}
						@foreach ($courses  as $course)
						<option value="{{ $course->id }}">
							{{ $course->name }}
						</option>
						@endforeach
					</select>
				</div>

			</div>
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Ngành</label></div>
				<div class="col-12 col-md-9">
					<select name="id_discipline" class="form-control" id="select_discipline">
						<option disabled selected> Chọn ngành</option>}
						
						@foreach ($disciplines  as $discipline)
						<option value="{{ $discipline->id }}">
							{{ $discipline->name }}
						</option>
						@endforeach
					</select>
				</div>

			</div>

          		<div class="row form-group">
					<div class="col col-md-3"><label for="select" class=" form-control-label">Chọn lớp</label></div>
					<div class="col-12 col-md-9">
						<select name="id" class="form-control" id="select_class">
							{{-- <option disabled selected> Chọn lớp</option>}
							@foreach ($classes  as $class)
							    <option value="{{ $class->id}}">
							    	{{ $class->full_name }}
							    </option>
							@endforeach --}}
						</select>
					</div>
				</div>

				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Nhập số sinh viên</label></div>
					<div class="col-12 col-md-9"><input type="number" id="text-input" name="students" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small>
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
<script type="text/javascript" >
	jQuery(document).ready(function($) {
		$("#select_discipline").change(function(){
			var id_discipline = $(this).val();
			$("#select_class").html('');
			$.ajax({
				url: '{{ route('ajax.assignment_class_subject') }}',
				type: 'GET',
				dataType: 'json',
				data: {id_discipline : id_discipline,id_course:$('#select_course').val()},
			})

			.done(function(response) {
				$(response).each(function()
				{
					$("#select_class").append(`
						<option value='${this.id}'>
						${this.full_name_ajax}
						</option>`)
				})
			})
			.fail(function() { 
				alert("sai roi")
			})
		})
	});
</script>

@endpush			
				
