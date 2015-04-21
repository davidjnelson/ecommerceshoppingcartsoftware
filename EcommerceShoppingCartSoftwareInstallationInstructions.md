# Introduction #

This wiki will guide you on how to install Ecommerce Shopping Cart Software.


# Details #

```

--------------------------------------------
Installing Ecommerce Shopping Cart Software:
--------------------------------------------

1) Ftp all files with the exception of GPL.txt and installation_instructions.txt preserving the original folder structure to your web server.  
2) Then, run http://yourdomainname.com/ecommerce_shopping_cart_software/install/index.php in your web browser.  Follow the instructions on screen.  
3) Next, chmod ecommerce_shopping_cart_software/includes/configure.php and chmod ecommerce_shopping_cart_software/admin/includes/configure.php to 444.
4) Chmod 777 the /images folder.
5) If your web server uses a different directory for SSL / https protected files, repeat steps 1-4 for this directory.
6) Change your admin username and password by sending an http request to /install/change_password.php via your web browser, using the following query string parameters: db_username [Database Username], db_password [Database Password], db_server [Database Server], db_database [Database Name] ). 

Example:
http://www.yourdomain.com/ecommerce_shopping_cart_software/install/change_password.php?db_username=user&db_password=pass&db_server=localhost&db_database=ecommerce_shopping_cart_software

If you don't do this it will be easy for anyone with a little software knowledge to log in and edit your store's settings.   This feature will most likely be incorporated into the admin UI very soon.  If you can't figure out how to do it, try using the windows installer for unix.
7) Then, delete the install directory from your web server.  

---------------------------------------
Using Ecommerce Shopping Cart Software:
---------------------------------------

To run the catalog, type http://yourdomainname.com/ecommerce_shopping_cart_software/index.php.  To run the administration interface, type https://yourdomainname.com/ecommerce_shopping_cart_software/admin/index.php.  The initial username and password are username: admin@localhost.com & password: admin

--------------
Tips & Tricks:
--------------

1) Edit the primary look and feel template of your website, and control which boxes are on each page:  edit /templates/main_page.tpl.php  This file contains the primary look and feel of your web site.  Also /templates/box.tpl.php will give you control over the look and feel of the boxes on the left side of the screen and at the bottom of the screen.
2) Use the Ecommerce Shopping Cart Software Windows Installer For Unix instead of installing manually.  It's much easier!  Download it at http://www.ecommerceshoppingcartsoftware.org/

-------------------
Further Assistance:
-------------------

```

If you need further assistance, professional installation help is available for purchase here at http://www.ecommerceshoppingcartsoftware.org