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

$sql = "SELECT favColor FROM termproject_profiles WHERE profile_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$favColor = "#ffffff"; // default fallback

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $favColor = $row['favColor'] ?? "#ffffff";
}
$stmt->close();

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
    }
    $newcolor = isset($_POST['favcolor']) ? trim($_POST['favcolor']) : null;

    if ($newcolor !== null) {
        $sql = "UPDATE termproject_profiles SET favColor = ? WHERE profile_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newcolor, $userID);
    }

    if ($stmt->execute()) {
        // Optional: redirect to refresh the page and show the updated description
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<p style='color:red;'>Update failed: " . $stmt->error . "</p>";
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
<style>
    
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  align-items: flex-start;
  display: flex;
  flex-direction: column;
  margin-left: 40px;
  margin-right: 40px;
}

.profile-pic {
  width: 250px; /* Ensure width and height are the same */
  height: 250px;
  border-radius: 50%; /* Ensures it's a circle */
  object-fit: cover; /* Prevents distortion */
  display: block;

  object-fit: cover;
  margin-right: 20px;
  border-width:10px;
 border-color: <?php echo htmlspecialchars($favColor); ?>;
  border-style: solid;
}

.search-container {
  display: flex;
  align-items: center;
  justify-content: space-between; /* Ensures elements stay side by side */
  width: 100%;
  margin-bottom: 0px;
  max-width: 1000px;
  padding: 15px;
  border-radius: 10px;
  /*box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); /* Optional shadow */
}

.search-bar {
  /*background-color: rgb(49, 51, 52); /* Grey Background */
  width: 100%;
  max-width: 1000px;
  padding: 10px;
  border-radius: 20px;
  border: 1px solid #ccc;
}

.simple-button {
  border-radius: 20px;
  border: 1px solid #ccc;
  padding: 10px;
  margin-left: 10px;
}

.image-grid {

  display: grid;
  grid-template-columns: repeat(auto-fit, 250px);
  gap: 20px;
  max-width: 1500px;
  width: 100%;
  background-color: <?php echo htmlspecialchars($favColor); ?>;
  padding: 20px;
  border-radius: 20px;
}

/* Use a fixed width and height for grid images */
.image-grid img {
  width: 200px;       /* fixed width */
  height: 250px;      /* fixed height */
  object-fit: cover;  /* ensures the image fills the dimensions without distortion */
  border-radius: 10px;
}

.profile-container {
    
  display: flex;
  margin-bottom: 60px;
  width: 100%;
  max-width: 1000px;
}

.profile-description {
    
  background-color: rgba(0, 0, 0, 0);
  flex-direction: column;
  align-items: start; /* Moves everything to the left */
  width: 100%;
  max-width: 800px;
  word-wrap: break-word; /* Ensures text wraps */
  overflow-wrap: break-word; /* Ensures text wraps */
  white-space: normal; /* Allows wrapping inside the box */
  position: relative; /* Establishes a positioning context for the button */
  padding: 20px; /* Optional: Adds padding inside the box */
}

.profile-name {
 /* background-color: <?php echo htmlspecialchars($favColor); ?>; */
  border-radius: 10px;
}





textarea {
  width: 100%; /* Make it take the full width of the box */
  max-width: 1200px; /* Limit the width to match the profile box */
  height: 100%;
  max-height: 300px;
  padding: 10px;
  border-radius: 20px; /* Rounded edges */
  border: 1px solid #ccc; /* Border color */
  font-size: 16px; /* Optional: Adjust text size */
  resize: vertical; /* Allows resizing vertically */
}

.box {
    border-width:2px;
   border-color: <?php echo htmlspecialchars($favColor); ?>;
  border-style: solid;
  flex-direction: row;
  background-color: rgba(27, 27, 31, 0.512);
  color: white;
  text-align: center;
  padding: 20px;
  border-radius: 10px;
  width: 1000px;
  min-height: 50px; /* Ensures they are the same height */

}

/* Modal Styles */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent background */
}

.modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border-radius: 10px;
  width: 80%; /* Set the width of the modal */
  height: 80%; /* Set the width of the modal */
  max-width: 1000px;
  max-height: 800px;
}

/* Close Button */
.close-btn {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.image-container {
  position: relative;
  display: inline-block; /* keeps image and button together */
}
.close-btn:hover,
.close-btn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.edit-profile-form {
  position: relative; /* Required for positioning the button inside the form */
  height: 300px; /* Set a fixed height for the popup */
}

.save-btn {
  position: absolute;
  bottom: 10px; /* Position the button 10px from the bottom of the form */
  left: 50%;
  transform: translateX(-50%); /* Centers the button horizontally */
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  font-size: 16px;
}

.save-btn:hover {
  background-color: #45a049;
}
.Fav-button {
  position: absolute;
  bottom: 10px;
  right: 60px;
  transition: background 0.2s;
  background-color: rgba(0, 0, 0, 0); /* semi-transparent background */
  color: white;  /* Set initial color of the SVG */
  border-radius:50% ;
  border: none;
  cursor: pointer;
}

.Fav-button:hover {
  background-color: rgb(255, 243, 199); /* Background color on hover */
}

.Fav-button:hover svg {
  color:rgb(255, 202, 67); /* Change the color of the SVG on hover (e.g., gold) */
}
.edit-btn {
    position: absolute;
    top: 10px; /* Distance from the top edge */
    right: 10px; /* Distance from the right edge */
    padding: 5px 10px;
    background-color: #4CAF50; /* Green background */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.edit-btn:hover {
    background-color: #45a049; /* Darker green on hover */
}
.color-box {
  
  padding: 20px;
  border-radius: 15px;
  margin-top: 20px;
  width: 250px;
  display: flex;
  color:rgb(155, 155, 155);
  align-items: center;
  left: 60px;
}

input[type="color"] {
    margin-left:20px;
  margin-top: 10px;
  width: 60px;
  height: 40px;
  border: none;
  cursor: pointer;
  background: none;
}

</style>
<!-- big internal css is not good -->
<!--<link rel="stylesheet" href="/css/profilePage.css">-->
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
                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/pics/' . $profilePic;
                    
                    // Debug output (remove or comment out in production)
                    // var_dump($absolutePath);
                    
                    // Check if the profilePic is non-empty and the file exists
                    if ( ($profilePic != NULL) and (file_exists($absolutePath))  ) {
                        echo '<img src="/pics/' . htmlspecialchars($profilePic) . '" alt="Saved Image" class="profile-pic">';
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
            <div class="color-box">
                    <label for="colorPicker">Pick a Profile Color:</label>
                    <input type="color" id="colorPicker" name="favcolor" value="<?php echo htmlspecialchars($favColor); ?>">
                </div>
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
