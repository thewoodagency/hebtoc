<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Form</title>
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
    .form-radio-item label, .form-checkbox-item label, .form-grading-label, .form-header{
        color:false;
    }

</style>

<script src="http://jotform.co/static/jotform.js?3.1.26" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init();
</script>
</head>
<body>
<form class="jotform-form" action="hotel_proc.php" method="post" name="form_32946254898168" id="32946254898168" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32946254898168" />
  <div class="form-all">
    <ul class="form-section">
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Sat 6/7
              </th>
              <th class="form-matrix-column-headers form-matrix-column_1">
                Sun 6/8
              </th>
              <th class="form-matrix-column-headers form-matrix-column_2">
                Mon 6/9
              </th>
              <th class="form-matrix-column-headers form-matrix-column_3">
                Tues 6/10
              </th>
              <th class="form-matrix-column-headers form-matrix-column_4">
                Wed 6/11
              </th>
              <th class="form-matrix-column-headers form-matrix-column_5">
                Thur 6/12
              </th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            <?php
			for ($i=0; $i<28; $i++)
			{
			echo '
            <tr>
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container"><input class="form-textbox" type="text" size="15" name="first'.$i.'" id="first'.$i.'" />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox" type="text" size="15" name="last'.$i.'" id="last'.$i.'" />
            <label class="form-sub-label" for="last_3" id="sublabel_last"> Last Name </label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <input class="form-radio" type="checkbox" name="room'.$i.'[]" value="1" />
              </td>
              <td align="center" class="form-matrix-values">
                <input class="form-radio" type="checkbox" name="room'.$i.'[]" value="2" />
              </td>
              <td align="center" class="form-matrix-values">
                <input class="form-radio" type="checkbox" name="room'.$i.'[]" value="3" />
              </td>
              <td align="center" class="form-matrix-values">
                <input class="form-radio" type="checkbox" name="room'.$i.'[]" value="4" />
              </td>
              <td align="center" class="form-matrix-values">
                <input class="form-radio" type="checkbox" name="room'.$i.'[]" value="5" />
              </td>
              <td align="center" class="form-matrix-values">
                <input class="form-radio" type="checkbox" name="room'.$i.'[]" value="6" />
              </td>
            </tr>';
            
			}
			?>
            <!-- entry loop end -->
            
          </table>
        </div>
      </li>
      <li class="form-line" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="text-align:left" class="form-buttons-wrapper">
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
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32946254898168" />
  <script type="text/javascript">
  document.getElementById("si" + "mple" + "_spc").value = "32946254898168-32946254898168";
  </script>
</form></body>
</html>