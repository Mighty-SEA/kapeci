<?php

namespace App\Http\Controllers;

use App\Models\Student;

class AdminController extends Controller
{
	public function dashboard()
	{
		$studentCount = Student::count();
		return view('admin.dashboard', compact('studentCount'));
	}
} 