<?php

/*--------------------------------------------------------//
            Enter your mashape application key.
        An application key has one available mind.
  Create more mashape applications if you need more minds.
//--------------------------------------------------------*/

$mashapeKey = 'ExampleLotsOfRandomChars856HKDSwwqe54v';

/*--------------------------------------------------------//
      We'll make a functions called api() for talking 
       to our mind, and nuke() for wiping the mind.
            Becareful about using nuke though!
//--------------------------------------------------------*/

function api($mindName, $userName, $message){
  global $mashapeKey;
  $api = 'https://erinsteph-cognitionlab-v1.p.mashape.com';
  $api .= '/mind/' . rawurlencode($mindName);  //  use rawurlencode() over urlencode()   //
  $api .= '/user/' . rawurlencode($userName); //  to encode spaces as %20 rather than + //
  $api .= '/message/' . rawurlencode($message);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $api);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Mashape-Key: ' . $mashapeKey));
  $response = curl_exec($ch);
  curl_close($ch);
  return json_decode($response, true);
}

function nuke(){
  global $mashapeKey;
  $api = 'https://erinsteph-cognitionlab-v1.p.mashape.com/nuke';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $api);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Mashape-Key: ' . $mashapeKey));
  $response = curl_exec($ch);
  curl_close($ch);
  return json_decode($response, true)['nuked'];
}

/*--------------------------------------------------------//
       Now we'll set the mind and user names and send 
     the message. Here we set it in script, but you can 
       easily pipe messages in from all over the web.
//--------------------------------------------------------*/

$mindName = 'Mind'; // A name for the bot to go by.
$userName = 'User'; // A name for the user to go by.

$message = "Hello there Mind, I'm User!";

print $userName . ' - ' . $message;

print '<br>';

$reply = api($mindName, $userName, $message); // Send the message and save the reply

print $reply['mind'] . ' - ' . $reply['message'];

print '<br>';

/*--------------------------------------------------------//
     And if we want to erase the mind and start again:
//--------------------------------------------------------*/

if(nuke() === "success"){
  print 'Mind nuked.';
}

?>