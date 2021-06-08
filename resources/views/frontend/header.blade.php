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
                   <li style="margin-left: 30px"><a data-scroll onclick="show_login()">Login</a></li>
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
        <strong style="font-weight: normal; font-size: 30px">LOG IN</</strong>
      </div>
    </div>
      <form action="{{ route('process_login_patient') }}" method="post" enctype="multipart/form-data">@csrf
          <div class="row form-group">
          <div class="col-12 col-md-12"><input type="text" id="text-input" name="email" placeholder="Email" class="form-control" ></div>
          </div>
          <div class="row form-group">
          <div class="col-12 col-md-12" style="margin-top: 10px"><input type="text" id="text-input" name="password" placeholder="Password" class="form-control" ></div>
          </div>
          <div class="row form-group" align="center">
          <button class="btn btn-success btn-sm" style="margin-top: 20px">
          <i class="far fa-check-circle"></i> Login</button>
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
        <strong style="font-weight: normal; font-size: 30px">Lịch hẹn khám</</strong>
      </div>
    </div>
    <div>
      <table class="table" id="list">
        <tr>
          <th scope="col" style="text-align: center; font-size: 15px">Thời gian hẹn khám</th>
          <th scope="col" style="text-align: center; font-size: 15px">Chuyên Khoa</th>
          <th scope="col" style="text-align: center; font-size: 15px">Bác Sĩ</th>
          <th scope="col" style="text-align: center; font-size: 15px">Phòng khám</th>
        </tr>
        <tbody id="show_appointment_patient" style="text-align: center;">
        
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
function show_login() {
    document.getElementById("form_login").style.display = "block";
}
function hiden_login() {
    document.getElementById("form_login").style.display = "none";
}
</script>
<style type="text/css">
  #header{
    position: absolute;
  }
  #form_login{
    position: fixed;
    margin-top: 5%;
    z-index: 90;
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