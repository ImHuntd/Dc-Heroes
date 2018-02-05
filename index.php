<!--worked together with Eddie-->

<!DOCTYPE html>
<?php
		include("inc/database-connection.php");
		if (isset($_GET['TeamId'])) {
			$TeamId = $_GET['TeamId'];
		}
		if (isset($_GET['HeroId'])) {
			$HeroId = $_GET['HeroId'];
		}
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/dclogo.png" />
    <title>DC Heroes</title>
  </head>
  <body>

<?php
   include("inc/header.php")
 ?>

<div class="container-main">
  <div class="container-left">
    <h1>Teams</h1>
    <ul>

      <?php
      $sql = "SELECT TEAM_NAME,TEAM_ID
      FROM teams";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <li>
            <a href="index.php?TeamId=<?php echo $row['TEAM_ID']; ?>"><?php echo $row["TEAM_NAME"];?></a>
          </li>
          <?php
        }
      }
      else {echo "0 results";}
      ?>
    </ul>
  </div>

  <div class="container-center">
    <?php
    if (isset($TeamId)) {
      $sql = "SELECT *
      FROM Heroes
      WHERE TEAM_ID = $TeamId	";

      //die($sql);

      $result = mysqli_query($conn, $sql);
      echo "<!-- $sql -->";
      $nrRows = mysqli_num_rows($result);
      if ($nrRows > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          ?>

          <div>
              <?php echo $row["HERO_NAME"]; ?>
                <br />
              <img src="<?php echo $row['HERO_IMAGE'];?>"/>
              <?php echo $row["HERO_DESCRIPTION"] ?>             
              <div>
                <p><a href="index.php?TeamId=<?php echo $TeamId; ?>&HeroId=<?php echo $row['HERO_ID']; ?>">Learn More</a></p>
              </div>

            </div>

            <?php
          }
        } else {
          echo "0 results";
        }
      }
      else
      {
        echo "Please select team first ";
      }
      ?>
    </div>

    <div class="container-right">
      <?php
      if (isset($HeroId)) {
        $sql = "SELECT *
        FROM Heroes
        WHERE HERO_ID = $HeroId	";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div>
              <div class="HeroBackgroundForImg">
                <div class="HeroName">
                  <h1><?php echo $row["HERO_NAME"]; ?></h1>
                </div>
              </div>
              <img src="<?php echo $row['HERO_IMAGE'];?>"/>
              <div class="HeroDescription">
                <?php echo $row["HERO_DESCRIPTION"] ?>
                <h1>POWERS</h1>
                <?php echo $row["HERO_POWERS"] ?>
              </div>

            </div>
            <?php
          }
        } else {
          echo "0 results";
        }
  }
  else
  {
    echo "Please select superhero first ";
  }
    ?>
  </div>
</div>
<?php
      include("inc/footer.php")
    ?>
  </body>
</html>
