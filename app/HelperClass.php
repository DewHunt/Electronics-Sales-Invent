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
}
