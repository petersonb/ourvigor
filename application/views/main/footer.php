<?php if ($this->session->userdata('facebook_id')): ?>
    <a href="<?php echo base_url('fb/link_account'); ?>"><img alt="Your account is linked to a Facebook account" style="height: 25px; background: #fff; float:right;" src="<?php echo base_url('images/facebook_icon.png'); ?>" /></a>
<?php else: ?>
    <a alt="Link your accont!" href="<?php echo base_url('fb/link_account'); ?>"><img style="height: 25px; background: #fff; float:right;" src="<?php echo base_url('images/facebook_icon_bw.png'); ?>" /></a>
<?php endif; ?>
