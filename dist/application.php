<?php
$subject = "New Application";
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$store = $_POST["store"];
$monday = $_POST["monday"];
$tuesday = $_POST["tuesday"];
$wednesday = $_POST["wednesday"];
$thursday = $_POST["thursday"];
$friday = $_POST["friday"];
$saturday = $_POST["saturday"];
$sunday = $_POST["sunday"];
$am = $_POST["am"];
$pm = $_POST["pm"];
$both = $_POST["both"];
$history = $_POST["history"];
$message = $_POST["message"];

$age = $_POST["age"];
$proof = $_POST["proof"];

header('Content-Type: application/json');
if ($name === ''){
print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
exit();
}
if ($email === ''){
print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
exit();
} else {
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
exit();
}
}
if ($subject === ''){
print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
exit();
}
if ($phone === ''){
print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
exit();
}
$content="A new application has been submitted for store: $store \n\nApplicant details: \nName: $name \nEmail: $email \nPhone: $phone \n\n Previous Work experience details: $message \n\nDesired Working Days: \nMonday: $monday \nTuesday: $tuesday \nWednesday: $wednesday \nThursday: $thursday \nFriday: $friday \nSaturday: $saturday \nSunday: $sunday \n\nDesired Working Times: \nAM: $am \nPM: $pm \nBoth: $both. \n\nGeneral Questions: \n\n16 Years: $age \nLegal Proof of right to work: $proof";
$content=wordwrap($content,70);
$recipient = "Lbreedlove@cicispizza.com, store$store@cicis.com";
$mailheader = "From: $email \r\n - Store: $store";
mail($recipient, $subject, $content, $mailheader) or die("Error!");
print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
exit();
?>