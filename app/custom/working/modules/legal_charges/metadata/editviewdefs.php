<?php
$module_name = 'legal_charges';
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
            'name' => 'charge',
            'label' => 'LBL_CHARGE',
            'tabindex' => '2',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
            'tabindex' => '3',
          ),
        ),
      ),
    ),
  ),
)
);
?>
