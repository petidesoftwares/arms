<?php
    require 'vendor/autoload.php';
    use Mailgun\Mailgun;
    
    # Instantiate the client.
    $mgClient = Mailgun::create('f32d1da273cc4f432f64bd39f24bfe72-a09d6718-78aaefe5', 'https://app.mailgun.com');
    $domain = "www.myschool-arms.herokuapp.com";
    $params = array(
      'from'    => 'Excited User <ARMS@myschool-arms>',
      'to'      => 'idepeter68@gmail.com',
      'subject' => 'Hello',
      'text'    => 'Testing some Mailgun awesomness!'
    );
    
    # Make the call to the client.
    $mgClient->messages()->send($domain, $params);   
?>