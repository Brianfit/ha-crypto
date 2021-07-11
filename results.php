<html>
<head>
<link href="//fonts.googleapis.com/css?family=Bubbler One&subset=latin" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A yaml code generator to create a Home Assistant sensor which will display your profit or loss on any crypto coin.">
    <meta name="author" content="Brian Fitzgerald">
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap4/css/bootstrap.min.css" rel="stylesheet">
<!--     <script src="coingeckolist.js"></script> -->
    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }

/* Modify the backgorund color */
.navbar-custom {
    background-color: #BD5FFF;
}

</style>

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-custom">
      <div class="container">
        <a class="navbar-brand" href="http://brian-fitzgerald.net">Open Source. Coffee Fueled.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
<!-- 
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
 -->
            <li class="nav-item">
              <a class="nav-link" href="https://www.buymeacoffee.com/brianfit">Say Thanks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" mailto="brianfit58@gmail.com">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">

<?php $amount = $_POST["howmany"]; $fiat = $_POST["whichcurrency"]; ?>
<br/>
<br/>
<div style='width:75%'>
<p style="font-family: 'Bubbler One', sans-serif;">You bought <?php echo $_POST["howmany"]; ?> <?php echo $_POST["coinname"]; ?> at a price of <?php $price = $_POST["whatprice"]; if (strpos('.',$price) == 0){ $price = '0'+$price;} echo $price ?> <?php echo $_POST["whichcurrency"]; ?> per coin. So you spent <?php $buy = ($price * $amount); echo $buy+' '+$fiat; ?><br/>

<bold>Here is the code for your HomeAssistant configuration.yaml.</bold> If you already have a sensor: block, don't copy the sensor: line here. Just nest the two platform statements into your existing sensor: block.

</p>
</div> 
</div>
</div>
<hr/>
<pre>
sensor:
  - platform: rest
    name: '<?php $hyphenated = $_POST["coinname"]; $trans = array("-" => ""); echo strtr($hyphenated, $trans); ?>_rate'
    value_template: "{{ value_json['<?php echo $_POST["coinname"]; ?>'].<?php echo strtolower($_POST["whichcurrency"]); ?> }}"
    unit_of_measurement: '<?php echo $_POST["whichcurrency"]; ?>' 
    resource: https://api.coingecko.com/api/v3/simple/price?ids=<?php echo $_POST["coinname"]; ?>&vs_currencies=<?php echo strtolower($_POST["whichcurrency"]); ?>


  - platform: template
    sensors:
      <?php $hyphenated = $_POST["coinname"]; $trans = array("-" => ""); echo strtr($hyphenated, $trans); ?>:
        friendly_name: 'Profit (loss) on <?php $camel = ucwords($_POST["coinname"],"-"); $trans = array("-" => " "); echo strtr($camel, $trans); ?>'
        unit_of_measurement: '<?php echo $_POST["whichcurrency"]; ?>' 
        value_template: "{{((states.sensor.<?php $hyphenated = $_POST["coinname"]; $trans = array("-" => ""); echo strtr($hyphenated, $trans); ?>_rate.state| float * <?php echo $_POST["howmany"]; ?>) - (<?php echo $_POST["howmany"]; ?> * <?php $price = $_POST["whatprice"]; if (strpos('.',$price) == 0) {$price = '0'+$price; } echo $price ?>) )  | round(2) }}"    
</pre>
<hr/><br/>
<!-- What it's worth on the left, what you paid on the right.  -->
<div class="text-center">
<a href="https://www.buymeacoffee.com/brianfit"><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee &emoji=☕&slug=brianfit&button_colour=BD5FFF&font_colour=ffffff&font_family=Poppins&outline_colour=000000&coffee_colour=FFDD00"></a>
<div class="row">
<div class="col-lg-6 textcenter">
<img src="images/NoobSquawkEth.jpg" class="img-fluid"><br />
<p>Send me Eth: 0x8edf3acb240BA1C5DcBCF1EA2f1C69c7Ef01d9e6</p>
</div>
<div class="col-lg-6 textcenter">
<img src="images/BitcoinonCoinBase.jpg" class="img-fluid"><br/>
Send me Bitcoin: 18v5YucMaJLoDEACknqmGyjkUGHJkj8V8K <br/>
</div> <!-- column -->
</div> <!-- row -->
</div> <!-- text center -->

</div> <!-- container-->
</body>
</html>