<?php

namespace Siequipos\Http\Controllers\Admin;

//use Siequipos\Models\Student;
use Illuminate\Http\Request;
use Input;
use Siequipos\Http\Controllers\Controller;
use Siequipos\Models\Student;
use View;

class StudentController extends Controller
{
    public function index()
    {
        //return View::make('admin/student');
        return view('admin.student');
    }

    public function saverecord(Request $request)
    {
        // $poststudent = Input::all();
        $poststudent = $request->all();
        // return $poststudent;

        $rule = [
            'student_name' => 'required',
            'gender' => 'required',
            'phone' => 'required'
        ];

        $this->validate($request, $rule);

        $student = Student::create($poststudent);

        if ($student) {
            if($request->ajax()) {
                return response()->json([
                    'success'=> true,
                    'message'=> 'Estudiante Agregado',
                ], 200);
            }
        }

        /*$data = [
            'student_name' => $poststudent['studentname'],
            'gender'       => $poststudent['gender'],
            'phone'        => $poststudent['phone'],
        ];
        $check = \DB::table('students')->insert($data);

        if ($check > 0) {
            return 1;
        } else {
            return 0;
        }*/
    }

    public function edit()
    {
        $postedit = Input::all();
        $id       = $postedit['id'];
        // return $id;
        $data = \DB::table('students')->where('id', $id)->first();
        // return $data;

        // 1:04 HORA
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
    }

    public function updaterecord()
    {
        $poststudent = Input::all();

        $data = [
            'student_name' => $poststudent['studentname'],
            'gender'       => $poststudent['gender'],
            'phone'        => $poststudent['phone'],
        ];
        $check = \DB::table('students')->where('id', $poststudent['id'])->update($data);

        if ($check > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete()
    {
        $postedit = Input::all();
        $id       = $postedit['id'];
        $data     = \DB::table('students')->where('id', $id)->delete();

        if ($data) {
            return 0;
        } else {
            return 1;
        }
        exit();
    }

    public function display()
    {
        $display = "";
        //$data    = \DB::table('students')->get();
        $data    = Student::all();

        foreach ($data as $key) {
            $gender = $key->gender;
            //if ($gender === 0) {
            if ($gender === '0') {
                $gender = 'Masculino';
            } else {
                $gender = 'Femenino';
            }

            $display .= "
                <tr>
                    <td>$key->id</td>
                    <td>$key->student_name</td>
                    <td>$gender</td>
                    <td>$key->phone</td>
                    <td>
                        <a data-id='$key->id' href='#' class='editar'>Editar</a> | <a data-id='$key->id' href='#' class='eliminar'>Eliminar</a>
                    </td>
                </tr>";
        }
        return $display;
    }
}
