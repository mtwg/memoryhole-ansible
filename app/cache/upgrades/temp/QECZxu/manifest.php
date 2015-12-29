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

	$manifest = array (
		 'acceptable_sugar_versions' => 
		  array (
	     	
		  ),
		  'acceptable_sugar_flavors' =>
		  array(
		  	'CE', 'PRO','ENT'
		  ),
		  'readme'=>'',
		  'key'=>'legal',
		  'author' => 'Greg',
		  'description' => '',
		  'icon' => '',
		  'is_uninstallable' => true,
		  'name' => 'LegalSupport',
		  'published_date' => '2014-12-12 00:22:27',
		  'type' => 'module',
		  'version' => '1418343747',
		  'remove_tables' => 'prompt',
		  );
$installdefs = array (
  'id' => 'LegalSupport',
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'legal_evidence',
      'class' => 'legal_evidence',
      'path' => 'modules/legal_evidence/legal_evidence.php',
      'tab' => true,
    ),
    1 => 
    array (
      'module' => 'legal_events',
      'class' => 'legal_events',
      'path' => 'modules/legal_events/legal_events.php',
      'tab' => true,
    ),
    2 => 
    array (
      'module' => 'legal_arrestees',
      'class' => 'legal_arrestees',
      'path' => 'modules/legal_arrestees/legal_arrestees.php',
      'tab' => true,
    ),
    3 => 
    array (
      'module' => 'legal_lawyers',
      'class' => 'legal_lawyers',
      'path' => 'modules/legal_lawyers/legal_lawyers.php',
      'tab' => true,
    ),
    4 => 
    array (
      'module' => 'legal_charges',
      'class' => 'legal_charges',
      'path' => 'modules/legal_charges/legal_charges.php',
      'tab' => true,
    ),
    5 => 
    array (
      'module' => 'legal_witnesses',
      'class' => 'legal_witnesses',
      'path' => 'modules/legal_witnesses/legal_witnesses.php',
      'tab' => true,
    ),
  ),
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_evidence.php',
      'to_module' => 'legal_evidence',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_events.php',
      'to_module' => 'legal_events',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_witnesses.php',
      'to_module' => 'legal_witnesses',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_events.php',
      'to_module' => 'legal_events',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_arrestees.php',
      'to_module' => 'legal_arrestees',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_evidence.php',
      'to_module' => 'legal_evidence',
    ),
    6 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_witnesses.php',
      'to_module' => 'legal_witnesses',
    ),
    7 => 
    array (
      'from' => '<basepath>/SugarModules/layoutdefs/legal_charges.php',
      'to_module' => 'legal_charges',
    ),
  ),
  'relationships' => 
  array (
    0 => 
    array (
      'module' => 'legal_evidence',
      'module_vardefs' => '<basepath>/SugarModules/vardefs/legal_evidence.php',
      'meta_data' => '<basepath>/SugarModules/relationships/legal_events_legal_evidenceMetaData.php',
    ),
    1 => 
    array (
      'module' => 'legal_witnesses',
      'module_vardefs' => '<basepath>/SugarModules/vardefs/legal_witnesses.php',
      'meta_data' => '<basepath>/SugarModules/relationships/legal_events_legal_witnessesMetaData.php',
    ),
    2 => 
    array (
      'module' => 'legal_events',
      'module_vardefs' => '<basepath>/SugarModules/vardefs/legal_events.php',
      'meta_data' => '<basepath>/SugarModules/relationships/legal_arrestees_legal_eventsMetaData.php',
    ),
    3 => 
    array (
      'module' => 'legal_evidence',
      'module_vardefs' => '<basepath>/SugarModules/vardefs/legal_evidence.php',
      'meta_data' => '<basepath>/SugarModules/relationships/legal_arrestees_legal_evidenceMetaData.php',
    ),
    4 => 
    array (
      'module' => 'legal_witnesses',
      'module_vardefs' => '<basepath>/SugarModules/vardefs/legal_witnesses.php',
      'meta_data' => '<basepath>/SugarModules/relationships/legal_arrestees_legal_witnessesMetaData.php',
    ),
    5 => 
    array (
      'module' => 'legal_charges',
      'module_vardefs' => '<basepath>/SugarModules/vardefs/legal_charges.php',
      'meta_data' => '<basepath>/SugarModules/relationships/legal_arrestees_legal_chargesMetaData.php',
    ),
  ),
  'image_dir' => '<basepath>/icons',
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/modules/legal_evidence',
      'to' => 'modules/legal_evidence',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/modules/legal_events',
      'to' => 'modules/legal_events',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/modules/legal_arrestees',
      'to' => 'modules/legal_arrestees',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/modules/legal_lawyers',
      'to' => 'modules/legal_lawyers',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/modules/legal_charges',
      'to' => 'modules/legal_charges',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/modules/legal_witnesses',
      'to' => 'modules/legal_witnesses',
    ),
  ),
  'vardefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/vardefs/legal_events.php',
      'to_module' => 'legal_events',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/vardefs/legal_events.php',
      'to_module' => 'legal_events',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/vardefs/legal_arrestees.php',
      'to_module' => 'legal_arrestees',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/vardefs/legal_arrestees.php',
      'to_module' => 'legal_arrestees',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/vardefs/legal_arrestees.php',
      'to_module' => 'legal_arrestees',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/vardefs/legal_arrestees.php',
      'to_module' => 'legal_arrestees',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
  ),
);