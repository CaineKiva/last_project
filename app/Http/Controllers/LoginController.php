<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Nurse;
use Hash;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller {
	public function login() {
		return view('login.login2');
	}

	// login doctor
	public function login_doctor() {
		return view('login.login_doctor');
	}
	public function process_login_doctor(Request $rq) {
		$doctor = Doctor::where('email', $rq->email)->first();

		if (isset($doctor)) {
			Session::put('doctor_id', $doctor->doctor_id);
			Session::put('last_name', $doctor->last_name);
			Session::put('first_name', $doctor->first_name);
			Session::put('speciallist_id', $doctor->speciallist_id);
			Session::put('competence_id', $doctor->competence_id);
			return redirect()->route('index');
		} else {
			return redirect()->route('login')->with('error', 'Sai');
		}
	}
	

	// login admin
	public function login_admin() {
		return view('login.login_admin');
	}
	public function process_login_admin(Request $rq) {
		$admin = Admin::where('email', $rq->email)->first();

		if (isset($admin)) {
			Session::put('id', $admin->id);
			Session::put('first_name', $admin->first_name);
			Session::put('last_name', $admin->last_name);
			Session::put('birthday', $admin->birthday);
			Session::put('phone', $admin->phone);
			Session::put('gender', $admin->gender);
			Session::put('address', $admin->address);
			Session::put('email', $admin->email);
			Session::put('password', $admin->password);
			return redirect()->route('index');

		} else {
			return redirect()->route('login')->with('error', 'Sai');
		}
	}

	// login teacher
	public function login_nurse() {
		return view('login.login_nurse');
	}
	public function process_login_nurse(Request $rq) {
		$nurse = Teacher::where('email', $rq->email)->first();

		if (isset($nurse) && Hash::check($rq->password, $nurse->password)) {
			Session::put('id', $nurse->id);
			Session::put('first_name', $nurse->first_name);
			Session::put('last_name', $nurse->last_name);
			Session::put('birthday', $nurse->birthday);
			Session::put('phone', $nurse->phone);
			Session::put('address', $nurse->address);
			Session::put('gender', $nurse->gender);
			Session::put('email', $nurse->email);
			Session::put('password', $nurse->password);

			return redirect()->route('index');

		} else {
			return redirect()->route('login');
		}
	}

	// log out
	public function logout() {
		Session::flush();

		return redirect()->route('login')->with('sussess', 'Bye');

	}

}
