<html>
<head>
<title>Page Title</title>
</head>
<body>
<?php
$host = 'localhost'; // or your host name
$dbname = 'student'; // your database name
$username = 'root'; // your database username
$password = ''; // your database password
$con = new mysqli($host,$username,$password,$dbname);
if(mysqli_connect_errno()){
    echo "Failed to connect!";
    exit();
}
$instructor_id=$_POST["userid"];

$course = "SELECT course_number FROM `courses` WHERE instructor_id='$instructor_id'";
$result1 = $con->query($course);
if($result1->num_rows>0){
	while($row = $result1->fetch_assoc()){
        $course_id = $row["course_number"];
		$allattend = "SELECT * FROM `attendance` WHERE course_number='$course_id'";
        $result2 = $con->query($allattend);
        if($result2->num_rows>0){
	        while($row = $result2->fetch_assoc()){
                if($row["if_attended"] == 1){
			        echo"Course Number: ".$row["course_number"]." Student ID:".$row["student_id"]." Attended: Yes<br><br>";
		        }else{
			        echo"Course Number: ".$row["course_number"]." Student ID:".$row["student_id"]." Attended: No<br><br>";
                }
		    }
    
	    }else{
            echo "<h1>Error!</h1>";
            echo "no user found";
        }
	}

		echo "<br><br>";
		echo '<form action= "./instructor_homepage.php" method = "post">';
		echo '<input type="hidden" name="userid" value=' . $instructor_id . '>';
		echo '<input type="submit" value="goto homepage">';
		echo "</form>";
	
}
else{
	echo "<h1>Error!</h1>";
	echo "no user found";
}
?>

</body>
</html>