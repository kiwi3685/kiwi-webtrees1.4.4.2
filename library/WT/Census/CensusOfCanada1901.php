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
class WT_Census_CensusOfCanada1901 extends WT_Census_CensusOfCanada implements WT_Census_CensusInterface {
	/**
	 * When did this census occur.
	 *
	 * @return string
	 */
	public function censusDate() {
		return '31 MAR 1901';
	}

	/**
	 * The columns of the census.
	 *
	 * @return CensusColumnInterface[]
	 */
	public function columns() {
		return array(
			new WT_Census_CensusColumnFullName($this, 'Names', 'Name of each person in family or household', 'width: 200px;'),
			new WT_Census_CensusColumnRelationToHead($this, 'Relation', 'Relation to head of household'),
			new WT_Census_CensusColumnSexMF($this, 'Sex', 'Sex (M = Male; F = Female)'),
			new WT_Census_CensusColumnAge($this, 'Age'),
			new WT_Census_CensusColumnConditionCan($this, 'Marital Status', 'Single, Married, Widowed, or Divorced'),
			new WT_Census_CensusColumnBirthPlaceSimple($this, 'French Canadian', 'Whether French Canadian'),
			new WT_Census_CensusColumnNull($this, 'Infirm', 'Infirmities – (1) deaf and dumb, (2) blind, (3) unsound mind'),
			new WT_Census_CensusColumnFatherBirthPlaceSimple($this, 'BPF', 'Birthplace of father'),
			new WT_Census_CensusColumnMotherBirthPlaceSimple($this, 'BPM', 'Birthplace of mother'),
			new WT_Census_CensusColumnReligion($this, 'Religion', 'Religion'),
			new WT_Census_CensusColumnOccupation($this, 'Occupation', 'Profession, occupation, or trade'),
			new WT_Census_CensusColumnNull($this, 'Employer', 'Whether an employer - Y/N'),
			new WT_Census_CensusColumnNull($this, 'Wage Earner', 'Whether a wage earner - Y/N'),
			new WT_Census_CensusColumnNull($this, 'Unemployed', 'Whether unemployed during the week preceding the census'),
			new WT_Census_CensusColumnNull($this, 'Employees', 'If an employer, state the average number of hands employed during the year'),
			new WT_Census_CensusColumnNull($this, 'Read / Write', 'Whether able to read and write'),
			new WT_Census_CensusColumnNull($this, 'Infirm', 'Whether deaf and dumb, blind, or of an unsound mind'),
		);
	}
}
