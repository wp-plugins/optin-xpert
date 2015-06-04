<div class="optin-flyin-display email-subscribe" >
  <div class="flyin-optin-image">
      <a  id="menu-close-flyin" href="#" class="btn tx-optin-close flyin <?php echo $OPTIN_TIMER ?> pull-right">X</a>
    <?php if(empty($OPTIN_IMAGE)): ?>  
      <img src="<?php echo plugins_url('../../assets/image/flyer-icon_tx.svg', __FILE__ ) ?>"; ?>
    <?php else: ?>
     <img src="<?php echo $OPTIN_IMAGE ?>"; ?>
    <?php endif; ?>
  </div>

  <div class="flyin-optin-content">
    <?php if(empty($OPTIN_DATA)): ?> 
      <h2>Subscribe With Us</h2>
      <p>Join our mailing list to receive the latest news and updates.</p>
    <?php else: ?>
      <?php echo $OPTIN_DATA; ?>
    <?php endif; ?> 
  </div>

  <div class="flyin-optin-mail">
    <form method="post" id="tx-optin-form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div id = "optin-email-subcribe" class="form-group">
        <input  type="email" name="optin_mail" value="" class="form-control" id="optin_mail" placeholder="Enter email" required>
      </div>
      <button id="optin-email-button" type="submit" class="btn tx-optin-submit btn-primary ">Subscribe!!</button>
    </form>
  </div>
</div>




<?php if($OPTIN_TIMER === "scrolldown"): ?>
<script>
jQuery(document).ready(function ($) {

  $('#menu-close-flyin').on('click',function(){
    $('.optin-flyin-display').css({'display':'none'});
  });

  //__footer popup show__//
  $('.optin-flyin-display').waypoint(function(direction) {
    $('.optin-flyin-display').animate({bottom: '0px'});
  }, {
    offset: '100%'
  });

});
</script>

<?php else: ?>

<script>
jQuery(document).ready(function ($) {
  var TIMER = <?php echo $OPTIN_TIMER; ?>; // jshint ignore:line
  
  $('#menu-close-flyin').on('click',function(){
    $('.optin-flyin-display').css({'display':'none'});
  });

  setTimeout(function(){
    $('.optin-flyin-display').animate({bottom: '0px'});
  }, TIMER);
});
</script>
<?php endif; ?>