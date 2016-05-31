<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 26.05.2016
 * Time: 15:33
 */

namespace core;


class Images
{

    public static function loadintemp($file_in,$uploaddir)
    {
            $i=0;
            foreach( $file_in as $file )
            {
                $imginf=getimagesize($file['tmp_name']); //отримую дані про файл
                if ($imginf)
                { //якщо це зображення

                    $tmp_ext = str_replace('image/', '', $imginf['mime']);//витягую розширення
                    // перейменувать файл в "стандартне" ім'я.
                    $i++;
                    $tmp_name = "imgtmp$i.$tmp_ext";
                    if( move_uploaded_file( $file['tmp_name'], $uploaddir.$tmp_name ) )
                    {
                        $files[] = $tmp_name;
                        $error = null;
                    }
                    else
                    {
                        $error = true;
                        $error_data = "errorloadfile";
                    }
                }
                else
                {
                    $error = true;
                    $error_data = "isnotanimage";
                }
            }

            $data = ($error)?  ['error' => $error_data] : ['files' => $files, 'imginf'=> $imginf];
            return  $data ;
    }
}