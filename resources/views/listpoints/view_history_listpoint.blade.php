@extends('layouts.master')

@section('titles',"Xem lịch sử điểm danh")

@section('content')

@if (Session('thongbao'))
	<div class="alert alert-success" role="alert">
		{{ Session('thongbao') }}
	</div>
@endif
<table class="table">
	
	<thead>
		<tr>
			<th>Sinh viên</th>
			<th >Đi</th>
			<th >Nghỉ</th>
			<th >Muộn</th>

			
		</tr>
	</thead>
	<tbody>
		@foreach ($array as $history)
			<tr>
				<td>
					{{ $history->sinhvien }}
				</td>
				<td>
					<input type="radio" name="{{ $history->name }}" value="0" {{ ($history->status ==0) ?'checked':''}} readonly="readonly">
				</td>

				<td>
					<input type="radio" name="{{ $history->name }}" value="1"
						{{( $history->status ==1 )?'checked':''}} readonly="readonly" 
					>
				</td>

				<td>
					<input type="radio" name="{{ $history->name }}" value="2"
						{{($history->status ==2 )?'checked':''}} readonly="readonly" 
					>
				</td>
				
			</tr>
		@endforeach
		
	</tbody>
</table>
@endsection
						

