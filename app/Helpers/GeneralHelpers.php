<?php

namespace App\Helpers;

class GeneralHelpers
{

    /**
     * build child menu
     * @param $child
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function tanggal_indo($tanggal=null, $time=true, $day=true) 
    {   

        $date = strtotime($tanggal);

        $hari=date('w', $date);
        $tgl =date('d', $date);
        $bln =date('m', $date);
        $thn =date('Y', $date);

        switch($hari){      
            case 0 :
                $hari='Minggu';
                break;
            case 1 :
                $hari='Senin';
                break;
            case 2 :
                $hari='Selasa';
                break;
            case 3 :
                $hari='Rabu';
                break;
            case 4 :
                $hari='Kamis';
                break;
            case 5 :
                $hari="Jum'at";
                break;
            case 6 :
                $hari='Sabtu';
                break;
            default:
                $hari='UnKnown';
                break;
        }
    
        switch($bln){       
            case 1 :
                $bln='Januari';
                break;
            case 2 :
                $bln='Februari';
                break;
            case 3 :
                $bln='Maret';
                break;
            case 4 :
                $bln='April';
                break;
            case 5 :
                $bln='Mei';
                break;
            case 6 :
                $bln="Juni";
                break;
            case 7 :
                $bln='Juli';
                break;
            case 8 :
                $bln='Agustus';
                break;
            case 9 :
                $bln='September';
                break;
            case 10 :
                $bln='Oktober';
                break;      
            case 11 :
                $bln='November';
                break;
            case 12 :
                $bln='Desember';
                break;
            default:
                $bln='UnKnown';
                break;
        }

        if($time)
        {   
            $day = ($day==true) ? $hari .', ': '';
            $format = $day.$tgl." ".$bln." ".$thn .' | '. strftime('%H:%M', $date) . ' WIB';
        }else{
            $day = ($day==true) ? $hari .', ': '';
            $format = $day. $tgl." ".$bln." ".$thn;
        }

        return $format;
    }

    public static function urlRegex(){
        return "/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/";
    }

    public function excuteFileSh($params) {
        
        $data = isset($params['data']) ? $params['data'] : '';
        @exec(base_path('sh/'.$params['file']) . ' ' . $params['path'].' '.$data, $output, $return);
       
        // echo "<br />----------------<br />";
        // if(function_exists('exec')) {
        //     echo "exec is enabled";
        // }
        // echo "<br />----------------<br />";
        // echo '<pre/>'; print_r($output); 
        // echo "<br />----------------<br />";
        // echo '<pre/>'; print_r($return); 
        // echo "<br />----------------<br />";
        // if (!$return) {
        //     echo "Successfully";
        // } else {
        //     echo "failed";
        // }
        // echo "<br />----------------<br />";
        // // shell_exec(base_path('sh/'.$params['file'].' '.$params['path']));
        // echo base_path('sh/'.$params['file']) . ' ' . $params['path'];
        
        return true;

    }

}