<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="form-group"> 
	<select name="collection" class="form-control minput custom-select col-md-3 pull-right" required>
		<?php $collections = get_my_collection();  ?>
		<?php if (count($collections) == ''): ?>
			<option>You haven't create any collection</option>
		<?php else: ?>
			<?php foreach ($collections as $col): ?>
	    		<option value="<?php echo $col->id ?>"><?php echo $col->title ?></option>
	    	<?php endforeach ?>
		<?php endif ?>
    	
    </select>
</div>