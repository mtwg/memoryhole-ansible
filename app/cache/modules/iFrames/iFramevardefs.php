<?php 
 $GLOBALS["dictionary"]["iFrame"]=array (
  'table' => 'iframes',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'vname' => 'LBL_ID',
      'type' => 'id',
      'required' => true,
    ),
    'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_LIST_NAME',
      'type' => 'varchar',
      'len' => '255',
      'required' => true,
      'importable' => 'required',
    ),
    'url' => 
    array (
      'name' => 'url',
      'vname' => 'LBL_LIST_URL',
      'type' => 'varchar',
      'len' => '255',
      'required' => true,
      'importable' => 'required',
    ),
    'type' => 
    array (
      'name' => 'type',
      'vname' => 'LBL_LIST_TYPE',
      'type' => 'varchar',
      'len' => '255',
      'required' => true,
    ),
    'placement' => 
    array (
      'name' => 'placement',
      'vname' => 'LBL_LIST_PLACEMENT',
      'type' => 'varchar',
      'len' => '255',
      'required' => true,
      'importable' => 'required',
    ),
    'status' => 
    array (
      'name' => 'status',
      'vname' => 'LBL_LIST_STATUS',
      'type' => 'bool',
      'required' => true,
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'vname' => 'LBL_DELETED',
      'type' => 'bool',
      'required' => true,
    ),
    'date_entered' => 
    array (
      'name' => 'date_entered',
      'vname' => 'LBL_DATE_ENTERED',
      'type' => 'datetime',
      'required' => true,
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'vname' => 'LBL_DATE_MODIFIED',
      'type' => 'datetime',
      'required' => true,
    ),
    'created_by' => 
    array (
      'name' => 'created_by',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_ASSIGNED_TO',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'dbType' => 'id',
      'required' => true,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'iframespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_cont_name',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'name',
        1 => 'deleted',
      ),
    ),
  ),
  'custom_fields' => false,
);