
@extends('layouts.master')
@section('content')

	<div class="card"  >
		<div class="card-header" >
			<div class="col-12 col-md-5"><strong>Cập nhật thông tin bệnh nhân</strong> </div>
		    <div class="col-12 col-md-7" align="right"><strong>Ngày nhập viện: {{$medicalrecords->created_at->format('d/m/Y')}}</strong></div>
		</div>
		<div class="card-body card-block" >
			<form action="{{ route('medicalrecords.process_update',['medicalrecords_id'=>$medicalrecords->medicalrecords_id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				@csrf
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Họ</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="first_name" placeholder="Text" class="form-control" value="{{$medicalrecords->patient->first_name}}">{{ $errors->first('first_name') }}</div>
				</div>
					<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" placeholder="Text" class="form-control" value="{{$medicalrecords->patient->last_name}}">{{ $errors->first('last_name') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày sinh</label></div>
					<div class="col-12 col-md-9"><input type="date" id="text-input" name="birthday" placeholder="Text" class="form-control" value="{{$medicalrecords->patient->birthday}}">{{ $errors->first('birthday') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Giới tính</label></div>
					<div class="col-12 col-md-9"><input class="form-control" value=" @php if ($medicalrecords->patient->gender==1){echo "Nam";}else {echo "Nữ";} @endphp"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phòng điều trị</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="room" placeholder="Text" class="form-control" value="{{$medicalrecords->room}}">{{ $errors->first('room') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
					<div class="col-12 col-md-9"><input type="tex" id="text-input" name="contact_phone" placeholder="Text" class="form-control" value="{{$medicalrecords->patient->contact_phone}}">{{ $errors->first('contact_phone') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label">Địa chỉ</label></div>
					<div class="col-12 col-md-9"><input type="text" name="address" placeholder="Địa chỉ" class="form-control" value="{{$medicalrecords->patient->address}}">{{ $errors->first('address') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label">Tình trạng sức khoẻ</label></div>
					<div class="col-12 col-md-9"><input type="text" name="status" placeholder="Tình trạng sức khoẻ" class="form-control" value="{{$medicalrecords->status}}">{{ $errors->first('status') }}</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="password-input" class=" form-control-label">Khuyến nghị từ bác sĩ</label></div>
					<div class="col-12 col-md-9"><input type="text" name="advice" placeholder="Khuyến nghị từ bác sĩ" class="form-control" value="{{$medicalrecords->advice}}">{{ $errors->first('advice') }}</div>
				</div>
                <div class="row form-group">
				<div class="col col-md-3" style="margin: auto;"><label for="select" class=" form-control-label">Chuyên khoa điều trị</label></div>
				<div class="col-12 col-md-9">
					<select name="speciallist_id" class="form-control" id="select_speciallist">
						@foreach ($speciallist  as $speciallist)
						    @if ($speciallist->speciallist_id == $medicalrecords->speciallist_id)
								<option value="{{ $speciallist->speciallist_id }}" selected>
							    	{{ $speciallist->speciallist_name }}
							    </option>
							@else
								<option value="{{ $speciallist->speciallist_id }}">
							        {{ $speciallist->speciallist_name }}
						        </option>
							@endif
						@endforeach
					</select>
				</div>
			    </div>
			    <div class="row form-group">
			    <div class="col col-md-3" ><label for="select" class=" form-control-label">Bác sĩ phụ trách</label></div>
			    <div class="col-12 col-md-9">
				    <select class="form-control" name="doctor_id" id="select_doctor" >
                        @foreach ($doctor  as $doctor)
						    @if ($doctor->doctor_id == $medicalrecords->doctor_id )
								<option value="{{ $doctor->doctor_id }}" selected>
							    	{{ $doctor->full_name }}
							    </option>
							@elseif($doctor->speciallist_id == $medicalrecords->speciallist_id)
								<option value="{{ $doctor->doctor_id }}">
							        {{ $doctor->full_name }}
						        </option>
							@endif
						@endforeach
				    </select>
			    </div>
                </div>
                <div class="card-footer" align="center" >
				<button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-dot-circle-o"></i>Submit</button>
				<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i>Reset</button>
		     	</div>
			</form>
		</div>
	</div>
@endsection

@push('js')
<script type="text/javascript" >
	jQuery(document).ready(function($) {
		$("#select_speciallist").change(function(){
			var speciallist_id = $(this).val();
			$("#select_doctor").html('');
			$.ajax({
				url: '{{ route('ajax.speciallist_doctor') }}',
				type: 'GET',
				dataType: 'json',
				data: {speciallist_id : speciallist_id},
			})
			.done(function(response) {
					$(response).each(function()
					{
                        $("#select_doctor").append(`
							<option value='${this.doctor_id}'>
							${this.first_name} ${this.last_name}
							</option>`)
					})
				})

		})
	});

</script>

@endpush





