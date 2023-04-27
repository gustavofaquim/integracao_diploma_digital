<?php 


include '../conf/Database.php';


function teste(){
    $con = new Database();

        
    $query = $con->query("SELECT TOP 10 * FROM LY_ALUNO");
    $response = $query->fetchAll(PDO::FETCH_OBJ);

    var_dump($response);
    
    return intval($response);
}


teste();