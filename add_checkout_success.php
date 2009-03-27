<?php
//ICW ADDED FOR ORDER_TOTAL CREDIT SYSTEM - Start Addition
  $gv_query=escs_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id='".$customer_id."'");
  if ($gv_result=escs_db_fetch_array($gv_query)) {
    if ($gv_result['amount'] > 0) {
?>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td align="center" class="main"><?php echo GV_HAS_VOUCHERA; echo escs_href_link(FILENAME_GV_SEND); echo GV_HAS_VOUCHERB; ?></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
}}
//ICW ADDED FOR ORDER_TOTAL CREDIT SYSTEM - End Addition
?>