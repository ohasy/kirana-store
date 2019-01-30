<?php

        function uploadFile($file_field):array{
            $file = $_FILES[$file_field];
            $file_name = trim($file['name']);
            $tmp = explode('.',$file_name);
            $fileExtension = strtolower(end($tmp));
            $new_name = uniqid(rand()).'.'.$fileExtension;
            var_dump($file);
            $types = array('image/jpeg','image/jpg','image/png');
    
            if(!in_array($file['type'],$types)){
                return array("error"=>"not valid file type");
            } 
            else {
                move_uploaded_file($file['tmp_name'],'../../uploads/'.$new_name);
                return array("success"=>$new_name);
            }
        }

?>