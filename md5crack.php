<?php
function decode_md5($hash)
{
  //simple check for md5 hash
  if(!preg_match('/^[a-f0-9]{32}$/i',$hash))return '';

  //make request to service
  $pass=file_get_contents('http://md5.darkbyte.ru/api.php?q='.$hash);

  //not found
  if(!$pass)return '';

  //found, but not valid
  if(md5($pass)!=strtolower($hash))return '';

  //found :)
  return $pass;
}

?>

<?php
//usage example
//$md5=encode_md5('teststring');
//echo 'MD5(teststring) == '.$md5."<br>\r\n";

$md = $_POST['md'];
$pass=decode_md5("$md");
echo '$md == MD5('.$pass.')';
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="md" />
</form>
