<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */
?> 

<div class="col-sm-12">
	<h3>Edit ImportLog Status - <?=$importObj->getString("filename")?></h3>
</div>

<? if ($message_importsettings) { ?>
	<div id="warning" class="alerty alert-warning"><?=$message_importsettings?></div>
<? } ?>

<div class="col-sm-3">
	<div class="form-group">		
			<label>
				Status:
			</label>		
		
			<?=$statusDropDownStatus?>		
	</div>
    <div class="form-group">		
			<label>
				Action:
			</label>		
        
			<?=$statusDropDownAction?>
		
	</div>
</div>

