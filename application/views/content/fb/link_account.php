<h1>Link OurVigor to Facebook</h1>

<p>Clicking the link below will allow you to link your OurVigor account with your Facebook account.</p>
<p>At this time, the only thing a linked account does is turn the little Facebook icon blue in the bottom corner of the page. However, eventually you will be able to do things such as publish your exercises, invite friends to OurVigor, boast about your personal progress, and exclaim to the internet through social media every time you meet your goals!</p>

<?php if (!$linked): ?>
    <h3 ><a style="color: #00f" href="<?php echo $link; ?>">Link My Account!</a></h3>
<?php else: ?>
    <h3>Your account has been linked to Facebook.</h3>
    <h3 ><a style="color: #00f" href="<?php echo $link; ?>">Unlink My Account</a></h3>
<?php endif; ?>
