<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/toc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}

function PlayVideo(part) {
	window.location = "player.php?video=" + part;
} 
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body onload="MM_CheckFlashVersion('8,0,0,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');">
<table cellpadding="0" cellspacing="0" border="0">
<tr><td>
<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','320','height','240','id','FLVPlayer','src','FLVPlayer_Progressive','flashvars','&MM_ComponentVersion=1&skinName=Corona_Skin_3&streamName=flash/<?echo $_GET['video'];?>&autoPlay=true&autoRewind=false','quality','high','scale','noscale','name','FLVPlayer','salign','lt','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','FLVPlayer_Progressive' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="320" height="240" id="FLVPlayer">
  <param name="movie" value="flash/interview.swf?file=<?echo $_GET['video'];?>.flv" />
  <param name="salign" value="lt" />
  <param name="quality" value="high" />
  <param name="scale" value="noscale" />
  <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Corona_Skin_3&streamName=flash/<?echo $_GET['video'];?>&autoPlay=true&autoRewind=false" />
  <embed src="flash/interview.swf?file=<?echo $_GET['video'];?>.flv" flashvars="&MM_ComponentVersion=1&skinName=Corona_Skin_3&streamName=flash/<?echo $_GET['video'];?>&autoPlay=true&autoRewind=false" quality="high" scale="noscale" width="320" height="240" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object></noscript>
</td>
<td bgcolor="black" class="vdnormal" valign="top">
  <div align="left" style="padding:5px">
  <br /><br />
  <? if ($_GET['video'] == 'toc1'){ ?><strong>Ride On Center for Kids (3:45)</strong> 
  <? }else{ ?> <a class="vdlink" href="javascript:PlayVideo('toc1')">Ride On Center for Kids (3:45)</a> 
  <? } ?>
  
  <? if ($_GET['video'] == 'toc2'){ ?><br /><strong>People's Community Clinic (1:43)</strong>
  <? }else{ ?> <br /><a class="vdlink" href="javascript:PlayVideo('toc2');">People's Community Clinic (1:43)</a> 
  <? } ?>
  
  <? if ($_GET['video'] == 'toc3'){ ?><br /><strong>Connections (2:55)</strong>
  <? }else{ ?> <br /><a class="vdlink" href="javascript:PlayVideo('toc3');">Connections (2:55)</a>
  <? } ?>
  
  <? if ($_GET['video'] == 'toc4'){ ?><br /><strong>Any Baby Can (3:34)</strong>
  <? }else{ ?> <br /><a class="vdlink" href="javascript:PlayVideo('toc4');">Any Baby Can (3:34)</a>  
  <? } ?>

  </div>
</td></tr>
</table>
</body>
</html>
