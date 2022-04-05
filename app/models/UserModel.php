<?php
class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query("SELECT * FROM user ");
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $uLevel = $allData[$i]["level"];
            if ($uLevel == 1) {
                $uLevel = "Admin";
            } else if ($uLevel == 2) {
                $uLevel = "User";
            } else {
                $uLevel = "UNKNOWN LEVEL";
            }
            $allData[$i]["level"] = $uLevel;
        }
        return $allData;
    }

    public function getOneDataById($id)
    {
        $this->db->query(" SELECT * from user WHERE id =:id  ");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahData($data)
    {
        $query = "INSERT INTO user 
                        (nama, level, email) 
                VALUES  (:nama, :level, :email)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('level', $data['level']);
        $this->db->bind('email', $data['email']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        $query = "  UPDATE user SET  
                        nama    =:nama, 
                        level   =:level, 
                        email   =:email 
                    WHERE   
                        id=:id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('level', $data['level']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusData($data)
    {
        $query = "  DELETE FROM user WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    
}
