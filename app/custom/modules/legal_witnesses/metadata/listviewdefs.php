<?php
$module_name = 'legal_witnesses';
$listViewDefs = array (
$module_name =>
array (
  'NAME' => 
  array (
    'width' => '20',
    'label' => 'LBL_NAME',
    'link' => true,
    'orderBy' => 'last_name',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
  ),
  'EMAIL' => 
  array (
    'width' => '10',
    'label' => 'LBL_EMAIL',
    'default' => true,
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'LEGAL_OBSERVER' => 
  array (
    'width' => '10',
    'label' => 'LBL_LEGAL_OBSERVER',
    'default' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'width' => '10',
    'label' => 'LBL_DATE_MODIFIED',
    'default' => true,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10',
    'label' => 'LBL_WORK_PHONE',
    'default' => false,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '15',
    'label' => 'LBL_OFFICE_PHONE',
    'default' => false,
  ),
  'PHONE_FAX' => 
  array (
    'width' => '10',
    'label' => 'LBL_FAX_PHONE',
    'default' => false,
  ),
  'ADDRESS_STREET' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
    'default' => false,
  ),
  'ADDRESS_CITY' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'ADDRESS_STATE' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'default' => false,
  ),
  'ADDRESS_POSTALCODE' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
)
);
?>
