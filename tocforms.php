<!doctype html>
 
<html lang="en">
<head>
<script language="JavaScript"
         type="text/javascript" src="lib/ajax.js"></script> 
<script language="JavaScript"
         type="text/javascript">
function makeactive(tab) { 
document.getElementById("tab1").className = ""; 
document.getElementById("tab2").className = ""; 
document.getElementById("tab3").className = "";
document.getElementById("tab"+tab).className = "active";
callAHAH('content.php?content= '+tab, 'content',
     'getting content for tab '+tab+'. Wait...', 'Error'); 
} 
</script>
<style>
pre {text-indent: 30px} 

#tabmenu { 
color: #000; 
border-bottom: 1px solid black; 
margin: 12px 0px 0px 0px; 
padding: 0px; 
z-index: 1; 
padding-left: 10px } 

#tabmenu li { 
display: inline; 
overflow: hidden; 
list-style-type: none; } 

#tabmenu a, a.active { 
color: #aaaaaa; 
background: #295229;
font: normal 1em verdana, Arial, sans-serif; 
border: 1px solid black; 
padding: 2px 5px 0px 5px; 
margin: 0px; 
text-decoration: none;
cursor:hand; } 

#tabmenu a.active { 
background: #ffffff; 
border-bottom: 3px solid #ffffff; } 

#tabmenu a:hover { 
color: #fff; 
background: #ADC09F; } 

#tabmenu a:visited { 
color: #E8E9BE; } 

#tabmenu a.active:hover { 
background: #ffffff; 
color: #DEDECF; } 

#content {font: 0.9em/1.3em verdana, sans-serif; 
text-align: justify; 
background: #ffffff; 
padding: 20px; 
border: 1px solid black; 
border-top: none; 
z-index: 2; } 

#content a { 
text-decoration: none; 
color: #E8E9BE; } 

#content a:hover { background: #aaaaaa; } 
</style>
<link href="lib/formCss.css?3.1.26" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="lib/nova.css?3.1.26" />
<link type="text/css" media="print" rel="stylesheet" href="lib/printForm.css?3.1.26" />
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
        padding-top:20px;
        width:690px;
        font-family:'Verdana';
        font-size:12px;
    }
	#level {
		font-size: 16px;
	}
</style>

<script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      $('input_10_confirm').hint('Confirm Email');
      $('input_10').hint('ex: myname@example.com');
   });
</script>
</head>
<body>
<ul id="tabmenu" > 
<li onclick="makeactive(1)"><a class=""
      id="tab1">First Page</a></li> 
<li onclick="makeactive(2)"><a class=""
      id="tab2">Second Page</a></li> 
<li onclick="makeactive(3)"><a class=""
      id="tab3">Third Page</a></li> 
</ul> 
<div id="content"></div>
</body>
</html>