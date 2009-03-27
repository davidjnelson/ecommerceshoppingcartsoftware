<?php

// Current EP Version
$curver = '2.61-MS2';

/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

//*******************************
//*******************************
// E D I T   H I S T O R Y
//*******************************
//*******************************
Easy Populate

The point of easy populate is to let someone use an excel file exported to
a tab delimited file to set up their entire store:
categories, products, manufacturers, quantities, and prices.

-----------------------------------
Modified by Tim Wasson - Wasson65 (wasson65@nc.rr.com) to:
 accept category/subcategory names
 allow reordering of columns in csv file
 accept manufacturer name or id
 some minor code simplification
 accept and set status of the product if desired
 changed all # to // comment markers so KDE's Kate will syntax highlight correctly
 added support for default images for products, categories, and categories.
 added support for exporting a csv file that can be modified and sent back in.
-----------------------------------
1.1 Changes
 Fixed a stupid bug, I didn't change the references to easypopulate.php from excel.php
 Added note in the docs that if the Excel import is already done, don't need to do the alter table
 Removed the extra semicolon on the end of the line in the csv download.  It prevented you from exporting and importing a file.
-----------------------------------
1.2 Fixes
More bugs fixed
___________________________________
1.3 Fixes
Added another link to put csv file in temp file for access via tools->files, for some windows machines that refuse to dl right...
-----------------------------------
1.4 Fixes
Switchted to tabs for delimiters
Strip cr's and tab's from strings before exporting
Added explicit end of row field
Added ability to split a big file into smaller files in the temp dir
Preserve double quotes, single quotes, and apostrophes and commas
Removed references to category_root, it's no longer required
------------------------------------
1.5 Fixes
Changed --EOR-- to EOREOR for better excel usability.
Made script accept "EOREOR" or EOREOR without the quotes.
If inserting a new product, delete any product_descriptions with that product_id to avoid an error if old data was still present.
------------------------------------
1.6 Fixes
Ooops, manufacturer_id variable misspellings meant that mfg wasn't getting set or updated
Whe I re-arranged the code, I left out the call to actually put the data into the products table.  Ooops again...
------------------------------------
1.61 Fixes
One more manufacturer id name fix.
------------------------------------
Skipped to 2.0 because of the big jump in functionality
------------------------------------
2.0
Made EP handle magic-quotes
Thanks to Joshua Dechant aka dreamscape, for this fix
Rewrote the categories part to handle any number of categories
------------------------------------
2.1
Fix split files not splitting.
Change from "file" to "fgets" to read the file to be split to avoid out of memory problems... hopefully
------------------------------------
2.2
Added multi-language support. - thanks to elari, who wrote all the code around handling all active langs in OSC
Added category names assumed to be in default language - thanks to elari again!  who wrote all that code as well
Fixed bug where files wouldn't split because the check for EOREOR was too specific.
Added separate file for functions escs_get_uploaded_file and friends so that older snapshots will have it and work.
Finally updated the docs since they sucked
Moved product_model field to the start of each row because sometimes, if the image name was empty, the parsing would get confused
------------------------------------
2.3
Thanks to these sponsors - their financial support made this release possible!
Support for more than one output file format with variable numbers of columns
	Sponsored by Ted Joffs

Support for Separate Price per Customer mod
	Sponsored by Alan Pace

Support for Linda's Header Controller v2.0
	Sponsored by Stewart MacKenzie

Removed quotes around all the fields on export.
Added configuration variable so you can turn off the qoutes -> control codes replacement
Merged Elari's changes to not hardcode language id's
------------------------------------
2.31
Bugfix for single language non-english name/desc not being put into the output file.
The code was still checking for product_name_1 instead of product_name_$langid.
------------------------------------
2.32 - never released into the wild
Added config var $zero_qty_inactive, defaulted to true.
This will make zero qty items inactive by default.
---- STILL NEED TO DEBUG THIS! ----
------------------------------------
2.4
Support for Froogle downloads to EP.
	Sponsored by Ted Joffs
Changed comments - it's not Multiple Price per Product, it's
Separate Price per Customer.
------------------------------------
2.41beta
Fixed bugs with Froogle:
1. Category not getting built right
2. Strip HTML from name/description
3. Handle SearchEngineFriendly URL's

Adding "Delete" capability via EP. -- NOT COMPLETE
Fixed bug - the Model/Category would give SQL errors
Fixed bug - Items with no manufacturer were getting a man of '' (empty string)
Fixed bug - When trying to import, all items gave a "Deleting product" message but no db changes
	This was because I'd tried inserting the delete functionality and didn't finish it.
	Commented it out for now.
Added Date_added, fixed Date_available
Fixed active/inactive status settings
Fixed bug with misnamed item for Linda's Header Controller support
Fixed bug with SQL syntax error with new products
These following 3 fixes thanks to Yassen Yotov
	Fixed bug where the default image name vars weren't declared global in function walk()
	Added set_time_limit call, it won't cover all cases, but hopefully many. commented out to avoid
		complaints with safe mode servers
	Fixed hardcoded catalog/temp/ in output string for splitting files
------------------------------------
2.5
DJZeon found a bug where product URL was getting lost because I always deleted and inserted the product description info - fixed
Same bug also was causing times viewed to be reset to zero because I always deleted and inserted the product descriiption.
Added the multi-image lines from Debbie and Nickie - Thanks!
Changed the output file name to make more sense, now it looks like EP2003Mar20-09:45.txt
------------------------------------
2.51
No code changes, bump version because I forgot to update the docs about the high-to-low category order
------------------------------------
2.53
Bug fixes?
------------------------------------
2.60
Fix froogle categories in reverse order bug
Comment out mimage lines that were causing problems for people in 2.53
Added separator configuration variable so you can pick the separator character to use.
Made Froogle download look for an applicable specials price
Froogle downloads have "froogle" at the start of the file name
You can now specify a file in the temp directory and it will upload that instead of uploading via the browser
------------------------------------
2.61-MS2
Bug fixes thanks to frozenlightning.com
Replaced escs_array_merge with array_merge to bring up to MS2 Standards.
Modified by Deborah Carney, inspired by the Think Tank to be included in the CRE Loaded 6
New support will be found at http://phesis.co.uk in the forums, as well as at forums.oscommerce.com in the Contributions section.  This script was/is written by volunteers, please don't email or PM them, more answers are available in the forums if you search.  If you want EP to do something, someone else probably already asked....
Known issue:  html in the product description gets messed up, not sure how to fix it.

Derived from the Excel Import 1.51 by:

ukrainianshop.net

  Copyright (c) 2002-2003 Tim Wasson
  Released under the GNU General Public License
*/
//*******************************
//*******************************
// E N D
// E D I T   H I S T O R Y
//*******************************
//*******************************

//
//*******************************
//*******************************
// C O N F I G U R A T I O N
// V A R I A B L E S
//*******************************
//*******************************

// **** Temp directory ****
// if you changed your directory structure from stock and do not have /catalog/temp/, then you'll need to change this accordingly.
//
$tempdir = "/temp/";
$tempdir2 = "temp/";

//**** File Splitting Configuration ****
// we attempt to set the timeout limit longer for this script to avoid having to split the files
// NOTE:  If your server is running in safe mode, this setting cannot override the timeout set in php.ini
// uncomment this if you are not on a safe mode server and you are getting timeouts
//set_time_limit(330);

// if you are splitting files, this will set the maximum number of records to put in each file.
// if you set your php.ini to a long time, you can make this number bigger
global $maxrecs;
$maxrecs = 300; // default, seems to work for most people.  Reduce if you hit timeouts
//$maxrecs = 4; // for testing

//**** Image Defaulting ****
global $default_images, $default_image_manufacturer, $default_image_product, $default_image_category;

// set them to your own default "We don't have any picture" gif
//$default_image_manufacturer = 'no_image_manufacturer.gif';
//$default_image_product = 'no_image_product.gif';
//$default_image_category = 'no_image_category.gif';

// or let them get set to nothing
$default_image_manufacturer = '';
$default_image_product = '';
$default_image_category = '';

//**** Status Field Setting ****
// Set the v_status field to "Inactive" if you want the status=0 in the system
// Set the v_status field to "Delete" if you want to remove the item from the system <- THIS IS NOT WORKING YET!
// If zero_qty_inactive is true, then items with zero qty will automatically be inactive in the store.
global $active, $inactive, $zero_qty_inactive, $deleteit;
$active = 'Active';
$inactive = 'Inactive';
//$deleteit = 'Delete'; // not functional yet
$zero_qty_inactive = true;

//**** Size of products_model in products table ****
// set this to the size of your model number field in the db.  We check to make sure all models are no longer than this value.
// this prevents the database from getting fubared.  Just making this number bigger won't help your database!  They must match!
global $modelsize;
$modelsize = 25;

//**** Price includes tax? ****
// Set the v_price_with_tax to
// 0 if you want the price without the tax included
// 1 if you want the price to be defined for import & export including tax.
global $price_with_tax;
$price_with_tax = false;

// **** Quote -> Escape character conversion ****
// If you have extensive html in your descriptions and it's getting mangled on upload, turn this off
// set to 1 = replace quotes with escape characters
// set to 0 = no quote replacement
global $replace_quotes;
$replace_quotes = true;

// **** Field Separator ****
// change this if you can't use the default of tabs
// Tab is the default, comma and semicolon are commonly supported by various progs
// Remember, if your descriptions contain this character, you will confuse EP!
global $separator;
$separator = "\t"; // tab is default
//$separator = ","; // comma
//$separator = ";"; // semi-colon
//$separator = "~"; // tilde
//$separator = "-"; // dash
//$separator = "*"; // splat

// **** Max Category Levels ****
// change this if you need more or fewer categories
global $max_categories;
$max_categories = 10; // 7 is default




// ****************************************
// Froogle configuration variables
// -- YOU MUST CONFIGURE THIS!  IT WON'T WORK OUT OF THE BOX!
// ****************************************

// **** Froogle product info page path ****
// We can't use the tep functions to create the link, because the links will point to the admin, since that's where we're at.
// So put the entire path to your product_info.php page here
global $froogle_product_info_path;
$froogle_product_info_path = "http://www.your-domain/catalog/product_info.php";

// **** Froogle product image path ****
// Set this to the path to your images directory
global $froogle_image_path;
$froogle_image_path = "http://www.your-domain/catalog/images/";

// **** Froogle - search engine friendly setting
// if your store has SEARCH ENGINE FRIENDLY URLS set, then turn this to true
// I did it this way because I'm having trouble with the code seeing the constants
// that are defined in other places.
global $froogle_SEF_urls;
$froogle_SEF_urls = true;


// ****************************************
// End Froogle configuration variables
// ****************************************

//*******************************
//*******************************
// E N D
// C O N F I G U R A T I O N
// V A R I A B L E S
//*******************************
//*******************************


//*******************************
//*******************************
// S T A R T
// INITIALIZATION
//*******************************
//*******************************


require('includes/application_top.php');

//*******************************
// If you are running a pre-Nov1-2002 snapshot of OSC, then we need this include line to avoid
// errors like:
//   undefined function escs_get_uploaded_file
 if (!function_exists(escs_get_uploaded_file)){
	include ('easypopulate_functions.php');
 }
//*******************************

global $filelayout, $filelayout_count, $filelayout_sql, $langcode, $fileheaders;

// these are the fields that will be defaulted to the current values in the database if they are not found in the incoming file
global $default_these;
$default_these = array(
	'v_products_image',
	#'v_products_mimage',
	#'v_products_bimage',
	#'v_products_subimage1',
	#'v_products_bsubimage1',
	#'v_products_subimage2',
	#'v_products_bsubimage2',
	#'v_products_subimage3',
	#'v_products_bsubimage3',
	'v_categories_id',
	'v_products_price',
	'v_products_quantity',
	'v_products_weight',
	'v_date_avail',
	'v_instock',
	'v_tax_class_title',
	'v_manufacturers_name',
	'v_manufacturers_id',
	'v_products_dim_type',
	'v_products_length',
	'v_products_width',
	'v_products_height'
	);

//elari check default language_id from configuration table DEFAULT_LANGUAGE
$epdlanguage_query = escs_db_query("select languages_id, name from " . TABLE_LANGUAGES . " where code = '" . DEFAULT_LANGUAGE . "'");
if (escs_db_num_rows($epdlanguage_query)) {
	$epdlanguage = escs_db_fetch_array($epdlanguage_query);
	$epdlanguage_id   = $epdlanguage['languages_id'];
	$epdlanguage_name = $epdlanguage['name'];
} else {
	Echo 'Strange but there is no default language to work... That may not happen, just in case... ';
}

$langcode = ep_get_languages();

if ( $dltype != '' ){
	// if dltype is set, then create the filelayout.  Otherwise it gets read from the uploaded file
	ep_create_filelayout($dltype); // get the right filelayout for this download
}
//*******************************
//*******************************
// E N D
// INITIALIZATION
//*******************************
//*******************************


if ( $download == 'stream' or  $download == 'tempfile' ){
	//*******************************
	//*******************************
	// DOWNLOAD FILE
	//*******************************
	//*******************************
	$filestring = ""; // this holds the csv file we want to download

	if ( $dltype=='froogle' ){
		// set the things froogle wants at the top of the file
		$filestring .= "# html_escaped=YES\n";
		$filestring .= "# updates_only=NO\n";
		$filestring .= "# product_type=OTHER\n";
		$filestring .= "# quoted=YES\n";
	}

	$result = escs_db_query($filelayout_sql);
	$row =  escs_db_fetch_array($result);

	// Here we need to allow for the mapping of internal field names to external field names
	// default to all headers named like the internal ones
	// the field mapping array only needs to cover those fields that need to have their name changed
	if ( count($fileheaders) != 0 ){
		$filelayout_header = $fileheaders; // if they gave us fileheaders for the dl, then use them
	} else {
		$filelayout_header = $filelayout; // if no mapping was spec'd use the internal field names for header names
	}
	//We prepare the table heading with layout values
	foreach( $filelayout_header as $key => $value ){
		$filestring .= $key . $separator;
	}
	// now lop off the trailing tab
	$filestring = substr($filestring, 0, strlen($filestring)-1);

	// set the type
	if ( $dltype == 'froogle' ){
		$endofrow = "\n";
	} else {
		// default to normal end of row
		$endofrow = $separator . 'EOREOR' . "\n";
	}
	$filestring .= $endofrow;

	$num_of_langs = count($langcode);
	while ($row){


		// if the filelayout says we need a products_name, get it
		// build the long full froogle image path
		$row['v_products_fullpath_image'] = $froogle_image_path . $row['v_products_image'];
		// Other froogle defaults go here for now
		$row['v_froogle_instock'] 		= 'Y';
		$row['v_froogle_shipping'] 		= '';
		$row['v_froogle_upc'] 			= '';
		$row['v_froogle_color']			= '';
		$row['v_froogle_size']			= '';
		$row['v_froogle_quantitylevel']		= '';
		$row['v_froogle_manufacturer_id']	= '';
		$row['v_froogle_exp_date']		= '';
		$row['v_froogle_product_type']		= 'OTHER';
		$row['v_froogle_delete']		= '';
		$row['v_froogle_currency']		= 'USD';
		$row['v_froogle_offer_id']		= $row['v_products_model'];
		$row['v_froogle_product_id']		= $row['v_products_model'];

		// names and descriptions require that we loop thru all languages that are turned on in the store
		foreach ($langcode as $key => $lang){
			$lid = $lang['id'];

			// for each language, get the description and set the vals
			$sql2 = "SELECT *
				FROM products_description
				WHERE
					products_id = " . $row['v_products_id'] . " AND
					language_id = '" . $lid . "'
				";
			$result2 = escs_db_query($sql2);
			$row2 =  escs_db_fetch_array($result2);

			// I'm only doing this for the first language, since right now froogle is US only.. Fix later!
			// adding url for froogle, but it should be available no matter what
			if ($froogle_SEF_urls){
				// if only one language
				if ($num_of_langs == 1){
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '/products_id/' . $row['v_products_id'];
				} else {
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '/products_id/' . $row['v_products_id'] . '/language/' . $lid;
				}
			} else {
				if ($num_of_langs == 1){
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '?products_id=' . $row['v_products_id'];
				} else {
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '?products_id=' . $row['v_products_id'] . '&language=' . $lid;
				}
			}

			$row['v_products_name_' . $lid] 	= $row2['products_name'];
			$row['v_products_description_' . $lid] 	= $row2['products_description'];
			$row['v_products_url_' . $lid] 		= $row2['products_url'];

			// froogle advanced format needs the quotes around the name and desc
			$row['v_froogle_products_name_' . $lid] = '"' . strip_tags(str_replace('"','""',$row2['products_name'])) . '"';
			$row['v_froogle_products_description_' . $lid] = '"' . strip_tags(str_replace('"','""',$row2['products_description'])) . '"';

			// support for Linda's Header Controller 2.0 here
//			if(isset($filelayout['v_products_head_title_tag_' . $lid])){
//				$row['v_products_head_title_tag_' . $lid] 	= $row2['products_head_title_tag'];
//				$row['v_products_head_desc_tag_' . $lid] 	= $row2['products_head_desc_tag'];
//				$row['v_products_head_keywords_tag_' . $lid] 	= $row2['products_head_keywords_tag'];
//			}
			// end support for Header Controller 2.0
		}

		// for the categories, we need to keep looping until we find the root category

		// start with v_categories_id
		// Get the category description
		// set the appropriate variable name
		// if parent_id is not null, then follow it up.
		// we'll populate an aray first, then decide where it goes in the
		$thecategory_id = $row['v_categories_id'];
		$fullcategory = ''; // this will have the entire category stack for froogle
		for( $categorylevel=1; $categorylevel<$max_categories+1; $categorylevel++){
			if ($thecategory_id){
				$sql2 = "SELECT categories_name
					FROM categories_description
					WHERE
						categories_id = " . $thecategory_id . " AND
						language_id = " . $epdlanguage_id ;

				$result2 = escs_db_query($sql2);
				$row2 =  escs_db_fetch_array($result2);
				// only set it if we found something
				$temprow['v_categories_name_' . $categorylevel] = $row2['categories_name'];
				// now get the parent ID if there was one
				$sql3 = "SELECT parent_id
					FROM categories
					WHERE
						categories_id = " . $thecategory_id;
				$result3 = escs_db_query($sql3);
				$row3 =  escs_db_fetch_array($result3);
				$theparent_id = $row3['parent_id'];
				if ($theparent_id != ''){
					// there was a parent ID, lets set thecategoryid to get the next level
					$thecategory_id = $theparent_id;
				} else {
					// we have found the top level category for this item,
					$thecategory_id = false;
				}
				//$fullcategory .= " > " . $row2['categories_name'];
				$fullcategory = $row2['categories_name'] . " > " . $fullcategory;
			} else {
				$temprow['v_categories_name_' . $categorylevel] = '';
			}
		}
		// now trim off the last ">" from the category stack
		$row['v_category_fullpath'] = substr($fullcategory,0,strlen($fullcategory)-3);

		// temprow has the old style low to high level categories.
		$newlevel = 1;
		// let's turn them into high to low level categories
		for( $categorylevel=6; $categorylevel>0; $categorylevel--){
			if ($temprow['v_categories_name_' . $categorylevel] != ''){
				$row['v_categories_name_' . $newlevel++] = $temprow['v_categories_name_' . $categorylevel];
			}
		}
		// if the filelayout says we need a manufacturers name, get it
		if (isset($filelayout['v_manufacturers_name'])){
			if ($row['v_manufacturers_id'] != ''){
				$sql2 = "SELECT manufacturers_name
					FROM manufacturers
					WHERE
					manufacturers_id = " . $row['v_manufacturers_id']
					;
				$result2 = escs_db_query($sql2);
				$row2 =  escs_db_fetch_array($result2);
				$row['v_manufacturers_name'] = $row2['manufacturers_name'];
			}
		}


		// If you have other modules that need to be available, put them here


		// this is for the separate price per customer module
		if (isset($filelayout['v_customer_price_1'])){
			$sql2 = "SELECT
					customers_group_price,
					customers_group_id
				FROM
					products_groups
				WHERE
				products_id = " . $row['v_products_id'] . "
				ORDER BY
				customers_group_id"
				;
			$result2 = escs_db_query($sql2);
			$ll = 1;
			$row2 =  escs_db_fetch_array($result2);
			while( $row2 ){
				$row['v_customer_group_id_' . $ll] 	= $row2['customers_group_id'];
				$row['v_customer_price_' . $ll] 	= $row2['customers_group_price'];
				$row2 = escs_db_fetch_array($result2);
				$ll++;
			}
		}
		if ($dltype == 'froogle'){
			// For froogle, we check the specials prices for any applicable specials, and use that price
			// by grabbing the specials id descending, we always get the most recently added special price
			// I'm checking status because I think you can turn off specials
			$sql2 = "SELECT
					specials_new_products_price
				FROM
					specials
				WHERE
				products_id = " . $row['v_products_id'] . " and
				status = 1 and
				expires_date < CURRENT_TIMESTAMP
				ORDER BY
					specials_id DESC"
				;
			$result2 = escs_db_query($sql2);
			$ll = 1;
			$row2 =  escs_db_fetch_array($result2);
			if( $row2 ){
				// reset the products price to our special price if there is one for this product
				$row['v_products_price'] 	= $row2['specials_new_products_price'];
			}
		}

		//elari -
		//We check the value of tax class and title instead of the id
		//Then we add the tax to price if $price_with_tax is set to 1
		$row_tax_multiplier 		= escs_get_tax_class_rate($row['v_tax_class_id']);
		$row['v_tax_class_title'] 	= escs_get_tax_class_title($row['v_tax_class_id']);
		$row['v_products_price'] 	= $row['v_products_price'] +
							($price_with_tax * round($row['v_products_price'] * $row_tax_multiplier / 100,2));


		// Now set the status to a word the user specd in the config vars
		if ( $row['v_status'] == '1' ){
			$row['v_status'] = $active;
		} else {
			$row['v_status'] = $inactive;
		}

		// remove any bad things in the texts that could confuse EasyPopulate
		$therow = '';
		foreach( $filelayout as $key => $value ){
			//echo "The field was $key<br>";

			$thetext = $row[$key];
			// kill the carriage returns and tabs in the descriptions, they're killing me!
			$thetext = str_replace("\r",' ',$thetext);
			$thetext = str_replace("\n",' ',$thetext);
			$thetext = str_replace("\t",' ',$thetext);
			// and put the text into the output separated by tabs
			$therow .= $thetext . $separator;
		}

		// lop off the trailing tab, then append the end of row indicator
		$therow = substr($therow,0,strlen($therow)-1) . $endofrow;

		$filestring .= $therow;
		// grab the next row from the db
		$row =  escs_db_fetch_array($result);
	}

	#$EXPORT_TIME=time();
	$EXPORT_TIME = strftime('%Y%b%d-%H%I');
	if ($dltype=="froogle"){
		$EXPORT_TIME = "FroogleEP" . $EXPORT_TIME;
	} else {
		$EXPORT_TIME = "EP" . $EXPORT_TIME;
	}

	// now either stream it to them or put it in the temp directory
	if ($download == 'stream'){
		//*******************************
		// STREAM FILE
		//*******************************
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=$EXPORT_TIME.txt");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $filestring;
		die();
	} else {
		//*******************************
		// PUT FILE IN TEMP DIR
		//*******************************
		$tmpfname = DIR_FS_DOCUMENT_ROOT . $tempdir . "$EXPORT_TIME.txt";
		//unlink($tmpfname);
		$fp = fopen( $tmpfname, "w+");
		fwrite($fp, $filestring);
		fclose($fp);
		echo "You can get your file in the Tools/Files under " . $tempdir . "EP" . $EXPORT_TIME . ".txt";
		die();
	}
}   // *** END *** download section
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- � Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>

<table border="0" width="100%" cellspacing="2" cellpadding="2">
<tr>
<td width="<?php echo BOX_WIDTH; ?>" valign="top" height="27">
<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<?php require(DIR_WS_INCLUDES . 'column_left.php');?>
</table></td>
<td class="pageHeading" valign="top"><?php
echo "Easy Populate $curver - Default Language : " . $epdlanguage_name . '(' . $epdlanguage_id .')' ;
?>

<p class="smallText">

<?php

if ($localfile or (is_uploaded_file($usrfl) && $split==0)) {
	//*******************************
	//*******************************
	// UPLOAD AND INSERT FILE
	//*******************************
	//*******************************

	if ($usrfl){
		// move the file to where we can work with it
		$file = escs_get_uploaded_file('usrfl');
		if (is_uploaded_file($file['tmp_name'])) {
			escs_copy_uploaded_file($file, DIR_FS_DOCUMENT_ROOT . $tempdir);
		}

		echo "<p class=smallText>";
		echo "File uploaded. <br>";
		echo "Temporary filename: " . $usrfl . "<br>";
		echo "User filename: " . $usrfl_name . "<br>";
		echo "Size: " . $usrfl_size . "<br>";

		// get the entire file into an array
		$readed = file(DIR_FS_DOCUMENT_ROOT . $tempdir . $usrfl_name);
	}
	if ($localfile){
		// move the file to where we can work with it
		$file = escs_get_uploaded_file('usrfl');
		if (is_uploaded_file($file['tmp_name'])) {
			escs_copy_uploaded_file($file, DIR_FS_DOCUMENT_ROOT . $tempdir);
		}

		echo "<p class=smallText>";
		echo "Filename: " . $localfile . "<br>";

		// get the entire file into an array
		$readed = file(DIR_FS_DOCUMENT_ROOT . $tempdir . $localfile);
	}

	// now we string the entire thing together in case there were carriage returns in the data
	$newreaded = "";
	foreach ($readed as $read){
		$newreaded .= $read;
	}

	// now newreaded has the entire file together without the carriage returns.
	// if for some reason excel put qoutes around our EOREOR, remove them then split into rows
	$newreaded = str_replace('"EOREOR"', 'EOREOR', $newreaded);
	$readed = explode( $separator . 'EOREOR',$newreaded);


	// Now we'll populate the filelayout based on the header row.
	$theheaders_array = explode( $separator, $readed[0] ); // explode the first row, it will be our filelayout
	$lll = 0;
	$filelayout = array();
	foreach( $theheaders_array as $header ){
		$cleanheader = str_replace( '"', '', $header);
	//	echo "Fileheader was $header<br><br><br>";
		$filelayout[ $cleanheader ] = $lll++; //
	}
	unset($readed[0]); //  we don't want to process the headers with the data

	// now we've got the array broken into parts by the expicit end-of-row marker.
	array_walk($readed, 'walk');

}

if (is_uploaded_file($usrfl) && $split==1) {
	//*******************************
	//*******************************
	// UPLOAD AND SPLIT FILE
	//*******************************
	//*******************************
	// move the file to where we can work with it
	$file = escs_get_uploaded_file('usrfl');
	//echo "Trying to move file...";
	if (is_uploaded_file($file['tmp_name'])) {
		escs_copy_uploaded_file($file, DIR_FS_DOCUMENT_ROOT . $tempdir);
	}

	$infp = fopen(DIR_FS_DOCUMENT_ROOT . $tempdir . $usrfl_name, "r");

	//toprow has the field headers
	$toprow = fgets($infp,32768);

	$filecount = 1;

	echo "Creating file EP_Split" . $filecount . ".txt ...  ";
	$tmpfname = DIR_FS_DOCUMENT_ROOT . $tempdir . "EP_Split" . $filecount . ".txt";
	$fp = fopen( $tmpfname, "w+");
	fwrite($fp, $toprow);

	$linecount = 0;
	$line = fgets($infp,32768);
	while ($line){
		// walking the entire file one row at a time
		// but a line is not necessarily a complete row, we need to split on rows that have "EOREOR" at the end
		$line = str_replace('"EOREOR"', 'EOREOR', $line);
		fwrite($fp, $line);
		if (strpos($line, 'EOREOR')){
			// we found the end of a line of data, store it
			$linecount++; // increment our line counter
			if ($linecount >= $maxrecs){
				echo "Added $linecount records and closing file... <Br>";
				$linecount = 0; // reset our line counter
				// close the existing file and open another;
				fclose($fp);
				// increment filecount
				$filecount++;
				echo "Creating file EP_Split" . $filecount . ".txt ...  ";
				$tmpfname = DIR_FS_DOCUMENT_ROOT . $tempdir . "EP_Split" . $filecount . ".txt";
				//Open next file name
				$fp = fopen( $tmpfname, "w+");
				fwrite($fp, $toprow);
			}
		}
		$line=fgets($infp,32768);
	}
	echo "Added $linecount records and closing file...<br><br> ";
	fclose($fp);
	fclose($infp);

	echo "You can download your split files in the Tools/Files under /catalog/temp/";

}

?>
      </p>

      <table width="75%" border="2">
        <tr>
          <td width="75%">
           <FORM ENCTYPE="multipart/form-data" ACTION="easypopulate.php?split=0" METHOD=POST>
              <p>
                <div align = "left">
                <p><b>Upload EP File</b></p>
                <p>
                  <INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="100000000">
                  <p></p>
                  <input name="usrfl" type="file" size="50">
                  <input type="submit" name="buttoninsert" value="Insert into db"><br>
                </p>
              </div>

              </form>

           <FORM ENCTYPE="multipart/form-data" ACTION="easypopulate.php?split=1" METHOD=POST>
              <p>
                <div align = "left">
                <p><b>Split EP File</b></p>
                <p>
                  <INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000000">
                  <p></p>
                  <input name="usrfl" type="file" size="50">
                  <input type="submit" name="buttonsplit" value="Split file"><br>
                </p>
              </div>

             </form>

           <FORM ENCTYPE="multipart/form-data" ACTION="easypopulate.php" METHOD=POST>
              <p>
                <div align = "left">
                <p><b>Import from Temp Dir (<? echo $tempdir; ?>)</b></p>
		<p class="smallText">
		<INPUT TYPE="text" name="localfile" size="50">
                  <input type="submit" name="buttoninsert" value="Insert into db"><br>
                </p>
              </div>

             </form>




		<p><b>Download EP and Froogle Files</b></p>

	      <!-- Download file links -  Add your custom fields here -->
	  <a href="easypopulate.php?download=stream&dltype=full">Download <b>Complete</b> tab-delimited .txt file to edit</a><br>
	  <a href="easypopulate.php?download=stream&dltype=priceqty">Download <b>Model/Price/Qty</b> tab-delimited .txt file to edit</a><br>
	  <a href="easypopulate.php?download=stream&dltype=category">Download <b>Model/Category</b> tab-delimited .txt file to edit</a><br>
	  <a href="easypopulate.php?download=stream&dltype=froogle">Download <b>Froogle</b> tab-delimited .txt file</a><br>

		<p><b>Create EP and Froogle Files in Temp Dir (<? echo $tempdir; ?>)</b></p>
	  <a href="easypopulate.php?download=tempfile&dltype=full">Create Complete tab-delimited .txt file in temp dir</a><br>
          <a href="easypopulate.php?download=tempfile&dltype=priceqty"">Create Model/Price/Qty tab-delimited .txt file in temp dir</a><br>
          <a href="easypopulate.php?download=tempfile&dltype=category">Create Model/Category tab-delimited .txt file in temp dir</a><br>
	  <a href="easypopulate.php?download=tempfile&dltype=froogle">Create Froogle tab-delimited .txt file in temp dir</a><br>
	  </td>
	</tr>
      </table>
    </td>
 </tr>
</table>

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<p>�</p>
<p>�</p><p><br>
</p></body>
</html>

<?php

function ep_get_languages() {
	$languages_query = escs_db_query("select languages_id, code from " . TABLE_LANGUAGES . " order by sort_order");
	// start array at one, the rest of the code expects it that way
	$ll =1;
	while ($ep_languages = escs_db_fetch_array($languages_query)) {
		//will be used to return language_id en language code to report in product_name_code instead of product_name_id
		$ep_languages_array[$ll++] = array(
					'id' => $ep_languages['languages_id'],
					'code' => $ep_languages['code']
					);
	}
	return $ep_languages_array;
};

function escs_get_tax_class_rate($tax_class_id) {
	$tax_multiplier = 0;
	$tax_query = escs_db_query("select SUM(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " WHERE  tax_class_id = '" . $tax_class_id . "' GROUP BY tax_priority");
	if (escs_db_num_rows($tax_query)) {
		while ($tax = escs_db_fetch_array($tax_query)) {
			$tax_multiplier += $tax['tax_rate'];
		}
	}
	return $tax_multiplier;
};

function escs_get_tax_title_class_id($tax_class_title) {
	$classes_query = escs_db_query("select tax_class_id from " . TABLE_TAX_CLASS . " WHERE tax_class_title = '" . $tax_class_title . "'" );
	$tax_class_array = escs_db_fetch_array($classes_query);
	$tax_class_id = $tax_class_array['tax_class_id'];
	return $tax_class_id ;
}

function print_el( $item2 ) {
	echo " | " . substr(strip_tags($item2), 0, 10);
};

function print_el1( $item2 ) {
	echo sprintf("| %'.4s ", substr(strip_tags($item2), 0, 80));
};
function ep_create_filelayout($dltype){
	global $filelayout, $filelayout_count, $filelayout_sql, $langcode, $fileheaders, $max_categories;
	// depending on the type of the download the user wanted, create a file layout for it.
	$fieldmap = array(); // default to no mapping to change internal field names to external.
	switch( $dltype ){
	case 'full':
		// The file layout is dynamically made depending on the number of languages
		$iii = 0;
		$filelayout = array(
			'v_products_model'		=> $iii++,
			'v_products_image'		=> $iii++,
			);

		foreach ($langcode as $key => $lang){
			$l_id = $lang['id'];
			// uncomment the head_title, head_desc, and head_keywords to use
			// Linda's Header Tag Controller 2.0
			//echo $langcode['id'] . $langcode['code'];
			$filelayout  = array_merge($filelayout , array(
					'v_products_name_' . $l_id		=> $iii++,
					'v_products_description_' . $l_id	=> $iii++,
					'v_products_url_' . $l_id	=> $iii++,
//					'v_products_head_title_tag_'.$l_id	=> $iii++,
//					'v_products_head_desc_tag_'.$l_id	=> $iii++,
//					'v_products_head_keywords_tag_'.$l_id	=> $iii++,
					));
		}


		// uncomment the customer_price and customer_group to support multi-price per product contrib

		$filelayout  = array_merge($filelayout , array(
			'v_products_price'		=> $iii++,
			'v_products_weight'		=> $iii++,
			'v_date_avail'			=> $iii++,
			'v_date_added'			=> $iii++,
			'v_products_quantity'		=> $iii++,
			#'v_customer_price_1'		=> $iii++,
			#'v_customer_group_id_1'		=> $iii++,
			#'v_customer_price_2'		=> $iii++,
			#'v_customer_group_id_2'		=> $iii++,
			#'v_customer_price_3'		=> $iii++,
			#'v_customer_group_id_3'		=> $iii++,
			#'v_customer_price_4'		=> $iii++,
			#'v_customer_group_id_4'		=> $iii++,
			'v_manufacturers_name'		=> $iii++,
			));

		// build the categories name section of the array based on the number of categores the user wants to have
		for($i=1;$i<$max_categories+1;$i++){
			$filelayout = array_merge($filelayout, array('v_categories_name_' . $i => $iii++));
		}

		$filelayout = array_merge($filelayout, array(
			'v_tax_class_title'		=> $iii++,
			'v_status'			=> $iii++,
			));

		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_image as v_products_image,
			p.products_price as v_products_price,
			p.products_weight as v_products_weight,
			p.products_date_available as v_date_avail,
			p.products_date_added as v_date_added,
			p.products_tax_class_id as v_tax_class_id,
			p.products_quantity as v_products_quantity,
			p.manufacturers_id as v_manufacturers_id,
			subc.categories_id as v_categories_id,
			p.products_status as v_status
			FROM
			products as p,
			categories as subc,
			products_to_categories as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			";

		break;
	case 'priceqty':
		$iii = 0;
		// uncomment the customer_price and customer_group to support multi-price per product contrib
		$filelayout = array(
			'v_products_model'		=> $iii++,
			'v_products_price'		=> $iii++,
			'v_products_quantity'		=> $iii++,
			#'v_customer_price_1'		=> $iii++,
			#'v_customer_group_id_1'		=> $iii++,
			#'v_customer_price_2'		=> $iii++,
			#'v_customer_group_id_2'		=> $iii++,
			#'v_customer_price_3'		=> $iii++,
			#'v_customer_group_id_3'		=> $iii++,
			#'v_customer_price_4'		=> $iii++,
			#'v_customer_group_id_4'		=> $iii++,
				);
		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_price as v_products_price,
			p.products_quantity as v_products_quantity
			FROM
			products as p
			";

		break;

	case 'category':
		// The file layout is dynamically made depending on the number of languages
		$iii = 0;
		$filelayout = array(
			'v_products_model'		=> $iii++,
		);

		// build the categories name section of the array based on the number of categores the user wants to have
		for($i=1;$i<$max_categories+1;$i++){
			$filelayout = array_merge($filelayout, array('v_categories_name_' . $i => $iii++));
		}


		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			subc.categories_id as v_categories_id
			FROM
			products as p,
			categories as subc,
			products_to_categories as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			";
		break;

	case 'froogle':
		// this is going to be a little interesting because we need
		// a way to map from internal names to external names
		//
		// Before it didn't matter, but with froogle needing particular headers,
		// The file layout is dynamically made depending on the number of languages
		$iii = 0;
		$filelayout = array(
			'v_froogle_products_url_1'			=> $iii++,
			);
		//
		// here we need to get the default language and put
		$l_id = 1; // dummy it in for now.
//		foreach ($langcode as $key => $lang){
//			$l_id = $lang['id'];
			$filelayout  = array_merge($filelayout , array(
					'v_froogle_products_name_' . $l_id		=> $iii++,
					'v_froogle_products_description_' . $l_id	=> $iii++,
					));
//		}
		$filelayout  = array_merge($filelayout , array(
			'v_products_price'		=> $iii++,
			'v_products_fullpath_image'	=> $iii++,
			'v_category_fullpath'		=> $iii++,
			'v_froogle_offer_id'		=> $iii++,
			'v_froogle_instock'		=> $iii++,
			'v_froogle_ shipping'		=> $iii++,
			'v_manufacturers_name'		=> $iii++,
			'v_froogle_ upc'		=> $iii++,
			'v_froogle_color'		=> $iii++,
			'v_froogle_size'		=> $iii++,
			'v_froogle_quantitylevel'	=> $iii++,
			'v_froogle_product_id'		=> $iii++,
			'v_froogle_manufacturer_id'	=> $iii++,
			'v_froogle_exp_date'		=> $iii++,
			'v_froogle_product_type'	=> $iii++,
			'v_froogle_delete'		=> $iii++,
			'v_froogle_currency'		=> $iii++,
				));
		$iii=0;
		$fileheaders = array(
			'product_url'		=> $iii++,
			'name'			=> $iii++,
			'description'		=> $iii++,
			'price'			=> $iii++,
			'image_url'		=> $iii++,
			'category'		=> $iii++,
			'offer_id'		=> $iii++,
			'instock'		=> $iii++,
			'shipping'		=> $iii++,
			'brand'			=> $iii++,
			'upc'			=> $iii++,
			'color'			=> $iii++,
			'size'			=> $iii++,
			'quantity'		=> $iii++,
			'product_id'		=> $iii++,
			'manufacturer_id'	=> $iii++,
			'exp_date'		=> $iii++,
			'product_type'		=> $iii++,
			'delete'		=> $iii++,
			'currency'		=> $iii++,
			);
		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_image as v_products_image,
			p.products_price as v_products_price,
			p.products_weight as v_products_weight,
			p.products_date_added as v_date_avail,
			p.products_tax_class_id as v_tax_class_id,
			p.products_quantity as v_products_quantity,
			p.manufacturers_id as v_manufacturers_id,
			subc.categories_id as v_categories_id
			FROM
			products as p,
			categories as subc,
			products_to_categories as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			";
		break;

	}
	$filelayout_count = count($filelayout);

}


function walk( $item1 ) {
	global $filelayout, $filelayout_count, $modelsize;
	global $active, $inactive, $langcode, $default_these, $deleteit, $zero_qty_inactive;
        global $epdlanguage_id, $price_with_tax, $replace_quotes;
	global $default_images, $default_image_manufacturer, $default_image_product, $default_image_category;
	global $separator, $max_categories;
	// first we clean up the row of data

	// chop blanks from each end
	$item1 = ltrim(rtrim($item1));

	// blow it into an array, splitting on the tabs
	$items = explode($separator, $item1);

	// make sure all non-set things are set to '';
	// and strip the quotes from the start and end of the stings.
	// escape any special chars for the database.
	foreach( $filelayout as $key=> $value){
		$i = $filelayout[$key];
		if (isset($items[$i]) == false) {
			$items[$i]='';
		} else {
			// Check to see if either of the magic_quotes are turned on or off;
			// And apply filtering accordingly.
			if (function_exists('ini_get')) {
				//echo "Getting ready to check magic quotes<br>";
				if (ini_get('magic_quotes_runtime') == 1){
					// The magic_quotes_runtime are on, so lets account for them
					// check if the last character is a quote;
					// if it is, chop off the quotes.
					if (substr($items[$i],-1) == '"'){
						$items[$i] = substr($items[$i],2,strlen($items[$i])-4);
					}
					// now any remaining doubled double quotes should be converted to one doublequote
					$items[$i] = str_replace('\"\"',"&#34",$items[$i]);
					if ($replace_quotes){
						$items[$i] = str_replace('\"',"&#34",$items[$i]);
						$items[$i] = str_replace("\'","&#39",$items[$i]);
					}
				} else { // no magic_quotes are on
					// check if the last character is a quote;
					// if it is, chop off the 1st and last character of the string.
					if (substr($items[$i],-1) == '"'){
						$items[$i] = substr($items[$i],1,strlen($items[$i])-2);
					}
					// now any remaining doubled double quotes should be converted to one doublequote
					$items[$i] = str_replace('""',"&#34",$items[$i]);
					if ($replace_quotes){
						$items[$i] = str_replace('"',"&#34",$items[$i]);
						$items[$i] = str_replace("'","&#39",$items[$i]);
					}
				}
			}
		}
	}
/*
	if ( $items['v_status'] == $deleteit ){
		// they want to delete this product.
		echo "Deleting product " . $items['v_products_model'] . " from the database<br>";
		// Get the ID

		// kill in the products_to_categories

		// Kill in the products table

		return; // we're done deleteing!
	}
*/
	// now do a query to get the record's current contents
	$sql = "SELECT
		p.products_id as v_products_id,
		p.products_model as v_products_model,
		p.products_image as v_products_image,
		p.products_price as v_products_price,
		p.products_weight as v_products_weight,
		p.products_date_added as v_date_avail,
		p.products_tax_class_id as v_tax_class_id,
		p.products_quantity as v_products_quantity,
		p.manufacturers_id as v_manufacturers_id,
		subc.categories_id as v_categories_id
		FROM
		products as p,
		categories as subc,
		products_to_categories as ptoc
		WHERE
		p.products_id = ptoc.products_id AND
		p.products_model = '" . $items[$filelayout['v_products_model']] . "' AND
		ptoc.categories_id = subc.categories_id
		";

	$result = escs_db_query($sql);
	$row =  escs_db_fetch_array($result);


	while ($row){
		// OK, since we got a row, the item already exists.
		// Let's get all the data we need and fill in all the fields that need to be defaulted to the current values
		// for each language, get the description and set the vals
		foreach ($langcode as $key => $lang){
			//echo "Inside defaulting loop";
			//echo "key is $key<br>";
			//echo "langid is " . $lang['id'] . "<br>";
//			$sql2 = "SELECT products_name, products_description
//				FROM products_description
//				WHERE
//					products_id = " . $row['v_products_id'] . " AND
//					language_id = '" . $lang['id'] . "'
//				";
			$sql2 = "SELECT *
				FROM products_description
				WHERE
					products_id = " . $row['v_products_id'] . " AND
					language_id = '" . $lang['id'] . "'
				";
			$result2 = escs_db_query($sql2);
			$row2 =  escs_db_fetch_array($result2);
                        // Need to report from ......_name_1 not ..._name_0
			$row['v_products_name_' . $lang['id']] 		= $row2['products_name'];
			$row['v_products_description_' . $lang['id']] 	= $row2['products_description'];
			$row['v_products_url_' . $lang['id']] 		= $row2['products_url'];

			// support for Linda's Header Controller 2.0 here
			if(isset($filelayout['v_products_head_title_tag_' . $lang['id'] ])){
//				$row['v_products_head_title_tag_' . $lang['id']] 	= $row2['products_head_title_tag'];
//				$row['v_products_head_desc_tag_' . $lang['id']] 	= $row2['products_head_desc_tag'];
//				$row['v_products_head_keywords_tag_' . $lang['id']] 	= $row2['products_head_keywords_tag'];
			}
			// end support for Header Controller 2.0
		}

		// start with v_categories_id
		// Get the category description
		// set the appropriate variable name
		// if parent_id is not null, then follow it up.
		$thecategory_id = $row['v_categories_id'];

		for( $categorylevel=1; $categorylevel<$max_categories+1; $categorylevel++){
			if ($thecategory_id){
				$sql2 = "SELECT categories_name
					FROM categories_description
					WHERE
						categories_id = " . $thecategory_id . " AND
						language_id = " . $epdlanguage_id ;

				$result2 = escs_db_query($sql2);
				$row2 =  escs_db_fetch_array($result2);
				// only set it if we found something
				$temprow['v_categories_name_' . $categorylevel] = $row2['categories_name'];
				// now get the parent ID if there was one
				$sql3 = "SELECT parent_id
					FROM categories
					WHERE
						categories_id = " . $thecategory_id;
				$result3 = escs_db_query($sql3);
				$row3 =  escs_db_fetch_array($result3);
				$theparent_id = $row3['parent_id'];
				if ($theparent_id != ''){
					// there was a parent ID, lets set thecategoryid to get the next level
					$thecategory_id = $theparent_id;
				} else {
					// we have found the top level category for this item,
					$thecategory_id = false;
				}
			} else {
					$temprow['v_categories_name_' . $categorylevel] = '';
			}
		}
		// temprow has the old style low to high level categories.
		$newlevel = 1;
		// let's turn them into high to low level categories
		for( $categorylevel=$max_categories+1; $categorylevel>0; $categorylevel--){
			if ($temprow['v_categories_name_' . $categorylevel] != ''){
				$row['v_categories_name_' . $newlevel++] = $temprow['v_categories_name_' . $categorylevel];
			}
		}

		if ($row['v_manufacturers_id'] != ''){
			$sql2 = "SELECT manufacturers_name
				FROM manufacturers
				WHERE
				manufacturers_id = " . $row['v_manufacturers_id']
				;
			$result2 = escs_db_query($sql2);
			$row2 =  escs_db_fetch_array($result2);
			$row['v_manufacturers_name'] = $row2['manufacturers_name'];
		}

		//elari -
		//We check the value of tax class and title instead of the id
		//Then we add the tax to price if $price_with_tax is set to true
		$row_tax_multiplier = escs_get_tax_class_rate($row['v_tax_class_id']);
		$row['v_tax_class_title'] = escs_get_tax_class_title($row['v_tax_class_id']);
		if ($price_with_tax){
			$row['v_products_price'] = $row['v_products_price'] + round($row['v_products_price']* $row_tax_multiplier / 100,2);
		}

		// now create the internal variables that will be used
		// the $$thisvar is on purpose: it creates a variable named what ever was in $thisvar and sets the value
		foreach ($default_these as $thisvar){
			$$thisvar	= $row[$thisvar];
		}

		$row =  escs_db_fetch_array($result);
	}

	// this is an important loop.  What it does is go thru all the fields in the incoming file and set the internal vars.
	// Internal vars not set here are either set in the loop above for existing records, or not set at all (null values)
	// the array values are handled separatly, although they will set variables in this loop, we won't use them.
	foreach( $filelayout as $key => $value ){
		$$key = $items[ $value ];
	}

        // so how to handle these?  we shouldn't built the array unless it's been giving to us.
	// The assumption is that if you give us names and descriptions, then you give us name and description for all applicable languages
	foreach ($langcode as $lang){
		//echo "Langid is " . $lang['id'] . "<br>";
		$l_id = $lang['id'];
		if (isset($filelayout['v_products_name_' . $l_id ])){
			//we set dynamically the language values
			$v_products_name[$l_id] 	= $items[$filelayout['v_products_name_' . $l_id]];
			$v_products_description[$l_id] 	= $items[$filelayout['v_products_description_' . $l_id ]];
			$v_products_url[$l_id] 		= $items[$filelayout['v_products_url_' . $l_id ]];
			// support for Linda's Header Controller 2.0 here
			if(isset($filelayout['v_products_head_title_tag_' . $l_id])){
//				$v_products_head_title_tag[$l_id] 	= $items[$filelayout['v_products_head_title_tag_' . $l_id]];
//				$v_products_head_desc_tag[$l_id] 	= $items[$filelayout['v_products_head_desc_tag_' . $l_id]];
//				$v_products_head_keywords_tag[$l_id] 	= $items[$filelayout['v_products_head_keywords_tag_' . $l_id]];
			}
			// end support for Header Controller 2.0
		}
	}
	//elari... we get the tax_clas_id from the tax_title
	//on screen will still be displayed the tax_class_title instead of the id....
	if ( isset( $v_tax_class_title) ){
		$v_tax_class_id          = escs_get_tax_title_class_id($v_tax_class_title);
	}
	//we check the tax rate of this tax_class_id
        $row_tax_multiplier = escs_get_tax_class_rate($v_tax_class_id);

	//And we recalculate price without the included tax...
	//Since it seems display is made before, the displayed price will still include tax
	//This is same problem for the tax_clas_id that display tax_class_title
	if ($price_with_tax){
		$v_products_price        = round( $v_products_price / (1 + ( $row_tax_multiplier * $price_with_tax/100) ), 2);
	}

	// if they give us one category, they give us all 6 categories
	unset ($v_categories_name); // default to not set.
	if ( isset( $filelayout['v_categories_name_1'] ) ){
		$newlevel = 1;
		for( $categorylevel=6; $categorylevel>0; $categorylevel--){
			if ( $items[$filelayout['v_categories_name_' . $categorylevel]] != ''){
				$v_categories_name[$newlevel++] = $items[$filelayout['v_categories_name_' . $categorylevel]];
			}
		}
		while( $newlevel < $max_categories+1){
			$v_categories_name[$newlevel++] = ''; // default the remaining items to nothing
		}
	}

	if (ltrim(rtrim($v_products_quantity)) == '') {
		$v_products_quantity = 1;
	}
	if ($v_date_avail == '') {
		$v_date_avail = "CURRENT_TIMESTAMP";
	} else {
		// we put the quotes around it here because we can't put them into the query, because sometimes
		//   we will use the "current_timestamp", which can't have quotes around it.
		$v_date_avail = '"' . $v_date_avail . '"';
	}

	if ($v_date_added == '') {
		$v_date_added = "CURRENT_TIMESTAMP";
	} else {
		// we put the quotes around it here because we can't put them into the query, because sometimes
		//   we will use the "current_timestamp", which can't have quotes around it.
		$v_date_added = '"' . $v_date_added . '"';
	}


	// default the stock if they spec'd it or if it's blank
	$v_db_status = '1'; // default to active
	if ($v_status == $inactive){
		// they told us to deactivate this item
		$v_db_status = '0';
	}
	if ($zero_qty_inactive && $v_products_quantity == 0) {
		// if they said that zero qty products should be deactivated, let's deactivate if the qty is zero
		$v_db_status = '0';
	}

	if ($v_manufacturer_id==''){
		$v_manufacturer_id="NULL";
	}

	if (trim($v_products_image)==''){
		$v_products_image = $default_image_product;
	}

	if (strlen($v_products_model) > $modelsize ){
		echo "<font color='red'>" . strlen($v_products_model) . $v_products_model . "... ERROR! - Too many characters in the model number.<br>
			12 is the maximum on a standard OSC install.<br>
			Your maximum product_model length is set to $modelsize<br>
			You can either shorten your model numbers or increase the size of the field in the database.</font>";
		die();
	}

	// OK, we need to convert the manufacturer's name into id's for the database
	if ( isset($v_manufacturers_name) && $v_manufacturers_name != '' ){
		$sql = "SELECT man.manufacturers_id
			FROM manufacturers as man
			WHERE
				man.manufacturers_name = '" . $v_manufacturers_name . "'";
		$result = escs_db_query($sql);
		$row =  escs_db_fetch_array($result);
		if ( $row != '' ){
			foreach( $row as $item ){
				$v_manufacturer_id = $item;
			}
		} else {
			// to add, we need to put stuff in categories and categories_description
			$sql = "SELECT MAX( manufacturers_id) max FROM manufacturers";
			$result = escs_db_query($sql);
			$row =  escs_db_fetch_array($result);
			$max_mfg_id = $row['max']+1;
			// default the id if there are no manufacturers yet
			if (!is_numeric($max_mfg_id) ){
				$max_mfg_id=1;
			}

			// Uncomment this query if you have an older 2.2 codebase
			/*
			$sql = "INSERT INTO manufacturers(
				manufacturers_id,
				manufacturers_name,
				manufacturers_image
				) VALUES (
				$max_mfg_id,
				'$v_manufacturers_name',
				'$default_image_manufacturer'
				)";
			*/

			// Comment this query out if you have an older 2.2 codebase
			$sql = "INSERT INTO manufacturers(
				manufacturers_id,
				manufacturers_name,
				manufacturers_image,
				date_added,
				last_modified
				) VALUES (
				$max_mfg_id,
				'$v_manufacturers_name',
				'$default_image_manufacturer',
				CURRENT_TIMESTAMP,
				CURRENT_TIMESTAMP
				)";
			$result = escs_db_query($sql);
			$v_manufacturer_id = $max_mfg_id;
		}
	}
	// if the categories names are set then try to update them
	if ( isset($v_categories_name_1)){
		// start from the highest possible category and work our way down from the parent
		$v_categories_id = 0;
		$theparent_id = 0;
		for ( $categorylevel=$max_categories+1; $categorylevel>0; $categorylevel-- ){
			$thiscategoryname = $v_categories_name[$categorylevel];
			if ( $thiscategoryname != ''){
				// we found a category name in this field

				// now the subcategory
				$sql = "SELECT cat.categories_id
					FROM categories as cat, categories_description as des
					WHERE
						cat.categories_id = des.categories_id AND
						des.language_id = $epdlanguage_id AND
						cat.parent_id = " . $theparent_id . " AND
						des.categories_name = '" . $thiscategoryname . "'";
				$result = escs_db_query($sql);
				$row =  escs_db_fetch_array($result);
				if ( $row != '' ){
					foreach( $row as $item ){
						$thiscategoryid = $item;
					}
				} else {
					// to add, we need to put stuff in categories and categories_description
					$sql = "SELECT MAX( categories_id) max FROM categories";
					$result = escs_db_query($sql);
					$row =  escs_db_fetch_array($result);
					$max_category_id = $row['max']+1;
					if (!is_numeric($max_category_id) ){
						$max_category_id=1;
					}
					$sql = "INSERT INTO categories(
						categories_id,
						categories_image,
						parent_id,
						sort_order,
						date_added,
						last_modified
						) VALUES (
						$max_category_id,
						'$default_image_category',
						$theparent_id,
						0,
						CURRENT_TIMESTAMP
						,CURRENT_TIMESTAMP
						)";
					$result = escs_db_query($sql);
					$sql = "INSERT INTO categories_description(
							categories_id,
							language_id,
							categories_name
						) VALUES (
							$max_category_id,
							'$epdlanguage_id',
							'$thiscategoryname'
						)";
					$result = escs_db_query($sql);
					$thiscategoryid = $max_category_id;
				}
				// the current catid is the next level's parent
				$theparent_id = $thiscategoryid;
				$v_categories_id = $thiscategoryid; // keep setting this, we need the lowest level category ID later
			}
		}
	}

	if ($v_products_model != "") {
		//   products_model exists!
		array_walk($items, 'print_el');

		// First we check to see if this is a product in the current db.
		$result = escs_db_query("SELECT products_id FROM products WHERE (products_model = '". $v_products_model . "')");

		if (escs_db_num_rows($result) == 0)  {
			//   insert into products

			$sql = "SELECT MAX( products_id) max FROM products";
			$result = escs_db_query($sql);
			$row =  escs_db_fetch_array($result);
			$max_product_id = $row['max']+1;
			if (!is_numeric($max_product_id) ){
				$max_product_id=1;
			}
			$v_products_id = $max_product_id;
			echo "<font color='green'> !New Product!</font><br>";

			$query = "INSERT INTO products (
					products_image,
					products_model,
					products_price,
					products_status,
					products_last_modified,
					products_date_added,
					products_date_available,
					products_tax_class_id,
					products_weight,
					products_quantity,
					manufacturers_id)
						VALUES (
							'$v_products_image',";

			// unmcomment these lines if you are running the image mods
			/*
				$query .=		. $v_products_mimage . '", "'
							. $v_products_bimage . '", "'
							. $v_products_subimage1 . '", "'
							. $v_products_bsubimage1 . '", "'
							. $v_products_subimage2 . '", "'
							. $v_products_bsubimage2 . '", "'
							. $v_products_subimage3 . '", "'
							. $v_products_bsubimage3 . '", "'
			*/

			$query .="				'$v_products_model',
								'$v_products_price',
								'$v_db_status',
								CURRENT_TIMESTAMP,
								$v_date_added,
								$v_date_avail,
								'$v_tax_class_id',
								'$v_products_weight',
								'$v_products_quantity',
								'$v_manufacturer_id')
							";
				$result = escs_db_query($query);
		} else {
			// existing product, get the id from the query
			// and update the product data
			$row =  escs_db_fetch_array($result);
			$v_products_id = $row['products_id'];
			echo "<font color='black'> Updated</font><br>";
			$row =  escs_db_fetch_array($result);
			$query = 'UPDATE products
					SET
					products_price="'.$v_products_price.
					'" ,products_image="'.$v_products_image;

			// uncomment these lines if you are running the image mods
/*
				$query .=
					'" ,products_mimage="'.$v_products_mimage.
					'" ,products_bimage="'.$v_products_bimage.
					'" ,products_subimage1="'.$v_products_subimage1.
					'" ,products_bsubimage1="'.$v_products_bsubimage1.
					'" ,products_subimage2="'.$v_products_subimage2.
					'" ,products_bsubimage2="'.$v_products_bsubimage2.
					'" ,products_subimage3="'.$v_products_subimage3.
					'" ,products_bsubimage3="'.$v_products_bsubimage3;
*/

			$query .= '", products_weight="'.$v_products_weight .
					'", products_tax_class_id="'.$v_tax_class_id .
					'", products_date_available= ' . $v_date_avail .
					', products_date_added= ' . $v_date_added .
					', products_last_modified=CURRENT_TIMESTAMP
					, products_quantity="' . $v_products_quantity .
					'" ,manufacturers_id=' . $v_manufacturer_id .
					' , products_status=' . $v_db_status . '
					WHERE
						(products_id = "'. $v_products_id . '")';

			$result = escs_db_query($query);
		}

		// the following is common in both the updating an existing product and creating a new product
                if ( isset($v_products_name)){
			foreach( $v_products_name as $key => $name){
							if ($name!=''){
					$sql = "SELECT * FROM products_description WHERE
							products_id = $v_products_id AND
							language_id = " . $key;
					$result = escs_db_query($sql);
					if (escs_db_num_rows($result) == 0) {
						// nope, this is a new product description
						$result = escs_db_query($sql);
						$sql =
							"INSERT INTO products_description
								(products_id,
								language_id,
								products_name,
								products_description,
								products_url)
								VALUES (
									'" . $v_products_id . "',
									" . $key . ",
									'" . $name . "',
									'". $v_products_description[$key] . "',
									'". $v_products_url[$key] . "'
									)";
						// support for Linda's Header Controller 2.0
						if (isset($v_products_head_title_tag)){
							// override the sql if we're using Linda's contrib
							$sql =
								"INSERT INTO products_description
									(products_id,
									language_id,
									products_name,
									products_description,
									products_url,
//									products_head_title_tag,
//									products_head_desc_tag,
//									products_head_keywords_tag)
									VALUES (
										'" . $v_products_id . "',
										" . $key . ",
										'" . $name . "',
										'". $v_products_description[$key] . "',
										'". $v_products_url[$key] . "',
								//		'". $v_products_head_title_tag[$key] . "',
								//		'". $v_products_head_desc_tag[$key] . "',
								//		'". $v_products_head_keywords_tag[$key] . "')";
						}
						// end support for Linda's Header Controller 2.0
						$result = escs_db_query($sql);
					} else {
						// already in the description, let's just update it
						$sql =
							"UPDATE products_description SET
								products_name='$name',
								products_description='".$v_products_description[$key] . "',
								products_url='" . $v_products_url[$key] . "'
							WHERE
								products_id = '$v_products_id' AND
								language_id = '$key'";
						// support for Lindas Header Controller 2.0
						if (isset($v_products_head_title_tag)){
							// override the sql if we're using Linda's contrib
							$sql =
								"UPDATE products_description SET
									products_name = '$name',
									products_description = '".$v_products_description[$key] . "',
									products_url = '" . $v_products_url[$key] ."',
								//	products_head_title_tag = '" . $v_products_head_title_tag[$key] ."',
								//	products_head_desc_tag = '" . $v_products_head_desc_tag[$key] ."',
								//	products_head_keywords_tag = '" . $v_products_head_keywords_tag[$key] ."'
								WHERE
									products_id = '$v_products_id' AND
									language_id = '$key'";
						}
						// end support for Linda's Header Controller 2.0
						$result = escs_db_query($sql);
					}
				}
			}
		}
		if (isset($v_categories_id)){
			//find out if this product is listed in the category given
			$result_incategory = escs_db_query('SELECT
						products_to_categories.products_id,
						products_to_categories.categories_id
						FROM
							products_to_categories
						WHERE
						products_to_categories.products_id='.$v_products_id.' AND
						products_to_categories.categories_id='.$v_categories_id);

			if (escs_db_num_rows($result_incategory) == 0) {
				// nope, this is a new category for this product
				$res1 = escs_db_query('INSERT INTO products_to_categories (products_id, categories_id)
							VALUES ("' . $v_products_id . '", "' . $v_categories_id . '")');
			} else {
				// already in this category, nothing to do!
			}
		}
		// for the separate prices per customer module
		$ll=1;

		if (isset($v_customer_price_1)){
			if ($v_customer_group_id_1 == ''){
				echo "<font color=red>ERROR - v_customer_group_id and v_customer_price must occur in pairs</font>";
				die();
			}
			// they spec'd some prices, so clear all existing entries
			$result = escs_db_query('
						DELETE
						FROM
							products_groups
						WHERE
							products_id = ' . $v_products_id
						);
			// and insert the new record
			if ($v_customer_price_1 != ''){
				$result = escs_db_query('
							INSERT INTO
								products_groups
							VALUES
							(
								' . $v_customer_group_id_1 . ',
								' . $v_customer_price_1 . ',
								' . $v_products_id . ',
								' . $v_products_price .'
								)'
							);
			}
			if ($v_customer_price_2 != ''){
				$result = escs_db_query('
							INSERT INTO
								products_groups
							VALUES
							(
								' . $v_customer_group_id_2 . ',
								' . $v_customer_price_2 . ',
								' . $v_products_id . ',
								' . $v_products_price . '
								)'
							);
			}
			if ($v_customer_price_3 != ''){
				$result = escs_db_query('
							INSERT INTO
								products_groups
							VALUES
							(
								' . $v_customer_group_id_3 . ',
								' . $v_customer_price_3 . ',
								' . $v_products_id . ',
								' . $v_products_price . '
								)'
							);
			}
			if ($v_customer_price_4 != ''){
				$result = escs_db_query('
							INSERT INTO
								products_groups
							VALUES
							(
								' . $v_customer_group_id_4 . ',
								' . $v_customer_price_4 . ',
								' . $v_products_id . ',
								' . $v_products_price . '
								)'
							);
			}

		}

	} else {
		// this record was missing the product_model
		array_walk($items, 'print_el');
		echo "<p class=smallText>No products_model field in record. This line was not imported <br>";
		echo "<br>";
	}
// end of row insertion code
}


require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>