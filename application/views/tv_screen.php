<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TV Screen</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      color:white;
    }
    .main {
      display: flex;
      flex-direction: row;
      background-color: red;
      height:100%
    }

    .currentNo {
      width: 100%;
      background-color: blue;
      justify-content: center;
      display: flex;
      flex-wrap: wrap;
      flex-direction: column;
      align-items: center;
    }

    .cashierDiv{
      width: 100%;
      background-color: green;
      display: flex;
      flex-direction: column;
    }

    .cashier{
      width: 100%;
      height: 400px;
      border: 2px solid white;
      display: flex;
      flex-wrap: wrap;
      flex-direction: column;
      align-items: center;
    }

    .button{
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      align-items: center;

    }

    button {
      font-size: 16px;
      font-weight: bold;
      color: #FFFFFF;
      background-color: #5995DA;
      border: none;
      border-radius: 3px;
      padding: 10px 40px;
      margin:10px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="main">
    <div class="currentNo">
      <span style="font-size:100px" id="mainNo">1</span>
      <span style="font-size:75px" id="mainLbl">Cashier 1</span>
    </div>
    <div class="cashierDiv">
      <div class="cashier" id="cashier1">
        <span style="font-size:100px" id="cashier1No">1</span>
        <span style="font-size:75px" id="cashier1Lbl">Cashier 1</span>
       
        
      </div>
      <div class="cashier" id="cashier2">
      <span style="font-size:100px" id="cashier2No">1</span>
        <span style="font-size:75px" id="cashier2Lbl">Cashier 2</span>
       
      </div>
      <div class="cashier" id="cashier3">
      <span style="font-size:100px" id="cashier3No">1</span>
        <span style="font-size:75px" id="cashier3Lbl">Cashier 3</span>
       
      </div>
    </div>
  </div>

  <audio controls hidden id="audio">
  <source src="<?php echo base_url('file.mp3'); ?>" type="audio/mpeg">
  Your browser does not support the audio tag.
</audio>
  
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?php echo base_url('node_modules/socket.io-client/dist/socket.io.js');?>"></script>

<script>
  var synth = window.speechSynthesis;

  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
  socket.on( 'changeCount', function( data ) {
    PlayAudio();
    document.getElementById('mainNo').innerHTML = data.value; 
    document.getElementById('mainLbl').innerHTML = data.name; 
    document.getElementById(data.id + "No").innerHTML = data.value; 

    setTimeout(function(e){
      speakFunc('Customer Number '+ data.value +', Please proceed to '+ data.name + '. Next Number, '+ (data.value + 1) +'.');
      }, 1000)
  });

  let speakFunc = (word) => {
      var utterThis = new SpeechSynthesisUtterance(word);
      utterThis.voice = synth.getVoices()[0];
      synth.speak(utterThis);
  }

  let PlayAudio = () =>{
    var audioElement = document.getElementById('audio');
    audioElement.load();
	  audioElement.play();
  }
</script>
</html>