/*
 * CodePress regular expressions for SQL syntax highlighting
 * By Merlin Moncure
 */
 
// SQL
Language.syntax = [
// strings single quote [blue]
	{ input : /\'(.*?)(\')/g, output : '<s>\'$1$2</s>' }, 
// reserved words [BLUE]
	{ input : /\b(add|after|aggregate|alias|all|and|as|authorization|between|by|cascade)\b/gi, output : '<b>$1</b>' }, 
  	{ input : /\b(cache|cache|called|case|check|column|comment|constraint|createdb|createuser)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(cycle|database|default|deferrable|deferred|diagnostics|distinct|domain|each)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(else|elseif|elsif|encrypted|except|exception|for|foreign|from|from|full|function)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(get|go|group|having|if|immediate|immutable|in|increment|initially|increment|index)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(inherits|inner|input|intersect|into|invoker|is|join|key|language|left|limit)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(local|loop|match|maxvalue|minvalue|natural|nextval|no|nocreatedb|nocreateuser)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(not|null|of|offset|oids|on|only|operator|or|order|outer|owner|partial|password)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(perform|plpgsql|primary|procedure|record|references|replace|restrict|return|returns|right)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(row|rule|schema|security|sequence|session|sql|stable|statistics|table|temp|temporary)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(then|time|to|transaction|trigger|type|unencrypted|union|unique|user|using|valid|value)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(values|view|volatile|when|where|with|without|zone)\b/gi, output : '<b>$1</b>' }, 
// types [RED]
	{ input : /\b(bigint|bigserial|bit|boolean|box|bytea|char|character|cidr|circle|date|decimal|double|float4|float8)\b/gi, output : '<u>$1</u>' }, 
	{ input : /\b(inet|int2|int4|int8|integer|interval|line|lseg|macaddr|money|numeric|oid|path|point|polygon|precision|real)\b/gi, output : '<u>$1</u>' }, 
	{ input : /\b(refcursor|serial|serial4|serial8|smallint|text|timestamp|varbit|varchar|uniqueidentifier)\b/gi, output : '<u>$1</u>' }, 
// commands	[ORANGE]
	{ input : /\b(abort|alter|analyze|begin|checkpoint|close|cluster|comment|commit|copy|create|deallocate|declare)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(delete|drop|end|execute|explain|fetch|grant|insert|listen|load|lock|move|notify|prepare|reindex)\b/gi, output : '<b>$1</b>' }, 
	{ input : /\b(reset|restart|revoke|rollback|select|set|show|start|truncate|unlisten|update)\b/gi, output : '<b>$1</b>' }, 
// comments	[GREY]
	{ input : /([^:]|^)\-\-(.*?)(<br|<\/P)/g, output: '$1<i>--$2</i>$3' },
// @VARS [turquis]	
	{ input : /(\@[\w\.]*)/g, output: '<var>$1</var>' },
//Numbers	
	{ input : /\b([\d]+)\b/g, output : '<a>$1</a>' },
//Collums aka Attributes
{ input : /(\.[\w\.]*)/g, output: '<span>$1</span>' },
//Tables
	{ input : /\b(arresteees|legal_arresal_witnesses|legal_arresegal_charges|legal_arresgal_evidence|legal_arreslegal_events|legal_arrestees|legal_arrestees_audit|legal_arrestees_cstm|legal_charges|legal_charges_audit|legal_evental_witnesses|legal_eventgal_evidence|legal_events|legal_events_audit|legal_evidence|legal_evidence_audit|legal_evidence_cstm|legal_lawyers|legal_lawyers_audit|legal_lawyers_cstm|legal_witnesses|legal_witnesses_audit|legal_witnesses_cstm)([, ;\)]?)/gi, output: '<strong>$1</strong>$2' },
//Columns
	{ input : /\b(account_id|affinity_group_c|after_value_string|after_value_text|alt_address_city|alt_address_country|alt_address_postalcode|alt_address_state|alt_address_street|arrest_date|arresting_officer|arrest_location|arrest_time|arrest_time_c|assigned_user_id|assistant|assistant_phone|badge_number|bail_c|before_value_string|before_value_text|booking_number_c|can_represent_in_mn_c|caseid_c|case_number_c|charge|charge_desc|charges_c|citation_number|civil_rights_experience_c|contacts_c|created_by|data_type|date|date_created|date_entered|date_modified|date_of_birth|datetimelocation_c|deleted|department|description|disposition_c|do_not_call|email|end_time|evidence_id_c|federal_practice_c|felony_charges|field_name|first_appearance_date_c|first_appearance_location_c|first_name|gender_id_c|gender_solidarity_c|id|id_c|id_display_c|immigration_issues|incident_id|jail_facility_c|jail_location_c|jurisdiction_c|last_name|lawyer_id|lawyer_roles_c|lawyersspecialties_c|legal_arrestees_ida|legal_charges_idb|legal_events_ida|legal_events_idb|legal_evidence_idb|legal_observer|legal_strategy_c|legal_witnesses_idb|license_number_c|loctation|medical_concern_c|medical_needs_c|minor|modified_user_id|name|next_hearing_time_c|nlg_c|organization_c|parent_id|phone_fax|phone_home|phone_mobile|phone_other|phone_work|practicing_states_c|preferred_name|primary_address_city|primary_address_country|primary_address_postalcode|primary_address_state|primary_address_street|regular_courts_c|release_date|release_time|release_type_c|represented_protestors_c|salutation|start_time|state_c|support_contact_c|support_needs_c|support_person_c|title|type|unconfirmed_arrest_c|use_of_force|use_of_force_c|wants_bail_c|wants_lawyer_c|witness|years_in_crim_practice_c|years_in_practice_c)([, ;\)]?)/gi, output: '<em>$1</em>$2' }
	
]
Language.Functions = [
  //{ input : /(from|join)([ ]*[\w\.]+[ ]*)(\w+)/gi , name : '$3' , output : '<dfn>$1</dfn>' },
  //{ input : /(from|join)([ ]*[\w\.]+[ ]*)(\w+)/gi , name : '$3' , output : '<dfn>$1</dfn>' },
  { input : /(from|join)([ ]*[\w\.]+[ ]*)(\w+)/gi , name : '$3' , output : '$1' },
  { input : /(\)[ ]*)(\w+)/gi , name : '$2' }
]

Language.snippets = [
	{ input : 'select', output : 'select $0 from  where ' }
]

Language.complete = [
	{ input : '\'', output : '\'$0\'' },
	{ input : '"', output : '"$0"' },
	{ input : '(', output : '\($0\)' },
	{ input : '[', output : '\[$0\]' },
	{ input : '{', output : '{\n\t$0\n}' }		
]

Language.shortcuts = []
