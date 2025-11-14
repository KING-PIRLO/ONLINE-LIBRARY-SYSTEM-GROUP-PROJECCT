<?php
include('includes/config.php');
if(isset($_GET['term'])){
    $term = $_GET['term'];
    $sql = "SELECT id, BookName, ISBNNumber FROM tblbooks WHERE ISBNNumber LIKE :term OR BookName LIKE :term LIMIT 10";
    $query = $dbh->prepare($sql);
    $searchTerm = "%".$term."%";
    $query->bindParam(':term', $searchTerm, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    $data = array();
    if($query->rowCount() > 0){
        foreach($results as $result){
            $data[] = array(
                'id' => $result->id,
                'label' => $result->ISBNNumber . ' - ' . $result->BookName,
                'value' => $result->ISBNNumber
            );
        }
    }
    echo json_encode($data);
}
?>
