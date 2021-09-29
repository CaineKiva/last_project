      <!-- Left Panel -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <aside id="left-panel" class="left-panel" style="color: white">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">{{-- <img src="public/images/logo.png" alt="Logo"> --}}Hospital management</a>
           {{--  <a class="navbar-brand hidden" href="./"><img src="public/images/logo2.png" alt=""></a> --}}
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
<!--                 <li class="active">
                    <li class="active">
                        <a href="{{ route('index') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                </li> -->
        @if (Session::get('id'))
                <li class="active">
                    <li class="active">
                        <a href="{{ route('index') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                    </li>
                </li>
                <h3 class="menu-title"><i class="fa fa-book"></i> Quản lý dữ liệu bệnh viện</h3>
                <li>
                    <a href="{{ route('speciallist.index_list') }}"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard "></i>Chuyên Khoa</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard "></i>Bệnh Án</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-bars"></i><a href="{{ route('medicalrecords.medicalrecords_index') }}">Chi tiết</a></li>
<!--                         <li><i class="fa fa-share-square-o"></i><a href="">Cập nhật thông tin bệnh án</a></li> -->
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-user-md "></i>Bác Sĩ</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fas fa-list-alt"></i><a href="{{ route('doctor.doctor_index') }}">Danh sách bác sĩ</a></li>
<!--                         <li><i class="fa fa-plus-square"></i><a href="{{ route('doctor.view_insert') }}">Thêm</a></li> -->
                        <!-- <li><i class="fa fa-file-excel-o"></i><a href="{{ route('doctor.view_insert_excel') }}">Add by Excel</a></li> -->
<!--                         <li><i class="fas fa-edit"></i><a href="">Cập nhật thông tin</a></li> -->
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-user-nurse"></i></i>Y Tá</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fas fa-list-alt"></i><a href="{{ route('nurse.nurse_index') }}">Danh sách y tá</a></li>
<!--                         <li><i class="fa fa-plus-square"></i><a href="{{ route('nurse.view_insert') }}">Thêm</a></li>
                        <li><i class="fas fa-edit"></i><a href="">Cập nhật thông tin</a></li> -->
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-wheelchair"></i>Bệnh nhân</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa far fa-clipboard"></i><a href="{{ route('patient.patient_index') }}">Danh sách bệnh nhân</a></li>
<!--                         <li><i class="fa fa-plus-square"></i><a href="">Thêm</a></li> -->
                        <!-- <li><i class="fa fa-id-badge"></i><a href="">Sửa môn</a></li> -->
                       </ul>
                </li>
<!--                 <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-flask"></i>Dược liệu, Thuốc</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-id-card-o"></i><a href="">Danh sách nhà cung cấp</a></li>
                        <li><i class="fa fa-file-excel-o"></i><a href="">Thêm Thuốc</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="">Cập nhật thông tin</a></li>
                       </ul>
                </li> -->

<!--                  <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-view-list"></i>Phân công</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="">Theo giáo viên</a></li>
                        <li><i class="fa fa-table"></i><a href="">Xem</a></li>
                        <li><i class="fa fa-table"></i><a href="">Theo lớp</a></li>
                        <li><i class="fa fa-table"></i><a href="">Danh sách dạy</a></li>
                    </ul>

                </li> -->
        @endif

        @if (Session::get('doctor_id'))
            <li class="active">
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-dashboard"></i>Bác Sĩ : {{ Session::get('last_name') }}</a>
                </li>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-user-md "></i>Lịch Hẹn Khám Bệnh</a>
                <ul class="sub-menu children dropdown-menu">
                <li><i class="fa fas fa-list-alt"></i><a href="{{ route('doctor.appointment_list') }}">Danh sách Lịch hẹn</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-list-alt "></i>Bệnh án và bệnh nhân</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fas fa-wheelchair"></i><a href="{{ route('doctor.view_list') }}">Danh sách bệnh nhân đang điều trị</a></li>
                        <li><i class="fas fa-list-alt"></i><a href="{{ route('doctor.medicalrecords_history') }}">Danh sách bệnh án</a></li>
                    </ul>
                </li>
        @endif

        @if (Session::get('nurse_id'))
            <li class="active">
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-dashboard"></i>Y tá : {{ Session::get('last_name') }}</a>
                </li>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-user-md "></i>Lịch Hẹn Khám Bệnh</a>
                <ul class="sub-menu children dropdown-menu">
                <li><i class="fa fas fa-list-alt"></i><a href="{{ route('appointment.appointment_list') }}">Danh sách Lịch hẹn</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-hospital-o"></i>Nhập/Xuất viện</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fas fa-home"></i><a href="{{ route('medicalrecords.being_treated') }}">Nhập/Xuất viện và thanh toán viện phí</a></li>
                </ul>
            </li>
            <!-- <li class="menu-item">
                <a href="{{ route('medicalrecords.being_treated') }}">Xuất viện và thanh toán viện phí</a>
            </li> -->
        @endif
                <h3 class="menu-title">Người dùng</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Tài khoản</a>
                    <ul class="sub-menu children dropdown-menu">
                       <li><i class="menu-icon fa fa-paper-plane"></i><a href="{{ route('password.view_update_password') }}" >Thông tin User </a></li>
                       <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('login.logout') }}">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

    <!-- Left Panel -->
