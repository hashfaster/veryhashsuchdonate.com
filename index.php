<?php
// Global variables
require("config.php");
$QUERY_BALANCE = "http://chain.so/api/v2/get_address_balance/DOGE/$ADDRESS";
$QUERY_POOL = "http://doge.hashfaster.com/index.php?";

// Get the balance of the donation address    
$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);
$soChainResponse = file_get_contents($QUERY_BALANCE, false, $context);

// Parse the balance
$soChainJson = json_decode($soChainResponse, true);

$addressBalance = $soChainJson["data"]["confirmed_balance"];

// Get the worked stats
$hashrate_data = array("page" => "api", "action" => "getuserhashrate", "api_key" => $API_KEY, "id" => $API_ID);
$workers_data = array("page" => "api", "action" => "getuserworkers", "api_key" => $API_KEY, "id" => $API_ID);

$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);

$hashrate_data = json_decode(file_get_contents($QUERY_POOL . http_build_query($hashrate_data), false, $context), true);
$hashrate = $hashrate_data["getuserhashrate"]["data"];

$workers_data = json_decode(file_get_contents($QUERY_POOL . http_build_query($workers_data), false, $context), true);
$workers = count($workers_data["getuserworkers"]["data"])
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Very Hash Such Donate</title>
        
        <meta charset="utf-8">
        <meta name="description" content="Dogecoin is an open source peer-to-peer digital currency, favored by Shiba Inus worldwide.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- HTML5 Shiv -->
        <!--[if lt IE 9]>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
        <![endif]-->
        
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700%7COswald' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/very.css" rel="stylesheet">
    </head>
    <body>
        <div class="header center">
            <div class="container">
                <h1 class="title dogefont">Very Hash Such Donate</h1>
                <h4 class="title-desc">Very Hash Such Donate is a new way to donate to the furthering of Dogecoin via donating for worthy causes, from community driven fund raisers, to bountys for Dogecoin developers to intergrate new features.</h4>
                <br />
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="well">
                            <div class="row" id="main-stats">
                                <div class="col-xs-6">
                                    <h3>Total Dogecoin Donated:</h3>
                                    <h4 id="totalDonated"><?php echo number_format($addressBalance, 0); ?></h4>
                                </div>
                                <div class="col-xs-6">
                                    <h3>Current Fundraiser:</h3>
                                    <h4 id="currentFundraiser"><?php echo $NAME; ?></h4>
                                </div>
                            </div><!-- end main stats -->
                            <div class="row" id="other-stats">
                                <div class="col-xs-4 col-xs-offset-2">
                                    <h4>Total workers:</h4>
                                    <h4 id="totalWorkers"><?php echo $workers; ?></h4>
                                </div>
                                <div class="col-xs-4">
                                    <h4>Hashrate:</h4>
                                    <h4 id="hashrate"><?php echo number_format(($hashrate / 1000), 2) . " MH/s"; ?></h4>
                                </div>
                            </div><!-- end other stats -->
                        </div><!-- end well -->
                    </div><!-- end well container -->
                </div><!-- end outer row -->
            </div><!-- end container -->
        </div><!-- End header -->
        
        <div class="divider"></div>
        
        <div class="howto">
            <div class="padheader">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-4 center">
                            <!-- put an image here -->
                            <img src="dogecoin.png" width="80%" class="logo" />
                        </div>
                        <div class="col-xs-8">
                            <h1 class="dogefont">How To Help</h1>
                            <h4>Simply donate your scrypt hashrate by using the following stratum address and worker:</h4>
                            <pre>stratum+tcp://muchthanks.veryhashsuchdonate.com:3339<br />workername: themoon.donate<br />password: anything</pre>
                            <h4>Cgminer example:</h4>
                            <pre>./cgminer --scrypt -o stratum+tcp://muchthanks.veryhashsuchdonate.com:3339 -u themoon.donate -p x</pre>
                            <h4>Your hashing power gets translated directly into Dogecoin, and paid to the current fundraiser wallet of: <?php echo "<a href=\"https://chain.so/address/DOGE/$ADDRESS\" target=\"_blank\">$ADDRESS</a>" ?></h4>
                        </div>
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end padheader -->
        </div><!-- end howto -->
        
        <div class="padheader">
            <div class="container">
                <h1 class="dogefont">About</h1>
                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis erat nec eros dictum, vel lobortis ante posuere. Integer pretium quam adipiscing est blandit, vel iaculis tortor dignissim. Praesent vel ultrices nibh, bibendum convallis risus. In quam dolor, consequat sed arcu quis, malesuada tempor neque. Nam elementum est non ultricies faucibus. Vivamus molestie luctus iaculis. Curabitur et leo orci. Phasellus volutpat nibh ante, sed tincidunt sem gravida quis. Ut congue, ligula a varius posuere, tellus felis tincidunt augue, eget lacinia est felis vitae diam. Pellentesque rhoncus, libero sed vulputate semper, libero felis euismod sapien, nec lobortis nibh elit sit amet arcu. Donec non malesuada lectus. Morbi condimentum risus nisi, vel consectetur leo sollicitudin quis. In a laoreet nisl, sed suscipit ipsum. Sed orci magna, dictum sed neque vitae, elementum rutrum lectus.</h4>
                
                <hr />
                <div class="row right">
                    <p>Designed by <a href="http://butzow.me" target="_blank">Ben Butzow</a></p>
                </div>
            </div>
        </div>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>