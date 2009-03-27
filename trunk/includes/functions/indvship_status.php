<?php
/*

Indvship

*/
?>
<?php


// BOF Indv Ship
  function escs_get_configuration_key_value($lookup) {
    $configuration_query_raw= escs_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key='" . $lookup . "'");
    $configuration_query= escs_db_fetch_array($configuration_query_raw);
    $lookup_value= $configuration_query['configuration_value'];
    return $lookup_value;
  }
// EOF

?>
