<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Pedido');
define('NAVBAR_TITLE_2', 'Realizado con Exito');

define('HEADING_TITLE', 'Su Pedido ha sido Procesado!');

define('TEXT_SUCCESS', 'Su pedido ha sido realizado con &eacute;xito! Sus productos llegar&aacute;n a su destino de 2 a 5 dias laborales.');
define('TEXT_NOTIFY_PRODUCTS', 'Por favor notifiqueme de cambios realizados a los productos seleccionados:');
define('TEXT_SEE_ORDERS', 'Puede ver sus pedidos viendo la pagina de <a href="' . escs_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Su Cuenta\'</a> y pulsando sobre <a href="' . escs_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Historial\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Dirija sus preguntas al <a href="' . escs_href_link(FILENAME_CONTACT_US) . '">administrador</a>.');
define('TEXT_THANKS_FOR_SHOPPING', '¡Gracias por comprar con nosotros!');

define('TABLE_HEADING_COMMENTS', 'Introduzca un comentario sobre su pedido');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Fecha Caducidad: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' descargas restantes');
define('HEADING_DOWNLOAD', 'Descargue sus productos aqui:');
define('FOOTER_DOWNLOAD', 'Puede descargar sus productos mas tarde en \'%s\'');
define('PAYPAL_NAVBAR_TITLE_2_OK', 'Realizado con Exito'); // PAYPALIPN
define('PAYPAL_NAVBAR_TITLE_2_PENDING', 'Pedido en procesamiento'); // PAYPALIPN
define('PAYPAL_NAVBAR_TITLE_2_FAILED', 'Fallo en el pago'); // PAYPALIPN
define('PAYPAL_HEADING_TITLE_OK', 'Su Pedido ha sido Procesado!'); // PAYPALIPN
define('PAYPAL_HEADING_TITLE_PENDING', 'Su Pedido esta siendo procesado!!'); // PAYPALIPN
define('PAYPAL_HEADING_TITLE_FAILED', 'Su pago a fallado!'); // PAYPALIPN
define('PAYPAL_TEXT_SUCCESS_OK', 'Su pedido ha sido realizado con exito! Sus productos llegaran a su destino de 2 a 5 dias laborales.'); // PAYPALIPN
define('PAYPAL_TEXT_SUCCESS_PENDING', 'Su pedido esta siendo procesado!'); // PAYPALIPN
define('PAYPAL_TEXT_SUCCESS_FAILED', 'Su pago a fallado! Por favor verifique que los datos ingresados para pagar con Paypal sea correctos.'); // PAYPALIPN
?>