/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

function toggleBox(szDivID) {
  if (document.layers) { // NN4+
    if (document.layers[szDivID].visibility == 'visible') {
      document.layers[szDivID].visibility = "hide";
      document.layers[szDivID].display = "none";
      document.layers[szDivID+"SD"].fontWeight = "normal";
    } else {
      document.layers[szDivID].visibility = "show";
      document.layers[szDivID].display = "inline";
      document.layers[szDivID+"SD"].fontWeight = "bold";
    }
  } else if (document.getElementById) { // gecko(NN6) + IE 5+
    var obj = document.getElementById(szDivID);
    var objSD = document.getElementById(szDivID+"SD");

    if (obj.style.visibility == 'visible') {
      obj.style.visibility = "hidden";
      obj.style.display = "none";
      objSD.style.fontWeight = "normal";
    } else {
      obj.style.visibility = "visible";
      obj.style.display = "inline";
      objSD.style.fontWeight = "bold";
    }
  } else if (document.all) { // IE 4
    if (document.all[szDivID].style.visibility == 'visible') {
      document.all[szDivID].style.visibility = "hidden";
      document.all[szDivID].style.display = "none";
      document.all[szDivID+"SD"].style.fontWeight = "normal";
    } else {
      document.all[szDivID].style.visibility = "visible";
      document.all[szDivID].style.display = "inline";
      document.all[szDivID+"SD"].style.fontWeight = "bold";
    }
  }
}

function changeStyle(what, how) {
  if (document.getElementById) {
    document.getElementById(what).style.fontWeight = how;
  } else if (document.all) {
    document.all[what].style.fontWeight = how;
  }
}

function changeText(where, what) {
  if (document.getElementById) {
    document.getElementById(where).innerHTML = what;
  } else if (document.all) {
    document.all[where].innerHTML = what;
  }
}
