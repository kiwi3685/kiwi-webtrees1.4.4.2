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

if (!defined('WT_WEBTREES')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

// change resource module names to report
try {
	self::exec("UPDATE `##module` SET `module_name` = REPLACE(`module_name`, 'resource_', 'report_') WHERE field LIKE '%resource_%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
try {
	self::exec("UPDATE `##module` SET `module_name` = REPLACE(`module_name`, 'no_census', 'report_ukcensus') WHERE field LIKE '%no_census%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
try {
	self::exec("UPDATE `##module` SET `module_name` = REPLACE(`module_name`, 'uk_register', 'report_ukregister') WHERE field LIKE '%uk_register%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
try {
	self::exec("UPDATE `##module_privacy` SET `module_name` = REPLACE(`module_name`, 'resource_', 'report_') WHERE field LIKE '%resource_%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
try {
	self::exec("UPDATE `##module_privacy` SET `module_name` = REPLACE(`module_name`, 'no_census', 'report_ukcensus') WHERE field LIKE '%no_census%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
try {
	self::exec("UPDATE `##module_privacy` SET `module_name` = REPLACE(`module_name`, 'uk_register', 'report_ukregister') WHERE field LIKE '%uk_register%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
try {
	self::exec("UPDATE `##module_privacy` SET `component` = REPLACE(`component`, 'resource', 'report') WHERE field LIKE '%resource%'");
} catch (PDOException $ex) {
	// Perhaps we have already deleted this data?
}
// remove resource to module_privacy components
self::exec("ALTER TABLE `##module_privacy` CHANGE component component ENUM('block', 'chart', 'menu', 'report', 'sidebar', 'tab', 'theme', 'widget')");
// add resource to module_privacy components
self::exec("ALTER TABLE `##module_privacy` CHANGE component component ENUM('block', 'chart', 'list', 'menu', 'report', 'sidebar', 'tab', 'widget', 'resource')");
// remove old resource settings
self::exec("DELETE FROM `##module_privacy` WHERE `module_name` like '%resource_%'");
self::exec("DELETE FROM `##module` WHERE `module_name` like '%resource_%'");
// enable all reports
self::exec("UPDATE `##module` SET `status` = 'enabled' WHERE `module_name` like '%report_%'");

// Update the version to indicate success
WT_Site::preference($schema_name, $next_version);