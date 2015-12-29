<?php
// created: 2014-12-11 18:41:41
$dictionary["legal_events_legal_evidence"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'legal_events_legal_evidence' => 
    array (
      'lhs_module' => 'legal_events',
      'lhs_table' => 'legal_events',
      'lhs_key' => 'id',
      'rhs_module' => 'legal_evidence',
      'rhs_table' => 'legal_evidence',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'legal_events_legal_evidence_c',
      'join_key_lhs' => 'legal_events_legal_evidencelegal_events_ida',
      'join_key_rhs' => 'legal_events_legal_evidencelegal_evidence_idb',
    ),
  ),
  'table' => 'legal_events_legal_evidence_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'legal_events_legal_evidencelegal_events_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'legal_events_legal_evidencelegal_evidence_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'legal_events_legal_evidencespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'legal_events_legal_evidence_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'legal_events_legal_evidencelegal_events_ida',
        1 => 'legal_events_legal_evidencelegal_evidence_idb',
      ),
    ),
  ),
);