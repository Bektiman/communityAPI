<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KantorController extends Controller
{

    public function getPegawai($indeks = '0000')

    {
        //eselon 1 pusat
     $data = [];
        // if ($indeks == '0000') {
        //     $query = "select * from view_pegorg_showed_pusat where orgid like '%0000'";
        //     $q1 = $query .= "where orgid = '10000' ";
        //     $q2 = $query .= "where orgid <> '10000'";
        //     $q3 = "select * from view_kantor where kantorid ='0000'";
        //     $data['Kepala'] = DB::select($q1);
        //     $data['Anggota'] = DB::select($q2);
        //     $data['Alamat'] = DB::select($q3);
        // } //eselon 1 pusat detail
        // if (strlen($indeks) == 5 && substr($indeks, -4) == '0000') {
        //     $query = "select * from view_pegorg_showed_pusat where orgid = '$indeks'";
        //     $q1 = $query .= "where orgid like '%0000'";
        //     $q2 = $query .= "where orgid like '%000' and orgid not like '%0000' and orgid not like '9%'";
        //     $q3 = "select * from view_kantor where kantorid ='0000'";
        //     $data['Kepala'] = DB::select($q1);
        //     $data['Anggota'] = DB::select($q2);
        //     $data['Alamat'] = DB::select($q3);
        // }//eselon  2 pusat
        // if(strlen($indeks)==5 && substr($indeks,-3) =='000'){
        //     $query ="select * from view_pegorg_showed_pusat where orgid = '$indeks'";
        //     $q1 = $query .= "where orgid like '%000' and orgid not like '9%'";
        //     $q2 = $query .= "where orgid like '%00' and orgid not like '%000' and orgid not like '9%'";
        //     $q3 = "select * from view_kantor where kantorid ='0000'";
        //     $data['Kepala'] = DB::select($q1);
        //     $data['Anggota'] = DB::select($q2);
        //     $data['Alamat'] = DB::select($q3);

        // }// eselon 3 pusat
        // if(strlen($indeks)==5 && substr($indeks,-2) =='00'){
        //     $query ="select * from view_pegorg_showed where orgid = '$indeks'";
        //     $q1 = $query .= "where orgid like '%00' and orgid not like '9%'";
        //     $q2 = $query .= "where orgid not like '%00' and orgid not like '9%'";
        //     $q3 = "select * from view_kantor where kantorid ='0000'";
        //     $data['Kepala'] = DB::select($q1);
        //     $data['Anggota'] = DB::select($q2);
        //     $data['Alamat'] = DB::select($q3);

        //kabupaten_kota NON jakarta
        if ((strlen($indeks) == 4) && (substr($indeks, -2) != '00') && (substr($indeks, 2) != '31')) {

            $query = "SELECT * FROM (SELECT o.orgid,
            o.orgnama,
            p.pegid,
            p.nip,
            p.pegstatusid,
            p.pegwilid,
            p.jabid,
            p.peggeldep,
            p.pegnama,
            p.peggelblk,
            p.pegdbid
           FROM view_organisasi o
             LEFT JOIN view_pegawai p ON o.orgid = p.orgid AND p.pegshow = 'true' AND pegwilid = '".$indeks."000000') a where a.orgid like '928%' ";
        }
            $q1 = $query." and orgid = '92800'"; 
            $q2 = $query." and orgid <> '92800' order by cast(orgid as int) asc, cast(jabid as int) asc ";
            $q3 = "select * from view_kantor where kantorid ='" .$indeks. "'";
            $data['Kepala'] = DB::select($q1);
            $data['Anggota']= DB::select($q2);
            $data['Alamat'] = DB::select($q3);
            //bps kota jakarta 
        // if (strlen($indeks) == 4 && substr($indeks,0, -2) != '00' && (substr($indeks,0,2) != '31')) {
        //     $query = "SELECT * FROM (SELECT o.orgid,
        //     o.orgnama,
        //     p.pegid,
        //     p.nip,
        //     p.pegstatusid,
        //     p.pegwilid,
        //     p.jabid,
        //     p.peggeldep,
        //     p.pegnama,
        //     p.peggelblk,
        //     p.pegdbid
        //    FROM view_organisasi o
        //      LEFT JOIN view_pegawai p ON o.orgid = p.orgid AND p.pegshow = 'true' AND pegwilid = ' '".$indeks."'000000') a where a.orgid like '918%' order by cast(orgid as int) asc, cast(jabid as int) asc ";
        //     $q1 = $query .= " and jabid= '3'";
        //     $q2 = $query .= " and jabid <>'3'";
        //     $q3 = "select * from view_kantor where kantorid ='" . $indeks . "'";
        //     $data['Kepala'] = DB::select($q1);
        //     $data['Anggota'] = DB::select($q2);
        //     $data['Alamat'] = DB::select($q3);
        // }
        return $data;
    }

    public function getKantor(Request $request)
    {
        $data = [];
        $namakantor = $request->input('namakantor');
        //  echo $namakantor1;
        //  dd($namakantor);
        // $namakantor1 = strtolower($namakantor1);
        if ($namakantor == 'all') {
            $data['kantor'] = DB::select('select * from view_kantor');
        } else {
            $data['kantor'] = DB::select("select * from view_kantor where LOWER(kannama) like '%" . $namakantor . "%'");
        }
        return $data;
    }
}
