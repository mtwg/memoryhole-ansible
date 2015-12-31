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
$dictionary['legal_lawyers'] = array(
	'table'=>'legal_lawyers',
	'audited'=>true,
	'fields'=>array (
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
),
	'relationships'=>array (
),
	'optimistic_lock'=>true,
);
$dictionary['legal_lawyers']['relationships']['lawyer_arrestee'] = array( 
'lhs_module' => 'legal_lawyers', 
'lhs_table' => 'legal_lawyers', 
'lhs_key' => 'id', 
'rhs_module' => 'legal_arrestees',
'rhs_table' => 'legal_arrestees', // must use custom table as we're using a custom Relate field in step 4
'rhs_key' => 'account_id', // must match the name of the field containing the PARENT id in the CHILD_cstm table
'relationship_type' => 'one-to-many' // one LHS to many RHS
);
$dictionary['legal_lawyers']['fields']['arrestees'] = array ( 
'name' => 'arrestees', 
'type' => 'link', 
'relationship' => 'lawyer_arrestee', 
'source'=>'non-db', 
'vname'=>'LBL_ARRESTEES', 
);


require_once('include/SugarObjects/VardefManager.php');
VardefManager::createVardef('legal_lawyers','legal_lawyers', array('basic','assignable','person'));