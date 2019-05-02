<?php

require __DIR__ . '/db.php';

if(resolve('/admin/auth/login')){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($login()){            
            flash('logado com sucesso','success');
            return header('location: /admin');
        }
        flash('dados invalidos','error');
    }
    render('admin/auth/login','admin/login');
} elseif('/admin/auth/login'){
    logout();
}