<?php
// Standard theme
//
// kiwitrees: Web based Family History software
// Copyright (C) 2012 webtrees development team.
//
// Derived from PhpGedView and webtrees
// Copyright (C) 2002 to 2009 PGV Development Team
// Copyright (C) 2010 to 2013  webtrees Development Team.  All rights reserved.
//
// This is free software;you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
//
// PNG Icons By:Alessandro Rei; License: GPL; http://www.kde-look.org/content/show.php/Dark-Glass+reviewed?content=67902
//
// $Id: theme.php 14386 2012-10-03 17:35:05Z greg $

if (!defined('WT_WEBTREES')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

// Theme name - this needs double quotes, as file is scanned/parsed by script
$theme_name = "kiwitrees"; /* I18N: Name of a theme. */ WT_I18N::translate('kiwitrees');

$headerfile = WT_THEME_DIR.'header.php';
$footerfile = WT_THEME_DIR.'footer.php';

//- main icons
$WT_IMAGES = array(
	// used to draw charts
	'dline'          =>WT_THEME_URL.'images/dline.png',
	'dline2'         =>WT_THEME_URL.'images/dline2.png',
	'hline'          =>WT_THEME_URL.'images/hline.png',
	'spacer'         =>WT_THEME_URL.'images/spacer.png',
	'vline'          =>WT_THEME_URL.'images/vline.png',

	// used in button images and javascript
	'add'            =>WT_THEME_URL.'images/add.png',
	'button_family'  =>WT_THEME_URL.'images/buttons/family.png',
	'minus'          =>WT_THEME_URL.'images/minus.png',
	'plus'           =>WT_THEME_URL.'images/plus.png',
	'remove'         =>WT_THEME_URL.'images/remove.png',
	'search'         =>WT_THEME_URL.'images/search.png',

	// need different sizes before moving to CSS
	'default_image_M'=>WT_THEME_URL.'images/silhouette_male.png',
	'default_image_F'=>WT_THEME_URL.'images/silhouette_female.png',
	'default_image_U'=>WT_THEME_URL.'images/silhouette_unknown.png',
);

//-- pedigree chart variables
$bwidth = 270;			// width of boxes on pedigree chart
$bheight = 90;			// height of boxes on pedigree chart
$baseyoffset = 10;		// position the entire pedigree tree relative to the top of the page
$basexoffset = 10;		// position the entire pedigree tree relative to the left of the page
$bxspacing = 20;			// horizontal spacing between boxes on the pedigree chart
$byspacing = 30;			// vertical spacing between boxes on the pedigree chart
$linewidth = 1.5;			// width of joining lines
$shadowcolor = "";		// shadow color for joining lines
$shadowblur = 0;			// shadow blur for joining lines
$shadowoffsetX = 0;		// shadowOffsetX for joining lines
$shadowoffsetY = 0;		// shadowOffsetY for joining lines

// descendancy - relationship chart variables
$Dbaseyoffset = 20;		// position the entire descendancy tree relative to the top of the page
$Dbasexoffset = 20;		// position the entire descendancy tree relative to the left of the page
$Dbxspacing = 5;			// horizontal spacing between boxes
$Dbyspacing = 20;			// vertical spacing between boxes
$Dbwidth = 270;			// width of DIV layer boxes
$Dbheight = 90;			// height of DIV layer boxes
$Dindent = 15;			// width to indent descendancy boxes
$Darrowwidth = 30;		// additional width to include for the up arrows

// -- Dimensions for compact version of chart displays
$cbwidth = 240;
$cbheight = 60;

// --  The largest possible area for charts is 300,000 pixels, so the maximum height or width is 1000 pixels
$WT_STATS_S_CHART_X = 550;
$WT_STATS_S_CHART_Y = 200;
$WT_STATS_L_CHART_X = 900;
// --  For map charts, the maximum size is 440 pixels wide by 220 pixels high
$WT_STATS_MAP_X = 440;
$WT_STATS_MAP_Y = 220;

$WT_STATS_CHART_COLOR1 = "ffffff";
$WT_STATS_CHART_COLOR2 = "9ca3d4";
$WT_STATS_CHART_COLOR3 = "e5e6ef";

if (file_exists(WT_THEME_URL . 'mytheme.php')) {
	include 'mytheme.php';
}
