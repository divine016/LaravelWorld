<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Import DB facade
use Exception;

class StudentController extends Controller
{
    public function index() {

      

        //assume we are pulling data from the database

        /* $students = [
            ['id' => 1, 'name' => 'Kouti Divine', 'score' => 40],
            ['id' => 2, 'name' => 'Fongoh Martin', 'score' => 45],
            ['id' => 3, 'name' => 'Mbella KIngsley', 'score' => 10],
            ['id' => 4, 'name' => 'Enow Viney', 'score' => 24],
            ['id' => 5, 'name' => 'Jane Doe', 'score' => 37],
            ['id' => 6, 'name' => 'obame manualle', 'score' => 2],  
        ]; */

        //$students = [];
        // $students = Student::all(); //select * from students table

        // select * from students where score>10

        $students = Student::where('score', '>', 10)
                    ->orderBy('id', 'desc') //can also oder by name
                    // ->take(2) //limit
                    ->get();
        dd($students);


        return view('students', compact('students'));  
        
    }

    public function show($studentId) {  
        // return view('student-detail', compact('studentId'));
        return view('student-detail') -> with('studentId', $studentId);

        // echo 'i am showing student with id '. $studentId;
    }

    public function create(){
        // echo 'we are creating a new studnet';

        // $student = new Student;
        // $student->name ='babila menong';
        // $student->score ='18';
        // // $student->created_at =Carbon::now();
        // // $student->updated_at =Carbon::now();

        // $student->save(); //key to running the query

        // echo '<br> student record created successfully';

        return view('students.create');


    }
    
    public function store(Request $request){
        $data = $request->all();
        // dd($student);


        $student = new Student;
        $student->name = $data['name'];
        $student->score = $data['score'];
        $student->save();

        return redirect()->route('students');
        // return view('students.create');


    }
}
;