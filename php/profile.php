<?php
    include "../directory.php";
    //include SITE_ROOT."/php/redirectHome.php";
    $webpageTitle = "Profile";
    include SITE_ROOT."/includes/profile_header.php";
    include SITE_ROOT."/db/dbConnection.php";
?>

<?php
    //Ensure tables are there
    include SITE_ROOT."/db/tableCreatePics.php";
    include SITE_ROOT."/db/tablePopulatePics.php";
    include SITE_ROOT."/db/tableCreatePicsSaved.php";
?>

<?php /* require_once '../AnimalWeb/includes/header.php'?>
<?php require_once '../AnimalWeb/db/conn.php' */?>

<?php 
$userID = $_SESSION['profile_id']; // Assign to a variable for clarity

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}

// Fetch saved images for the logged-in user with optional search filter

// Save profile description and fav color
if (isset($_POST['save_profile'])) {
    $newDescription = isset($_POST['new_description']) ? trim($_POST['new_description']) : null;

    if ($newDescription !== null) {
        $sql = "UPDATE termproject_profiles SET profile_description = ? WHERE profile_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newDescription, $userID);
        if ($stmt->execute()) {
            // Optional: redirect to refresh the page and show the updated description
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p style='color:red;'>Update failed: " . $stmt->error . "</p>";
        }
    }
}
// save favPic
if (isset($_POST['like'])) {
    $FavPic = trim($_POST['like']);
    $sql = "UPDATE termproject_profiles SET profile_pic = ? WHERE profile_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $FavPic, $userID);
    if ($stmt->execute()) {
        // Optional: redirect to refresh the page and show the updated description
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<p style='color:red;'>Update failed: " . $stmt->error . "</p>";
    }
}

?>
<!-- big internal css is not good -->
<link rel="stylesheet" href="/css/profilePage.css">
    <!-- Profile Section -->
    <div class="profile-container">
    
        <div>
            <?php  
            $sql = "SELECT profile_pic FROM termproject_profiles WHERE profile_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
                        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Convert backslashes to forward slashes
                    $profilePic = str_replace('\\', '/', $row['profile_pic']);
                    $profilePic = trim($profilePic);
                    
                    // Build an absolute filesystem path
                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $profilePic;
                    
                    // Debug output (remove or comment out in production)
                    // var_dump($absolutePath);
                    
                    // Check if the profilePic is non-empty and the file exists
                    if (!empty($profilePic) && file_exists($absolutePath)) {
                        echo '<img src="' . htmlspecialchars($profilePic) . '" alt="Saved Image" class="profile-pic">';
                    } else {
                        echo '<img src="/pics/Lion.jpg" alt="empty" class="profile-pic">';
                    }
                }
            }
            ?> 
        </div>
        <div class="box">
        
          <H1 class="profile-name">
            
            <?php  
            $sql = "SELECT profile_username FROM termproject_profiles WHERE profile_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Check if a user was found
            if ($result->num_rows > 0) {
                // Fetch the user's name
                $row = $result->fetch_assoc();
                $userName = htmlspecialchars($row['profile_username']);
            } else {
                // Handle the case where no user was found
                $userName = 'User';
            }
            
            echo $userName?>
          </H1>
          <div class="profile-description">
          <?php  
            $sql = "SELECT profile_description FROM termproject_profiles WHERE profile_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Check if a user was found
            if ($result->num_rows > 0) {
                // Fetch the user's name
                $row = $result->fetch_assoc();
                $userDescription = htmlspecialchars($row['profile_description']);
            } else {
                // Handle the case where no user was found
                $userDescription= 'Write something...';
            }
            
            echo $userDescription?>
       
        </div>



        </div>
        <button class="edit-btn" id="editBtn">Edit</button>
    </div>
    
    </div>
    
    <div id="editModal" class="modal">
        <div class="modal-content">

        <span class="close-btn" id="closeBtn">&times;</span>
        <form class="edit-profile-form"id="editForm" method="POST" action="">
            <textarea name="new_description" rows="4" cols="50" placeholder="Edit your description..." ><?php echo htmlspecialchars($userDescription);?></textarea>
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
        $sql = "SELECT pic_path 
        FROM (termproject_pics_saved
        INNER JOIN termproject_pics ON termproject_pics_saved.pic_id = termproject_pics.pic_id)
        WHERE profile_id = ? AND pic_path LIKE ?";
        //get the search to work
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $searchQuery . "%";  // Wildcard for LIKE query
        $stmt->bind_param("is", $userID, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();

        
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {

      
        
            $value = $row['pic_path'];
            echo '
            <div class="image-container">
            
                <form id="LikePic" method="POST" action="">
                <a href="/php/picture.php?pic_path=' . urlencode($value) . '"><img src="/pics/' . htmlspecialchars($value) . '" alt="Saved Image" class="imger"></a>
                <button class="Fav-button" type="submit" name="like" value="/pics/' . htmlspecialchars($value) . '">
                
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>
                </svg>
                </button>
                </form>
            </div>';


          }
      } else {
          echo "<p>No saved images yet.</p>";
      }
      ?>
    </div>

</body>
<?php
    include SITE_ROOT."/includes/footer.php";
?>
