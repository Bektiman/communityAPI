<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class OrganisasiController extends Controller


{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show($jabid, $nip = null)
    {

        $query = "SELECT * FROM public.view_pegawai
    WHERE jabid = '$jabid' AND pegshow = true
    ORDER BY orgid";

        return DB::select($query);
    }
    public function getKantor($kantorid = null)
    {
        $query = "Select * From public.view_kantor ";

        if (!is_null($kantorid) && strlen($kantorid) == 4 && is_numeric($kantorid)) {
            switch (substr($kantorid, -2)) {
                case "00":
                    # code...
                    $kodeprov = substr($kantorid, 0, 2);
                    if ($kodeprov == '00') {
                        $query = "select * from view_organisasi where orglevel = '3' or AND orgid not like '9%'";
                    } else {

                        $query .= "where maxjab='3' and kantorid like '$kodeprov%'";

                        // $params[] = substr($kantorid,0,2);

                    }
                    break;

                default:
                    # code...
                    $query .= "WHERE maxjab ='1' or maxjab ='2'";
                    break;
            }
        } else {
            $query .= "WHERE maxjab ='1' or maxjab ='2'";
        }
        return DB::select($query);
    }
    public function getEselon1($kantorid = '0000')
    {
        $query = "select * from view_pegawai where pegwilid = '" . $kantorid . "000000' AND jabid = '1' AND pegshow = 'true' order by orgid asc";
        return DB::select($query);
    }
    public function getEselon2($kantorid = '0000', $orgid = null)
    {
        $data = [];
        if ($kantorid == '0000') {
            $query = "select * from view_pegawai where pegwilid = '" . $kantorid . "000000' AND jabid = '2' AND orgid = '".$orgid."' AND pegshow = 'true'";
            $query2 = "select orgnama,orgid from view_organisasi where orgid like '" . substr($orgid, 0, 2) . "%' AND  orgid like '%00'";
            $data["pegawai"] = DB::select($query);
            $data["fungsi"] = DB::select($query2);
        } else if ($kantorid != '0000') {
            $query = "select * from view_pegawai where pegwilid = '" . $kantorid . "000000' AND jabid = '2' AND pegshow = 'true'";
            $query2 = "select orgnama, orgid from view_organisasi where orgid like '92%' AND orgid like '%00' AND orgid <> '92800' AND orgid <> '92000'";
            $data['pegawai'] = DB::select($query);
            $data["fungsi"] = DB::select($query2);
        }

        return $data;
    }
    public function getEselon3($kantorid,$orgid=null)
    {
        $data = [];
        if ($kantorid== '0000') {
            $query = "select * from view_pegawai where pegwilid = '" . $kantorid . "000000' AND orgid like '".substr($orgid,0,3)."%' AND pegshow = 'true' order by orgid asc" ;
            $data = DB::select($query);
        } else {
            $query = "select * from view_pegawai where pegwilid = '".$kantorid. "000000' AND pegshow = 'true' ";
            $data = DB::select($query);

        }


        return $data;
    }


    //
}
