<?php $title; require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/header.php'; ?>

<h1>Form Data Received</h1>


<p><strong>Email:</strong> <?php echo isset($_POST['email']) ? $_POST['email'] : 'Not provided'; ?></p>
<p><strong>Address:</strong> <?php echo isset($_POST['address']) ? $_POST['address'] : 'Not provided'; ?></p>
<p><strong>City:</strong> <?php echo isset($_POST['city']) ? $_POST['city'] : 'Not provided'; ?></p>
<p><strong>Province:</strong> <?php echo isset($_POST['province']) ? $_POST['province'] : 'Not provided'; ?></p>
<p><strong>Postal Code:</strong> <?php echo isset($_POST['postalcode']) ? $_POST['postalcode'] : 'Not provided'; ?></p>


 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/footer.php'; ?>
