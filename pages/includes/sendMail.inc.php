<?php
// the message

$msg = $_POST['content'];
$from = $_POST['mail'];
$myMail= "jakovusdar@gmail.com";

$msg = wordwrap($msg,70);
$autoResponse="Thank you for contacting us, we will answer you as soon as possible.\nDo not reply to this message.";

if($msg =='' || $from ==''){
header("Location: ../contact.php");
exit();
}

mail($from,"Auto Response",$autoResponse);
mail($myMail,"Forum question",$msg);

header("Location: ../contact.php");
