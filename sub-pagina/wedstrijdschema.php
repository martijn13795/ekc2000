<?php include '../includes/html.php';?>
    <div class="container">
        <div>
            <iframe class="antilopen" border="0"frameborder="0" src="http://www.antilopen.nl/competitie/programma.asp?ci=54&clubstyle=EKC2000&kolomkoppen=true"></iframe>
        </div>
    </div>

<script language="JavaScript">
    <!--
    function autoResize(id){
        var newheight;
        var newwidth;

        if(document.getElementById){
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
    //-->
</script>

<IFRAME SRC="http://www.antilopen.nl/competitie/programma.asp?ci=54&clubstyle=EKC2000&kolomkoppen=true" width="100%" height="200px" id="iframe1" marginheight="0" frameborder="0" onLoad="autoResize('iframe1');"></iframe>