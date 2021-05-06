@extends('layouts.master')

@section('titles',"Điểm danh")

@section('content')

@if (Session('thongbao'))
	<div class="alert alert-success" role="alert">
		{{ Session('thongbao') }}
	</div>
@endif
<button type="submit" class="btn btn-success">
	<a href="{{ route('listpoints.view_history') }}" style="color: white">Xem điểm danh</a>
</button>
<br>
<br>
<div class="card"  >
	<div class="card-body card-block" >
		<form action="{{ route('listpoints.process_post') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Khóa</label></div>
				<div class="col-12 col-md-9">
					<select  class="form-control" id="select_course">
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
					<select name="id" class="form-control" id="select_discipline">
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
				<div class="col col-md-3"><label for="select" class=" form-control-label">Môn</label></div>
				<div class="col-12 col-md-9">
					<select name="id_subject" class="form-control" id="select_subject">
						<option disabled selected> Chọn môn</option>}
						
					</select>
				</div>

			</div>

			<div class="row form-group">
				<div class="col col-md-3"><label for="select" class=" form-control-label">Lớp</label></div>
				<div class="col-12 col-md-9">
					<select name="id_class" class="form-control" id="select_class">
						<option disabled selected> Chọn lớp</option>}
						
					</select>
				</div>

			</div>
			

			<table class="table">
				<thead style="text-align: center">
					<tr>
						<th>ID</th>
						<th>Tên sinh viên</th>
						<th>Số buổi nghỉ</th>
						<th>Đi</th>
						<th>Nghỉ</th>
						<th>Muộn</th>
					</tr>
				</thead>
				<tbody id="select_students" style="text-align: center;">
				
				</tbody>
				
			</table>
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
	{{-- <script  type="text/javascript">
		 $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
	</script> --}}
	<script>
			jQuery(document).ready(function($) {
				 $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
			});
	</script>
	<script type="text/javascript">
		// jQuery(document).ready(function submitData() {
		function submitData(){
			statusList = jQuery('input[type=radio]:checked')
			var data=[];
			for (var i = 0; i < statusList.length; i++) {
				var std={
					'id' : jQuery(statusList[i]).attr('name'),
					'value' : jQuery(statusList[i]).val()
				}
				data.push(std)
			}
			console.log(data) 

			$.post('{{  route('listpoints.process_post') }} ',{
				'data' : JSON.stringify(data)	
			}, function(dt){
				location.reload()
			})
		}
	</script>

	<script type="text/javascript" >
		jQuery(document).ready(function($) {
			$("#select_discipline").change(function(){
				var id_discipline = $(this).val();
				$("#select_class").html('');
				$.ajax({
					url: '{{ route('ajax.listpoint') }}',
					type: 'GET',
					dataType: 'json',
					data: {id_discipline : id_discipline,id_course:$('#select_course').val()},
				})

				.done(function(response) {
					$("#select_class").append(`
						<option >
						Chọn lớp
						</option>`)
					$(response).each(function()
					{


						$("#select_class").append(`
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
	<script>
		jQuery(document).ready(function($) {
			$("#select_discipline").change(function(){
				var id_discipline = $(this).val();
				$("#select_subject").html('');
				$.ajax({
					url: '{{ route('ajax.listpoint_subject') }}',
					type: 'GET',
					dataType: 'json',
					data: {id_discipline : id_discipline,id_teacher:$('#id_teacher').val()},
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
	{{-- <script>
		jQuery(document).ready(function($) {
			$("#select_course").change(function(){
				var id = $(this).val();
				$("#select_class").html('');
				$.ajax({
					url: '{{ route('ajax.test_class') }}',
					type: 'GET',
					dataType: 'json',
					data: {id : id},
				})
				.done(function(response) {
					$("#select_class").append(`
						<option >
						Chọn môn
						</option>`)
					$(response).each(function()
					{

						$("#select_class").append(`
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
	</script> --}}
		<script>
		jQuery(document).ready(function($) {
			$("#select_class").change(function(){
				var id_class = $(this).val();
				$("#select_students").html('');
				$.ajax({
					url: '{{ route('ajax.listpoint_students') }}',
					type: 'GET',
					dataType: 'json',
					data: {id_class : id_class, id_subject:$('#select_subject').val()},
				})
				.done(function(response) {
					$(response[0]).each(function()
					{
						$("#select_students").append(`   
							<tr>
								<td>${this.id} 
								<td>${this.name} (${this.birthday})
								<td>${this.dem}/${response[1]}
								<td><input type="radio" name="${this.id}" value="0"  checked="true	">
								<td><input type="radio" name="${this.id}" value="1">
								<td><input type="radio" name="${this.id}" value="2">
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

						

