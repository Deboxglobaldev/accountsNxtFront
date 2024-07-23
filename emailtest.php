<?php

// multiple recipients
$to = 'satendragurjar844@gmail.com';

// subject
$subject = 'Birthday Reminder';
// message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

function emailSend($to,$subject,$message){

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: satendragurjar844@gmail.com' . "\r\n";
$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";

// Mail it				
return mail($to, $subject, $message, $headers);

}

echo emailSend($to,$subject,$message);

?>