<?php
include("config/constants.php");
$mail = $_POST['email'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$msg = $_POST['msg'];

$sql = "insert into contact_us values('$mail','$name','$subject','$msg')";
//exec query
$res = mysqli_query($conn, $sql);
if ($res) {
    echo '<script>
    alert("Message sent successfully.\n Thank you!!!");
    window.location.href = "contact.php";
    </script>';
} else {
    echo '<script>
    alert("Oops!!! Something went wrong.");
    window.location.href = "contact.php";
    </script>';
}
