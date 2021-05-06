
<?php

use Illuminate\Support\Facades\Route;

route::get("login", "LoginController@login")->name("login");

// login students
route::get("login_student", "LoginController@login_student")->name("login_student");
route::post("process_login_student", "LoginController@process_login_student")->name("process_login_student");
// login admin
route::get("login_admin", "LoginController@login_admin")->name("login_admin");
route::post("process_login_admin", "LoginController@process_login_admin")->name("process_login_admin");
// login teacher
route::get("login_doctor", "LoginController@login_doctor")->name("login_doctor");
route::post("process_login_doctor", "LoginController@process_login_doctor")->name("process_login_doctor");

// middleware
route::group(['middleware' => 'CheckLogin'], function () {
	route::get("", "Controller@index")->name("index");

	// logout
	$controller = "LoginController";
	route::group(["prefix" => "login", "as" => "login."], function () use ($controller) {
		route::get("logout", "$controller@logout")->name("logout");
	});

	// Doctor
	$controller = "DoctorController";
	route::group(["prefix" => "doctor", "as" => "doctor."], function () use ($controller) {
		route::get("doctor_index", "$controller@doctor_index")->name("doctor_index");
		route::get("view_list", "$controller@view_list")->name("view_list");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
            route::get("", "$controller@show")->name("show");
			route::get("view_insert", "$controller@view_insert")->name("view_insert");
			route::post("process_insert", "$controller@process_insert")->name("process_insert");
			route::get("view_insert_excel", "$controller@view_insert_excel")->name("view_insert_excel");
			route::post("process_insert_excel", "$controller@process_insert_excel")->name("process_insert_excel");
			route::get("delete/{doctor_id}", "$controller@delete")->name("delete");
			route::get("view_update/{doctor_id}", "$controller@view_update")->name("view_update");
			route::post("process_update/{doctor_id}", "$controller@process_update")->name("process_update");
			// route::get("assignment_subject_doctor", "$controller@assignment_subject_doctor")->name("assignment_subject_doctor");
			// route::post("process_assignment_subject_doctor", "$controller@process_assignment_subject_doctor")->name("process_assignment_subject_doctor");
			// route::get("subject_doctor", "$controller@subject_doctor")->name("subject_doctor");
		});

	});
    // Nurse
	$controller = "NurseController";
	route::group(["prefix" => "nurse", "as" => "nurse."], function () use ($controller) {
		route::get("index", "$controller@index")->name("index");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
            route::get("", "$controller@show_nurse")->name("show_nurse");
			route::get("view_insert", "$controller@view_insert")->name("view_insert");
			route::post("process_insert", "$controller@process_insert")->name("process_insert");
			route::get("view_insert_excel", "$controller@view_insert_excel")->name("view_insert_excel");
			route::post("process_insert_excel", "$controller@process_insert_excel")->name("process_insert_excel");
			route::get("delete/{nurse_id}", "$controller@delete")->name("delete");
			route::get("view_update/{nurse_id}", "$controller@view_update")->name("view_update");
			route::post("process_update/{nurse_id}", "$controller@process_update")->name("process_update");
        });
	});
    // Medicalrecords
	$controller = "MedicalrecordsController";
	route::group(["prefix" => "medicalrecords", "as" => "medicalrecords."], function () use ($controller) {
		route::get("medicalrecords_index", "$controller@medicalrecords_index")->name("medicalrecords_index");
		route::get("medicalrecords_doctor", "$controller@medicalrecords_doctor")->name("medicalrecords_doctor");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
			route::get("view_insert", "$controller@view_insert")->name("view_insert");
			route::post("process_insert", "$controller@process_insert")->name("process_insert");
			route::get("delete/{medicalrecords_id}", "$controller@delete")->name("delete");
			route::get("view_update/{medicalrecords_id}", "$controller@view_update")->name("view_update");
			route::post("process_update/{medicalrecords_id}", "$controller@process_update")->name("process_update");
		});

	});
	// Patient
	$controller = "PatientController";
	route::group(["prefix" => "patient", "as" => "patient."], function () use ($controller) {
		route::get("patient_index", "$controller@patient_index")->name("patient_index");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
            route::get("", "$controller@show_patient")->name("show_patient");
			route::get("view_insert", "$controller@view_insert")->name("view_insert");
			route::post("process_insert", "$controller@process_insert")->name("process_insert");
			route::get("view_insert_excel", "$controller@view_insert_excel")->name("view_insert_excel");
			route::post("process_insert_excel", "$controller@process_insert_excel")->name("process_insert_excel");
			route::get("delete/{patient_id}", "$controller@delete")->name("delete");
			route::get("view_update/{patient_id}", "$controller@view_update")->name("view_update");
			route::post("process_update/{patient_id}", "$controller@process_update")->name("process_update");
        });
	});
	// Speciallist
	$controller = "SpeciallistController";
	route::group(["prefix" => "speciallist", "as" => "speciallist."], function () use ($controller) {
		route::get("index_list", "$controller@index_list")->name("index_list");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
			route::get("doctor_list/{speciallist_id}", "$controller@doctor_list")->name("doctor_list");
			route::get("view_insert", "$controller@view_insert")->name("view_insert");
			route::post("process_insert", "$controller@process_insert")->name("process_insert");
			route::get("delete/{speciallist_id}", "$controller@delete")->name("delete");
			route::get("view_update/{speciallist_id}", "$controller@view_update")->name("view_update");
			route::post("process_update/{speciallist_id}", "$controller@process_update")->name("process_update");
		});

	});

	// nganh hoc
	$controller = "DisciplineController";
	route::group(["prefix" => "discipline", "as" => "discipline."], function () use ($controller){
		route::get("", "$controller@show_discipline")->name("show_discipline");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
			route::get("view_insert_discipline", "$controller@view_insert_discipline")->name("view_insert_discipline");
			route::post("process_insert_discipline", "$controller@process_insert_discipline")->name("process_insert_discipline");
			route::get("delete/{id}", "$controller@delete")->name("delete");
			route::get("view_update_discipline/{id}", "$controller@view_update_discipline")->name("view_update_discipline");
			route::post("process_update_discipline/{id}", "$controller@process_update_discipline")->name("process_update_discipline");
			route::get("index_discipline", "$controller@index_discipline")->name("index_discipline");
		});
	});	

	//mon hoc

	$controller = "SubjectController";
	route::group(["prefix" => "subject", "as" => "subject."], function () use ($controller) {
		route::get("index_subject", "$controller@index_subject")->name("index_subject");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
			route::get("", "$controller@show_subject")->name("show_subject");
			route::get("view_insert_subject", "$controller@view_insert_subject")->name("view_insert_subject");
			route::post("process_insert_subject", "$controller@process_insert_subject")->name("process_insert_subject");
			route::get("delete/{id}","$controller@delete")->name("delete");
			route::get("view_update_subject/{id}","$controller@view_update_subject")->name("view_update_subject");
			route::post("process_update_subject/{id}","$controller@process_update_subject")->name("process_update_subject");

		});
	});

	//lop
	$controller = "ClassController";
	route::group(["prefix" => "class", "as" => "class."], function () use ($controller) {
		route::get("index_class", "$controller@index_class")->name("index_class");
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
			route::get("view_insert_class", "$controller@view_insert_class")->name("view_insert_class");
			route::get("view_insert_class_under_student", "$controller@view_insert_class_under_student")->name("view_insert_class_under_student");

			route::post("process_insert_class", "$controller@process_insert_class")->name("process_insert_class");
			route::get("delete/{id}","$controller@delete")->name("delete");
			route::get("show_edit", "$controller@show_edit")->name("show_edit");
			route::get("view_update_class/{id}","$controller@view_update_class")->name("view_update_class");
			route::post("process_update_class/{id}","$controller@process_update_class")->name("process_update_class");
			route::get("assignment_class_subject", "$controller@assignment_class_subject")->name("assignment_class_subject");
			route::post("process_assignment_class_subject", "$controller@process_assignment_class_subject")->name("process_assignment_class_subject");
			route::post("process_insert_class_under_srudent", "$controller@process_insert_class_under_srudent")->name("process_insert_class_under_srudent");
		});
	});

	//phân công
	
	$controller = "AssignmentController";
	route::group(["prefix" => "assignment", "as" => "assignment."], function () use ($controller) {
		route::group(['middleware' => 'CheckAdmin'], function () use ($controller){
			route::get("assignment_teacher", "$controller@assignment_teacher")->name("assignment_teacher");
			route::get("view_assignment_teacher", "$controller@view_assignment_teacher")->name("view_assignment_teacher");
			route::get("show", "$controller@show")->name("show");
			route::post("process_assignment_teacher", "$controller@process_assignment_teacher")->name("process_assignment_teacher");
			route::get("assignment_class", "$controller@assignment_class")->name("assignment_class");
			
			// route::post("process_assignment_class", "$controller@process_assignment_class")->name("process_assignment_class");

		});
	});

	//ajax
	$controller = "AjaxController";
	route::group(["prefix" => "ajax", "as" => "ajax."], function () use ($controller) {

		route::get("doctor_speciallist", "$controller@doctor_speciallist")->name("doctor_speciallist");
		route::get("medicine_supplier", "$controller@medicine_supplier")->name("medicine_supplier");
		// route::get("assignment_discipline_subject", "$controller@assignment_discipline_subject")->name("assignment_discipline_subject");
		// route::get("listpoint_subject", "$controller@listpoint_subject")->name("listpoint_subject");
		// route::get("listpoint_class", "$controller@listpoint_class")->name("listpoint_class");
		// route::get("assignment_class_td", "$controller@assignment_class_td")->name("assignment_class_td");
		// route::get("subject_teacher", "$controller@subject_teacher")->name("subject_teacher");
		// route::get("assignment_class_subject", "$controller@assignment_class_subject")->name("assignment_class_subject");
		// route::get("listpoint", "$controller@listpoint")->name("listpoint");
		// route::get("listpoint_students", "$controller@listpoint_students")->name("listpoint_students");
		// route::get("test_class", "$controller@test_class")->name("test_class");
		// route::get("view_assignment", "$controller@view_assignment")->name("view_assignment");
		// route::get("history_listpoint", "$controller@history_listpoint")->name("history_listpoint");
	});
	
	// diem danh
	$controller = "ListpointsController";
	route::group(["prefix" => "listpoints", "as" => "listpoints."], function () use ($controller) {
		
		route::get("view_listpoints", "$controller@view_listpoints")->name("view_listpoints");
		// route::post("process_listpoint", "$controller@process_listpoint")->name("process_listpoint");
		route::post("process_post", "$controller@process_post")->name("process_post");
		route::get("history", "$controller@history")->name("history");
		route::post("process_history", "$controller@process_history")->name("process_history");
		route::post("view_history", "$controller@view_history")->name("view_history");
		route::post("view_listpoints_history", "$controller@view_listpoints_history")->name("view_listpoints_history");
		
	});

	// password
	$controller = "PasswordController";
	route::group(["prefix" => "password", "as" => "password."], function () use ($controller) {
		
		route::get("view_update_password", "$controller@view_update_password")->name("view_update_password");
		route::get("view_change_password/{id}", "$controller@view_change_password")->name("view_change_password");
		route::post("process_change_password/{id}", "$controller@process_change_password")->name("process_change_password");
		
	});

});
