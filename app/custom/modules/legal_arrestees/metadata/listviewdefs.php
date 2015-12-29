<?php
$module_name = 'legal_arrestees';
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
  'ARREST_CITY_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_ARREST_CITY',
    'sortable' => true,
    'default' => true,
  ),
  'ARREST_DATE' => 
  array (
    'width' => '10',
    'label' => 'LBL_ARREST_DATE',
    'default' => true,
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'EMAIL' => 
  array (
    'width' => '10',
    'label' => 'LBL_EMAIL',
    'default' => true,
  ),
  'DOCKET_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_DOCKET',
    'sortable' => true,
    'default' => true,
  ),
  'SUPPORT_NEEDS_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_SUPPORT_NEEDS',
    'sortable' => true,
    'default' => true,
  ),
  'FIRST_APPEARANCE_DATE_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_FIRST_APPEARANCE_DATE',
    'sortable' => true,
    'default' => true,
  ),
  'NEXT_HEARING_TIME_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_NEXT_HEARING_TIME',
    'sortable' => true,
    'default' => true,
  ),
  'FELONY_CHARGES' => 
  array (
    'width' => '10',
    'label' => 'LBL_FELONY_CHARGES',
    'default' => true,
  ),
  'DATE_OF_BIRTH' => 
  array (
    'width' => '10',
    'label' => 'LBL_DATE_OF_BIRTH',
    'default' => false,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10',
    'label' => 'LBL_WORK_PHONE',
    'default' => false,
  ),
  'PREFERRED_NAME' => 
  array (
    'width' => '10',
    'label' => 'LBL_PREFERRED_NAME',
    'default' => false,
  ),
  'ADDRESS_STREET' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
    'default' => false,
  ),
  'BOOKING_NUMBER_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_BOOKING_NUMBER',
    'sortable' => false,
    'default' => false,
  ),
  'ADDRESS_CITY' => 
  array (
    'width' => '10',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'CASE_NUMBER_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_CASE_NUMBER',
    'sortable' => false,
    'default' => false,
  ),
  'RELEASE_TYPE_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_RELEASE_TYPE',
    'sortable' => false,
    'default' => false,
  ),
  'CHARGES_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_CHARGES',
    'sortable' => false,
    'default' => false,
  ),
  'RELEASE_DATE' => 
  array (
    'width' => '10',
    'label' => 'LBL_RELEASE_DATE',
    'default' => false,
  ),
  'CITATION_NUMBER' => 
  array (
    'width' => '10',
    'label' => 'LBL_CITATION_NUMBER',
    'default' => false,
  ),
  'STATE_C' => 
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
  'DISPOSITION_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_DISPOSITION',
    'sortable' => true,
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
  'DATE_MODIFIED' => 
  array (
    'width' => '10',
    'label' => 'LBL_DATE_MODIFIED',
    'default' => false,
  ),
  'LAWYER' => 
  array (
    'width' => '10',
    'label' => 'LBL_LAWYER',
    'default' => false,
  ),
  'ARREST_TIME' => 
  array (
    'width' => '10',
    'label' => 'LBL_ARREST_TIME',
    'sortable' => false,
    'default' => false,
  ),
  'ARRESTING_OFFICER' => 
  array (
    'width' => '10',
    'label' => 'LBL_ARRESTING_OFFICER',
    'default' => false,
  ),
  'ARREST_LOCATION' => 
  array (
    'width' => '10',
    'label' => 'LBL_ARREST_LOCATION',
    'default' => false,
  ),
  'BADGE_NUMBER' => 
  array (
    'width' => '10',
    'label' => 'LBL_BADGE_NUMBER',
    'default' => false,
  ),
  'IMMIGRATION_ISSUES' => 
  array (
    'width' => '10',
    'label' => 'LBL_IMMIGRATION_ISSUES',
    'default' => false,
  ),
  'RELEASE_TIME' => 
  array (
    'width' => '10',
    'label' => 'LBL_RELEASE_TIME',
    'default' => false,
  ),
  'INCIDENT_ID' => 
  array (
    'width' => '10',
    'label' => 'LBL_INCIDENT_ID',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '10',
    'label' => 'LBL_MODIFIED_NAME',
    'default' => false,
  ),
  'MINOR' => 
  array (
    'width' => '10',
    'label' => 'LBL_MINOR',
    'default' => false,
  ),
  'ARREST_TIME_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_ARREST_TIME',
    'sortable' => false,
    'default' => false,
  ),
  'GENDER_ID_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_GENDER_ID',
    'sortable' => false,
    'default' => false,
  ),
  'GENDER_SOLIDARITY_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_GENDER_SOLIDARITY',
    'sortable' => false,
    'default' => false,
  ),
  'MEDICAL_CONCERN_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_MEDICAL_CONCERN',
    'sortable' => false,
    'default' => false,
  ),
  'JURISDICTION_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_JURISDICTION',
    'sortable' => false,
    'default' => false,
  ),
  'UNCONFIRMED_ARREST_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_UNCONFIRMED_ARREST',
    'sortable' => false,
    'default' => false,
  ),
  'WANTS_LAWYER_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_WANTS_LAWYER',
    'sortable' => false,
    'default' => false,
  ),
  'BAIL_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_BAIL',
    'sortable' => false,
    'default' => false,
  ),
  'CONTACTS_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_CONTACTS',
    'sortable' => false,
    'default' => false,
  ),
  'AFFINITY_GROUP_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_AFFINITY_GROUP',
    'sortable' => false,
    'default' => false,
  ),
  'JAIL_FACILITY_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_JAIL_FACILITY',
    'sortable' => false,
    'default' => false,
  ),
  'JAIL_LOCATION_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_JAIL_LOCATION',
    'sortable' => false,
    'default' => false,
  ),
  'MEDICAL_NEEDS_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_MEDICAL_NEEDS',
    'sortable' => false,
    'default' => false,
  ),
  'LEGAL_STRATEGY_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_LEGAL_STRATEGY',
    'sortable' => false,
    'default' => false,
  ),
  'SUPPORT_CONTACT_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_SUPPORT_CONTACT',
    'sortable' => false,
    'default' => false,
  ),
  'SUPPORT_PERSON_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_SUPPORT_PERSON',
    'sortable' => false,
    'default' => false,
  ),
  'FIRST_APPEARANCE_LOCATION_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_FIRST_APPEARANCE_LOCATION',
    'sortable' => false,
    'default' => false,
  ),
  'WANTS_BAIL_C' => 
  array (
    'width' => '10',
    'label' => 'LBL_WANTS_BAIL',
    'sortable' => false,
    'default' => false,
  ),
)
);
?>
