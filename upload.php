<?php
if (isset($_FILES['my_image'])) {
$sname = "192.168.200.13";
$uname = "ssyr";
$password = "ssyr#2022";
$db_name = "Pruebas";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
echo "Connection failed!";
exit();
}

$img_name = $_FILES['my_image']['name'];
$img_size = $_FILES['my_image']['size'];
$tmp_name = $_FILES['my_image']['tmp_name'];
$error    = $_FILES['my_image']['error'];

if ($error === 0) {

  if ($img_size > 1000000) {
    $em = "Sorry, your file is too large.";
    $error = array('error' => 1, 'em'=> $em);
    echo json_encode($error);
    exit();
  }else {
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (in_array($img_ex_lc, $allowed_exs)) {
      $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
      $img_upload_path = "c:/xampp7/htdocs/uploads/".$new_img_name;
      move_uploaded_file($tmp_name, $img_upload_path);
      $sql = "INSERT INTO users (image)
      VALUES ('$new_img_name')";
      mysqli_query($conn, $sql);
      $res = array('error' => 0, 'src'=> $new_img_name);
      echo json_encode($res);
      exit();

    }else {
    $em = "You can't upload files of this type";
    $error = array('error' => 1, 'em'=> $em);
    echo json_encode($error);
    exit();
    }
  }

}else {
  $em = "unknown error occurred!";
  $error = array('error' => 1, 'em'=> $em);
  echo json_encode($error);
  exit();
}
}
?> 

