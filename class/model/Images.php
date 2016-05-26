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

        // ����� ����� ������� ��� �������� ������������ ������ � ������� ������ ���� �����

        if( isset( $_GET['uploadfiles'] ) ){
            $error = false;
            $files = array();

            $uploaddir ='avatares/'; // . - ������� ����� ��� ��������� submit.php

            // �������� ����� ���� � ���

            if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

            // ���������� ����� �� ��������� ���������� � ���������
            foreach( $_FILES as $file ){
                if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
                    $files[] = realpath( $uploaddir . $file['name'] );
                }
                else{
                    $error = true;
                }
            }

            $data = $error ? array('error' => '������ �������� ������.') : array('files' => $files );

        }

        return json_encode( $data );
    }
}