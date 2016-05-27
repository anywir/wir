<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 26.05.2016
 * Time: 15:33
 */

namespace model;


class Images
{

    public function loadAvatar()
    {

        // Здесь нужно сделать все проверки передаваемых файлов и вывести ошибки если нужно

        if( isset( $_GET['uploadfiles'] ) ){
            $error = false;
            $files = array();

            $uploaddir ='avatares/'; // куди зберігати аватарки

            // Создадим папку если её нет

            if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

            // переместим файлы из временной директории в указанную
            foreach( $_FILES as $file ){

                if( copy( $file['tmp_name'], $uploaddir . $file['name'] ) ){
                    $files[] = $file['name'];
                }
                else{
                    $error = true;
                }
            }

            $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );

        }

        return json_encode( $data );
    }
}