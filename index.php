<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body bgcolor="#FAEBD7">

</body>
</html>


<?php 
    $url = "https://api.exchangeratesapi.io/latest?base=INR";
     /*$url="https://data.fixer.io/api/latest
    ? base=INR";*/
    $ch = curl_init();
    $timeout = 0;

    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
    $rawdata = curl_exec($ch);

   
      curl_close($ch);
    
    $data=json_decode($rawdata,true);
      /*echo "<pre>";
      print_r($data);*/
         $INR_Indian=$data['rates']['INR'];
         $USD_Dollar=$data['rates']['USD'];
         $GBP_Pound=$data['rates']['GBP'];
        $EUR_Euro=$data['rates']['EUR'];
        $AUD_AustrilsnDollar=$data['rates']['AUD'];

$servername="localhost";
$username="root";
$password="root";
$databse="namekart";
$conn=mysqli_connect($servername,$username,$password,$databse);
if(!$conn)
     die("connection not created..".mysqli_connect_error());
   $sql = "INSERT INTO  currency(INR_Indian,USD_Dollar, GBP_Pound, EUR_Euro,AUD_AustrilsnDollar)
VALUES ('$INR_Indian','$USD_Dollar','$GBP_Pound','$EUR_Euro', '$AUD_AustrilsnDollar')";

        $conn->query($sql);




echo "<h3 style='color:green;text-align:center'>Currency display</h3>";
   $result=mysqli_query($conn,"select INR_Indian,USD_Dollar,GBP_Pound,EUR_Euro,AUD_AustrilsnDollar,Logindate from currency");


echo "<table border='2'>
   <tr>
      <th>INR_Indian</th>
      <th>USD_Dollar</th>
      <th>GBP_Pound</th>
      <th>EUR_Euro</th>
      <th>AUD_AustrilsnDollar</th>
      <th>DateTime</th>
    </tr>";
    if(mysqli_num_rows($result)>0)
    {
      while ($array = mysqli_fetch_assoc($result))
     {
        echo "<tr><td>".$array["INR_Indian"]."</td><td>".
        $array["USD_Dollar"]."</td><td>".$array["GBP_Pound"].
        "</td><td>".$array["EUR_Euro"]."</td><td>".
        $array["AUD_AustrilsnDollar"]."</td><td>".$array["Logindate"].
        "</td></tr>";
     }

    }
    else
    {
        echo "0 results";
    }
    echo "</table";












?>