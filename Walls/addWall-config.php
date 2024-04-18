<?php

require_once("database.php");
class addWallConfig
{

    private $id;
    private $name;
    private $status;
    private $address;
    private $about;
    protected $dbCnx;

    public function __construct($id = 0, $name = "", $status = "", $address = "", $about = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->address = $address;
        $this->about = $about;

        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . "ArtzoroDB3", DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }
    //id
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    //name
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    //status
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    //address
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }

    //about
    public function setAbout($about)
    {
        $this->about = $about;
    }
    public function getAbout()
    {
        return $this->about;
    }

    public function insertData()
    {
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO walls(name, status, address, about) values(?, 0, ?, ?)");
            $stm->execute([$this->name, $this->status, $this->address, $this->about]);
            echo "<script>alert('Data saved successfully');document.location='Walls.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function fetchAll()
    {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM walls");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function fetchOne()
    {
        try {

            $stm = $this->dbCnx->prepare("SELECT FROM walls WHERE WallID=?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update()
    {
        try {
            $stm = $this->dbCnx->prepare("UPDATE walls SET Name = ?, Status=0, Address=?, About=? WHERE WallID=?");
            $stm->execute([$this->name, $this->status, $this->address, $this->about, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteWall()
    {
        try {
            $stm = $this->dbCnx->prepare("DELETE from walls WHERE WallID=?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
            echo "<script>alert('data deleted successfully'); document.location='Walls.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
