<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="form-group"> 
	<select name="collection" class="form-control minput custom-select col-md-3 pull-right">
		<?php $collections = get_my_collection();  ?>
    	<?php foreach ($collections as $col): ?>
    		<option value="<?php echo $col->id ?>"><?php echo $col->title ?></option>
    	<?php endforeach ?>
    </select>
</div>