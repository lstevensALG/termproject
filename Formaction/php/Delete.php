<?php 
    $title = "View Records";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/db/conn.php';
   
    $sql = "SELECT * FROM client_info WHERE 1";

    $result = mysqli_query($conn, $sql);


 
    $sql = "DELETE FROM client_info";

    if (mysqli_query($conn, $sql)) {
        // Redirect back with a success message
        header("Location: view_records.php?success=1");
        exit();
    } else {
        echo "Error deleting records: " . mysqli_error($conn);
    }
?>



<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/footer.php';
 ?>
