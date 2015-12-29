<?php
$module_name = 'legal_witnesses';
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
            'name' => 'first_name',
            'label' => 'LBL_FIRST_NAME',
            'tabindex' => '1',
          ),
          1 => 
          array (
            'name' => 'legal_observer',
            'label' => 'LBL_LEGAL_OBSERVER',
            'tabindex' => '3',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'last_name',
            'displayParams' => 
            array (
              'required' => true,
            ),
            'label' => 'LBL_LAST_NAME',
            'tabindex' => '2',
          ),
          1 => NULL,
        ),
      ),
      'CONTACT INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'phone_mobile',
            'label' => 'LBL_MOBILE_PHONE',
            'tabindex' => '4',
          ),
          1 => 
          array (
            'name' => 'primary_address_street',
            'label' => 'LBL_PRIMARY_ADDRESS_STREET',
            'tabindex' => '7',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_work',
            'label' => 'LBL_OFFICE_PHONE',
            'tabindex' => '5',
          ),
          1 => 
          array (
            'name' => 'primary_address_city',
            'label' => 'LBL_PRIMARY_ADDRESS_CITY',
            'tabindex' => '8',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'email',
            'label' => 'LBL_EMAIL',
            'tabindex' => '6',
          ),
          1 => 
          array (
            'name' => 'state_c',
            'label' => 'LBL_PRIMARY_ADDRESS_STATE',
            'tabindex' => '9',
          ),
        ),
        3 => 
        array (
          0 => NULL,
          1 => 
          array (
            'name' => 'alt_address_postalcode',
            'label' => 'LBL_ALT_ADDRESS_POSTALCODE',
            'tabindex' => '10',
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
            'tabindex' => '11',
          ),
        ),
      ),
    ),
  ),
)
);
?>
