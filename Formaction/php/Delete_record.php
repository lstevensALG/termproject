<?php 
    $title = "View Records";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/db/conn.php';
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['primaryKey'])) {
        $primaryKey = mysqli_real_escape_string($conn, $_POST['primaryKey']);
    
        // Check if the record exists
        $check_sql = "SELECT * FROM client_info WHERE client_id = '$primaryKey'";
        $check_result = mysqli_query($conn, $check_sql);
    
        if (mysqli_num_rows($check_result) > 0) {
            // Delete the record
            $delete_sql = "DELETE FROM client_info WHERE client_id = '$primaryKey'";
            if (mysqli_query($conn, $delete_sql)) {
                header("Location: /Formaction/php/view_records.php?success=1");
                exit();
            } else {
                header("Location: /Formaction/php/view_records.php?error=" . urlencode("Error deleting record: " . mysqli_error($conn)));
                exit();
            }
        } else {
            header("Location: /Formaction/php/view_records.php?error=" . urlencode("No record found with that Primary Key."));
            exit();
        }
    } else {
        header("Location: /Formaction/php/view_records.php?error=" . urlencode("Invalid request."));
        exit();
    }

?>



<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/footer.php';
 ?>
