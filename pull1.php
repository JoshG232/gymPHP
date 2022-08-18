<?php include "inc/header.php" ?>





<?php
  $name = $setNum = $weight = $reps = "";
  $nameErr = $setNumErr = $weightErr = $repsErr = "";

  //Form Submit
  if (isset($_POST["submit"])) {
    //Validation for name
    if (empty($_POST["name"])){
      $nameErr = "Name is required";

    }
    else {
      $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    // Validation for set
    if (empty($_POST["setNum"])){
      $setNumErr = "Set is required";

    }
    else {
      $setNum = filter_input(INPUT_POST, "setNum", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
  
    //Validation for weight
    if (empty($_POST["weight"])){
      $weightErr = "Email is required";

    }
    else {
      $weight = filter_input(INPUT_POST, "weight", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
  
    //Validation for reps
    if (empty($_POST["reps"])){
      $repsErr = "Feedback is required";

    }
    else {
      $reps = filter_input(INPUT_POST, "reps", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($nameErr) && empty($setNumErr) && empty($weightErr) && empty($repsErr)){
      //Add to the database
      $sql = "INSERT INTO pull1 (name,setNum,weight,reps) VALUES 
      ('$name','$setNum','$weight','$reps')";

      if (mysqli_query($conn, $sql)){
        //Successful
        header('Location: /gymV1/pull1.php');
      }
      else {
        echo "Error" . mysqli_error($conn);
      }
    }

    
  }

?>
    <h1>Select Exercise</h1>
    <p>Fill in the boxes below</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-4 w-75" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name of exercise</label>
        <select class="form-control" id="name" name="name">
          <option value="Cable Pulldown">Cable Pulldown</option>
          <option value="Cable row">Cable row</option>
          <option value="Lat Pulldown">Lat Pulldown</option>
          <option value="Rear Delt Flys">Rear Delt Flys</option>
          <option value="Hammer Curls">Hammer Curls</option>
          <option value="Shrugs">Shrugs </option>
          <option value="Incline Curl">Incline Curl </option>
          <option value="Preacher Curls">Preacher Curls</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="setNum" class="form-label">Set</label>
        <input type="text" class="form-control <?php echo $setNumErr ? "is-invalid" : null; ?>" id="setNum" name="setNum" placeholder="Enter your set">
        <div class="invalid-feedback">
          <?php echo $setNumErr; ?>
        </div>
      </div>

      <div class="mb-3">
        <label for="weight" class="form-label">weight</label>
        <input type="text" class="form-control <?php echo $weightErr ? "is-invalid" : null; ?>" id="weight" name="weight" placeholder="Enter your weight">
        <div class="invalid-feedback">
          <?php echo $weightErr; ?>
        </div>
      </div>

      <div class="mb-3">
        <label for="reps" class="form-label">Reps</label>
        <textarea class="form-control <?php echo $repsErr ? "is-invalid" : null; ?>" id="reps" name="reps" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
          <?php echo $repsErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>

    
<?php
  $sql = "SELECT * FROM pull1";
  $result = mysqli_query($conn,$sql);
  $exercises = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
    <h2>Exercises</h2>

    <!-- <?php if(empty($exercies)): ?>
      <p class="lead mt3">There is no change</p> 
    <?php endif; ?> -->
      
    <?php foreach($exercises as $item): ?>

    <div class="card my-3 w-75 ">
     <div class="card-body text-center">
      
     <style>
        table, th, td {
          border:1px solid black;
          padding: 2px;
        }
      </style>

      <table>
        <tr>
          <td>Exercise name:<?php echo $item["name"]; ?></td>
          <td>Set:<?php echo $item["setNum"]; ?></td>
          <td>Number of reps:<?php echo $item["reps"]; ?></td>
          <td>Weight:<?php echo $item["weight"]; ?></td>
        </tr>
      </table>


      <!-- <div class="text-seconday mt-2">
        By <?php echo $item["name"]; ?> on <?php echo $item["date"]; ?>
      </div> -->
     </div>
   </div>

    <?php endforeach; ?>
   
   </div>
  </div>
