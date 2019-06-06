<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    <?php include 'left.inc.php'; ?>


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control" >
                <option value="0">Select Continent</option>
                <?php
                //Fill this place

                //****** Hint ******
                //display the list of continents
                $sql = "SELECT ContinentCode,ContinentName FROM continents";
                $continents = $conn->query($sql);

                while($row = $continents->fetch_assoc()) {
                  echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }

                ?>
              </select>     
              
              <select name="country" class="form-control"id="country">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place

                //****** Hint ******
                /* display list of countries */
                $sql = "SELECT ISO,CountryName,Continent FROM countries";
                $countries = $conn->query($sql);

                while($row = $countries->fetch_assoc()) {
                    echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                }
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
            <?php 
            //Fill this place

            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
            <li>
              <a href="detail.php?id=????" class="img-responsive">
                <img src="images/square-medium/????" alt="????">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>????</p>
                  </div>
                </div>
              </a>
            </li>        
            */
            $sql = "SELECT * FROM imagedetails";
            $images = $conn->query($sql);
            while($row = $images->fetch_assoc()){
                if (valid($row)){
                        echo '<li>
              <a href="detail.php?id='.$row['ImageID'].'" class="img-responsive">
                <img src="images/square-medium/'.$row['Path'].'" alt="'.$row['Title'].'" style="height: 225px;width: 225px;">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>'.$row['Description'].'</p>
                  </div>
                </div>
              </a>
            </li>        ';
                }
            }
            function valid($row){
                if (!isset($_GET['continent'])||($_GET['continent']=='0'&&$_GET['country']=='0')) return true;
                else if($_GET['country']=='0') return $_GET['continent'] == $row['ContinentCode'];
                else return $_GET['country'] == $row['CountryCodeISO'];
            }
            ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <?php
    echo '<script type="text/javascript">';
    echo '$("select[name=\'continent\']").change(function(){var country = $("select[name=\'country\']");country.empty();';
    echo 'var newOpt = document.createElement("option");
         newOpt.text = "Select Country";
         newOpt.value = "0";
         document.getElementById("country").appendChild(newOpt);';
    $sql = "SELECT ISO,CountryName,Continent FROM countries";
    $countries = $conn->query($sql);
    while($row = $countries->fetch_assoc()){
        echo 'if("'.$row['Continent'].'"==$(this).val()){
         var newOpt = document.createElement("option");
         newOpt.text = "'.$row['CountryName'].'";
         newOpt.value = "'.$row['ISO'].'";
         document.getElementById("country").appendChild(newOpt);
        }';
    }
    echo '})
    </script>';
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
<?php
$conn->close();
?>
