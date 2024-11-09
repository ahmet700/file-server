<?php
session_start();

if(!isset($_SESSION['melogin'])) { header('location:index.php');}


    if($_FILES){
  
            
            function renameFile($filename)
            {
                $charMap = [
                    'Ç' => 'c', 'Ş' => 's', 'Ğ' => 'g', 'Ü' => 'u', 'İ' => 'i', 'Ö' => 'o',
                    'ç' => 'c', 'ş' => 's', 'ğ' => 'g', 'ü' => 'u', 'ö' => 'o', 'ı' => 'i',
                    ' ' => '-'
                ];
                $filename = strtolower(str_replace(array_keys($charMap), array_values($charMap), $filename));

                return $filename;
            }

      
        $uploadfolder = 'u';
        $file = $_FILES['file']; 
        $url_decode = urldecode($file['name']);
        $name = explode('/', $url_decode);
        $rand = time(); 
        
           
            $upload_file = $uploadfolder.'/'.$rand.renamefile($name[count($name) - 1]);
            move_uploaded_file($file['tmp_name'], $upload_file);
            $filename = renamefile($name[count($name) - 1])."_$rand";
            echo ' <meta http-equiv="refresh" content="3; url=index.php"><div class="alert alert-success text-center"><strong>İşlem Başarılı.!</strong> Dosya başarıyla yüklendi.<br><br><a href="'.$uploadfolder.'/'.$filename.'" class="btn btn-success btn-xs" target="_blank">Dosyayı Görüntüle</a></div>';
        
				die();
	}
	
	
	if (@$_POST['filename'])
	{
		$file= realpath("u/".base64_decode($_POST['filename']));
		
		@unlink($file);
		
		header('location:index.php');
	}
	
	
?>