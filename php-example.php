<?php

/*--------------------------------------------------------//
            Enter your mashape application key.
   Mashape accounts and keys are free, though you can pay 
   for pro packages with more included API if you need to.
//--------------------------------------------------------*/

$mashapeKey = 'ExampleLotsOfRandomChars856HKDSwwqe54v';

/*--------------------------------------------------------//
      We'll make a functions called api() for talking 
       to our mind, and nuke() for wiping the mind.
            Becareful about using nuke though!
//--------------------------------------------------------*/

function api($mindID,$mindName, $userName, $message){
  global $mashapeKey;
  $api = 'https://mind.p.mashape.com/';
  //  use rawurlencode() over urlencode() to encode spaces as %20 rather than +
  $api .= '/' . rawurlencode($mindID);  
  $api .= '/' . rawurlencode($mindName); 
  $api .= '/' . rawurlencode($userName); 
  $api .= '/' . rawurlencode($message);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $api);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Mashape-Key: ' . $mashapeKey));
  $response = curl_exec($ch);
  curl_close($ch);
  return json_decode($response, true);
}

function nuke($mindID){
  global $mashapeKey;
  $api = 'https://mind.p.mashape.com/';
  $mindID + '/nuke';
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
$mindID = 'Mind1';
$mindName = 'Mind'; // A name for the bot to go by.
$userName = 'User'; // A name for the user to go by.

$message = "Hello there Mind, I'm User!";

print $userName . ' - ' . $message;

print '<br>';

$reply = api($mindID, $mindName, $userName, $message); // Send the message and save the reply

print $reply['mind'] . ' - ' . $reply['message'];

print '<br>';

/*--------------------------------------------------------//
     And if we want to erase the mind and start again:
//--------------------------------------------------------*/

if(nuke($mindID) === "success"){
  print 'Mind nuked.';
}

?>