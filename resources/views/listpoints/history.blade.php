@extends('layouts.master')

@section('titles',"Lịch sử điểm danh")

@section('content')

@if (Session('thongbao'))
<div class="alert alert-success" role="alert">
	{{ Session('thongbao') }}
</div>
@endif

<div class="card"  >
	<div class="card-body card-block" >
		<form action="{{ route('listpoints.process_history') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Lớp</label></div>
				<div class="col-12 col-md-9">
					<select name="id_class" class="form-control" id="select_class">
						<option disabled selected> Chọn lớp</option>}
						@foreach ($classes  as $class)
						<option value="{{ $class->id }}">
							{{ $class->name }}
						</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Môn</label></div>
				<div class="col-12 col-md-9">
					<select name="id_subject" class="form-control" id="select_subject">
						{{-- <option disabled selected> Chọn môn</option>}
						
						@foreach ($subjects  as $subject)
						<option value="{{ $subject->id }}">
							{{ $subject->name }}
						</option>
						@endforeach --}}
					</select>
				</div>

			</div>
			
			

			
			<button   class="btn btn-primary btn-sm" type="submit" onclick="submitData()">
				<i class="fa fa-dot-circle-o"></i> Submit
			</button>
			<button type="reset" class="btn btn-danger btn-sm">
				<i class="fa fa-ban"></i> Reset
			</button>
		</form>

		
	</div>
		{{-- <div class="card-footer">
			
		</div> --}}
</div>
	

	@endsection
	
	@push('js')
	
	<script>
		jQuery(document).ready(function($) {
			$(".alert").fadeTo(2000, 500).slideUp(500, function(){
				$(".alert").slideUp(500);
			});
		});
	</script>
	

	<script type="text/javascript" >
		jQuery(document).ready(function($) {
			$("#select_class").change(function(){
				var id_class = $(this).val();
				$("#select_subject").html('');
				$.ajax({
					url: '{{ route('ajax.history_listpoint') }}',
					type: 'GET',
					dataType: 'json',
					data: {id_class : id_class},
				})

				.done(function(response) {
					$("#select_subject").append(`
						<option >
						Chọn môn
						</option>`)
					$(response).each(function()
					{


						$("#select_subject").append(`
							<option value='${this.id}'>
							${this.name}
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



