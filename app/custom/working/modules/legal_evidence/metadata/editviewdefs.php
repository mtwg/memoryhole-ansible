<?php
$module_name = 'legal_evidence';
$viewdefs = array (
$module_name =>
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
    ),
    'panels' => 
    array (
      'DEFAULT' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
            'tabindex' => '1',
          ),
          1 => 
          array (
            'name' => 'type',
            'label' => 'LBL_TYPE',
            'tabindex' => '3',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'witness',
            'label' => 'LBL_WITNESS',
            'tabindex' => '2',
          ),
          1 => 
          array (
            'name' => 'evidence_id_c',
            'label' => 'LBL_EVIDENCE_ID',
            'tabindex' => '4',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'datetimelocation_c',
            'label' => 'LBL_DATETIMELOCATION',
            'tabindex' => '5',
          ),
          1 => 
          array (
            'name' => 'use_of_force_c',
            'label' => 'LBL_USE_OF_FORCE',
            'tabindex' => '6',
          ),
        ),
      ),
      'NOTES' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
            'tabindex' => '7',
          ),
        ),
      ),
    ),
  ),
)
);
?>
