@extends('layouts.master')
@section('titles',"Thủ tục nhập viện")
@section('content')

    <div class="card"  >

        <div class="card-body card-block" >
            <form action="{{ route('medicalrecords.hospitalized_insert') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Bệnh nhân</label></div>
                    <div class="col-12 col-md-9">
                        <select name="patient_id" class="form-control" id="select_patient">
                            <option disabled selected>Nhập tên bệnh nhân</option>}
                            @foreach ($patient as $patient )
                                <option value="{{ $patient->patient_id }}">
                                    {{ $patient->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group" id="birthday_div" style="display: none">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ngày sinh</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="birthday" name="birthday" class="form-control" readonly></div>
                </div>
                <div class="row form-group" id="gender_div" style="display: none">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Giới tính</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="gender" name="gender" class="form-control" readonly></div>
                </div>
                <div class="row form-group" id="contact_phone_div" style="display: none">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại liên hệ</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="contact_phone" name="contact_phone" class="form-control" readonly></div>
                </div>
                <div class="row form-group" id="speciallist_div">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Chuyên khoa</label></div>
                    <div class="col-12 col-md-9">
                        <select name="speciallist_id" class="form-control" id="select_speciallist">
                            <option selected="selected" value="0" disabled>Chuyên Khoa</option>
                            @foreach ($speciallist as $speciallist)
                                <option value="{{ $speciallist->speciallist_id }}">
                                    {{ $speciallist->speciallist_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group" id="doctor_div">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Bác sĩ</label></div>
                    <div class="col-12 col-md-9">
                        <select class="form-control" name="doctor_id" id="select_doctor">
                            <option selected="selected" value="0" disabled>Bác Sĩ Điều trị</option>
                            @foreach ($doctor as $doctor)
                                <option value="{{ $doctor->doctor_id }}">
                                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phòng điều trị</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="room" name="room" class="form-control"></div>
                </div>
                <div class="row form-group" id="status_div">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sức khoẻ hiện tại</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="status" name="status" class="form-control"></div>
                </div>
                <div class="row form-group" id="advice_div">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dặn dò</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="advice" name="advice" class="form-control" placeholder="Tạm thời chưa có dặn dò từ bác sĩ và y tá"></div>
                </div>
                <div class="row form-group" id="advice_div">
                    <div class="col col-md-12" align="center">
                        <button type="submit" class="btn btn-primary btn-sm" align="center">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>


@endsection

@push('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.3-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            $("#select_speciallist").change(function(){
                var speciallist_id = $(this).val();
                $("#select_doctor").html('');
                $.ajax({
                    url: '{{ route('ajax.doctor_speciallist') }}',
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
                            </option>
                        `)
                    })
                })
            });

            $('#select_patient').select2({
                placeholder:'Nhập tên bệnh nhân',
                allowClear: true
            });

            $("#select_patient").change(function(){
                var patient_id = $(this).val();
                // $("#select_doctor").html('');
                $.ajax({
                    url: '{{ route('ajax.patient_information') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {patient_id : patient_id},
                })
                .done(function(response) {
                    console.log(response);
                    $("#birthday_div").show();
                    $("#contact_phone_div").show();
                    $("#gender_div").show();
                    $("#birthday").val(response[0]['birthday']);
                    $("#contact_phone").val(response[0]['contact_phone']);
                    if(response[0]['gender'] == 1){
                        $("#gender").val('Name');
                    } else {
                        $("#gender").val('Nữ');
                    }
                })
            });

        });
    </script>
@endpush
