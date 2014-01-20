<?php echo form_open('users/find'); ?>
<?php
$this->table->add_row('Search', form_input('search'), form_submit('submit','Search'));
echo $this->table->generate();
?>
</form>
