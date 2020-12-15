<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('.../../lib/config.inc.php');
require ('.../../lib/functions.php');
$message = '';
if(isset($_GET['e'])) {
    $message = 'Your information is not correct. Please try again';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
<title>Form</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
<link href="../lib/formCss.css?3.1.26" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../lib/nova.css?3.1.26" />
<link type="text/css" media="print" rel="stylesheet" href="../lib/printForm.css?3.1.26" />
<style type="text/css">
    .form-label{
        width:150px !important;
    }
    .form-label-left{
        width:150px !important;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:150px !important;
    }
    body, html{
        margin:0;
        padding:0;
        background:false;
    }

    .form-all{
        margin:0px auto;
		margin-top: 50px;
        padding-top:20px;
        width:690px;
        font-family:'Verdana';
        font-size:12px;
    }
	#level {
		font-size: 16px;
	}
	#logo {
		text-align:center;
		padding-bottom: 20px;
	}
	#error {
		padding-bottom: 20px;
		color: #F00;
		font-size: 12px;
		text-align: center;
	}
</style>

<script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
</head>
<body>
<form class="jotform-form" action="charity_waiver_proc.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <div class="form-all"><div id="logo"><a href="/"><img src="../images/tocweblogo.gif" width="332" height="197" border="0"></a></div>
      <h3 style="font-size: 18px;font-weight: bold">Waiver - TOURNAMENT OF CHAMPIONS CHARITY WORK PROJECT</h3>
      <p>Please type the first letter of your company name and pick the company name. If you don't find your company name, your company has not been registered.
      </p>
      <ul class="form-section">
     
      <li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="input_1">
          Company Name<span class="form-required">*</span>
        </label>
        <div id="cid_1" class="form-input">
          <input type="text" placeholder="Type and find your company name" class=" form-textbox validate[required, Email]" data-type="input-textbox" id="companyName" name="companyName" size="55" value="" />
        </div>
      </li>
     
      <li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="input_1">
          Password<span class="form-required">*</span>
        </label>
        <div id="cid_1" class="form-input">
          <input type="password" class=" form-textbox validate[required]" data-type="input-textbox" id="password" name="password" size="20" value="" />
        </div>
      </li>
     
      <li class="form-line" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
            <button id="input_2" type="submit" class="form-submit-button">
              Submit
            </button>
          </div>
        </div>
      </li>
      <li style="display:none">
        Should be Empty:
        <input type="text" name="website" value="" />
      </li>
    </ul>
    <div id="error"><? echo $message ?></div>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

</form></body>
<script>
    $(document).ready(function () {
        $('#companyName').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
        JotForm.init(function(){

        });
    });

</script>
</html>