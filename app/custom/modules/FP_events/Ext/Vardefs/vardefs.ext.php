<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2013-04-30 14:55:07
$dictionary["FP_events"]["fields"]["fp_events_prospects_1"] = array (
  'name' => 'fp_events_prospects_1',
  'type' => 'link',
  'relationship' => 'fp_events_prospects_1',
  'source' => 'non-db',
  'vname' => 'LBL_FP_EVENTS_PROSPECTS_1_FROM_PROSPECTS_TITLE',
);


// created: 2013-04-25 10:18:48
$dictionary["FP_events"]["fields"]["fp_event_locations_fp_events_1"] = array (
  'name' => 'fp_event_locations_fp_events_1',
  'type' => 'link',
  'relationship' => 'fp_event_locations_fp_events_1',
  'source' => 'non-db',
  'vname' => 'LBL_FP_EVENT_LOCATIONS_FP_EVENTS_1_FROM_FP_EVENT_LOCATIONS_TITLE',
  'id_name' => 'fp_event_locations_fp_events_1fp_event_locations_ida',
);
$dictionary["FP_events"]["fields"]["fp_event_locations_fp_events_1_name"] = array (
  'name' => 'fp_event_locations_fp_events_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_FP_EVENT_LOCATIONS_FP_EVENTS_1_FROM_FP_EVENT_LOCATIONS_TITLE',
  'save' => true,
  'id_name' => 'fp_event_locations_fp_events_1fp_event_locations_ida',
  'link' => 'fp_event_locations_fp_events_1',
  'table' => 'fp_event_locations',
  'module' => 'FP_Event_Locations',
  'rname' => 'name',
);
$dictionary["FP_events"]["fields"]["fp_event_locations_fp_events_1fp_event_locations_ida"] = array (
  'name' => 'fp_event_locations_fp_events_1fp_event_locations_ida',
  'type' => 'link',
  'relationship' => 'fp_event_locations_fp_events_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_FP_EVENT_LOCATIONS_FP_EVENTS_1_FROM_FP_EVENTS_TITLE',
);


// created: 2013-04-15 12:13:27
$dictionary["FP_events"]["fields"]["fp_events_contacts"] = array (
  'name' => 'fp_events_contacts',
  'type' => 'link',
  'relationship' => 'fp_events_contacts',
  'source' => 'non-db',
  'vname' => 'LBL_FP_EVENTS_CONTACTS_FROM_CONTACTS_TITLE',
);


// created: 2013-04-30 14:52:24
$dictionary["FP_events"]["fields"]["fp_events_leads_1"] = array (
  'name' => 'fp_events_leads_1',
  'type' => 'link',
  'relationship' => 'fp_events_leads_1',
  'source' => 'non-db',
  'vname' => 'LBL_FP_EVENTS_LEADS_1_FROM_LEADS_TITLE',
);

?>