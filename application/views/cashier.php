<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cashier Screen</title>
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
      height:100%;
      background-color: green;
      display: flex;
      flex-direction: column;
    }

    .cashier{
      width: 100%;
      /* height: auto; */
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
        <div class="button">
        <button type="button" onclick="return prevNo('cashier1','Cashier 1')">Previous</button>
        <button type="button" onclick="return nextNo('cashier1','Cashier 1')">Next</button>
        </div>
        
      </div>
      <div class="cashier" id="cashier2">
      <span style="font-size:100px" id="cashier2No">1</span>
        <span style="font-size:75px" id="cashier2Lbl">Cashier 2</span>
        <div class="button">
        <button type="button" onclick="return prevNo('cashier2','Cashier 2')">Previous</button>
        <button type="button" onclick="return nextNo('cashier2','Cashier 2')">Next</button>
        </div>
      </div>
      <div class="cashier" id="cashier3">
      <span style="font-size:100px" id="cashier3No">1</span>
        <span style="font-size:75px" id="cashier3Lbl">Cashier 3</span>
        <div class="button">
        <button type="button" onclick="return prevNo('cashier3','Cashier 3')">Previous</button>
        <button type="button" onclick="return nextNo('cashier3','Cashier 3')">Next</button>
        </div>
      </div>
    </div>
  </div>
  
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?php echo base_url('node_modules/socket.io-client/dist/socket.io.js');?>"></script>
<script>
  let cashierCount = {
    'cashier1' : 1,
    'cashier2' : 1,
    'cashier3' : 1
  }

  // initialization
  document.getElementById('cashier1No').innerHTML = 1;
  document.getElementById('cashier2No').innerHTML = 1;
  document.getElementById('cashier3No').innerHTML = 1;

  const nextNo = (id,cashierName) => {
    cashierCount[id] = cashierCount[id] + 1;
    document.getElementById(id+ "No").innerHTML = cashierCount[id];
    document.getElementById('mainNo').innerHTML = cashierCount[id];
    document.getElementById('mainLbl').innerHTML = cashierName;
    

    var socket = io.connect( 'http://'+window.location.hostname+':3000' );
    socket.emit('changeCount', {
      id: id,
      name: cashierName,
      value: cashierCount[id]
    });
  };

  const prevNo = (id,cashierName, ctr) => {
    cashierCount[id] = cashierCount[id] - 1;
    if (cashierCount[id] == 0){
      cashierCount[id] = 1;
    }
    document.getElementById(id+ "No").innerHTML = cashierCount[id];
    document.getElementById('mainNo').innerHTML = cashierCount[id];
    document.getElementById('mainLbl').innerHTML = cashierName;
    

    var socket = io.connect( 'http://'+window.location.hostname+':3000' );
    socket.emit('changeCount', {
      id: id,
      name: cashierName,
      value: cashierCount[id]
    });
  };
</script>
</html>