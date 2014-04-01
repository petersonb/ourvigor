<?php if ($this->session->userdata('facebook_id')): ?>
    <img style="height: 25px; background: #fff; float:right;" src="<?php echo base_url('images/facebook_icon.png'); ?>" />
<?php else: ?>
    <a href="<?php echo base_url('fb/link_account'); ?>"><img style="height: 25px; background: #fff; float:right;" src="<?php echo base_url('images/facebook_icon_bw.png'); ?>" /></a>
<?php endif; ?>
