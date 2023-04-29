<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

// $to = "arindampradhan80@gmail.com";
// $subject = "Test Email";

// $message = "
// <html>
// <head>
// <title>Test Email</title>
// </head>
// <body>
// <p>Here is your login details!</p>
// <table>
// <tr>
// <th>Username</th>
// <th>Password</th>
// </tr>
// <tr>
// <td>12345678</td>
// <td>12345678</td>
// </tr>
// </table>
// </body>
// </html>
// ";


// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// $headers .= 'From: <info@massolution.in>' . "\r\n";


// if($mail = mail($to,$subject,$message,$headers)){
//     print_r($mail);
// }

$mysql = new mysqli('db-mysql-blr1-20482-do-user-10692459-0.b.db.ondigitalocean.com:25060','doadmin','iKd5pNhhL1YaDbrE','defaultdb');
var_dump($mysql);

?>