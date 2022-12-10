<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token");
header("Content-Type: application/json; charset=utf-8");

include "config.php";

$targetDir = "uploads/";

if (isset($_FILES["foto_siswa"]) == false || empty($_FILES["foto_siswa"]["name"])) 
{
    $fileName = "default.png";
    $update = mysqli_query($kon, "UPDATE tbl_mahasiswa SET
        npm = '$_POST[npm]',
        nama_mahasiswa = '$_POST[nama_mahasiswa]',
        jenis_kelamin = '$_POST[jenis_kelamin]',
        jurusan = '$_POST[jurusan]',
        foto_mahasiswa = '$fileName'
        WHERE kd = '$_POST[id]'");

    if ($update) 
    {
        $result = json_encode(array('error'=>false, 'msg'=>'Data Berhasil Disimpan!'));
    } else {
        $result = json_encode(array('error'=>true, 'msg'=>'Data Gagal Disimpan!'));
    }

    echo $result;
} else {
    $fileName = $_FILES['foto_siswa']['name'];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    if (in_array($fileType, $allowTypes)) 
    {
        if(move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $targetFilePath))
        {
            $update = mysqli_query($kon, "UPDATE tbl_mahasiswa SET 
                        npm = '$_POST[npm]',
                        nama_mahasiswa = '$_POST[nama_mahasiswa]',
                        jenis_kelamin = '$_POST[jenis_kelamin]',
                        jurusan  = '$_POST[jurusan]',
                        foto_mahasiswa = '$fileName'
                        WHERE kd = '$_POST[id]'");

            if ($update) 
            {
                $result = json_encode(array('error'=>false, 'msg'=>'Data Berhasil Disimpan!'));
            } else {
                $result = json_encode(array('error'=>true, 'msg'=>'Data Gagal Disimpan!'));
            }

            echo $result;

        } else {
            $result = json_encode(array('error'=>true, 'msg'=>'Data Gagal Disimpan!'));
            echo $result;
        }
    }
}

?>