<html>
<body>
<textarea id="chat" style="width:500;height:250;" readonly></textarea><br>
<input type="text" placeholder="name">
<textarea id="message" style="width:275;" placeholder="message"></textarea>
<button type="button">Send</button>
</body>
<script type="text/javascript">

/*----- Set Mashape application key and mind info here -----*/
/*-----  Be careful! Mashape key can be read on page!  -----*/
/*----- Don't use this example as-is out in the wild!  -----*/

  var mashapeKey = '';
  var mind-id = 'Mind1';
  var mind-name = 'Mind';

  var button = document.querySelector('button');
  var nme = document.querySelector('input');
  var msg = document.querySelector('#message');
  var chat = document.querySelector('#chat');
  
  button.addEventListener('click', function(){
    chat.innerHTML += nme.value + ' - ' + msg.value + '\n';
    var message = msg.value;
    msg.value = '';
    var x = new XMLHttpRequest();
    var url = 'https://mind.p.mashape.com';
    url += '/' + encodeURI(mind-id);
    url += '/' + encodeURI(mind-name);
    url += '/' + encodeURI(nme.value);
    url += '/' + encodeURI(message);
    x.open('GET', url);
    x.setRequestHeader('X-Mashape-Key', mashapeKey);
    x.onreadystatechange = function(){
      if(x.readyState == 4){
        chat.innerHTML += mind + ' - ' + JSON.parse(x.responseText)['message'] + '\n';
      }
    }
    x.send();
  }, false);

</script>
</html>