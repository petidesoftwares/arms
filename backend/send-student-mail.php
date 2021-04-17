<?php
    require 'vendor/autoload.php';
    use Mailgun\Mailgun;
    
    # Instantiate the client.
    $mgClient = Mailgun::create('PRIVATE_API_KEY', 'https://API_HOSTNAME');
    $domain = "sandbox85f471c909ed486f830a17926adada56.mailgun.org";
    $params = array(
      'from'    => 'Excited User <YOU@YOUR_DOMAIN_NAME>',
      'to'      => 'bob@example.com',
      'subject' => 'Hello',
      'text'    => 'Testing some Mailgun awesomness!'
    );
    
    # Make the call to the client.
    $mgClient->messages()->send($domain, $params);   
?>