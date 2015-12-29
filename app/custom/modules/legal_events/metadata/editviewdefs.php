<?php
$module_name = 'legal_events';
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
            'name' => 'start_time',
            'label' => 'LBL_START_TIME',
            'tabindex' => '4',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date',
            'label' => 'LBL_DATE',
            'tabindex' => '2',
          ),
          1 => 
          array (
            'name' => 'end_time',
            'label' => 'LBL_END_TIME',
            'tabindex' => '5',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'loctation',
            'label' => 'LBL_LOCTATION',
            'tabindex' => '3',
          ),
          1 => 
          array (
            'name' => 'use_of_force',
            'label' => 'LBL_USE_OF_FORCE',
            'tabindex' => '6',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'mass_arrest_c',
            'label' => 'LBL_MASS_ARREST',
          ),
          1 => NULL,
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
