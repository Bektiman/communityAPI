<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class CobaController extends Controller


{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        return DB::select('select * from posts');
    }

    //
}
