<?php
echo "mysqli_connect test4<br>";
$conn = mysqli_connect(
  "localhost",
  "alexnet",
  "alexnet1234",
  "opentutorials");
// $res = mysqli_query($mysqli, "SELECT 'Plaase, do not use ' as _msg from DUAL");
// $row = mysqli_fetch_assoc($res);
// echo $row['_msg'];
$sqlcmd = "
  INSERT INTO topic
    (title, description, created)
    VALUE(
      'MySQL',
      'MySQL is ...',
      NOW()
    );
";
$res = mysqli_query($conn, $sqlcmd);
if($res == false) {
  // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
  echo "저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
  error_log(mysqli_error($conn));
}

$sqlcmd = "
  SELECT * from topic;
";
$res = mysqli_query($conn, $sqlcmd);
if($res == false) {
  // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
  echo "조회하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
  error_log(mysqli_error($conn));
}

$row = mysqli_fetch_assoc($res);
echo $row['id']."/".$row['title'];
?>