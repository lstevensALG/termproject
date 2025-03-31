


<?php 
    $title = 'view records';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/db/conn.php';  
 ?>


<div class="container mt-4">
<form method="post" action="/Formaction/php/Receive_signup.php" class="row g-3">

  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4" name="email" required>
  </div>

  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" required >
  </div>

  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control" id="inputCity" name="city" required>
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Province</label>
    <select id="inputState" class="form-select" name="province" required>
    <option value="" selected disabled>Choose...</option>
      <option>Alberta</option>
          <option>British Columbia</option>
          <option>Manitoba</option>
          <option>New Brunswick</option>
          <option>Newfoundland and Labrador</option>
          <option>Northwest Territories</option>
          <option>Nova Scotia</option>
          <option>Nunavut</option>
          <option>Ontario</option>
          <option>Prince Edward Island</option>
          <option>Quebec</option>
          <option>Saskatchewan</option>
          <option>Yukon</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" class="form-control" id="inputZip" name="postalcode" required>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
<div class="container">
    <div class="row justify-content-center mt-5">
        <!-- View Records Button -->
        <div class="col-8">
            <a href="/Formaction/php/View_records.php" class="btn btn-info w-100" style="display: block; margin-bottom: 10px;">
                View Records
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8 d-flex">
            <form action="/Formaction/php/Delete_record.php" method="POST" class="w-100 d-flex">
                <!-- Primary Key Input -->
                <input type="text" name="primaryKey" 
                       class="form-control bg-success text-white mb-2"
                       style="flex: 0 0 30%; height: 100%;"
                       placeholder="Primary Key" required />

                <!-- Delete Button -->
                <button type="submit" 
                        class="btn btn-danger"
                        style="flex: 1; margin-left: 10px; margin-top: 0; height: 100%;">
                    To delete a record, click this button
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Formaction/includes/footer.php'; ?>