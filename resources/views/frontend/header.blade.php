<header>
    <div class="header-top wow fadeIn">
       <div class="container">
          <a class="navbar-brand" href="index.html"><img src="{{ asset('public/images/logo.png') }}" alt="image"></a>
          <div class="right-header">
             <div class="header-info">
                <div class="info-inner">
                   <span class="icontop"><img src="{{ asset('public/images/phone-icon.png') }}" alt="#"></span>
                   <span class="iconcont"><a href="tel:800 123 456">800 123 456</a></span>	
                </div>
                <div class="info-inner">
                   <span class="icontop"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                   <span class="iconcont"><a data-scroll href="mailto:info@yoursite.com">info@Lifecare.com</a></span>	
                </div>
                <div class="info-inner">
                   <span class="icontop"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                   <span class="iconcont"><a data-scroll href="#">Daily: 7:00am - 8:00pm</a></span>	
                </div>
             </div>
          </div>
       </div>
    </div><div class="header-bottom wow fadeIn">
       <div class="container">
          <nav class="main-menu">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i class="fa fa-bars" aria-hidden="true"></i></button>
             </div>
             
             <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                   <li><a class="active" href="index.html">Home</a></li>
                   <li><a data-scroll href="#about">About us</a></li>
                   <li><a data-scroll href="#service">Appoinment</a></li>
                   <li><a data-scroll href="#doctors">Doctors</a></li>
                   <li><a data-scroll href="#price">Price</a></li>
                   <li><a data-scroll href="#getintouch">Contact</a></li>
                   <li style="margin-left: 40px">
                        <div class="serch-bar">
                           <div id="custom-search-input">
                              <div class="input-group col-md-12">
                                 <input type="text" class="form-control input-lg" placeholder="Search" />
                                 <span class="input-group-btn">
                                 <button class="btn btn-info btn-lg" type="button">
                                 <i class="fa fa-search" aria-hidden="true"></i>
                                 </button>
                                 </span>
                              </div>
                           </div>
                        </div>
                   </li>
                   <li></li>
                   <li></li>
                   @if (Session::get('patient_id') == null)
                   <li style="margin-left: 30px"><a data-scroll class="button_login" onclick="show_login()">Login</a></li>
                   @elseif (Session::get('patient_id'))
                   <li style="margin-left: 30px"><a data-scroll href="{{ route('login.logout_patient') }}">Logout</a></li>
                   @endif
                </ul>
             </div>
          </nav>
          
       </div>
    </div>

 </header>


<div id="form_login" style="display: none ;">
  <div class="card"  >
    <div class="card-header" align="center" style="height: 50px;">
      <div class="row form-group">
        <div class="col-12 col-md-10" align="right"></div>
        <div class="col-12 col-md-2" align="right">
          <input type="reset" align="right" class="btn btn-danger fas fa-user" value="[ X ]" onclick="hiden_login()" style="color: white; font-family: Arial, Helvetica, sans-serif;">
        </div>
      </div>
      <div class="row form-group">
        <strong style="font-weight: normal; font-size: 30px" id="login_title">Đăng nhập</strong>
      </div>
    </div>
      <form action="{{ route('process_login_patient') }}" id="routes" method="post" enctype="multipart/form-data">@csrf
          <div class="row form-group" id="first_name_div">
            <div class="col-12 col-md-12"><input type="text" id="first_name" name="first_name" placeholder="Họ" class="form-control" ></div>
          </div>
          <div class="row form-group" id="last_name_div">
            <div class="col-12 col-md-12"><input type="text" id="last_name" name="last_name" placeholder="Tên" class="form-control" ></div>
          </div>
          <div class="row form-group" id="birthday_div">
            <div class="col-12 col-md-12"><input type="date" id="birthday" name="birthday" placeholder="Ngày sinh" class="form-control" ></div>
          </div>
          <div class="row form-group" id="gender_div">
          <div class="col-12 col-md-12">
            <div class="form-check-inline form-check">
              <label for="inline-radio1" class="form-check-label" style="align-content: center;">
                <input type="radio" id="inline-radio1" name="gender" value="1" class="form-check-input" @if (old('gender')==='1')checked @endif style="height: 15px; font-size: 15px;">Nam
              </label>
              <label for="inline-radio2" class="form-check-label ">
                <input type="radio" id="inline-radio2" name="gender" value="0" class="form-check-input" @if (old('gender')==='0')checked @endif style="height: 15px; font-size: 15px;">Nữ
              </label>
            </div>
          </div>
          </div>
          <div class="row form-group" id="address_div">
            <div class="col-12 col-md-12"><input type="text" id="address" name="address" placeholder="Địa chỉ" class="form-control" ></div>
          </div>
          <div class="row form-group" id="contact_phone_div">
            <div class="col-12 col-md-12"><input type="text" id="contact_phone" name="contact_phone" placeholder="Số điện thoại" class="form-control" ></div>
          </div>
          <div class="row form-group">
            <div class="col-12 col-md-12"><input type="text" id="text-input" name="email" placeholder="Email" class="form-control" ></div>
          </div>
            <div class="row form-group">
          <div class="col-12 col-md-12" style="margin-top: 10px"><input type="password" id="password" name="password" placeholder="Password" class="form-control" ></div>
          </div>
          <div class="row form-group" align="center">
            <button id="button_button" type="button" class="btn btn-primary btn-sm click" style="margin-top: 20px" onclick="show_div()">
              <i class="far fa-check-circle"></i> Đăng ký</button>
            <button id="submit_button" type="submit" class="btn btn-success btn-sm click" style="margin-top: 20px">
              <i class="far fa-check-circle"></i> Đăng nhập</button>
      </form>
    </div>
  </div>
</div>

<div id="appointment_list">
  <div class="card"  >
    <div class="card-header" align="center" style="height: 50px;">
      <div class="row form-group">
        <div class="col-12 col-md-11" align="right"></div>
        <div class="col-12 col-md-1" align="right">
          <input type="reset" align="right" class="btn btn-danger fas fa-user" value="[X]" onclick="hide_appointment()" style="color: white; font-family: Arial, Helvetica, sans-serif; ">
        </div>
      </div>
      <div class="row form-group">
        <strong style="font-weight: normal; font-size: 30px" id="appointment_time">Lịch hẹn khám</strong>
      </div>
    </div>
    <div>
      <table class="table" id="list">
        <tr>
          <th scope="col" style="text-align: center; font-size: 17px">Thời gian hẹn khám</th>
          <th scope="col" style="text-align: center; font-size: 17px">Chuyên Khoa</th>
          <th scope="col" style="text-align: center; font-size: 17px">Bác Sĩ</th>
          <th scope="col" style="text-align: center; font-size: 17px">Phòng khám</th>
        </tr>
        <tbody id="show_appointment_patient" style="text-align: center;">
        
        </tbody>
      </table>
    </div>
  </div>
</div>

 <div class="alert alert-success" style="display: block">
        {{ session()->get('message') }}
    </div>

@push('js')
<script type="text/javascript" >
  jQuery(document).ready(function($) {
    $(document).on('click', '.appointment.data.show', function (){
      console.log($(this).attr('patient_id'));
      var patient_id = $(this).attr('patient_id');
      $("#show_appointment_patient").html('');
      $.ajax({
        url: '{{ route('ajax.appointment_patient') }}',
        type: 'GET',
        dataType: 'json',
        data: {patient_id : patient_id},
      })
      .done(function(response) {
        var room;
        $(response['data']).each(function(index,value)
          {
            if (value.room == null) {
              console.log(value.room);
              room = "Chưa có phòng khám";
            } else {
              room = value.room;
            }
            $("#show_appointment_patient").append(`   
              <tr>
                <td scope="col" style="text-align: center; font-size: 17px">${value.time}</td>
                <td scope="col" style="text-align: center; font-size: 17px">${value.speciallist_name}</td>
                <td scope="col" style="text-align: center; font-size: 17px">${value.first_name} ${value.last_name}</td>
                <td scope="col" style="text-align: center; font-size: 17px">${room}</td>
              </tr>
            `)
          })
      })
    });
    $(document).on('click', '.btn.btn-success.btn-sm.click', function (){
      $("#routes").attr('method','post');
    });
    $(document).on('click', '.btn.btn-primary.btn-sm.click', function (){
      $("#login_title").text('Đăng ký');
      $("#first_name_div").show();
      $("#last_name_div").show();
      $("#birthday_div").show();
      $("#gender_div").show();
      $("#contact_phone_div").show();
      $("#address_div").show();
      $("#submit_button").text('Đăng ký');
      $("#button_button").hide();
      $("#routes").attr('action','{{ route('process_signup') }}');
      $("#routes").attr('method','post');
    });
    $(document).on('click', '.button_login', function (){
      $("#login_title").text('Đăng nhập');
      $("#first_name_div").hide();
      $("#last_name_div").hide();
      $("#birthday_div").hide();
      $("#gender_div").hide();
      $("#contact_phone_div").hide();
      $("#address_div").hide();
    });
  });

function show_login() {
    document.getElementById("form_login").style.display = "block";
}
function hiden_login() {
    document.getElementById("form_login").style.display = "none";
}
</script>
@endpush
<style type="text/css">
  #header{
    position: absolute;
  }
  #form_login{
    position: fixed;
    z-index: 90;
    margin-top: 2%;
    background-color: white;
    min-height: 300px;
    width: 40%;
    margin-left: 30%;
  }
  .form_login{
    align-self: center;
  }
  #appointment_list{
    display: none;
    position: fixed;
    margin-top: 2%;
    z-index: 91;
    background-color: white;
    min-height: 500px;
    width: 60%;
    margin-left: 20%;
  }
  .appointment_list{
    align-self: center;
  }
</style>