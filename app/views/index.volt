<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Payment Gateway</title>
      <link rel="stylesheet" href="https://wallet.audiotex.nl/css/style.css">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>

<body style="margin:auto;">
 <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-lg-2">
           
            <?php if(isset($step1) && isset($step2) && isset($step3)){ ?>
            <!--
            <span class="ssl glyphicon glyphicon-lock"></span>
            <span class="ssl-text" style="font-size:18px;">      
                Wallet v1.0
            </span -->
            <span><img src="img/logo-audiotex1.png" width="200" height="50"></span>
            <?php } else { ?>
            <span class="ssl-text" style="font-size:18px;"> 
            	Wallet Admin v1.0
            </span>
            <?php } ?>
            
            <div class="clearfix"></div>
        </div>
        
        
        <?php if(isset($step1) && isset($step2) && isset($step3)){ ?>
        
        <div class="col-xs-12 col-sm-8 col-lg-9" style="padding-left:50px;">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                
                    <div class="step <?php echo $step1; ?>">
                        <span class="glyphicon glyphicon-check"></span> 
                       	Mode of Payment
                        <div class="hidden-xs caret right"></div>
                        <div class="visible-xs caret bottom"></div>
                    </div>          
                </div>
        
                <div class="col-xs-12 col-sm-4">
                    <div id="step2" class="step <?php echo $step2; ?>">
                            <span class="glyphicon glyphicon-euro"></span> 
                            Pay
                            <div class="hidden-xs caret right"></div>
                        <div class="visible-xs caret bottom"></div>
                    </div>
                </div> 
                
                <div class="col-xs-12 col-sm-4">
                    <div id="step3" class="step <?php echo $step3; ?>">
                            <span id="step3_span" class="glyphicon glyphicon-ok"></span>
                            <label id="step3_label">Done</label>
                    </div>
                </div>                             


            </div>            
        </div>
		
		<?php } ?>
		
		
		<div class="panel panel-default col-xs-11" style="min-height:600px; padding-bottom:50px;">
			
			<br/>
			
			<?php if($disablecontent!=true){ echo $this->getContent(); }else{ ?>
			
				<div style="text-align: center; padding-top: 200px;">
					<label style="font-size: 18px; color:red;"><span class="glyphicon glyphicon-alert"></span>   Sorry, were unable to process your request. Please check your API Key,</label>
					<br/>
					<label style="font-size: 18px; color:red;">and try again</label>
				</div>
	
			<?php } ?>
			
		</div>

      
        
           
    </div>
</div>


	

    
  </body>
</html>
