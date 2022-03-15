<?php
   if ($ErrorMsn != "") {
   ?>
      <div id="error">
         <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
         <div id="errormsn">
          <?php echo $ErrorMsn; ?>
         </div>
      </div>
   <?php
   }
?>