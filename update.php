<?php
//var_dump($_POST);
$conn = mysqli_connect(
  "localhost",
  "alexnet",
  "alexnet1234",
  "opentutorials");

$sqlcmd = "SELECT * from topic limit 100";
$res = mysqli_query($conn, $sqlcmd);
if(true != $res) {
  // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
  echo "조회하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
  error_log(mysqli_error($conn));
}

$list = "";
while($row = mysqli_fetch_array($res)) {
  //<li><a href='index.php?id=19'>MySQL</a></li>
   $list = $list . "<li><a href='index.php?id={$row['id']}'>{$row['title']}</a></li>";
}

$article = array(
  'id'=>NULL,
  'title'=>"",
  'description'=>""
);
if(isset($_GET['id'])) {
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sqlcmd = "SELECT * from topic where id='$filtered_id'";
  $res = mysqli_query($conn, $sqlcmd);

  if(true != $res) {
    // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
    echo "조회하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
    error_log(mysqli_error($conn));
  }

  $row = mysqli_fetch_array($res);
  $article['id'] = $row['id'];
  $article['title'] = $row['title'];
  $article['description'] = $row['description'];
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
      <?=$list?>
    </ol>
    <form action="process_update.php" method="post">
      <p>
        <input type="hidden" name="id" value="<?=$article['id']?>">
      </p>
      <p>
        <input type="text" name="title" placeholder="Title" value="<?=$article['title']?>">
      </p>
      <p>
        <textarea type="textarea" name="description"><?=$article['description']?></textarea>
      </p>
      <p>
        <input type="submit">
      </p>
    </form>
  </body>
</html>