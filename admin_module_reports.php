<?php
// Module Administration User Interface.
//
// Kiwitrees: Web based Family History software
// Copyright (C) 2016 kiwitrees.net
//
// Derived from webtrees
// Copyright (C) 2012 webtrees development team
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

define('WT_SCRIPT_NAME', 'admin_module_reports.php');
require 'includes/session.php';
require WT_ROOT.'includes/functions/functions_edit.php';

$controller = new WT_Controller_Page();
$controller
	->requireAdminLogin()
	->setPageTitle(WT_I18N::translate('Module administration'))
	->pageHeader();

$modules=WT_Module::getActiveReports(WT_GED_ID, WT_PRIV_HIDE);

$action = safe_POST('action');

if ($action=='update_mods' && WT_Filter::checkCsrf()) {
	foreach ($modules as $module_name=>$module) {
		foreach (WT_Tree::getAll() as $tree) {
			$value = safe_POST("access-{$module_name}-{$tree->tree_id}", WT_REGEX_INTEGER, $module->defaultAccessLevel());
			WT_DB::prepare(
				"REPLACE INTO `##module_privacy` (module_name, gedcom_id, component, access_level) VALUES (?, ?, 'report', ?)"
			)->execute(array($module_name, $tree->tree_id, $value));
		}
	}
}

?>
<div id="reports"
	<form method="post" action="<?php echo WT_SCRIPT_NAME; ?>">
		<input type="hidden" name="action" value="update_mods">
		<?php echo WT_Filter::getCsrf(); ?>
		<table id="reports_table" class="modules_table">
			<thead>
				<tr>
					<th><?php echo WT_I18N::translate('Report'); ?></th>
					<th><?php echo WT_I18N::translate('Description'); ?></th>
					<th><?php echo WT_I18N::translate('Access level'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$order = 1;
				foreach ($modules as $module) {
					?>
					<tr class="sortme">
						<td>
							<?php echo $module->getTitle(); ?>
						</td>
						<td>
							<?php echo $module->getDescription(); ?>
						</td>
						<td>
							<input type="text" size="3" value="<?php echo $order; ?>" name="order-<?php echo $module->getName(); ?>">
						</td>
						<td>
							<table class="modules_table2">
								<?php foreach (WT_Tree::getAll() as $tree) { ?>
									<tr>
										<td>
											<?php echo $tree->tree_title_html; ?>
										</td>
										<td>
											<?php
												$access_level = WT_DB::prepare(
													"SELECT access_level FROM `##module_privacy` WHERE gedcom_id=? AND module_name=? AND component='report'"
												)->execute(array($tree->tree_id, $module->getName()))->fetchOne();
												if ($access_level === null) {
													$access_level = $module->defaultAccessLevel();
												}
												echo edit_field_access_level('access-' . $module->getName() . '-' . $tree->tree_id, $access_level);
											?>
										</td>
									</tr>
								<?php } ?>
							</table>
						</td>
					</tr>
				<?php
				$order++;
				}
					?>
			</tbody>
		</table>
		<button class="btn btn-primary show" type="submit">
			<i class="fa fa-floppy-o"></i>
			<?php echo WT_I18N::translate('save'); ?>
		</button>
	</form>
</div>
