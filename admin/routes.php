<?php

auth_protection();

if(resolve('/admin')) {
    render('admin/home','admin');

} elseif (resolve('/admin/pages.*')) {
    include __DIR__ . '/pages/routes.php' ;
    
} elseif (resolve('/admin/auth.*')) {
    include __DIR__ . '/auth/routes.php' ;
    
} elseif (resolve('/admin/users.*')) {
    include __DIR__ . '/user/routes.php' ;

} elseif (resolve('/admin/upload/image')) {  
    $file =$_FILES['file'] ?? null;

    if(!$file){
        http_response_code(422);
        echo 'nenhum arquivo enviado';
    }

    $allowedTypes = [
        'image/gif',
        'image/jpg',
        'image/jpeg',
        'image/png',
    ];

     if(!in_array($file['type'], $allowedTypes)){
         http_response_code(422);
         echo json_encode(['status' => 'nenhum arquivo enviado']);
         exit;
     }

     $name = uniqid(rand(),true). '.' .pathinfo($file['name'],PATHINFO_EXTENSION);

    move_uploaded_file($file['tmp_name'], __DIR__ . '/../public/upload/' . $name);
    

     echo '/upload/' . $name;

} else {
    http_response_code(404);    
    echo "pagina nao encontrada";
}