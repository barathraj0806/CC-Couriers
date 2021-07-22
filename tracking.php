<?php
    include("db_connect.php");
    $tid = '';
    $error = '';
    if(isset($_POST['track'])){
        if(empty($_POST['tid'])){
            $error = "*Required";
        }
        else{
            $tid = $_POST['tid'];
            if(empty($error))
            {
                $sql = "SELECT * FROM status WHERE Tracking_ID='$tid'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $status = mysqli_fetch_assoc($result);
                    $active = array();
                    if(! is_null($status['Delivered'])){
                        $active['Delivered'] = $active['Out_for_delivery'] = $active['Shipped'] = 'active';
                    }
                    elseif(! is_null($status['Out_for_delivery'])){
                        $active['Delivered'] = '';
                        $active['Out_for_delivery'] = $active['Shipped'] = 'active';
                    }
                    elseif(! is_null($status['Shipped'])){
                        $active['Delivered'] = $active['Out_for_delivery'] = '';
                        $active['Shipped'] = 'active';
                    }
                }
                else{
                    $error = "*Invalid Tracking ID";
                }
            }
        }
    }    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CC Couriers</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="style/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style/index_styles.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon-32x32.png">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important;  margin-top: 10px !important; " ></div>
        <div class="background"></div> 
       <nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-default navbar-light mb-10" style="background-color: rgb(218, 0, 0); color:white; margin-top:10px !important;">
            <div class="container">
                <button class="navbar-toggler text-dark" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav  " style="margin: 0 auto; font-size: large;">
                        <a class="nav-item nav-link text-light mr-5 " href="index.html" >Home</a>
                        <a class="nav-item nav-link text-light mr-5" href="index.html#about">About</a>
                        <a class="nav-item nav-link text-light mr-5 active" href="#">Tracking</a>
                        <a class="nav-item nav-link text-light mr-5" href="branches.php">Branches</a>
                        <a class="nav-item nav-link text-light mr-5" href="login.php">Staff Login</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-10">
            <div class="row">
                <div class="col-md-4 p-4 text-center pt-0" style="background-color: rgba(219, 0, 0, 0.5); margin-top: 20px;">
                    <img src="Images/track3.png" style="margin:0 auto; height: 250px;">
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label style="font-size: 20px;">Tracking ID : </label>
                            <input type="text" style="border-radius: 8px;" name="tid" value=" <?php echo $tid; ?> ">
                            <label style="color:white;"><?php echo $error; ?></label>
                        </div>
                        <input type="submit" name="track" class="btn btn-light text-center" value="Track" style="font-size: 20px;">
                    </form>
                </div>
                <div class="col-md-8 p-4 " style="background-color: rgba(219, 0, 0, 0.2); margin-top: 20px;">
                    <h3 class="display-6 text-center pb-2 mb-3" style="border-bottom: 2px solid black;">Delivery Status</h3>                    
                    <div>
                        <p> Tracking ID: <?php echo $tid; ?> </p>
                    </div>
                    <div class="track bg-info">
                        <div class="step active"> <span class="icon"> <i class="fa fa-map-marker"></i> </span> <span class="text"> Received </span> </div>
                        <div class="step <?php echo $active['Shipped']; ?>"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way</span> </div>
                        <div class="step <?php echo $active['Out_for_delivery']; ?>"> <span class="icon"> <i class="fa fa-cubes"></i> </span> <span class="text"> Out for delivery </span> </div>
                        <div class="step <?php echo $active['Delivered']; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Delivered</span> </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="container-fluid text-center mt-5" style="background-color: rgba(26, 10, 0,0.5); padding: 15px; position: relative; ">
            <div class="i-bar" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content:center; margin-bottom: 1em;">
                <a class="fa fa-facebook " href="#" style="border: none; text-decoration: none;  margin: 0em 1em; color: #d9d9d9; font-size: xx-large;"></a>
                <a class="fa fa-instagram" href="#" style="border: none; text-decoration: none;  margin: 0em 1em; color: #d9d9d9; font-size: xx-large;"></a>
                <a class="fa fa-envelope " href="#" style="border: none; text-decoration: none;  margin: 0em 1em; color: #d9d9d9; font-size: xx-large;"></a>
            </div>
            <p class="credit" style="font-size: 20px; font-stretch: 3px; text-align: center; color: #d9d9d9;">© CC COURIERS</p>
        </div>
    </body>
</html>