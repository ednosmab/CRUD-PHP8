<?php

class User extends Conn
{
    public object $conn;
    public array $formData;
    public int $id;

    public function list(): array
    {
        $this->conn = $this->connectDb();

        $query_users = "SELECT id, name, email FROM users ORDER BY id DESC LIMIT 40";
        $result_users = $this->conn->prepare($query_users);
        $result_users->execute();
        return $result_users->fetchAll();
    }

    public function create(): bool
    {
        $this->conn = $this->connectDb();
        $query_user = "INSERT INTO users (name, email, created) VALUES (:name, :email, Now())";
        $add_user = $this->conn->prepare($query_user);
        $name_user = ucwords($this->formData['name']);
        $add_user->bindParam(':name', $name_user);
        $add_user->bindParam(':email', $this->formData['email']);
        $add_user->execute();
        
        if($add_user->rowCount()){
            return true;
        }else{
            return false;
        }

    }

    public function view()
    {
        $this->conn = $this->connectDb();

        $query_user = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $result_user = $this->conn->prepare($query_user);
        $result_user->bindParam(':id', $this->id);
        $result_user->execute();
        return $result_user->fetchAll();
    }


    public function edit(): bool
    {
        var_dump($this->formData);
        $this->conn = $this->connectDb();
        $query_user = "UPDATE users SET name=:name, email=:email, modified=NOW() WHERE id=:id";
        $editUser = $this->conn->prepare($query_user);
        $editUser->bindParam(':id', $this->formData['id']);
        $editUser->bindParam(':name', $this->formData['name']);
        $editUser->bindParam(':email', $this->formData['email']);
        $editUser->execute();
        
        return $editUser->rowCount() ? true : false;
    }

    public function delete(): bool
    {
        $this->conn = $this->connectDb();
        $query_user = "DELETE FROM users WHERE id=:id LIMIT 1";
        $deleteUser = $this->conn->prepare($query_user);
        $deleteUser->bindParam('id', $this->id);
        $deleteUser->execute();

        return $deleteUser->rowCount() ? true : false;
    }
}