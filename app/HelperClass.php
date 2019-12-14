<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use  File;
use  DB;

class helperClass
{
    public static function siteLogo($file)
    {
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
        //$name = $file->getClientOriginalName();
            $directory = 'public/uploads/site_logo/logo/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$name".'.'."$logoExtension");
            return $directory.($name.'.'.$logoExtension);
    }

    public static function sitefavIcon($file)
    {
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
        //$name = $file->getClientOriginalName();
            $directory = 'public/uploads/site_logo/fav_icon/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$name".'.'."$logoExtension");
            return $directory.($name.'.'.$logoExtension);
    }

    public static function adminLogo($file)
    {
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
        //$name = $file->getClientOriginalName();
            $directory = 'public/uploads/admin_logo/main_logo/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$name".'.'."$logoExtension");
            return $directory.($name.'.'.$logoExtension);
    }

    public static function adminsmalLogo($file)
    {
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
        //$name = $file->getClientOriginalName();
            $directory = 'public/uploads/admin_logo/small_logo/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$name".'.'."$logoExtension");
            return $directory.($name.'.'.$logoExtension);
    }

    public static function adminfavIcon($file)
    {
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
        //$name = $file->getClientOriginalName();
            $directory = 'public/uploads/admin_logo/fav_icon/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$name".'.'."$logoExtension");
            return $directory.($name.'.'.$logoExtension);
    }

    // public static function changeStatus($tableName,$id)
    // {
    //     $changeStatus = db::table($tableName)->find($id);

    //     if ($changeStatus->status == 1)
    //     {
    //         $changeStatus->update( [               
    //             'status' => 0                
    //         ]);
    //     }
    //     else
    //     {
    //         $changeStatus->update( [               
    //             'status' => 1                
    //         ]);
    //     }
    // }


    /*This is last modified function for upload any image*/
    public static function UploadImage($file,$table=null,$directory=null)
    {   
        $lastData = \DB::table($table)->find(\DB::table($table)->max('id'));
        if(@$lastData)
        {
            $maxId = $lastData->id+1+rand(1000000,999999999);
        }
        else
        {
           $maxId = '1'.+rand(1000000,999999999); 
        }
        
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
        if(!file_exists ($directory))
        mkdir($directory);
        move_uploaded_file($file, "$directory$name".'_'.$maxId.'.'."$logoExtension");
        return $directory.($name.'_'.$maxId.'.'.$logoExtension);
    }

    public static function numberToWords($num)
    {    
        $ones = array(
            0 =>"Zero",1 => "One",2 => "Two",3 => "Three",4 => "Four",5 => "Five",6 => "Six",7 => "Seven",8 => "Eight",9 => "Nine",10 => "Ten",11 => "Eleven",12 => "Twelve",13 => "Thirteen",14 => "Fourteen",15 => "Fifteen",16 => "Sixteen",17 => "Seventeen",18 => "Eighteen",19 => "Nineteen"
        );

        $tens = array(
            0 => "Zero",1 => "Ten",2 => "Twenty",3 => "Thirty",4 => "Forty",5 => "Fifty",6 => "Sixty",7 => "Seventy",8 => "Eighty",9 => "Ninety" 
        );

        $hundreds = array(
            "Hundred","Thousand","Million","Billion","Trillion","Quardrillion" 
        ); /*limit t quadrillion */

        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr,1); 
        $rettxt = "";

        foreach($whole_arr as $key => $i)
        {
            while(substr($i,0,1)=="0")
                $i=substr($i,1,5);
            if($i < 20)
            {
                /* echo "getting:".$i; */
                $rettxt .= @$ones[$i];
            }
            elseif($i < 100)
            {
                if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)];
                if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)];
            }
            else
            {
                if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
                if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)];
                if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)];
            }

            if($key > 0)
            {
                $rettxt .= " ".$hundreds[$key]." ";
            }
        }

        if($decnum > 0)
        {
            $rettxt .= " and ";
            if($decnum < 20)
            {
                $rettxt .= $ones[$decnum];
            }
            elseif($decnum < 100)
            {
                $rettxt .= $tens[substr($decnum,0,1)];
                $rettxt .= " ".$ones[substr($decnum,1,1)];
            }
        }
       return $rettxt;            
    }
}
