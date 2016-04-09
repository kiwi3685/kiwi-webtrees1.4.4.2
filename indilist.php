<?php
// Individual List
//
// NOTE: indilist.php and famlist.php contain mostly identical code.
// Updates to one file almost certainly need to be made to the other one as well.
//
// Kiwitrees: Web based Family History software
// Copyright (C) 2016 kiwitrees.net
//
// Derived from webtrees
// Copyright (C) 2012 webtrees development team
//
// Derived from PhpGedView
// Copyright (C) 2002 to 2010  PGV Development Team
//
// This program is free software; you can redistribute it and/or modify
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

define('WT_SCRIPT_NAME', 'indilist.php');
require './includes/session.php';
require_once WT_ROOT.'includes/functions/functions_print_lists.php';

$controller=new WT_Controller_Page();

// We show three different lists: initials, surnames and individuals
// Note that the data may contain special chars, such as surname="<unknown>",
$alpha   =safe_GET('alpha', WT_REGEX_UNSAFE); // All surnames beginning with this letter where "@"=unknown and ","=none
$surname =safe_GET('surname', WT_REGEX_UNSAFE); // All indis with this surname.  NB - allow ' and "
$show_all=safe_GET('show_all', array('no','yes'), 'no'); // All indis
// Long lists can be broken down by given name
$show_all_firstnames=safe_GET('show_all_firstnames', array('no','yes'), 'no');
if ($show_all_firstnames=='yes') {
	$falpha='';
} else {
	$falpha=safe_GET('falpha'); // All first names beginning with this letter
}

$show_marnm=get_user_setting(WT_USER_ID, WT_SCRIPT_NAME.'_show_marnm');
switch (safe_GET('show_marnm', array('no','yes'))) {
case 'no':
	$show_marnm=false;
	if (WT_USER_ID) {
		set_user_setting(WT_USER_ID, WT_SCRIPT_NAME.'_show_marnm', $show_marnm);
	}
	break;
case 'yes':
	$show_marnm=true;
	if (WT_USER_ID) {
		set_user_setting(WT_USER_ID, WT_SCRIPT_NAME.'_show_marnm', $show_marnm);
	}
	break;
}

// Make sure selections are consistent.
// i.e. can't specify show_all and surname at the same time.
if ($show_all=='yes') {
	if ($show_all_firstnames=='yes') {
		$alpha='';
		$surname='';
		$legend=WT_I18N::translate('All');
		$url=WT_SCRIPT_NAME.'?show_all=yes&amp;ged='.WT_GEDURL;
		$show='indi';
	} else	if ($falpha) {
		$alpha='';
		$surname='';
		$legend=WT_I18N::translate('All').', '.htmlspecialchars($falpha).'…';
		$url=WT_SCRIPT_NAME.'?show_all=yes&amp;ged='.WT_GEDURL;
		$show='indi';
	} else {
		$alpha='';
		$surname='';
		$legend=WT_I18N::translate('All');
		$url=WT_SCRIPT_NAME.'?show_all=yes'.'&amp;ged='.WT_GEDURL;
		$show=safe_GET('show', array('surn', 'indi'), 'surn');
	}
} elseif ($surname) {
	$alpha=WT_Query_Name::initialLetter($surname); // so we can highlight the initial letter
	$show_all='no';
	if ($surname=='@N.N.') {
		$legend=$UNKNOWN_NN;
	} else {
		$legend=htmlspecialchars($surname);
		// The surname parameter is a root/canonical form.
		// Display it as the actual surname
		foreach (WT_Query_Name::surnames($surname, $alpha, $show_marnm === 'yes', false, WT_GED_ID) as $details) {
			$legend = implode('/', array_keys($details));
		}
	}
	$url=WT_SCRIPT_NAME.'?surname='.rawurlencode($surname).'&amp;ged='.WT_GEDURL;
	switch($falpha) {
	case '':
		break;
	case '@':
		$legend.=', '.$UNKNOWN_PN;
		$url.='&amp;falpha='.rawurlencode($falpha).'&amp;ged='.WT_GEDURL;
		break;
	default:
		$legend.=', '.htmlspecialchars($falpha).'…';
		$url.='&amp;falpha='.rawurlencode($falpha).'&amp;ged='.WT_GEDURL;
		break;
	}
	$show='indi'; // SURN list makes no sense here
} elseif ($alpha=='@') {
	$show_all='no';
	$legend=$UNKNOWN_NN;
	$url=WT_SCRIPT_NAME.'?alpha='.rawurlencode($alpha).'&amp;ged='.WT_GEDURL;
	$show='indi'; // SURN list makes no sense here
} elseif ($alpha==',') {
	$show_all='no';
	$legend=WT_I18N::translate('None');
	$url=WT_SCRIPT_NAME.'?alpha='.rawurlencode($alpha).'&amp;ged='.WT_GEDURL;
	$show='indi'; // SURN list makes no sense here
} elseif ($alpha) {
	$show_all='no';
	$legend=htmlspecialchars($alpha).'…';
	$url=WT_SCRIPT_NAME.'?alpha='.rawurlencode($alpha).'&amp;ged='.WT_GEDURL;
	$show=safe_GET('show', array('surn', 'indi'), 'surn');
} else {
	$show_all='no';
	$legend='…';
	$url=WT_SCRIPT_NAME.'?ged='.WT_GEDURL;
	$show='none'; // Don't show lists until something is chosen
}
$legend='<span dir="auto">'.$legend.'</span>';

$controller
	->setPageTitle(WT_I18N::translate('Individuals').' : '.$legend)
	->pageHeader();

echo '
	<div id="indilist-page">
		<h2 class="center">', WT_I18N::translate('Individuals'), '</h2>';

		// Print a selection list of initial letters
		$list=array();
		foreach (WT_Query_Name::surnameAlpha($show_marnm, false, WT_GED_ID) as $letter=>$count) {
			switch ($letter) {
			case '@':
				$html=$UNKNOWN_NN;
				break;
			case ',':
				$html=WT_I18N::translate('None');
				break;
			default:
				$html=htmlspecialchars($letter);
				break;
			}
			if ($count) {
				if ($letter==$alpha) {
					$list[]='<a href="'.WT_SCRIPT_NAME.'?alpha='.rawurlencode($letter).'&amp;ged='.WT_GEDURL.'" class="warning" title="'.$count.'">'.$html.'</a>';
				} else {
					$list[]='<a href="'.WT_SCRIPT_NAME.'?alpha='.rawurlencode($letter).'&amp;ged='.WT_GEDURL.'" title="'.$count.'">'.$html.'</a>';
				}
			} else {
				$list[]=$html;
			}
		}

		// Search spiders don't get the "show all" option as the other links give them everything.
		if (!$SEARCH_SPIDER) {
			if ($show_all=='yes') {
				$list[]='<span class="warning">'.WT_I18N::translate('All').'</span>';
			} else {
				$list[]='<a href="'.WT_SCRIPT_NAME.'?show_all=yes'.'&amp;ged='.WT_GEDURL.'">'.WT_I18N::translate('All').'</a>';
			}
		}
		echo '<p class="center alpha_index">', join(' | ', $list), '</p>';

		// Search spiders don't get an option to show/hide the surname sublists,
		// nor does it make sense on the all/unknown/surname views
		if (!$SEARCH_SPIDER) {
			echo '<p class="center">';
				if ($show!='none') {
					if ($show_marnm) {
						echo '<a href="', $url, '&amp;show='.$show.'&amp;show_marnm=no">', WT_I18N::translate('Exclude individuals with “%s” as a married name', $legend), '</a>';
					} else {
						echo '<a href="', $url, '&amp;show='.$show.'&amp;show_marnm=yes">', WT_I18N::translate('Include individuals with “%s” as a married name', $legend), '</a>';
					}

					if ($alpha!='@' && $alpha!=',' && !$surname) {
						if ($show=='surn') {
							echo '<br><a href="', $url, '&amp;show=indi">', WT_I18N::translate('Show the list of individuals'), '</a>';
						} else {
							echo '<br><a href="', $url, '&amp;show=surn">', WT_I18N::translate('Show the list of surnames'), '</a>';
						}
					}
				}
			echo '</p>';
		}

		if ($show=='indi' || $show=='surn') {
			$surns=WT_Query_Name::surnames($surname, $alpha, $show_marnm, false, WT_GED_ID);
			if ($show=='surn') {
				// Show the surname list
				switch ($SURNAME_LIST_STYLE) {
				case 'style1';
					echo format_surname_list($surns, 3, true, WT_SCRIPT_NAME);
					break;
				case 'style3':
					echo format_surname_tagcloud($surns, WT_SCRIPT_NAME, true);
					break;
				case 'style2':
				default:
					echo format_surname_table($surns, WT_SCRIPT_NAME);
					break;
				}
			} else {
				// Show the list
				$count=0;
				foreach ($surns as $surnames) {
					foreach ($surnames as $list) {
						$count+=count($list);
					}
				}
				// Don't sublists short lists.
				if ($count<get_gedcom_setting(WT_GED_ID, 'SUBLIST_TRIGGER_I')) {
					$falpha='';
					$show_all_firstnames='no';
				} else {
					$givn_initials=WT_Query_Name::givenAlpha($surname, $alpha, $show_marnm, false, WT_GED_ID);
					// Break long lists by initial letter of given name
					if ($surname || $show_all=='yes') {
						// Don't show the list until we have some filter criteria
						$show=($falpha || $show_all_firstnames=='yes') ? 'indi' : 'none';
						$list=array();
						foreach ($givn_initials as $givn_initial=>$count) {
							switch ($givn_initial) {
							case '@':
								$html=$UNKNOWN_PN;
								break;
							default:
								$html=htmlspecialchars($givn_initial);
								break;
							}
							if ($count) {
								if ($show=='indi' && $givn_initial==$falpha && $show_all_firstnames=='no') {
									$list[]='<a class="warning" href="'.$url.'&amp;falpha='.rawurlencode($givn_initial).'" title="'.$count.'">'.$html.'</a>';
								} else {
									$list[]='<a href="'.$url.'&amp;falpha='.rawurlencode($givn_initial).'" title="'.$count.'">'.$html.'</a>';
								}
							} else {
								$list[]=$html;
							}
						}
						// Search spiders don't get the "show all" option as the other links give them everything.
						if (!$SEARCH_SPIDER) {
							if ($show_all_firstnames=='yes') {
								$list[]='<span class="warning">'.WT_I18N::translate('All').'</span>';
							} else {
								$list[]='<a href="'.$url.'&amp;show_all_firstnames=yes">'.WT_I18N::translate('All').'</a>';
							}
						}
						if ($show_all=='no') {
							echo '<h2 class="center">', WT_I18N::translate('Individuals with surname %s', $legend), '</h2>';
						}
						echo '<p class="center alpha_index">', join(' | ', $list), '</p>';
					}
				}
				if ($show=='indi') {
					echo format_indi_table(
						WT_Query_Name::individuals($surname, $alpha, $falpha, $show_marnm, false, WT_GED_ID)
					);
				}
			}
		}
	echo '</div>';
