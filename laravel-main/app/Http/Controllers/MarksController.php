<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MarksController extends Controller
{
    public function show(int $id) {
        if (Gate::denies('show-mark')) {
            abort(403);
        }

        $students = DB::table('students')
            ->leftJoin('marks', 'students.mark_id', '=', 'marks.id')
            ->where('marks.id', '=', $id)
            ->get();
        return view('marks.show', ['students' => $students]);
    }
}