<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{

    public function studentIndex()
    {
        $students = Student::with('country')->paginate(10);
        return view('admin.student.index', compact('students'));
    }
    public function studentAdd(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $validated = $request->validate([
                'first_name' => 'required|string|max:50',
                'middle_name' => 'nullable|string|max:50',
                'last_name' => 'required|string|max:50',
                'admission_date' => 'required|string|max:50',
                'gender' => 'required|string|max:50',
                'dob' => 'required|string|max:50',
                'email' => 'required|string|max:50',
                'phone' => 'required|string|max:50',
                'address' => 'required|string|max:50',
                'father_name' => 'required|string|max:50',
                'father_phone' => 'required|string|max:50',
                'country_id' => 'required|string|',
                'course' => 'required|string|max:50',
                'doument_text_1' => 'required|string|max:50',
                'doument_image_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'doument_text_2' => 'required|string|max:50',
                'doument_image_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'doument_text_3' => 'required|string|max:50',
                'doument_image_3' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048 ',
                'doument_text_4' => 'required|string|max:50',
                'doument_image_4' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'student_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'active' => 'nullable|string',
            ]);
            $student = new Student();
            $student->first_name = $request->first_name;
            $student->middle_name = $request->middle_name;
            $student->last_name = $request->last_name;
            $student->gender = $request->gender;
            $student->admission_date = $request->admission_date;
            $student->student_photo = $request->student_photo->store('uploads/student');
            $student->dob = $request->dob;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->country_id = $request->country_id;
            $student->course = $request->course;
            $student->father_name = $request->father_name;
            $student->father_phone = $request->father_phone;
            $student->doument_text_1 = $request->doument_text_1;
            $student->doument_image_1 = $request->doument_image_1->store('uploads/student/document');
            $student->doument_text_2 = $request->doument_text_2;
            $student->doument_image_2 = $request->doument_image_2->store('uploads/student/document');
            $student->doument_text_3 = $request->doument_text_3;
            $student->doument_image_3 = $request->doument_image_3->store('uploads/student/document');
            $student->doument_text_4 = $request->doument_text_4;
            $student->doument_image_4 = $request->doument_image_4->store('uploads/student/document');
            $student->save();
            return redirect()->back()->with('success', 'Student added successfully');
        } else {
            $countrys = Country::all();
            return view('admin.student.add', compact('countrys'));
        }
    }
    public function studentShow($slug)
    {
        $student  = Student::where('slug', $slug)->first();
        if (!$student) {
            return redirect()->route('admin.admin-dashboard.student.index')->with('error', 'Student not found');
        }
        return view('admin.student.show', compact('student'));
    }
    public function studentEdit(Request $request, $slug)
    {
        $student = Student::where('slug', $slug)->first();
        if (!$student) {
            return redirect()->route('admin.admin-dashboard.student.index')->with('error', 'Student not found');
        }
        if ($request->getMethod() == 'POST') {
            $student->first_name = $request->first_name;
            $student->middle_name = $request->middle_name;
            $student->last_name = $request->last_name;
            $student->gender = $request->gender;
            $student->admission_date = $request->admission_date;
            if ($request->hasFile('image')) {
                $student->student_photo = $request->student_photo->store('uploads/student');
            }
            $student->dob = $request->dob;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->country_id = $request->country_id;
            $student->course = $request->course;
            $student->father_name = $request->father_name;
            $student->father_phone = $request->father_phone;
            $student->doument_text_1 = $request->doument_text_1;
            $student->doument_text_2 = $request->doument_text_2;
            $student->doument_text_3 = $request->doument_text_3;
            $student->doument_text_4 = $request->doument_text_4;
            if ($request->hasFile('image')) {
                $student->doument_image_1 = $request->doument_image_1->store('uploads/student/document');
            }
            if ($request->hasFile('image')) {
                $student->doument_image_2 = $request->doument_image_2->store('uploads/student/document');
            }
            if ($request->hasFile('image')) {
                $student->doument_image_3 = $request->doument_image_3->store('uploads/student/document');
            }
            if ($request->hasFile('image')) {
                $student->doument_image_4 = $request->doument_image_4->store('uploads/student/document');
            }
            $student->save();
            return redirect()->route('admin.admin-dashboard.student.index')->with('success', 'Student updated successfully');
        } else {
            $countrys = Country::all();
            return view('admin.student.edit', compact('countrys', 'student'));
        }
    }
    public function studentDel($slug)
    {
        $student = Student::where('slug', $slug)->first();
        if (!$student) {
            return redirect()->route('admin.admin-dashboard.student.index')->with('error', 'Student not found');
        }
        $student->delete();
        return redirect()->back()->with('success', 'Student delete successfully');

    }
}
