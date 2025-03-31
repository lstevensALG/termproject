<?php require_once '../AnimalWeb/includes/header.php'?>
<?php require_once '../AnimalWeb/db/conn.php'?>
<?php 
$_SESSION['ID'] = 2; // Set user ID manually for testing

$userID = $_SESSION['ID']; // Assign to a variable for clarity

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}

// Fetch saved images for the logged-in user with optional search filter


?>
    <title>Profile Page</title>
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
          width: 250px;  /* Ensure width and height are the same */
          height: 250px;
          border-radius: 50%; /* Ensures it's a circle */
          object-fit: cover; /* Prevents distortion */
          display: block;
          border-radius: 50%;
          object-fit: cover;
          margin-right: 20px;
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
        .simple-button{
          border-radius: 20px;
          border: 1px solid #ccc;
          padding: 10px;
          margin-left: 10px;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, 250px);
            gap: 10px;
            max-width: 1500px;
            width: 100%;
            background-color:rgba(62, 62, 151, 0.81);
            padding:20px;
            border-radius: 20px;

        }
        .image-grid img {
            width: 100%;
            height: 100%;
            max-height:250px;
            max-width:200px;
            object-fit: cover;
            border-radius: 10px;


        }

        .profile-container {

            display: flex;
            margin-bottom: 60px;
            width: 100%;
            max-width: 1000px;
        }
        .profile-description {
          background-color:rgba(27, 27, 31, 0.28);
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
        .profile-name{
          background-color:rgba(62, 62, 151, 0.81);
          border-radius: 10px;
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

textarea{
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
    flex-direction:row;
    background-color:rgba(27, 27, 31, 0.28);
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
    </style>

<body>

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
