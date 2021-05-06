@extends('layouts.master')
@section('content')
	
	<div class="card"  >
		<div class="card-header" >
			<strong>Thêm sinh viên</strong> 
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('students.process_insert_students_excel') }}" method="post" enctype="multipart/form-data" class="form-horizontal" >
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Chọn File</label></div>
					<div class="col-12 col-md-9"><input type="file" id="text-input" name="excel_student" placeholder="Text" class="form-control"><small class="form-text text-muted"></small></div>
				</div>
				
				
					<button type="submit" class="btn btn-primary btn-sm" >
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
