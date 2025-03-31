<?php
    include "../directory.php";
    //include SITE_ROOT."/php/redirectHome.php";
    $webpageTitle = "Profile";
    include SITE_ROOT."/includes/header.php";
    include SITE_ROOT."/db/dbConnection.php";
?>

<?php
    //Ensure tables are there
    include SITE_ROOT."/db/tableCreatePics.php";
    include SITE_ROOT."/db/tablePopulatePics.php";
?>

<?php /* require_once '../AnimalWeb/includes/header.php'?>
<?php require_once '../AnimalWeb/db/conn.php' */?>

<?php 
$userID = $_SESSION['ID']; // Assign to a variable for clarity

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}

// Fetch saved images for the logged-in user with optional search filter


?>
<!-- big internal css is not good -->
<link rel="stylesheet" href="/css/profilePage.css">

    <!-- Profile Section -->
    <div class="profile-container">
    <div class="profile-pic">
      <?php  
              $sql = "SELECT favpic FROM user_profile_info WHERE ID = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $userID);
              $stmt->execute();
              $result = $stmt->get_result();
              
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<img src="' . htmlspecialchars($row['favpic']) . '" alt="Saved Image" class="profile-pic">';
                }
            } 
              ?>
    </div>
        <div class="box">
          <H1 class="profile-name">
            
            <?php  
            $sql = "SELECT userNAME FROM user_profile_info WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Check if a user was found
            if ($result->num_rows > 0) {
                // Fetch the user's name
                $row = $result->fetch_assoc();
                $userName = htmlspecialchars($row['userNAME']);
            } else {
                // Handle the case where no user was found
                $userName = 'User';
            }
            
            echo $userName?>
          </H1>
          <div class="profile-description">
          <?php  
            $sql = "SELECT profile_Description FROM user_profile_info WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Check if a user was found
            if ($result->num_rows > 0) {
                // Fetch the user's name
                $row = $result->fetch_assoc();
                $userDescription = htmlspecialchars($row['profile_Description']);
            } else {
                // Handle the case where no user was found
                $userDescription= 'Write something...';
            }
            
            echo $userDescription?>

        </div>

        <button class="edit-btn" id="editBtn">Edit</button>

        </div>

    </div>
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">

        <span class="close-btn" id="closeBtn">&times;</span>
        <form class="edit-profile-form"id="editForm" method="POST" action="">
                <textarea name="new_description" rows="4" cols="50" placeholder="Edit your description..."></textarea>
                <button type="submit" name="save_profile"class="save-btn">Save</button>

            </form>
            

        </div>

    </div>
    <script>
          document.getElementById('editBtn').onclick = function() {document.getElementById('editModal').style.display = 'block';}
          document.getElementById('closeBtn').onclick = function() {document.getElementById('editModal').style.display = 'none';}
          window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                document.getElementById('editModal').style.display = 'none';
            }
          }
    </script>

    <form method="POST" action="">
      <div class="search-container">
      
      <input type="text" name="search" class="search-bar" placeholder="Search Your Saved Pictures..." value="<?php echo htmlspecialchars($searchQuery); ?>">
      <button type="submit" class="simple-button">Search</button>
          
      </div>
            
    </form>
       </div>
   

    <!-- Image Grid -->
    <div class="image-grid">
    <?php
        $sql = "SELECT photoURL FROM user_saved_info WHERE userID = ? AND photoNAME LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $searchQuery . "%";  // Wildcard for LIKE query
        $stmt->bind_param("is", $userID, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<img src="' . htmlspecialchars($row['photoURL']) . '" alt="Saved Image">';
          }
      } else {
          echo "<p>No saved images yet.</p>";
      }
      ?>
    </div>

</body>
<?php require_once '../AnimalWeb/includes/footer.php'?>
