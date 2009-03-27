<?php
// www.Texastar.com - can't take credit for the javascript, but including it
// in osCommerce is my fault.     
function tex_preLoadImages() {
  echo '   <script' . "\n";
  echo '     language="JavaScript"' . "\n";
  echo '     type="text/javascript">' . "\n";
  echo '    //<![CDATA[' . "\n";
  echo '      function MM_swapImgRestore() { //v3.0' . "\n";
  echo '        var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;' . "\n";
  echo '      }' . "\n";
  echo '      ' . "\n";
  echo '      function MM_preloadImages() { //v3.0' . "\n";
  echo '        var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();' . "\n";
  echo '          var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)' . "\n";
  echo '          if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}' . "\n";
  echo '      }' . "\n";
  echo '      ' . "\n";
  echo '      function MM_swapImage() { //v3.0' . "\n";
  echo '        var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)' . "\n";
  echo '         if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}' . "\n";
  echo '      }' . "\n";
  echo '      ' . "\n";
  echo '      function MM_findObj(n, d) { //v4.01' . "\n";
  echo '        var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {' . "\n";
  echo '          d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}' . "\n";
  echo '        if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];' . "\n";
  echo '        for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);' . "\n";
  echo '        if(!x && d.getElementById) x=d.getElementById(n); return x;' . "\n";
  echo '      }' . "\n";
  echo '      ' . "\n";
  echo '      function MM_reloadPage(init) {  //reloads the window if Nav4 resized' . "\n";
  echo '        if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {' . "\n";
  echo '          document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}' . "\n";
  echo '        else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) history.go(0);' . "\n";
  echo '      }' . "\n";
  echo '      ' . "\n";
  echo '      MM_reloadPage(true);' . "\n";
  echo '    //]]>' . "\n";
  echo '    </script>' . "\n";
	echo '' . "\n";
	}
	
function tex_popupWindow() {
  echo '   <script' . "\n";
  echo '     language="JavaScript"' . "\n";
  echo '     type="text/javascript">' . "\n";
  echo '    //<![CDATA[' . "\n";
  echo '      ' . "\n";
  echo "      function popupWindow(url) {" . "\n";
  echo "        window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')" . "\n";
  echo "      }	" . "\n";
  echo '      ' . "\n";
  echo "      function popupStdWindow(url) {" . "\n";
  echo "        window.open(url,'popupWindow','resizable=yes,copyhistory=no,width=640,height=480')" . "\n";
  echo "      }	" . "\n";
  echo '      ' . "\n";
  echo '    //]]>' . "\n";
  echo '    </script>' . "\n";
	echo '' . "\n";
	}
?>