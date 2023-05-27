<?php
/** Check if a spammer is filling out the form. if the field check was filled out that means a Spammer is attempting to autofill the form **/
if(isset($_POST['check']){
	/** kill the script **/
	die("Anti Spam");
	exit();
}
/** Check if all needed fields were submitted **/
if(!empty($_POST['cf-name']) && !empty($_POST['cf-email']) && !empty($_POST['cf-message']))
{
	
	
	/** set database connection configuration **/
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "resumedb";
	/** connect to database **/
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
	/** if connection is not successfull show error **/
      if(!$conn){
          die('On peux pas se connecter au serveur:' .mysql_error());
        }
/** initialize the form fields **/
$name = "";
$email = "";
$comment = "";
/** set the values based on submmited form fields and escape any special character like apostrophe to not break the sql query **/
$name = mysqli_real_escape_string($conn, $_POST['cf-name']);
$email = mysqli_real_escape_string($conn, $_POST['cf-email']);
$comment = mysqli_real_escape_string($conn, $_POST['cf-message']);
/** Run Insert query and check if successful **/
if(mysqli_query($conn, "INSERT INTO comments(name, email, comment) VALUES('" . $name . "', '" . $email . "', '" . $comment . "')")) {
echo '1';
} else {
echo "Erreur: " . $sql . "" . mysqli_error($conn);
}
/** Close mysql connection **/
mysqli_close($conn);
} 
/** if the values submitted are empty show error **/
else {
	
	echo "Valeurs sont vides. Erreur de submission";
	exit();
}
?>