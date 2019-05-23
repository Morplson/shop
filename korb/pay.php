    <?
        require_once( "cryptobox.class.php" );

        $orderID    =  "your_product1_or_signuppage1_etc";
        $userID     = "";
        $def_language   = "en"; // default payment box language; en - English, es - Spanish, fr - French, etc

        // Remove all the characters from the string other than a..Z0..9_-@. 
        $orderID = preg_replace('/[^A-Za-z0-9\.\_\-\@]/', '', $orderID);
        $userID = preg_replace('/[^A-Za-z0-9\.\_\-\@]/', '', $userID);

        $options = array( 
            "public_key"  => "",         // place your public key from gourl.io
            "private_key" => "",         // place your private key from gourl.io
            "webdev_key"  => "",        // optional, gourl affiliate program key
            "orderID"     => $orderID,   // few your users can have the same orderID but combination 'orderID'+'userID' should be unique
            "userID"      => $userID,   // optional; place your registered user id here (user1, user2, etc)
                    // for example, on premium page you can use for all visitors: orderID="premium" and userID="" (empty) 
                    // when userID value is empty - system will autogenerate unique identifier for every user and save it in cookies 
            "userFormat"  => "COOKIE",   // save your user identifier userID in cookies. Available: COOKIE, SESSION, IPADDRESS, MANUAL
            "amount"      => 0,         // amount in cryptocurrency or in USD below
            "amountUSD"   => 2,         // price is 2 USD; it will convert to cryptocoins amount, using Live Exchange Rates
                                        // For convert fiat currencies Euro/GBP/etc. to USD, use function convert_currency_live()
            "period"      => "24 HOUR",  // payment valid period, after 1 day user need to pay again
            "iframeID"    => "",         // optional; when iframeID value is empty - system will autogenerate iframe html payment box id
            "language"    => $def_language // text on EN - english, FR - french, please contact us and we can add your language
            );  

        // Initialise Bitcoin Payment Class 
        $box = new Cryptobox ($options);

        // Display payment box with custom width = 560 px and big qr code / or successful result
        $payment_box = $box->display_cryptobox(true, 560, 230, "border-radius:15px;border:1px solid #eee;padding:3px 6px;margin:10px;",
                        "display:inline-block;max-width:580px;padding:15px 20px;border:1px solid #eee;margin:7px;line-height:25px;"); 

        // Language selection list for payment box (html code)
        $languages_list = display_language_box($def_language);

        // Log
        $message = "";
        
        // A. Process Received Payment
        if ($box->is_paid()) 
        {
            $message .= "A. User will see this message during 24 hours after payment has been made!";
            
            $message .= "<br>".$box1->amount_paid()." ".$box1->coin_label()."  received<br>";
            
            // Your code here to handle a successful cryptocoin payment/captcha verification
            // For example, give user 24 hour access to your member pages
            // ...
        
            // Please use IPN (instant payment notification) function cryptobox_new_payment() for update db records, etc
            // Function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") called every time 
            // when a new payment from any user is received.
            // IPN description: https://gourl.io/api-php.html#ipn 
        }  
        else $message .= "The payment has not been made yet";

        
        // B. Optional - One-time Process Received Payment
        if ($box1->is_paid() && !$box1->is_processed()) 
        {
            $message .= "B. User will see this message one time after payment has been made!";  
        
            // Your code here - user see successful payment result
            // ...

            // Also you can use $box1->is_confirmed() - return true if payment confirmed 
            // Average transaction confirmation time - 10-20min for 6 confirmations  
            
            // Set Payment Status to Processed
            $box1->set_status_processed(); 
            
            // Optional, cryptobox_reset() will delete cookies/sessions with userID and 
            // new cryptobox with new payment amount will be show after page reload.
            // Cryptobox will recognize user as a new one with new generated userID
            // $box1->cryptobox_reset(); 


            // ...
            // Also you can use IPN function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") 
            // for send confirmation email, update database, update user membership, etc.
            // You need to modify file - cryptobox.newpayment.php, read more - https://gourl.io/api-php.html#ipn
            // ...

        }
    }
    ?>
    <!DOCTYPE html><html><head>
    <meta http-equiv='cache-control' content='no-cache'>
    <script src='cryptobox.min.js' type='text/javascript'></script>
    </head><body>

    <div style='margin:30px 0 5px 480px'>Language: &#160; <?= $languages_list ?></div>
    <?= $payment_box ?>
    <?= $message ?>

    </body>
    </html>
