<div id="service" class="services wow fadeIn">
    <div class="container">
      <div class="row">
        @if (!empty(Session::get('patient_id')))
          <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
        @else
          <div>
        @endif
             <div class="inner-services">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                   <div class="serv">
                      <span class="icon-service"><img src="{{ asset('public/images/service-icon1.png') }}" alt="#" /></span>
                      <h4>PREMIUM FACILITIES</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing.</p>
                   </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                   <div class="serv">
                      <span class="icon-service"><img src="{{ asset('public/images/service-icon2.png') }}" alt="#" /></span>
                      <h4>LARGE LABORATORY</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing.</p>
                   </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                   <div class="serv">
                      <span class="icon-service"><img src="{{ asset('public/images/service-icon3.png') }}" alt="#" /></span>
                      <h4>DETAILED SPECIALIST</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing.</p>
                   </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                   <div class="serv">
                      <span class="icon-service"><img src="{{ asset('public/images/service-icon4.png') }}" alt="#" /></span>
                      <h4>CHILDREN CARE CENTER</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing.</p>
                   </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                   <div class="serv">
                      <span class="icon-service"><img src="{{ asset('public/images/service-icon5.png') }}" alt="#" /></span>
                      <h4>FINE INFRASTRUCTURE</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing.</p>
                   </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                   <div class="serv">
                      <span class="icon-service"><img src="{{ asset('public/images/service-icon6.png') }}" alt="#" /></span>
                      <h4>ANYTIME BLOOD BANK</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing.</p>
                   </div>
                </div>
             </div>
          </div>
          @if (!empty(Session::get('patient_id')))
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
             <div class="appointment-form">
                <h3 style="text-align: center;"><button data-scroll onclick="show_appointment()" class="appointment data  show" patient_id = "{{ Session::get('patient_id') }}" style="color: white; margin: auto;">Xem lịch hẹn khám</button></h3>
                <div class="form">
                   <form method="post" enctype="multipart/form-data" id="route">@csrf
                      <fieldset>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                               <div class="form-group">
                                  <input type="hidden" name="patient_id" id="patient_id" value="{{ Session::get('patient_id') }}"  readonly="readonly"/>
                                   <input type="hidden" name="status" id="status" value="0"  readonly="readonly"/>
                                  <input type="text" value="{{ Session::get('first_name') }} {{ Session::get('last_name') }}"  readonly="readonly"/>
                               </div>
                            </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                               <div class="form-group">
                                  <input type="text" value="{{ Session::get('email') }}" id="email"  readonly="readonly" />
                               </div>
                            </div>
                         </div>

                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                               <div class="form-group">
                                 <input type="datetime-local" id="time" name="time" align="center" />
                               </div>
                            </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                               <div class="form-group">
                                  <select name="speciallist_id" class="form-control" id="select_speciallist">
                                    <option selected="selected" disabled>Chuyên Khoa</option>
                                      @foreach ($speciallist as $speciallist)
                                        <option value="{{ $speciallist->speciallist_id }}">
                                          {{ $speciallist->speciallist_name }}
                                        </option>
                                      @endforeach
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                               <div class="form-group">
                                  <select class="form-control" name="doctor_id" id="select_doctor">
                                      <option selected="selected" value='0' disabled>Bác Sĩ</option>
                                      @foreach ($doctor as $doctor)
                                        <option value="{{ $doctor->doctor_id }}">
                                          {{ $doctor->first_name }} {{ $doctor->last_name }}
                                        </option>
                                      @endforeach
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                               <div class="form-group">
                                  <textarea rows="4" id="symptom" class="form-control" placeholder="Triệu Chứng..." style="max-width: 320px; height: 120px; resize: none;" name="symptom"></textarea>
                               </div>
                            </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="form-group">
                                  <div class="center">
                                    <button type="button" onclick="success()" style="font-size: 10px" class="appointment_submit">Đặt lịch</button>
                                  </div>
                                </div>
                            </div>
                         </div>
                      </fieldset>
                   </form>
                </div>
             </div>
          </div>
          @endif
       </div>
    </div>
 </div>

<div id="lich_hen" style="display: block;">
</div>

@push('js')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="js/jquery-3.1.1.min.js"></script>
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
              </option>`)
          })
        })

    })

    $(document).on('click', '.appointment_submit', function (){
      newArray = [];
      var doctor_id = $("#select_doctor option:selected").val();
      $.ajax({
        url: '{{ route('ajax.appointment_list') }}',
        type: 'GET',
        dataType: 'json',
        data: {doctor_id : doctor_id},
      })
      .done(function(response){
        timeValue = $('#time').val();
        time = parseInt( Number(new Date(timeValue)) );
        $(response).each(function(index,value){
          downLimit = parseInt( Number(new Date(value.time)) - Number(1800000) );
          upLimit = parseInt( Number(new Date(value.time)) + Number(1800000) );
          if ( time > downLimit && time < upLimit) {
            newArray.push(1);
          }
          else {
            newArray.push(0);
          }
        })
        console.log(newArray);
        if (jQuery.inArray(1, newArray) !== -1) {
          alert("Lịch hẹn của bạn đã bị trùng, vui lòng chọn khoảng thời gian khác");
        }
        else {
          alert("Đặt lịch hẹn thành công");
          $.post( "{{ route('appointment.process_insert') }}", {
              patient_id : $("#patient_id").val(),
              doctor_id : $("#select_doctor option:selected").val(),
              speciallist_id : $("#select_speciallist option:selected").val(),
              time : $("#time").val(),
              symptom : $("#symptom").val(),
              "_token": "{{ csrf_token() }}",
          } );
          window.location.reload();
        }
      });
    });
  });

function show_appointment() {
    document.getElementById("appointment_list").style.display = "block";
}
function hide_appointment() {
    document.getElementById("appointment_list").style.display = "none";
}
</script>
@endpush
