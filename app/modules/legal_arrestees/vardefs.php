<?php
/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004 - 2007 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/
$dictionary['legal_arrestees'] = array(
	'table'=>'legal_arrestees',
	'audited'=>true,
	'fields'=>array (
  'account_id' => 
  array (
    'required' => false,
    'name' => 'account_id',
    'vname' => '',
    'type' => 'id',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => 36,
  ),
  'lawyer' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'lawyer',
    'vname' => 'LBL_LAWYER',
    'type' => 'relate',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '255',
    'id_name' => 'account_id',
    'ext2' => 'lawyers',
    'module' => 'legal_lawyers',
    'studio' => 'visible',
  ),
  'preferred_name' => 
  array (
    'required' => false,
    'name' => 'preferred_name',
    'vname' => 'LBL_PREFERRED_NAME',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '60',
  ),
  'arrest_date' => 
  array (
    'required' => false,
    'name' => 'arrest_date',
    'vname' => 'LBL_ARREST_DATE',
    'type' => 'date',
    'massupdate' => 1,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'display_default' => 'now',
  ),
  'arrest_time' => 
  array (
    'required' => false,
    'name' => 'arrest_time',
    'vname' => 'LBL_ARREST_TIME',
    'type' => 'text',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'studio' => 'visible',
  ),
  'arrest_location' => 
  array (
    'required' => false,
    'name' => 'arrest_location',
    'vname' => 'LBL_ARREST_LOCATION',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '25',
  ),
  'arresting_officer' => 
  array (
    'required' => false,
    'name' => 'arresting_officer',
    'vname' => 'LBL_ARRESTING_OFFICER',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '25',
  ),
  'badge_number' => 
  array (
    'required' => false,
    'name' => 'badge_number',
    'vname' => 'LBL_BADGE_NUMBER',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '25',
  ),
  'release_date' => 
  array (
    'required' => false,
    'name' => 'release_date',
    'vname' => 'LBL_RELEASE_DATE',
    'type' => 'date',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
  ),
  'release_time' => 
  array (
    'required' => false,
    'name' => 'release_time',
    'vname' => 'LBL_RELEASE_TIME',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '25',
  ),
  'email' => 
  array (
    'required' => false,
    'name' => 'email',
    'vname' => 'LBL_EMAIL',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '70',
  ),
  'date_of_birth' => 
  array (
    'required' => false,
    'name' => 'date_of_birth',
    'vname' => 'LBL_DATE_OF_BIRTH',
    'type' => 'date',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
  ),
  'immigration_issues' => 
  array (
    'required' => false,
    'name' => 'immigration_issues',
    'vname' => 'LBL_IMMIGRATION_ISSUES',
    'type' => 'bool',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '255',
  ),
  'felony_charges' => 
  array (
    'required' => false,
    'name' => 'felony_charges',
    'vname' => 'LBL_FELONY_CHARGES',
    'type' => 'bool',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '255',
  ),
  'minor' => 
  array (
    'required' => false,
    'name' => 'minor',
    'vname' => 'LBL_MINOR',
    'type' => 'bool',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '255',
  ),
  'incident_id' => 
  array (
    'required' => false,
    'name' => 'incident_id',
    'vname' => 'LBL_INCIDENT_ID',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '30',
  ),
  'citation_number' => 
  array (
    'required' => false,
    'name' => 'citation_number',
    'vname' => 'LBL_CITATION_NUMBER',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => 0,
    'reportable' => 0,
    'len' => '60',
  ),
),
	'relationships'=>array (
),
	'optimistic_lock'=>true,
);
require_once('include/SugarObjects/VardefManager.php');
VardefManager::createVardef('legal_arrestees','legal_arrestees', array('basic','assignable','person'));
