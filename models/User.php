<?php
//Herencia
class User extends Database{

    public function all(){
        try{
            $result = parent::connect()->prepare("SELECT * FROM users");
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function register($data){
        try{
            $result = parent::connect()->prepare("INSERT INTO users (name, email, password, rol_id) VALUES (?,?,?,1)");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['email'], PDO::PARAM_STR);
            $result->bindParam(3, $data['password'], PDO::PARAM_STR);
            return $result->execute();
        }catch (Exception $e){
           die("Error User->register() " . $e->getMessage());
        }
    }

    public function find_user(){
        try{
            $result = parent::connect()->prepare("SELECT * FROM users INNER JOIN roles  ON users.rol_id = roles.id_rol");
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }


    

    public function update_register($data){
        try{
            $result = parent::connect()->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['email'], PDO::PARAM_STR);
            $result->bindParam(3, $data['id'], PDO::PARAM_INT);
            return $result->execute();
        }catch (Exception $e){
            die("Error User->update_register() " . $e->getMessage());
        }
    }

    public function delete_users ($data){
        try{
            $SQL = 'DELETE FROM users WHERE id = ?';
            $result = parent::connect()->prepare($SQL);
            $result->execute(array($data));
            $variable = ( $result )?   header('location:?controller=User') : 'no eliminado' ;          
            echo $variable;

        }catch(Exception $m){
            die('Error Eliminar user->delete_users '.$m->getMessage());
        }finally{
            $result = null;
        }

    }






}
