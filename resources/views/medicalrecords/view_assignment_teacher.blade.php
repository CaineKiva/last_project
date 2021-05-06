@extends('layouts.master')
@section('titles',"Xem phân công")
@section('content')

<div class="card"  >
	
	<div class="card-body card-block" >
		<form action="{{ route('assignment.process_assignment_teacher') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Lớp</label></div>
				<div class="col-12 col-md-9">
					<select name="id_class" class="form-control" id="select_class">
						<option disabled selected> Chọn lớp</option>}
						@foreach ($array_classes  as $array_class)
						<option value="{{ $array_class->id }}">
							{{ $array_class->name }}
						</option>
						@endforeach
					</select>
				</div>


				
			</div>
			
	</div>

		<table class="table">
			<thead style="text-align: center">
				<tr>
					<th>Tên môn</th>
					<th>Tên giáo viên</th>


				</tr>
			</thead>
			<tbody id="select_assignment" style="text-align: center;">
				
			</tbody>

		</table>


		<div style="margin: auto; width: 100%">
			{{-- <button type="submit" class="btn btn-primary btn-sm" >
				<i class="fa fa-dot-circle-o"></i> Submit
			</button> --}}
			{{-- <button type="reset" class="btn btn-danger btn-sm">
				<i class="fa fa-ban"></i> Reset
			</button> --}}
		</div>
	</form>
</div>

</div>


@endsection

@push('js')

<script>
	jQuery(document).ready(function($) {
		$("#select_class").change(function(){
			var id_class = $(this).val();
			$("#select_assignment").html('');
			$.ajax({
				url: '{{ route('ajax.view_assignment') }}',
				type: 'GET',
				dataType: 'json',
				data: {id_class : id_class},
			})
			.done(function(response) {
				$(response).each(function()
				{
					$("#select_assignment").append(`   
						<tr>

						<td>${this.mon} 
						<td>${this.giaovien} 
						</tr>
						`)
				})

			})
			.fail(function() { 
				alert("sai roi")
			})
		})
	});


</script>

@endpush





