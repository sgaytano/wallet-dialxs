<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Payment Gateway</title>
      <link rel="stylesheet" href="css/style.css">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>

<body>
 <div class="container">
    <div class="row">
        <div class="ssl-container col-xs-12 col-sm-4 col-lg-2">
            <span class="ssl glyphicon glyphicon-lock"></span>
            <span class="ssl-text" style="font-size:18px;">                
                Wallet v1.0
            </span>        
            <div class="clearfix"></div>
        </div>
        
        <div class="col-xs-12 col-sm-8 col-lg-9">
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
                    <div class="step <?php echo $step2; ?>">
                            <span class="glyphicon glyphicon-euro"></span> 
                            Pay
                            <div class="hidden-xs caret right"></div>
                        <div class="visible-xs caret bottom"></div>
                    </div>
                </div> 
                
                <div class="col-xs-12 col-sm-4">
                    <div class="step <?php echo $step3; ?>">
                            <span class="glyphicon glyphicon-ok"></span> 
                            Done
                    </div>
                </div>                             


            </div>            
        </div>

		<div class="panel panel-default col-xs-11" style="height:100%; padding-bottom:50px;">
			
			<br/>
			
			<?php echo $this->getContent(); ?>
			
		</div>

      
        
           
    </div>
</div>


	

    
  </body>
</html>
