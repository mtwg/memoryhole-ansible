<?php
$module_name = 'legal_lawyers';
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
  'PHONE_MOBILE' => 
  array (
    'width' => '10',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '15',
    'label' => 'LBL_OFFICE_PHONE',
    'default' => true,
  ),
  'EMAIL' => 
  array (
    'width' => '10',
    'label' => 'LBL_EMAIL',
    'default' => true,
  ),
  'ORGANIZATION_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_ORGANIZATION',
    'sortable' => false,
    'default' => true,
  ),
  'NLG_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_NLG',
    'sortable' => false,
    'default' => true,
  ),
  'PHONE_HOME' => 
  array (
    'width' => '10',
    'label' => 'LBL_HOME_PHONE',
    'default' => false,
  ),
  'LAST_NAME' => 
  array (
    'width' => '10',
    'label' => 'LBL_LAST_NAME',
    'default' => false,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10',
    'label' => 'LBL_WORK_PHONE',
    'default' => false,
  ),
  'FIRST_NAME' => 
  array (
    'width' => '10',
    'label' => 'LBL_FIRST_NAME',
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
  'DESCRIPTION' => 
  array (
    'width' => '10',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'default' => false,
  ),
  'ADDRESS_CITY' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '10',
    'label' => 'LBL_MODIFIED_NAME',
    'default' => false,
  ),
  'ADDRESS_STATE' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'width' => '10',
    'label' => 'LBL_DATE_MODIFIED',
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
