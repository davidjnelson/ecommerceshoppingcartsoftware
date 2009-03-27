<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- tell_a_friend //-->
<?php

  $boxContent = "<script language='javascript'>window.onload='document.to_email_address.blur();'</script>" .
  				escs_draw_form('tell_a_friend', escs_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get') . '<div class="boxText">Tell A Friend: ' .
  				escs_draw_input_field('to_email_address', '', 'size="17" value="Type Friends Email" onfocus="this.value=\'\';this.focus();" onblur="if(this.value==\'\') { this.value=\'Type Friends Email\'; }"') . '&nbsp;' . '<input type="submit" value="Tell">' . escs_draw_hidden_field('products_id', $HTTP_GET_VARS['products_id']) . escs_hide_session_id() .
  				'</div></form>';
  print $boxContent;
?>
<!-- tell_a_friend_eof //-->
