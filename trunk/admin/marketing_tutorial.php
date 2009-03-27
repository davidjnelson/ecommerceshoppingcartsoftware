<?php
/*
  $Id$

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><? echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="JavaScript1.2">

function cOn(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCCCCC";
  }
}

function cOnA(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCFFFF";
  }
}

function cOut(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="DFE4F4";
  }
}
</script>
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<? include(DIR_WS_INCLUDES . 'header.php');  ?>
<!-- header_eof //-->


<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo "Marketing Tutorial"; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
     </tr>

<!-- body_text //-->
    <td width="100%" valign="top">
      <!-- Start of marketing tutorial //-->

<div class="helpText">

<p>There are three optimum ways to market your online store:</p>
<ol>
	<li><a href="#npsel">Non-Paid Search Engine Listings</a>
	<li><a href="#ssel">Sponsored Search Engine Listings</a>
	<li><a href="#n">Email Newsletters</a>
</ol>

<h3><a name="npsel">Non-Paid Search Engine Listings</h3>
<p>Defining a list of target keywords that your customers are using to look for your products, and
getting listed at the top of google, the new yahoo, and the new msn for those keywords and keywords phrases
is extremely important for the success of your online store.  To define a list of keywords, use overture's keyword
suggestion tool at <a href="http://inventory.overture.com/d/searchinventory/suggestion/" target="_blank">http://inventory.overture.com/d/searchinventory/suggestion/</a>.
Overture is a company that got bought out by Yahoo sometime in 2002-2003.  Their listings show up as sponsored
results in Yahoo and other portals.  Since Yahoo is used much less than google for searching, the number you see in
this tool for each search is smaller than the amount of searches occuring in google.
</p>
<p>Go to that address and type in words relating to what items you are selling.  You will see a list of related
words, as well as the word you typed in.  Next to the words is a number, showing how many searches have been done
on Yahoo as well as Overture/Yahoo's other partner sites within the last month.  A high number will tell you if people
are using a certain phrase more often than other phrases when looking for your products.  You can also use this
tool to determine which products are going to sell better due to how interested people are in finding them.</p>
<p>Make a list of the top words relating to your specific products and/or type of products, and write down how
many times the keyword phrase has been searched on in the last month.  Now that you have this list, you know
which keywords you want to show up at the top of the search engines.  Google is the king right now, and searches
on it account for _at least_ 80% of all internet searches conducted according to server log research done by the writer
of this tutorial.</p>
<p>What you will want to do mainly is to make sure your catalog is linked to in the <a href="http://dmoz.org/">open directory</a>.
This will ensure that google will index your site.  It's very important to have the search keywords you want to
show up for at the top of google to be the text of links on sites who link to your site.  It's even better if the
page you're linked to from other sites is about the product you are selling.  It is worthwile to buy text link
advertising from sites relating to what you're selling that have a high pagerank (see more info below on how
to determine pagerank using the google toolbar).</p>
<p><b>Here is a crash course on search engine optimization:</b></p>
<table border="0" cellspacing="0" cellpadding="10" width="90%">
<tr>
		<td><b>Get links from sites and directories that focus on content directly relating to your keyword</b></td>
		<td>Very very important.  If you're selling european cruises, get listed on all the big sites that list smaller european cruise sites.  To find the big directories for a keyword, do a google search on the keyword.  Easy enough.  You shouldn't have to pay for a listing though - be wary of sites that require money for inclusion.  Yahoo and Looksmart may be exceptions to this, I don't have experience with them though.</td>
	</tr>
	<tr>
		<td><b>Put your keyword in the text of the links from the sites and directories mentioned above</b></td>
		<td>If your site is called &quot;Bobs Travel&quot;, make the link you get from the directories above say: &quot;Bob's Travel Quality European Cruises&quot; or similar.</td>
	</tr>
	<tr>
		<td><b>Don't link to unpopular sites</b></td>
		<td>There's a hot debate on this one, but from my research I've found linking to unpopular sites will decrease your pagerank.</td>
	</tr>
	<tr>
		<td><b>Use the google toolbar to determine pagerank for sites linking to you</b></td>
		<td>Pagerank is quite popular in determining how optimized your site is for google's search engine results.  Download the google toolbar at http://toolbar.google.com.  Then, when evaluating if you want to be listed at a particular directory, see what the pagerank is for the home page of the site and the particular page you want to get linked to from.  Pagerank is determined by how many sites link to a site, and how many sites link to a site which links to a site.  This is potentially google's most innovative, important technology.</td>
	</tr>
	<tr>
		<td><b>Put your keyword in internal links on your site pointing to each page that focuses on a particular keyword</b></td>
		<td>Same rationale as in the above tip.</td>
	</tr>
	<tr>
		<td><b>Put your keyword in your domain name</b></td>
		<td>This can boost your google ranking.</td>
	</tr>
	<tr>
		<td><b>Have quality content</b></td>
		<td>Google's algorithms are so amazingly fine tuned, that it appears they can tell if your site is quality or not via their automated spidering software.  Make it quality!</td>
	</tr>
	<tr>
			<td><b>Do not post your site on free for all links pages, or other low quality sites</b></td>
			<td>This can lower your pagerank, lowering your google rankings.</td>
	</tr>
		<tr>
			<td><b>Do not put extremely similar or identical content on multiple sites</b></td>
			<td>In google's terms of service, they tell you not to do this.  They don't want 10 results for a keyword all pointing to the same content.  Makes sense.</td>
		</tr>
		<tr>
			<td><b>Target unique keywords</b></td>
			<td>If you're trying to get a top ten ranking for words like search engine optimization, php, or web hosting, you will probably have a tough time.  Target keywords with a small number of google results returned for better chances of getting a top listing.</td>
		</tr>
		<tr>
			<td><b><a href="http://www.expertwebinstalls.com/search_engine_rankings.html">Check your search engine rankings in google with Search Engine Rankings software for Windows</a></b></td>
			<td>There is a windows program that uses the google API to check your search engine rankings for particular keywords related to certain URLs.  Since it uses the google API it is sanctioned by google to use.  Nearly all other programs to check your search engine rankings can potentially get not only your ip address but an entire block near your ip address on your ISP banned from using any of google's services.  It's actually happened before to some Comcast users.  This will never happen to you using this tool, because Google allows you to query their xml web service 1,000 times per day, which this tool does using SOAP.</td>
	</tr>
</table>

<h3><a name="ssel">Sponsored Search Engine Listings</h3>
<p>Purchasing paid sponsored search results from Google and Yahoo is an important step to your internet marketing
strategy.  To sign up for Google Adwords, go to <a href="http://adwords.google.com/">adwords.google.com</a> and create
an account.  To sign up for Yahoo Sponsored Listings go to <a href="http://www.overture.com">www.overture.com</a>.  Once
you create links in both of these programs, you can track the success of each ad in your campaign.  To do so, enter a
URL like this inside the google or overture tool where you tell them which page to link to when the user clicks an ad:
http://www.yourwebsite.com/ecommerce_shopping_cart_software/index.php?ad=nameofad where &quot;nameofad&quot; is
the ad that you would like to track.  Instead of simply typing 'google' use the exact keyword phrase you purchased prepended
with the name of the advertiser you bought the click from.  For instance: http://www.yourwebsite.com/ecommerce_shopping_cart_software/index.php?ad=google-red_nikes if
you were selling red Nike(tm)(R) shoes through google's adwords program.</p>
<p>In the Reports-&gt;Customers screen, you can see which advertising source produced each customer.  More importantly,
if you click Tools-&gt;Ad Tracker Results, you can see exactly which pay per click buys have produced the most gross profits for you.</p>

<h3><a name="n">Email Newsletters (also called Ezines)</h3>
<p>Newsletters are a useful way to promote your online store as well.  Go to google and search for newsletters relating
to your specific product/industry.  For instance, if you sell truck camper shells, search google for: &quot;truck accessories ezine&quot;, &quot;
truck accessories newsletter&quot;, &quot;camping newsletter&quot;, &quot;camping ezine&quot; etc.  You should use the
same words in this search that you use when you think of your target customers demographics (where they live / what they do)
and psychographics (what and how they think).  If you have yet to envision who your target customer is, where they live,
what they do, what they think, and how they think, do that now.  This will benefit you in all aspects of running
your business.
When you buy ads in each newsletter, make sure to track each buy by using the ad tracking url.  For instance:
http://www.yourwebsite.com/ecommerce_shopping_cart_software/index.php?ad=ezine-camping_fans.</p>

</div>

	<!-- End of marketing tutorial //-->
	</td>
<!-- products_attributes_eof //-->
</tr></table>
<!-- body_text_eof //-->
<!-- footer //-->
<? include(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<? include(DIR_WS_INCLUDES . 'application_bottom.php');?>
