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

/**
 * Definitions for a census
 */
class WT_Census_CensusOfCanada1911 extends WT_Census_CensusOfCanada implements WT_Census_CensusInterface {
	/**
	 * When did this census occur.
	 *
	 * @return string
	 */
	public function censusDate() {
		return '01 JUN 1911';
	}

	/**
	 * The columns of the census.
	 *
	 * @return CensusColumnInterface[]
	 */
	public function columns() {
		return array(
			new WT_Census_CensusColumnFullName($this, 'Names', 'Name of each person whose place of abode was in the household', 'width: 200px;'),
			new WT_Census_CensusColumnNull($this, 'Habitation', 'Place of habitation or address'),
			new WT_Census_CensusColumnSexMF($this, 'Sex', 'Sex (M = Male; F = Female)'),
			new WT_Census_CensusColumnRelationToHead($this, 'Relation', 'Relation to head of household'),
			new WT_Census_CensusColumnConditionCan($this, 'Marital Status', 'Single, Married, Widowed, Divorced, or Legally Separated'),
			new WT_Census_CensusColumnBirthMonth($this, 'Month of Birth', ''),
			new WT_Census_CensusColumnBirthYear($this, 'Year of Birth', ''),
			new WT_Census_CensusColumnAge($this, 'Age', 'Age at last birthday'),
			new WT_Census_CensusColumnBirthPlaceSimple($this, 'Birth Place', 'Country or Place of Birth (if Canada, specify province or territory)'),
			new WT_Census_CensusColumnNull($this, 'Immigration', 'Year of immigration to Canada'),
			new WT_Census_CensusColumnNull($this, 'Naturalization', 'Year of naturalization, if formerly an alien'),
			new WT_Census_CensusColumnNull($this, 'Race', 'Racial or tribal origin'),
			new WT_Census_ColumnNationality($this, 'Nationality', 'Racial or tribal origin'),
			new WT_Census_CensusColumnReligion($this, 'Religion', 'Religion'),
		);
	}
}
