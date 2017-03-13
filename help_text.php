<?php
/**
 * Kiwitrees: Web based Family History software
 * Copyright (C) 2012 to 2017 kiwitrees.net
 *
 * Derived from webtrees (www.webtrees.net)
 * Copyright (C) 2010 to 2012 webtrees development team
 *
 * Derived from PhpGedView (phpgedview.sourceforge.net)
 * Copyright (C) 2002 to 2010 PGV Development Team
 *
 * Kiwitrees is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Kiwitrees.  If not, see <http://www.gnu.org/licenses/>.
 */

define('WT_SCRIPT_NAME', 'help_text.php');
require './includes/session.php';

$controller = new WT_Controller_Ajax();
global $WT_IMAGES;
$help=safe_GET('help');
switch ($help) {
	//////////////////////////////////////////////////////////////////////////////
	// This is a list of all known gedcom tags.  We list them all here so that
	// xgettext() may find them.
	//
	// Tags such as BIRT:PLAC are only used as labels, and do not require help
	// text.  These are only used for translating labels.
	//
	// Tags such as _BIRT_CHIL are pseudo-tags, used to create family events.
	//
	// Generally, these tags need to be lists explicitly in add_simple_tag()
	//////////////////////////////////////////////////////////////////////////////

case 'ADDR':
	$title = WT_Gedcom_Tag::getLabel('ADDR');
	$text = WT_I18N::translate('Enter the address into the field just as you would write it on an envelope.<br><br>Leave this field blank if you do not want to include an address.');
	break;

case 'AGNC':
	$title = WT_Gedcom_Tag::getLabel('AGNC');
	$text = WT_I18N::translate('The organization, institution, corporation, person, or other entity that has authority.<br><br>For example, an employer of a person, or a church that administered rites or events, or an organization responsible for creating and/or archiving records.');
	break;

case 'ASSO_1':
	$title = WT_Gedcom_Tag::getLabel('ASSO');
	$text = WT_I18N::translate('An associate is another individual who was involved with this individual, such as a friend or an employer.');
	break;

case 'ASSO_2':
	$title = WT_Gedcom_Tag::getLabel('ASSO');
	$text = WT_I18N::translate('An associate is another individual who was involved with this fact or event, such as a witness or a priest.');
	break;

case 'CAUS':
	$title = WT_Gedcom_Tag::getLabel('CAUS');
	$text = WT_I18N::translate('A description of the cause of the associated event or fact, such as the cause of death.');
	break;

case 'DATE':
	$title = WT_Gedcom_Tag::getLabel('DATE');
	$CALENDAR_FORMAT=null; // Don't perform conversions here - it will confuse the examples!
	$dates=array(
		'1900'                     =>new WT_Date('1900'),
		'JAN 1900'                 =>new WT_Date('JAN 1900'),
		'FEB 1900'                 =>new WT_Date('FEB 1900'),
		'MAR 1900'                 =>new WT_Date('MAR 1900'),
		'APR 1900'                 =>new WT_Date('APR 1900'),
		'MAY 1900'                 =>new WT_Date('MAY 1900'),
		'JUN 1900'                 =>new WT_Date('JUN 1900'),
		'JUL 1900'                 =>new WT_Date('JUL 1900'),
		'AUG 1900'                 =>new WT_Date('AUG 1900'),
		'SEP 1900'                 =>new WT_Date('SEP 1900'),
		'OCT 1900'                 =>new WT_Date('OCT 1900'),
		'NOV 1900'                 =>new WT_Date('NOV 1900'),
		'DEC 1900'                 =>new WT_Date('DEC 1900'),
		'11 DEC 1913'              =>new WT_Date('11 DEC 1913'),
		'01 FEB 2003'              =>new WT_Date('01 FEB 2003'),
		'ABT 1900'                 =>new WT_Date('ABT 1900'),
		'EST 1900'                 =>new WT_Date('EST 1900'),
		'CAL 1900'                 =>new WT_Date('CAL 1900'),
		'INT 1900 (...)'           =>new WT_Date('INT 1900 (...)'),
		'@#DJULIAN@ 44 B.C.'       =>new WT_Date('@#DJULIAN@ 44 B.C.'),
		'@#DJULIAN@ 14 JAN 1700'   =>new WT_Date('@#DJULIAN@ 14 JAN 1700'),
		'BET @#DJULIAN@ 01 SEP 1752 AND @#DGREGORIAN@ 30 SEP 1752'   =>new WT_Date('BET @#DJULIAN@ 01 SEP 1752 AND @#DGREGORIAN@ 30 SEP 1752'),
		'@#DJULIAN@ 20 FEB 1742/43'=>new WT_Date('@#DJULIAN@ 20 FEB 1742/43'),
		'FROM 1900 TO 1910'        =>new WT_Date('FROM 1900 TO 1910'),
		'FROM 1900'                =>new WT_Date('FROM 1900'),
		'TO 1910'                  =>new WT_Date('TO 1910'),
		'BET 1900 AND 1910'        =>new WT_Date('BET 1900 AND 1910'),
		'BET JAN 1900 AND MAR 1900'=>new WT_Date('BET JAN 1900 AND MAR 1900'),
		'BET APR 1900 AND JUN 1900'=>new WT_Date('BET APR 1900 AND JUN 1900'),
		'BET JUL 1900 AND SEP 1900'=>new WT_Date('BET JUL 1900 AND SEP 1900'),
		'BET OCT 1900 AND DEC 1900'=>new WT_Date('BET OCT 1900 AND DEC 1900'),
		'AFT 1900'                 =>new WT_Date('AFT 1900'),
		'BEF 1910'                 =>new WT_Date('BEF 1910'),
		// Hijri dates
		'@#DHIJRI@ 1497'           =>new WT_Date('@#DHIJRI@ 1497'),
		'@#DHIJRI@ MUHAR 1497'     =>new WT_Date('@#DHIJRI@ MUHAR 1497'),
		'ABT @#DHIJRI@ SAFAR 1497' =>new WT_Date('ABT @#DHIJRI@ SAFAR 1497'),
		'BET @#DHIJRI@ RABIA 1497 AND @#DHIJRI@ RABIT 1497'=>new WT_Date('BET @#DHIJRI@ RABIA 1497 AND @#DHIJRI@ RABIT 1497'),
		'FROM @#DHIJRI@ JUMAA 1497 TO @#DHIJRI@ JUMAT 1497'=>new WT_Date('FROM @#DHIJRI@ JUMAA 1497 TO @#DHIJRI@ JUMAT 1497'),
		'AFT @#DHIJRI@ RAJAB 1497' =>new WT_Date('AFT @#DHIJRI@ RAJAB 1497'),
		'BEF @#DHIJRI@ SHAAB 1497' =>new WT_Date('BEF @#DHIJRI@ SHAAB 1497'),
		'ABT @#DHIJRI@ RAMAD 1497' =>new WT_Date('ABT @#DHIJRI@ RAMAD 1497'),
		'FROM @#DHIJRI@ SHAWW 1497'=>new WT_Date('FROM @#DHIJRI@ SHAWW 1497'),
		'TO @#DHIJRI@ DHUAQ 1497'  =>new WT_Date('TO @#DHIJRI@ DHUAQ 1497'),
		'@#DHIJRI@ 03 DHUAH 1497'  =>new WT_Date('@#DHIJRI@ 03 DHUAH 1497'),
		// French dates
		'@#DFRENCH R@ 12'          =>new WT_Date('@#DFRENCH R@ 12'),
		'@#DFRENCH R@ VEND 12'     =>new WT_Date('@#DFRENCH R@ VEND 12'),
		'ABT @#DFRENCH R@ BRUM 12' =>new WT_Date('ABT @#DFRENCH R@ BRUM 12'),
		'BET @#DFRENCH R@ FRIM 12 AND @#DFRENCH R@ NIVO 12'=>new WT_Date('BET @#DFRENCH R@ FRIM 12 AND @#DFRENCH R@ NIVO 12'),
		'FROM @#DFRENCH R@ PLUV 12 TO @#DFRENCH R@ VENT 12'=>new WT_Date('FROM @#DFRENCH R@ PLUV 12 TO @#DFRENCH R@ VENT 12'),
		'AFT @#DFRENCH R@ GERM 12' =>new WT_Date('AFT @#DFRENCH R@ GERM 12'),
		'BEF @#DFRENCH R@ FLOR 12' =>new WT_Date('BEF @#DFRENCH R@ FLOR 12'),
		'ABT @#DFRENCH R@ PRAI 12' =>new WT_Date('ABT @#DFRENCH R@ PRAI 12'),
		'FROM @#DFRENCH R@ MESS 12'=>new WT_Date('FROM @#DFRENCH R@ MESS 12'),
		'TO @#DFRENCH R@ THER 12'  =>new WT_Date('TO @#DFRENCH R@ THER 12'),
		'EST @#DFRENCH R@ FRUC 12' =>new WT_Date('EST @#DFRENCH R@ FRUC 12'),
		'@#DFRENCH R@ 03 COMP 12'  =>new WT_Date('@#DFRENCH R@ 03 COMP 12'),
		// Jewish dates
		'@#DHEBREW@ 5481'          =>new WT_Date('@#DHEBREW@ 5481'),
		'@#DHEBREW@ TSH 5481'      =>new WT_Date('@#DHEBREW@ TSH 5481'),
		'ABT @#DHEBREW@ CSH 5481'  =>new WT_Date('ABT @#DHEBREW@ CSH 5481'),
		'BET @#DHEBREW@ KSL 5481 AND @#DHEBREW@ TVT 5481'=>new WT_Date('BET @#DHEBREW@ KSL 5481 AND @#DHEBREW@ TVT 5481'),
		'FROM @#DHEBREW@ SHV 5481 TO @#DHEBREW@ ADR 5481'=>new WT_Date('FROM @#DHEBREW@ SHV 5481 TO @#DHEBREW@ ADR 5481'),
		'AFT @#DHEBREW@ ADR 5481'  =>new WT_Date('AFT @#DHEBREW@ ADR 5481'),
		'AFT @#DHEBREW@ ADS 5480'  =>new WT_Date('AFT @#DHEBREW@ ADS 5480'),
		'BEF @#DHEBREW@ NSN 5481'  =>new WT_Date('BEF @#DHEBREW@ NSN 5481'),
		'ABT @#DHEBREW@ IYR 5481'  =>new WT_Date('ABT @#DHEBREW@ IYR 5481'),
		'FROM @#DHEBREW@ SVN 5481' =>new WT_Date('FROM @#DHEBREW@ SVN 5481'),
		'TO @#DHEBREW@ TMZ 5481'   =>new WT_Date('TO @#DHEBREW@ TMZ 5481'),
		'EST @#DHEBREW@ AAV 5481'  =>new WT_Date('EST @#DHEBREW@ AAV 5481'),
		'@#DHEBREW@ 03 ELL 5481'   =>new WT_Date('@#DHEBREW@ 03 ELL 5481'),
	);

	foreach ($dates as &$date) {
		$date=strip_tags($date->Display());
	}
	// These shortcuts work differently for different languages
	switch (preg_replace('/[^DMY]/', '', str_replace(array('J', 'F'), array('D', 'M'), strtoupper($DATE_FORMAT)))) {
	case 'YMD':
		$example1='11/12/1913'; // Note: we ignore the DMY order if it doesn't make sense.
		$example2='03/02/01';
		break;
	case 'MDY':
		$example1='12/11/1913';
		$example2='02/01/03';
		break;
	case 'DMY':
	default:
		$example1='11/12/1913';
		$example2='01/02/03';
		break;
	}
	$example1.='<br/>'.str_replace('/', '-', $example1).'<br/>'.str_replace('/', '.', $example1);
	$example2.='<br/>'.str_replace('/', '-', $example2).'<br/>'.str_replace('/', '.', $example2);
	$text =
		'<p>'.WT_I18N::translate('Dates are stored using English abbreviations and keywords.  Shortcuts are available as alternatives to these abbreviations and keywords.').'</p>'.
		'<table border="1">'.
		'<tr><th>'.WT_I18N::translate('Date').'</th><th>'.WT_I18N::translate('Format').'</th><th>'.WT_I18N::translate('Shortcut').'</th></tr>'.
		'<tr><td>'.$dates['1900'].'</td><td><tt dir="ltr" lang="en">1900</tt></td><td>&nbsp;</td></tr>'.
		'<tr><td>'.$dates['JAN 1900'].'<br/>'.$dates['FEB 1900'].'<br/>'.$dates['MAR 1900'].'<br/>'.$dates['APR 1900'].'<br/>'.$dates['MAY 1900'].'<br/>'.$dates['JUN 1900'].'<br/>'.$dates['JUL 1900'].'<br/>'.$dates['AUG 1900'].'<br/>'.$dates['SEP 1900'].'<br/>'.$dates['OCT 1900'].'<br/>'.$dates['NOV 1900'].'<br/>'.$dates['DEC 1900'].'</td><td><tt dir="ltr" lang="en">JAN 1900<br/>FEB 1900<br/>MAR 1900<br/>APR 1900<br/>MAY 1900<br/>JUN 1900<br/>JUL 1900<br/>AUG 1900<br/>SEP 1900<br/>OCT 1900<br/>NOV 1900<br/>DEC 1900</tt></td><td>&nbsp;</td></tr>'.
		'<tr><td>'.$dates['11 DEC 1913'].'</td><td><tt dir="ltr" lang="en">11 DEC 1913</tt></td><td><tt dir="ltr" lang="en">'.$example1.'</tt></td></tr>'.
		'<tr><td>'.$dates['01 FEB 2003'].'</td><td><tt dir="ltr" lang="en">01 FEB 2003</tt></td><td><tt dir="ltr" lang="en">'.$example2.'</tt></td></tr>'.
		'<tr><td>'.$dates['ABT 1900'].'</td><td><tt dir="ltr" lang="en">ABT 1900</tt></td><td><tt dir="ltr" lang="en">~1900</tt></td></tr>'.
		'<tr><td>'.$dates['EST 1900'].'</td><td><tt dir="ltr" lang="en">EST 1900</tt></td><td><tt dir="ltr" lang="en">*1900</tt></td></tr>'.
		'<tr><td>'.$dates['CAL 1900'].'</td><td><tt dir="ltr" lang="en">CAL 1900</tt></td><td><tt dir="ltr" lang="en">#1900</tt></td></tr>'.
		'<tr><td>'.$dates['INT 1900 (...)'].'</td><td><tt dir="ltr" lang="en">INT 1900 (...)</tt></td><td>&nbsp;</td></tr>'.
		'</table>'.
		'<p>'.WT_I18N::translate('Date ranges are used to indicate that an event, such as a birth, happened on a unknown date within a possible range.').'</p>'.
		'<table border="1">'.
		'<tr><th>'.WT_I18N::translate('Date range').'</th><th>'.WT_I18N::translate('Format').'</th><th>'.WT_I18N::translate('Shortcut').'</th></tr>'.
		'<tr><td>'.$dates['BET 1900 AND 1910'].'</td><td><tt dir="ltr" lang="en">BET 1900 AND 1910</tt></td><td><tt dir="ltr" lang="en">1900-1910</tt></td></tr>'.
		'<tr><td>'.$dates['AFT 1900'].'</td><td><tt dir="ltr" lang="en">AFT 1900</tt></td><td><tt dir="ltr" lang="en">&gt;1900</tt></td></tr>'.
		'<tr><td>'.$dates['BEF 1910'].'</td><td><tt dir="ltr" lang="en">BEF 1910</tt></td><td><tt dir="ltr" lang="en">&lt;1910</tt></td></tr>'.
		'<tr><td>'.$dates['BET JAN 1900 AND MAR 1900'].'</td><td><tt dir="ltr" lang="en">BET JAN 1900 AND MAR 1900</tt></td><td><tt dir="ltr" lang="en">Q1 1900</tt></td></tr>'.
		'<tr><td>'.$dates['BET APR 1900 AND JUN 1900'].'</td><td><tt dir="ltr" lang="en">BET APR 1900 AND JUN 1900</tt></td><td><tt dir="ltr" lang="en">Q2 1900</tt></td></tr>'.
		'<tr><td>'.$dates['BET JUL 1900 AND SEP 1900'].'</td><td><tt dir="ltr" lang="en">BET JUL 1900 AND SEP 1900</tt></td><td><tt dir="ltr" lang="en">Q3 1900</tt></td></tr>'.
		'<tr><td>'.$dates['BET OCT 1900 AND DEC 1900'].'</td><td><tt dir="ltr" lang="en">BET OCT 1900 AND DEC 1900</tt></td><td><tt dir="ltr" lang="en">Q4 1900</tt></td></tr>'.
		'</table>'.
		'<p>'.WT_I18N::translate('Date periods are used to indicate that a fact, such as an occupation, continued for a period of time.').'</p>'.
		'<table border="1">'.
		'<tr><th>'.WT_I18N::translate('Date period').'</th><th>'.WT_I18N::translate('Format').'</th><th>'.WT_I18N::translate('Shortcut').'</th></tr>'.
		'<tr><td>'.$dates['FROM 1900 TO 1910'].'</td><td><tt dir="ltr" lang="en">FROM 1900 TO 1910</tt></td><td><tt dir="ltr" lang="en">1900~1910</tt></td></tr>'.
		'<tr><td>'.$dates['FROM 1900'].'</td><td><tt dir="ltr" lang="en">FROM 1900</tt></td><td><tt dir="ltr" lang="en">1900-</tt></td></tr>'.
		'<tr><td>'.$dates['TO 1910'].'</td><td><tt dir="ltr" lang="en">TO 1910</tt></td><td><tt dir="ltr" lang="en">-1900</tt></td></tr>'.
		'</table>'.
		'<p>'.WT_I18N::translate('Simple dates are assumed to be in the gregorian calendar.  To specify a date in another calendar, add a keyword before the date.  This keyword is optional if the month or year format make the date unambiguous.').'</p>'.
		'<table border="1">'.
		'<tr><th>'.WT_I18N::translate('Date').'</th><th>'.WT_I18N::translate('Format').'</th></tr>'.
		'<tr><td colspan="2" align="center">'.WT_I18N::translate('Julian').'</td></tr>'.
		'<tr><td>'.$dates['@#DJULIAN@ 14 JAN 1700'].'</td><td><tt dir="ltr" lang="en">@#DJULIAN@ 14 JAN 1700</tt></td></tr>'.
		'<tr><td>'.$dates['@#DJULIAN@ 44 B.C.'].'</td><td><tt dir="ltr" lang="en">@#DJULIAN@ 44 B.C.</tt></td></tr>'.
		'<tr><td>'.$dates['@#DJULIAN@ 20 FEB 1742/43'].'</td><td><tt dir="ltr" lang="en">@#DJULIAN@ 20 FEB 1742/43</tt></td></tr>'.
		'<tr><td>'.$dates['BET @#DJULIAN@ 01 SEP 1752 AND @#DGREGORIAN@ 30 SEP 1752'].'</td><td><tt dir="ltr" lang="en">BET @#DJULIAN@ 01 SEP 1752 AND @#DGREGORIAN@ 30 SEP 1752</tt></td></tr>'.
		'<tr><td colspan="2" align="center">'.WT_I18N::translate('Jewish').'</td></tr>'.
		'<tr><td>'.$dates['@#DHEBREW@ 5481'].'</td><td><tt dir="ltr" lang="en">@#DHEBREW@ 5481</tt></td></tr>'.
		'<tr><td>'.$dates['@#DHEBREW@ TSH 5481'].'</td><td><tt dir="ltr" lang="en">@#DHEBREW@ TSH 5481</tt></td></tr>'.
		'<tr><td>'.$dates['ABT @#DHEBREW@ CSH 5481'].'</td><td><tt dir="ltr" lang="en">ABT @#DHEBREW@ CSH 5481</tt></td></tr>'.
		'<tr><td>'.$dates['BET @#DHEBREW@ KSL 5481 AND @#DHEBREW@ TVT 5481'].'</td><td><tt dir="ltr" lang="en">BET @#DHEBREW@ KSL 5481 AND @#DHEBREW@ TVT 5481</tt></td></tr>'.
		'<tr><td>'.$dates['FROM @#DHEBREW@ SHV 5481 TO @#DHEBREW@ ADR 5481'].'</td><td><tt dir="ltr" lang="en">FROM @#DHEBREW@ SHV 5481 TO @#DHEBREW@ ADR 5481</tt></td></tr>'.
		'<tr><td>'.$dates['AFT @#DHEBREW@ ADR 5481'].'</td><td><tt dir="ltr" lang="en">AFT @#DHEBREW@ ADR 5481</tt></td></tr>'.
		'<tr><td>'.$dates['AFT @#DHEBREW@ ADS 5480'].'</td><td><tt dir="ltr" lang="en">AFT @#DHEBREW@ ADS 5480</tt></td></tr>'.
		'<tr><td>'.$dates['BEF @#DHEBREW@ NSN 5481'].'</td><td><tt dir="ltr" lang="en">BEF @#DHEBREW@ NSN 5481</tt></td></tr>'.
		'<tr><td>'.$dates['ABT @#DHEBREW@ IYR 5481'].'</td><td><tt dir="ltr" lang="en">ABT @#DHEBREW@ IYR 5481</tt></td></tr>'.
		'<tr><td>'.$dates['FROM @#DHEBREW@ SVN 5481'].'</td><td><tt dir="ltr" lang="en">FROM @#DHEBREW@ SVN 5481</tt></td></tr>'.
		'<tr><td>'.$dates['TO @#DHEBREW@ TMZ 5481'].'</td><td><tt dir="ltr" lang="en">TO @#DHEBREW@ TMZ 5481</tt></td></tr>'.
		'<tr><td>'.$dates['EST @#DHEBREW@ AAV 5481'].'</td><td><tt dir="ltr" lang="en">EST @#DHEBREW@ AAV 5481</tt></td></tr>'.
		'<tr><td>'.$dates['@#DHEBREW@ 03 ELL 5481'].'</td><td><tt dir="ltr" lang="en">@#DHEBREW@ 03 ELL 5481</tt></td></tr>'.
		'<tr><td colspan="2" align="center">'.WT_I18N::translate('Hijri').'</td></tr>'.
		'<tr><td>'.$dates['@#DHIJRI@ 1497'].'</td><td><tt dir="ltr" lang="en">@#DHIJRI@ 1497</tt></td></tr>'.
		'<tr><td>'.$dates['@#DHIJRI@ MUHAR 1497'].'</td><td><tt dir="ltr" lang="en">@#DHIJRI@ MUHAR 1497</tt></td></tr>'.
		'<tr><td>'.$dates['ABT @#DHIJRI@ SAFAR 1497'].'</td><td><tt dir="ltr" lang="en">ABT @#DHIJRI@ SAFAR 1497</tt></td></tr>'.
		'<tr><td>'.$dates['BET @#DHIJRI@ RABIA 1497 AND @#DHIJRI@ RABIT 1497'].'</td><td><tt dir="ltr" lang="en">BET @#DHIJRI@ RABIA 1497 AND @#DHIJRI@ RABIT 1497</tt></td></tr>'.
		'<tr><td>'.$dates['FROM @#DHIJRI@ JUMAA 1497 TO @#DHIJRI@ JUMAT 1497'].'</td><td><tt dir="ltr" lang="en">FROM @#DHIJRI@ JUMAA 1497 TO @#DHIJRI@ JUMAT 1497</tt></td></tr>'.
		'<tr><td>'.$dates['AFT @#DHIJRI@ RAJAB 1497'].'</td><td><tt dir="ltr" lang="en">AFT @#DHIJRI@ RAJAB 1497</tt></td></tr>'.
		'<tr><td>'.$dates['BEF @#DHIJRI@ SHAAB 1497'].'</td><td><tt dir="ltr" lang="en">BEF @#DHIJRI@ SHAAB 1497</tt></td></tr>'.
		'<tr><td>'.$dates['ABT @#DHIJRI@ RAMAD 1497'].'</td><td><tt dir="ltr" lang="en">ABT @#DHIJRI@ RAMAD 1497</tt></td></tr>'.
		'<tr><td>'.$dates['FROM @#DHIJRI@ SHAWW 1497'].'</td><td><tt dir="ltr" lang="en">FROM @#DHIJRI@ SHAWW 1497</tt></td></tr>'.
		'<tr><td>'.$dates['TO @#DHIJRI@ DHUAQ 1497'].'</td><td><tt dir="ltr" lang="en">TO @#DHIJRI@ DHUAQ 1497</tt></td></tr>'.
		'<tr><td>'.$dates['@#DHIJRI@ 03 DHUAH 1497'].'</td><td><tt dir="ltr" lang="en">@#DHIJRI@ 03 DHUAH 1497</tt></td></tr>'.
		'<tr><td colspan="2" align="center">'.WT_I18N::translate('French').'</td></tr>'.
		'<tr><td>'.$dates['@#DFRENCH R@ 12'].'</td><td><tt dir="ltr" lang="en">@#DFRENCH R@ 12</tt></td></tr>'.
		'<tr><td>'.$dates['@#DFRENCH R@ VEND 12'].'</td><td><tt dir="ltr" lang="en">@#DFRENCH R@ VEND 12</tt></td></tr>'.
		'<tr><td>'.$dates['ABT @#DFRENCH R@ BRUM 12'].'</td><td><tt dir="ltr" lang="en">ABT @#DFRENCH R@ BRUM 12</tt></td></tr>'.
		'<tr><td>'.$dates['BET @#DFRENCH R@ FRIM 12 AND @#DFRENCH R@ NIVO 12'].'</td><td><tt dir="ltr" lang="en">BET @#DFRENCH R@ FRIM 12 AND @#DFRENCH R@ NIVO 12</tt></td></tr>'.
		'<tr><td>'.$dates['FROM @#DFRENCH R@ PLUV 12 TO @#DFRENCH R@ VENT 12'].'</td><td><tt dir="ltr" lang="en">FROM @#DFRENCH R@ PLUV 12 TO @#DFRENCH R@ VENT 12</tt></td></tr>'.
		'<tr><td>'.$dates['AFT @#DFRENCH R@ GERM 12'].'</td><td><tt dir="ltr" lang="en">AFT @#DFRENCH R@ GERM 12</tt></td></tr>'.
		'<tr><td>'.$dates['BEF @#DFRENCH R@ FLOR 12'].'</td><td><tt dir="ltr" lang="en">BEF @#DFRENCH R@ FLOR 12</tt></td></tr>'.
		'<tr><td>'.$dates['ABT @#DFRENCH R@ PRAI 12'].'</td><td><tt dir="ltr" lang="en">ABT @#DFRENCH R@ PRAI 12</tt></td></tr>'.
		'<tr><td>'.$dates['FROM @#DFRENCH R@ MESS 12'].'</td><td><tt dir="ltr" lang="en">FROM @#DFRENCH R@ MESS 12</tt></td></tr>'.
		'<tr><td>'.$dates['TO @#DFRENCH R@ THER 12'].'</td><td><tt dir="ltr" lang="en">TO @#DFRENCH R@ THER 12</tt></td></tr>'.
		'<tr><td>'.$dates['EST @#DFRENCH R@ FRUC 12'].'</td><td><tt dir="ltr" lang="en">EST @#DFRENCH R@ FRUC 12</tt></td></tr>'.
		'<tr><td>'.$dates['@#DFRENCH R@ 03 COMP 12'].'</td><td><tt dir="ltr" lang="en">@#DFRENCH R@ 03 COMP 12</tt></td></tr>'.
		'</table>';
	break;

case 'EMAI':
case 'EMAIL':
case 'EMAL':
case '_EMAIL':
	$title = WT_Gedcom_Tag::getLabel('EMAIL');
	$text = WT_I18N::translate('Enter the email address.<br><br>An example email address looks like this: <b>name@hotmail.com</b>  Leave this field blank if you do not want to include an email address.');
	break;

case 'FAX':
	$title = WT_Gedcom_Tag::getLabel('FAX');
	$text = WT_I18N::translate('Enter the FAX number including the country and area code.<br><br>Leave this field blank if you do not want to include a FAX number.  For example, a number in Germany might be +49 25859 56 76 89 and a number in USA or Canada might be +1 888 555-1212.');
	break;

// This help text is used for all NAME components
case 'NAME':
	$title = WT_Gedcom_Tag::getLabel('NAME');
	$text =
		'<p>' .
		WT_I18N::translate('The <b>name</b> field contains the individual’s full name, as they would have spelled it or as it was recorded.  This is how it will be displayed on screen.  It uses standard genealogical annotations to identify different parts of the name.') .
		'</p>' .
		'<ul><li>' .
		WT_I18N::translate('The surname is enclosed by slashes: <%s>John Paul /Smith/<%s>', 'span style="color:#0000ff;"', '/span') .
		'</li><li>' .
		WT_I18N::translate('If the surname is unknown, use empty slashes: <%s>Mary //<%s>', 'span style="color:#0000ff;"', '/span') .
		'</li><li>' .
		WT_I18N::translate('If an individual has two separate surnames, both should be enclosed by slashes: <%s>José Antonio /Gómez/ /Iglesias/<%s>', 'span style="color:#0000ff;"', '/span') .
		'</li><li>' .
		WT_I18N::translate('If an individual does not have a surname, no slashes are needed: <%s>Jón Einarsson<%s>', 'span style="color:#0000ff;"', '/span') .
		'</li><li>' .
		WT_I18N::translate('If an individual was not known by their first given name, the preferred name should be indicated with an asterisk: <%s>John Paul* /Smith/<%s>', 'span style="color:#0000ff;"', '/span') .
		'</li><li>' .
		WT_I18N::translate('If an individual was known by a nickname which is not part of their formal name, it should be enclosed by quotation marks.  For example, <%s>John "Nobby" /Clark/<%s>.', 'span style="color:#0000ff;"', '/span') .
		'</li></ul>';
	break;

case 'SURN':
	$title = WT_Gedcom_Tag::getLabel('SURN');
	$text = '<p>' .
		WT_I18N::translate('The <b>surname</b> field contains a name that is used for sorting and grouping.  It can be different to the individual’s actual surname which is always taken from the <b>name</b> field.  This field can be used to sort surnames with or without a prefix (Gogh / van Gogh) and to group spelling variations or inflections (Kowalski / Kowalska).  If an individual needs to be listed under more than one surname, each name should be separated by a comma.') .
		'</p>';
	break;

case '_MARNM_SURN':
	$title = WT_Gedcom_Tag::getLabel('_MARNM_SURN');
	$text = WT_I18N::translate('Use this field to add a married name. Enter the surname only. Each time a married name is added an extra Married Surname line will be created for subsequent additional married names.');
	break;

case 'NOTE':
	$title = WT_Gedcom_Tag::getLabel('NOTE');
	$text = WT_I18N::translate('Notes are free-form text and will appear in the Fact Details section of the page.');
	break;

case 'OBJE':
	$title = WT_Gedcom_Tag::getLabel('OBJE');
	$text =
		'<p>'.
		WT_I18N::translate('A media object is a record in the family tree which contains information about a media file.  This information may include a title, a copyright notice, a transcript, privacy restrictions, etc.  The media file, such as the photo or video, can be stored locally (on this webserver) or remotely (on a different webserver).').
		'</p>';
	break;

case 'PAGE':
	$title = WT_Gedcom_Tag::getLabel('PAGE');
	$text = WT_I18N::translate('In the Citation Details field you would enter the page number or other information that might help someone find the information in the source.');
	break;

case 'PEDI':
	$title = WT_Gedcom_Tag::getLabel('PEDI');
	$text = WT_I18N::translate('A child may have more than one set of parents.  The relationship between the child and the parents can be biological, legal, or based on local culture and tradition.  If no pedigree is specified, then a biological relationship will be assumed.');
	break;

case 'PHON':
	$title = WT_Gedcom_Tag::getLabel('PHON');
	$text = WT_I18N::translate('Enter the phone number including the country and area code.<br><br>Leave this field blank if you do not want to include a phone number.  For example, a number in Germany might be +49 25859 56 76 89 and a number in USA or Canada might be +1 888 555-1212.');
	break;

case 'PLAC':
	$title = WT_Gedcom_Tag::getLabel('PLAC');
	$text = WT_I18N::translate('Places should be entered according to the standards for genealogy.  In genealogy, places are recorded with the most specific information about the place first and then working up to the least specific place last, using commas to separate the different place levels.  The level at which you record the place information should represent the levels of government or church where vital records for that place are kept.<br><br>For example, a place like Salt Lake City would be entered as "Salt Lake City, Salt Lake, Utah, USA".<br><br>Let\'s examine each part of this place.  The first part, "Salt Lake City," is the city or township where the event occurred.  In some countries, there may be municipalities or districts inside a city which are important to note.  In that case, they should come before the city.  The next part, "Salt Lake," is the county.  "Utah" is the state, and "USA" is the country.  It is important to note each place because genealogical records are kept by the governments of each level.<br><br>If a level of the place is unknown, you should leave a space between the commas.  Suppose, in the example above, you didn\'t know the county for Salt Lake City.  You should then record it like this: "Salt Lake City, , Utah, USA".  Suppose you only know that a person was born in Utah.  You would enter the information like this: ", , Utah, USA".  <br><br>You can use the <b>Find Place</b> link to help you find places that already exist in the database.');
	break;

case 'RELA':
	$title = WT_Gedcom_Tag::getLabel('RELA');
	$text = WT_I18N::translate('Select a relationship name from the list. Selecting <b>Godfather</b> means: <i>This associate is the Godfather of the current individual</i>.');
	break;

case 'RESN':
	$title = WT_Gedcom_Tag::getLabel('RESN');
	$text =
		WT_I18N::translate('Restrictions can be added to records and/or facts.  They restrict who can view the data and who can edit it.').
		'<br><br>'.
		WT_I18N::translate('Note that if a user account is linked to a record, then that user will always be able to view that record.');
	break;

case 'ROMN':
	$title = WT_Gedcom_Tag::getLabel('ROMN');
	$text = WT_I18N::translate('In many cultures it is customary to have a traditional name spelled in the traditional characters and also a romanized version of the name as it would be spelled or pronounced in languages based on the Latin alphabet, such as English.<br><br>If you prefer to use a non-Latin alphabet such as Hebrew, Greek, Russian, Chinese, or Arabic to enter the name in the standard name fields, then you can use this field to enter the same name using the Latin alphabet.  Both versions of the name will appear in lists and charts.<br><br>Although this field is labeled "Romanized", it is not restricted to containing only characters based on the Latin alphabet.  This might be of use with Japanese names, where three different alphabets may occur.');
	break;

case 'SEX':
	$title = WT_Gedcom_Tag::getLabel('SEX');
	$text = WT_I18N::translate('Choose the appropriate gender from the drop-down list.  The <b>unknown</b> option indicates that the gender is unknown.');
	break;

case 'SOUR':
	$title = WT_Gedcom_Tag::getLabel('SOUR');
	$text = WT_I18N::translate('This field allows you to change the source record that this fact\'s source citation links to.  This field takes a Source ID.  Beside the field will be listed the title of the current source ID.  Use the <b>Find ID</b> link to look up the source\'s ID number.  To remove the entire citation, make this field blank.');
	break;

case 'STAT':
	$title = WT_Gedcom_Tag::getLabel('STAT');
	$text = WT_I18N::translate('This is an optional status field and is used mostly for LDS ordinances as they are run through the TempleReady program.');
	break;

case 'TEMP':
	$title = WT_Gedcom_Tag::getLabel('TEMP');
	$text = WT_I18N::translate('For LDS ordinances, this field records the Temple where it was performed.');
	break;

case 'TEXT':
	$title = WT_Gedcom_Tag::getLabel('TEXT');
	$text = WT_I18N::translate('In this field you would enter the citation text for this source.  Examples of data may be a transcription of the text from the source, or a description of what was in the citation.');
	break;

case 'TIME':
	$title = WT_Gedcom_Tag::getLabel('TIME');
	$text = WT_I18N::translate('Enter the time for this event in 24-hour format with leading zeroes. Midnight is 00:00. Examples: 04:50 13:00 20:30.');
	break;

case 'URL':
	$title = WT_Gedcom_Tag::getLabel('URL');
	$text = WT_I18N::translate('Enter the URL address including the http://.<br><br>An example URL looks like this: <b>http://www.kiwitrees.net/</b> Leave this field blank if you do not want to include a URL.');
	break;

case '_HEB':
	$title = WT_Gedcom_Tag::getLabel('_HEB');
	$text = WT_I18N::translate('In many cultures it is customary to have a traditional name spelled in the traditional characters and also a romanized version of the name as it would be spelled or pronounced in languages based on the Latin alphabet, such as English.<br><br>If you prefer to use the Latin alphabet to enter the name in the standard name fields, then you can use this field to enter the same name in the non-Latin alphabet such as Greek, Hebrew, Russian, Arabic, or Chinese.  Both versions of the name will appear in lists and charts.<br><br>Although this field is labeled "Hebrew", it is not restricted to containing only Hebrew characters.');
	break;

case '_PRIM':
	$title = WT_Gedcom_Tag::getLabel('_PRIM');
	$text = WT_I18N::translate('Use this field to signal that this media item is the highlighted or primary item for the person it is attached to.  The highlighted image is the one that will be used on charts and on the Individual page.');
	break;

case 'CHECK_MARRIAGE_RELATIONS':
	$title = WT_I18N::translate('Check relationships by marriage');
	$text = WT_I18N::translate('When calculating relationships, this option controls whether kiwitrees will include spouses/partners as well as blood relatives.');
	break;

case 'GEDCOM_MEDIA_PATH':
	$title = WT_I18N::translate('GEDCOM media path');
	$text =
		'<p>'.
		// I18N: A “path” is something like “C:\Documents\My_User\Genealogy\Photos\Gravestones\John_Smith.jpeg”
		WT_I18N::translate('Some genealogy applications create GEDCOM files that contain media filenames with full paths.  These paths will not exist on the web-server.  To allow kiwitrees to find the file, the first part of the path must be removed.').
		'</p><p>'.
		// I18N: %s are all folder names; “GEDCOM media path” is a configuration setting
		WT_I18N::translate('For example, if the GEDCOM file contains %1$s and kiwitrees expects to find %2$s in the media folder, then the GEDCOM media path would be %3$s.', '<span class="filename">/home/fab/documents/family/photo.jpeg</span>', '<span class="filename">family/photo.jpeg</span>', '<span class="filename">/home/fab/documents/</span>').
		'</p><p>'.
		WT_I18N::translate('This setting is only used when you read or write GEDCOM files.').
		'</p>';
	break;

case 'RELATIONSHIP_PATH_LENGTH':
	$title = WT_I18N::translate('Restrict to immediate family');
	$text =
		WT_I18N::translate('Where a user is associated to an individual record in a family tree and has a role of member, editor, or moderator, you can prevent them from accessing the details of distant, living relations.  You specify the number of relationship steps that the user is allowed to see.').
		'<br/><br/>'.
		WT_I18N::translate('For example, if you specify a path length of 2, the person will be able to see their grandson (child, child), their aunt (parent, sibling), their step-daughter (spouse, child), but not their first cousin (parent, sibling, child).').
		'<br/><br/>'.
		WT_I18N::translate('Note: longer path lengths require a lot of calculation, which can make your site run slowly for these users.');
	break;

case 'add_facts':
	$title = WT_I18N::translate('Add a fact');
	$text = WT_I18N::translate('Here you can add a fact to the record being edited.<br><br>First choose a fact from the drop-down list, then click the <b>Add</b> button.  All possible facts that you can add to the database are in that drop-down list.');
	$text.='<br/><br/>';
	$text.='<b>'.WT_I18N::translate('Add from clipboard').'</b>';
	$text.='<br/><br/>';
	$text.=WT_I18N::translate('Kiwitrees allows you to copy up to 10 facts, with all their details, to a clipboard.  This clipboard is different from the Clippings Cart that you can use to export portions of your database.<br><br>You can select any of the facts from the clipboard and copy the selected fact to the Individual, Family, Media, Source, or Repository record currently being edited.  However, you cannot copy facts of dissimilar record types.  For example, you cannot copy a Marriage fact to a Source or an Individual record since the Marriage fact is associated only with Family records.<br><br>This is very helpful when entering similar facts, such as census facts, for many individuals or families.');
	break;

case 'add_note':
	// This is a general help text for multiple pages
	$title = WT_I18N::translate('Add a note');
	$text = WT_I18N::translate('If you have a note to add to this record, this is the place to do so.<br><br>Just click the link, a window will open, and you can type your note.  When you are finished typing, just click the button below the box, close the window, and that\'s all.');
	break;

case 'add_shared_note':
	// This is a general help text for multiple pages
	$title = WT_I18N::translate('Add a shared note');
	$text = WT_I18N::translate('When you click the <b>Add a Shared Note</b> link, a new window will open.  You can choose to link to an existing shared note, or you can create a new shared note and at the same time create a link to it.');
	break;

case 'add_source':
	// This is a general help text for multiple pages
	$title = WT_I18N::translate('Add a source citation');
	$text = WT_I18N::translate('Here you can add a source <b>Citation</b> to this record.<br><br>Just click the link, a window will open, and you can choose the source from the list (Find ID) or create a new source and then add the Citation.<br><br>Adding sources is an important part of genealogy because it allows other researchers to verify where you obtained your information.');
	break;

case 'annivers_year_select':
	$title = WT_I18N::translate('Year input box');
	$text = WT_I18N::translate('This input box lets you change that year of the calendar.  Type a year into the box and press <b>Enter</b> to change the calendar to that year.<br><br><b>Advanced features</b> for <b>View Year</b><dl><dt><b>More than one year</b></dt><dd>You can search for dates in a range of years.<br><br>Year ranges are <u>inclusive</u>.  This means that the date range extends from 1 January of the first year of the range to 31 December of the last year mentioned.  Here are a few examples of year ranges:<br><br><b>1992-5</b> for all events from 1992 to 1995.<br><b>1972-89</b> for all events from 1972 to 1989.<br><b>1610-759</b> for all events from 1610 to 1759.<br><b>1880-1905</b> for all events from 1880 to 1905.<br><b>880-1105</b> for all events from 880 to 1105.<br><br>To see all the events in a given decade or century, you can use <b>?</b> in place of the final digits. For example, <b>197?</b> for all events from 1970 to 1979 or <b>16??</b> for all events from 1600 to 1699.<br><br/>Selecting a range of years will change the calendar to the year view.</dd></dl>');
	break;

case 'apply_privacy':
	$title = WT_I18N::translate('Apply privacy settings?');
	$text = WT_I18N::translate('This option will remove private data from the downloaded GEDCOM file.  The file will be filtered according to the privacy settings that apply to each access level.  Privacy settings are specified on the GEDCOM configuration page.');
	break;

case 'block_move_right':
	$title = WT_I18N::translate('Move list entries');
	$text = WT_I18N::translate('Use these buttons to move an entry from one list to another.<br><br>Highlight the entry to be moved, and then click a button to move or copy that entry in the direction of the arrow.  Use the <b>&raquo;</b> and <b>&laquo;</b> buttons to move the highlighted entry from the leftmost to the rightmost list or vice-versa.  Use the <b>&gt;</b> and <b>&lt;</b> buttons to move the highlighted entry between the Available Blocks list and the list to its right or left.<br><br>The entries in the Available Blocks list do not change, regardless of what you do with the Move Right and Move Left buttons.  This is so because the same block can appear several times on the same page.  The HTML block is a good example of why you might want to do this.');
	break;

case 'block_move_up':
	$title = WT_I18N::translate('Move list entries');
	$text = WT_I18N::translate('Use these buttons to re-arrange the order of the entries within the list.  The blocks will be printed in the order in which they are listed.<br><br>Highlight the entry to be moved, and then click a button to move that entry up or down.');
	break;

case 'default_individual':
	$title = WT_I18N::translate('Default individual');
	$text = WT_I18N::translate('This individual will be selected by default when viewing charts and reports.');
	break;

case 'edit_add_GEDFact_ASSISTED':
	$title = WT_I18N::translate('GEDFact shared note assistant');
	$text = WT_I18N::translate('Clicking the "+" icon will open the GEDFact Shared Note Assistant window.<br>Specific help will be found there.<br><br>When you click the "Save" button, the ID of the Shared Note will be pasted here.');
	break;

case 'edit_edit_raw':
	$title = WT_I18N::translate('Edit raw GEDCOM record');
	$text =
		WT_I18N::translate('This page allows you to bypass the usual forms, and edit the underlying data directly.  It is an advanced option, and you should not use it unless you understand the GEDCOM format.  If you make a mistake here, it can be difficult to fix.').
		'<br/><br/>'.
		/* I18N: %s is a URL */ WT_I18N::translate('You can download a copy of the GEDCOM specification from %s.', '<a href="http://kiwitrees.net/wp-content/uploads/2016/03/ged551-5.pdf">http://kiwitrees.net/wp-content/uploads/2016/03/ged551-5.pdf</a>');
	break;

case 'edit_merge':
	$title = WT_I18N::translate('Merge records');
	$text = WT_I18N::translate('This page will allow you to merge two GEDCOM records from the same GEDCOM file.<br><br>This is useful for people who have merged GEDCOMs and now have many people, families, and sources that are the same.<br><br>The page consists of three steps.<br><ol><li>You enter two GEDCOM IDs.  The IDs <u>must</u> be of the same type.  You cannot merge an individual and a family or family and source, for example.<br>In the <b>Merge To ID:</b> field enter the ID of the record you want to be the new record after the merge is complete.<br>In the <b>Merge From ID:</b> field enter the ID of the record whose information will be merged into the Merge To ID: record.  This record will be deleted after the Merge.</li><li>You select what facts you want to keep from the two records when they are merged.  Just click the checkboxes next to the ones you want to keep.</li><li>You inspect the results of the merge, just like with all other changes made online.</li></ol>Someone with Accept rights will have to authorize your changes to make them permanent.');
	break;

case 'edit_SOUR_EVEN':
	$title = WT_I18N::translate('Associate events with this source');
	$text = WT_I18N::translate('Each source records specific events, generally for a given date range and for a place jurisdiction.  For example a Census records census events and church records record birth, marriage, and death events.<br><br>Select the events that are recorded by this source from the list of events provided. The date should be specified in a range format such as <i>FROM 1900 TO 1910</i>. The place jurisdiction is the name of the lowest jurisdiction that encompasses all lower-level places named in this source. For example, "Oneida, Idaho, USA" would be used as a source jurisdiction place for events occurring in the various towns within Oneida County. "Idaho, USA" would be the source jurisdiction place if the events recorded took place not only in Oneida County but also in other counties in Idaho.');
	break;

case 'edituser_contact_meth':
	$title = WT_I18N::translate('Preferred contact method');
	$text = WT_I18N::translate('Kiwitrees has several different contact methods.  The administrator determines which method will be used to contact him.  You have control over the method to be used to contact <u>you</u>.  Depending on site configuration, some of the listed methods may not be available to you.');
	$text.='<br/><br/><dl><dt>';
	$text.=WT_I18N::translate('Internal messaging');
	$text.='</dt><dd>';
	$text.=WT_I18N::translate('With this option, the kiwitrees internal messaging system will be used and no emails will be sent.<br><br>You will receive only <u>internal</u> messages from the other users.  When another site user sends you a message, that message will appear in the Message block if it is included among your widgets.  If you have removed this block from your widget bar, you will not see any messages.  They will, however, show up as soon as you configure the widget bar to again have the Message block.');
	$text.='</dd><dt>';
	$text.=WT_I18N::translate('Internal messaging with emails');
	$text.='</dt><dd>';
	$text.=WT_I18N::translate('This option is like kiwitrees internal messaging, with one addition.  As an extra, a copy of the message will also be sent to the email address you configured on your Account page.<br><br>This is the default contact method.');
	$text.='</dd><dt>';
	$text.=WT_I18N::translate('Mailto link');
	$text.='</dt><dd>';
	$text.=WT_I18N::translate('With this option, you will only receive email messages at the address you configured on your Account page.  The messaging system internal to kiwitrees will not be used at all, and there will never be any messages in the Message block on your widget bar.');
	$text.='</dd><dt>';
	$text.=WT_I18N::translate('No contact method');
	$text.='</dt><dd>';
	$text.=WT_I18N::translate('With this option, you will not receive any messages.  Even the administrator will not be able to reach you.');
	$text.='</dd></dl>';
	break;

case 'edituser_contact_meth_short':
	$title = WT_I18N::translate('Preferred contact method');
	$text = WT_I18N::translate('Kiwitrees has several different contact methods.  The administrator determines which method will be used to contact him.  You have control over the method to be used to contact <u>you</u>.  Depending on site configuration, some of the listed methods may not be available to you.');
	break;

case 'edituser_gedcomid':
	$title = WT_I18N::translate('Individual record');
	$text = WT_I18N::translate('This is a link to your own record in the family tree.  If this is the wrong person, contact an administrator.');
	break;

case 'email':
	$title = WT_I18N::translate('Email address');
	$text = WT_I18N::translate('This email address will be used to send you password reminders, site notifications, and messages from other family members who are registered on the site.');
	break;

case 'fambook_descent':
	$title = WT_I18N::translate('Descendant generations');
	$text = WT_I18N::translate('This value determines the number of descendant generations of the root person that will be printed in Hourglass format.');
	break;

case 'fan_width':
	$title = WT_I18N::translate('Width');
	$text = WT_I18N::translate('Here you can change the diagram width from 50 percent to 300 percent.  At 100 percent the output image is about 640 pixels wide.');
	break;

case 'gedcom_news_archive':
	$title = WT_I18N::translate('View archive');
	$text = WT_I18N::translate('To reduce the height of the News block, the administrator has hidden some articles.  You can reveal these hidden articles by clicking the <b>View archive</b> link.');
	break;

case 'gedcom_news_flag':
	$title = WT_I18N::translate('Limit:');
	$text = WT_I18N::translate('Enter the limiting value here.<br><br>If you have opted to limit the News article display according to age, any article older than the number of days entered here will be hidden from view.  If you have opted to limit the News article display by number, only the specified number of recent articles, ordered by age, will be shown.  The remaining articles will be hidden from view.<br><br>Zeros entered here will disable the limit, causing all News articles to be shown.');
	break;

case 'gedcom_news_limit':
	$title = WT_I18N::translate('Limit display by:');
	$text = WT_I18N::translate('You can limit the number of News articles displayed, thereby reducing the height of the GEDCOM News block.<br><br>This option determines whether any limits should be applied or whether the limit should be according to the age of the article or according to the number of articles.');
	break;

case 'google_chart_surname':
	$title = WT_I18N::translate('Surname');
	$text = WT_I18N::translate('The number of occurrences of the specified name will be shown on the map. If you leave this field empty, the most common surname will be used.');
	break;

case 'header_favorites':
	$title = WT_I18N::translate('Favorites');
	$text = WT_I18N::translate('The Favorites drop-down list shows the favorites that you have selected on your widget bar.  It also shows the favorites that the site administrator has selected for the currently active GEDCOM.  Clicking on one of the favorites entries will take you directly to the Individual Information page of that person.<br><br>More help about adding Favorites is available in your widget bar.');
	break;

case 'include_media':
	$title = WT_I18N::translate('Include media (automatically zips files)');
	$text = WT_I18N::translate('Select this option to include the media files associated with the records in your clippings cart.  Choosing this option will automatically zip the files during download.');
	break;

case 'lifespan_chart':
	$title = WT_I18N::translate('Lifespans');
	$text = WT_I18N::translate('On this chart you can display one or more persons along a horizontal timeline.  This chart allows you to see how the lives of different people overlapped.<br><br>You can add people to the chart individually or by family groups by their IDs.  The previous list will be remembered as you add more people to the chart.  You can clear the chart at any time with the <b>Clear Chart</b> button.<br><br>You can also add people to the chart by searching for them by date range or locality.');
	break;

case 'next_path':
	$title = WT_I18N::translate('Find next relationship path');
	$text = WT_I18N::translate('You can click this button to see whether there is another relationship path between the two people.  Previously found paths can be displayed again by clicking the link with the path number.');
	break;

case 'no_update_CHAN':
	$title = WT_I18N::translate('Do not update the “last change” record');
	$text = WT_I18N::translate('Administrators sometimes need to clean up and correct the data submitted by users.<br>When Administrators make such corrections information about the original change is replaced.<br>When this option is selected kiwitrees will retain the original change information instead of replacing it.');
	break;

case 'oldest_top':
	$title = WT_I18N::translate('Show oldest top');
	$text = WT_I18N::translate('When this check box is checked, the chart will be printed with oldest people at the top.  When it is unchecked, youngest people will appear at the top.');
	break;

case 'password':
	$title = WT_I18N::translate('Password');
	$text = WT_I18N::translate('Leave password blank if you want to keep the current password.<br>Passwords must be at least 6 characters long and are case-sensitive, so that “secret” is different to “SECRET”.');
	break;

case 'password_confirm':
	$title = WT_I18N::translate('Confirm password');
	$text = WT_I18N::translate('Type your password again, to make sure you have typed it correctly.');
	break;

case 'PGV_WIZARD':
	$title = WT_I18N::translate('PhpGedView to kiwitrees transfer wizard');
	$text =WT_I18N::translate('The PGV to kiwitrees wizard is an automated process to assist administrators make the move from a PGV installation to a new kiwitrees one. It will transfer all PGV GEDCOM and other database information directly to your new kiwitrees database. The following requirements are necessary:');
	$text .= '<ul><li>';
	$text .= WT_I18N::translate('kiwitrees database must be on the same server as PGV\'s');
	$text .= '</li><li>';
	$text .= WT_I18N::translate('PGV must be version 4.2.3, or any SVN up to #6973');
	$text .= '</li><li>';
	$text .= WT_I18N::translate('All changes in PGV must be accepted');
	$text .= '</li><li>';
	$text .= WT_I18N::translate('You must export your latest GEDCOM data');
	$text .= '</li><li>';
	$text .= WT_I18N::translate('The current kiwitrees admin username must be the same as an existing PGV admin username');
	$text .= '</li><li>';
	$text .= WT_I18N::translate('All existing PGV users must have distinct email addresses');
	$text .= '</li></ul><p>';
	$text .= WT_I18N::translate('<b>Important Note:</b> The transfer wizard is not able to assist with moving media items. You will need to set up and move or copy your media configuration and objects separately after the transfer wizard is finished.');
	$text .= '</p>';
	break;

case 'phpinfo':
	$title = WT_I18N::translate('PHP information');
	$text = WT_I18N::translate('This page provides extensive information about the server on which kiwitrees is being hosted.  Many configuration details about the server\'s software, as it relates to PHP and kiwitrees, can be viewed.');
	break;

case 'pending_changes':
	$title = WT_I18N::translate('Pending changes');
	$text =
		'<p>'.
		WT_I18N::translate('When you add, edit, or delete information, the changes are not saved immediately.  Instead, they are kept in a “pending” area.  These pending changes need to be reviewed by a moderator before they are accepted.').
		'</p><p>'.
		WT_I18N::translate('This process allows the site’s owner to ensure that the new information follows the site’s standards and conventions, has proper source attributions, etc.').
		'</p><p>'.
		WT_I18N::translate('Pending changes are only shown when your account has permission to edit.  When you log out, you will no longer be able to see them.  Also, pending changes are only shown on certain pages.  For example, they are not shown in lists, reports, or search results.').
		'</p>';
	if (WT_USER_IS_ADMIN) {
		$text.=
			'<p>'.
			WT_I18N::translate('Each user account has an option to “automatically accept changes”.  When this is enabled, any changes made by that user are saved immediately.  Many administrators enable this for their own user account.').
			'</p>';
	}

	break;

case 'ppp_view_records':
	$title = WT_I18N::translate('View all records');
	$text = WT_I18N::translate('Clicking on this link will show you a list of all of the individuals and families that have events occurring in this place.  When you get to the end of a place hierarchy, which is normally a town or city, the name list will be shown automatically.');
	break;

case 'real_name':
	$title = WT_I18N::translate('Real name');
	$text = WT_I18N::translate('This is your real name, as you would like it displayed on screen.');
	break;

case 'register_comments':
	$title = WT_I18N::translate('Comments');
	$text = WT_I18N::translate('Use this field to tell the site administrator why you are requesting an account and how you are related to the genealogy displayed on this site.  You can also use this to enter any other comments you may have for the site administrator.');
	break;

case 'register_gedcomid':
	$title = WT_I18N::translate('Individual record');
	$text = WT_I18N::translate('Every person in the database has a unique ID number on this site.  If you know the ID number for your own record, please enter it here.  If you don\'t know your ID number or could not find it because of privacy settings, please provide enough information in the Comments field to help the site administrator identify who you are on this site so that he can set the ID for you.');
	break;

case 'remove_person':
	$title = WT_I18N::translate('Remove person');
	$text = WT_I18N::translate('Click this link to remove the person from the timeline.');
	break;

case 'role':
	$title = WT_I18N::translate('Role');
	$text =
		WT_I18N::translate('A role is a set of access rights, which give permission to view data, change configuration settings, etc.  Access rights are assigned to roles, and roles are granted to users.  Each family tree can assign different access to each role, and users can have a different role in each family tree.').
		'<br/><br>'.
		'<dl>'.
		'<dt>'.WT_I18N::translate('Visitor').'</dt><dd>'.
		WT_I18N::translate('Everybody has this role, including visitors to the site and search engines.').
		'</dd>'.
		'<dl>'.
		'<dt>'.WT_I18N::translate('Member').'</dt><dd>'.
		WT_I18N::translate('This role has all the permissions of the visitor role, plus any additional access granted by the family tree configuration.').
		'</dd>'.
		'<dl>'.
		'<dt>'.WT_I18N::translate('Editor').'</dt><dd>'.
		WT_I18N::translate('This role has all the permissions of the member role, plus permission to add/change/delete data.  Any changes will need to be approved by a moderator, unless the user has the "automatically accept changes" option enabled.').
		'</dd>'.
		'<dl>'.
		'<dt>'.WT_I18N::translate('Moderator').'</dt><dd>'.
		WT_I18N::translate('This role has all the permissions of the editor role, plus permission to approve/reject changes made by other users.').
		'</dd>'.
		'<dl>'.
		'<dt>'.WT_I18N::translate('Manager').'</dt><dd>'.
		WT_I18N::translate('This role has all the permissions of the moderator role, plus any additional access granted by the family tree configuration, plus permission to change the settings/configuration of a family tree.').
		'</dd>'.
		'<dl>'.
		'<dt>'.WT_I18N::translate('Administrator').'</dt><dd>'.
		WT_I18N::translate('This role has all the permissions of the manager role in all family trees, plus permission to change the settings/configuration of the site, users and modules.').
		'</dd>';
	break;

case 'show_fact_sources':
	$title = WT_I18N::translate('Show all sources');
	$text = WT_I18N::translate('When this option is checked, you can see all Source or Note records for this person.  When this option is unchecked, Source or Note records that are associated with other facts for this person will not be shown.');
	break;

case 'show_spouse':
	$title = WT_I18N::translate('Show spouses');
	$text = WT_I18N::translate('By default this chart does not show spouses for the descendants because it makes the chart harder to read and understand.  Turning this option on will show spouses on the chart.');
	break;

case 'simple_filter':
	$title = WT_I18N::translate('Simple search filter');
	$text = WT_I18N::translate('Simple search filter based on the characters entered, no wildcards are accepted.');
	break;

case 'upload_gedcom':
	$title = WT_I18N::translate('Upload family tree');
	$text = WT_I18N::translate('This option deletes all the genealogy data in your family tree and replaces it with data from a GEDCOM file on your computer.');
	break;

case 'upload_media_file':
	$title = WT_I18N::translate('Media file to upload');
	$text =
		WT_I18N::translate('Select the media file that you want to upload.  If a file already exists with the same name, it will be overwritten.').
		'<br/><br/>'.
		WT_I18N::translate('It is easier to manage your media files if you choose a consistent format for the filenames.  To organise media files into folders, you must first set the number of levels in the GEDCOM administration page.');
	break;

case 'upload_media':
	$title = WT_I18N::translate('Upload media files');
	$text = WT_I18N::translate('Upload one or more media files from your local computer.  Media files can be pictures, video, audio, or other formats.');
	break;

case 'upload_server_folder':
	$title = WT_I18N::translate('Folder name on server');
	$text =
		'<p>' .
		WT_I18N::translate('If you have a large number of media files, you can organize them into folders and subfolders.') .
		'</p>';
	break;

case 'upload_thumbnail_file':
	$title = WT_I18N::translate('Thumbnail to upload');
	$text = WT_I18N::translate('Choose the thumbnail image that you want to upload.  Although thumbnails can be generated automatically for images, you may wish to generate your own thumbnail, especially for other media types.  For example, you can provide a still image from a video, or a photograph of the person who made an audio recording.');
	break;

case 'useradmin_auto_accept':
	$title = WT_I18N::translate('Automatically approve changes made by this user');
	$text = WT_I18N::translate('Normally, any changes made to a family tree need to be approved by a moderator.  This option allows a user to make changes without needing a moderator\'s approval.');
	break;

case 'useradmin_gedcomid':
	$title = WT_I18N::translate('Individual record');
	$text = WT_I18N::translate('The individual record identifies the user in each family tree.  Since a user can view the details of their individual record, this can only be set by an administrator.  If the user does not have a record in a family tree, leave it empty.');
	break;

case 'useradmin_verification':
	$title = WT_I18N::translate('Account approval and email verification');
	$text = WT_I18N::translate('When a user registers for an account, an email is sent to their email address with a verification link.  When they click this link, we know the email address is correct, and the "email verified" option is selected automatically.').
		'<br/><br/>'.
		WT_I18N::translate('If an administrator creates a user account, the verification email is not sent, and the email must be verified manually.').
		'<br/><br/>'.
		WT_I18N::translate('You should not approve an account unless you know that the email address is correct.').
		'<br/><br/>'.
		WT_I18N::translate('A user will not be able to login until both the "email verified" and "approved by administrator" options are selected.');
	break;

case 'useradmin_visibleonline':
	$title = WT_I18N::translate('Visible online');
	$text = WT_I18N::translate('This checkbox controls your visibility to other users while you\'re online.  It also controls your ability to see other online users who are configured to be visible.<br><br>When this box is unchecked, you will be completely invisible to others, and you will also not be able to see other online users.  When this box is checked, exactly the opposite is true.  You will be visible to others, and you will also be able to see others who are configured to be visible.');
	break;

case 'username':
	$title = WT_I18N::translate('Username');
	$text =
		'<p>'.
		WT_I18N::translate('Usernames are case-insensitive and ignore accented letters, so that “chloe”, “chloë”, and “Chloe” are considered to be the same.').
		'</p><p>'.
		WT_I18N::translate('Usernames may not contain the following characters: &lt; &gt; " %% { } ;').
		'</p>';
	break;

case 'utf8_ansi':
	$title = WT_I18N::translate('Convert from UTF-8 to ANSI');
	$text = WT_I18N::translate('Kiwitrees uses UTF-8 encoding for accented letters, special characters and non-latin scripts. If you want to use this GEDCOM file with genealogy software that does not support UTF-8, then you can create it using ISO-8859-1 encoding.');
	break;

case 'zip':
	$title = WT_I18N::translate('Zip clippings');
	$text = WT_I18N::translate('Select this option as to save your clippings in a ZIP file.  For more information about ZIP files, please visit <a href="http://www.winzip.com" target="_blank" rel="noopener noreferrer">http://www.winzip.com</a>.');
	break;

default:
	$title = WT_I18N::translate('Help');
	$text = WT_I18N::translate('The help text has not been written for this item.');
	// If we've been called from a module, allow the module to provide the help text
	$mod=safe_GET('mod', '[A-Za-z0-9_]+');
	if (file_exists(WT_ROOT.WT_MODULES_DIR.$mod.'/help_text.php')) {
		require WT_ROOT.WT_MODULES_DIR.$mod.'/help_text.php';
	}
	break;
}

$controller->pageHeader();

echo '<div class="helpheader">', $title, '</div>';
echo '<div class="help_content">', $text,'</div>';
