<?php
//var_dump($_POST);
$conn = mysqli_connect(
  "localhost",
  "alexnet",
  "alexnet1234",
  "opentutorials");

$sqlcmd = "SELECT * from topic limit 100";
$res = mysqli_query($conn, $sqlcmd);
if($res == false) {
  // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
  echo "조회하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
  error_log(mysqli_error($conn));
}
$list = "";
while($row = mysqli_fetch_array($res)) {
   $list = $list . "<li>{$row['title']}</li>";
   //echo '<li>'.$row['title'].'</li>';
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1>WEB</h1>
    <ol>
      <?php echo $list;?>
    </ol>
  </body>
</html>