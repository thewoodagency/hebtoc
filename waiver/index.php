<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Autocomplete with Dynamic Data Load using PHP Ajax</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
	<style>
	.typeahead { border: 2px solid #FFF;border-radius: 4px;padding: 8px 12px;max-width: 300px;min-width: 290px;background: yellow;color: #000;}
	.tt-menu { width:300px; }
	ul.typeahead{margin:0px;padding:10px 0px;}
	ul.typeahead.dropdown-menu li a {padding: 10px !important;	border-bottom:#CCC 1px solid;color:#000;}
	ul.typeahead.dropdown-menu li:last-child a { border-bottom:0px !important; }
	.demo-label {font-size:1.5em;color: #686868;font-weight: 500;color:#FFF;}
	.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
		text-decoration: none;
		outline: 0;
	}
	</style>	
</head>
<body>
	<div class="bgcolor">
        <input type="text" name="passcode" id="passcode" class="typeahead" placeholder="Your passcode" autofocus/>
        <br>
		<input type="text" name="companyName" id="companyName" class="typeahead" placeholder="Company Name" autofocus/>
        <br>
        <input type="submit"
	</div>
</body>
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
    });

    $("#wname").click(() => {
        alert($("#companyName").val());
    });
</script>
</html>