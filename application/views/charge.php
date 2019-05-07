<!DOCTYPE html>
<html lang="en">
    <head>
            <title>Charge</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <style>
                #response_div {
                    margin: auto;
                    padding: 10px;
                }
                #response_div button {
                    margin-top: 20px;
                }
            </style>
    </head>
    <body>
        <div id="response_div">
            
            <?php if(!empty($error)): ?>
                <label><?=$error;?></label><br/>          
            <?php elseif($file_name): ?>
                <label>Payment was successful</label><br/>  
            <?php endif; ?>
            <button type="button" onclick="location.href='/payment'">Return</button>
        </div>
    </body>
</html>