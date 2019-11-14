<?php
		
function pages_get_data($redirectOnError){
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if(is_null($email) or is_null($password)){
        flash('Informe os campos email e password', 'error');
        header('location: '.$redirectOnError);
        die();
    }

    return compact('email','password');
}

$users_all = function () use ($conn){
    $result = $conn->query('SELECT * FROM users');
    return $result->fetch_all(MYSQLI_ASSOC);
};

$users_one = function ($id) use($conn){
    $sql = 'SELECT * FROM users where id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i',$id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();

};

$users_create = function () use($conn){
    $data = pages_get_data('/admin/users/create');

    $sql = 'INSERT INTO users(email,password,updated,created) VALUES (?,?,now(),now())';

    if (is_null($data['password'])) {
        flash('Informe o campo email', 'error');
        header('location: /admin/users/create');
        die();
    }
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $data['email'],$data['password']);

    flash('Criou registro com sucesso','success');
    return $stmt->execute();
};

$users_edit = function ($id)use($conn) {
    $data = pages_get_data('/admin/users/'.$id. '/edit');
    $sql = 'UPDATE users SET email=?,password=?,updated=NOW() WHERE id=?';

    if ($data['password']) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = 'UPDATE users set email=?, password=?, updated=NOW(), created=NOW() WHERE id=?';
    }

    $stmt = $conn->prepare($sql);

    if ($data['password']) {
        $stmt->bind_param('ssi', $data['email'], $data['password'], $id);
    } else {
        $stmt->bind_param('si', $data['email'], $id);
    }

    $stmt->bind_param('ssi', $data['email'],$data['password'],$id);
    return $stmt->execute();

    flash('Editou registro com sucesso','success');
};

$users_delete = function ($id) use ($conn){
    $sql= 'DELETE FROM users where id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    flash('Removeu registro com sucesso','success');
};
