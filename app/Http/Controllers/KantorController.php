<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KantorController extends Controller
{

    public function getPegawai($kantorid = 0000)

    {
        $data = [];
        $query = "select * from view_pegorg_showed where pegwilid = '" . $kantorid . "000000' order by cast(jabid as int), cast(orgid as int) asc";
        $data['pegawai'] = DB::select($query);
        return $data;
    }

    public function getKantor(Request $request)
    {
         $data = [];
         $namakantor=$request->input('namakantor');
        //  echo $namakantor1;
        //  dd($namakantor);
        // $namakantor1 = strtolower($namakantor1);
        if($namakantor=='all'){
            $data['kantor'] = DB::select('select * from view_kantor');
        } else{
            $data['kantor'] = DB::select("select * from view_kantor where LOWER(kannama) like '%". $namakantor."%'");
        }
        return $data;

    }
}
