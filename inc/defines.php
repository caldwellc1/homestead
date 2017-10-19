<?php

// This file contains the testing defines.  It has been moved out of defines.php
// due to the obvious issue of what to do every time prod is exported.  This
// file is in subversion is inc/hms_defines.php, and should live in phpWebSite's
// root as /inc/hms_defines.php.
require_once(PHPWS_SOURCE_DIR . 'inc/hms_defines.php');

/**
 * Name & Email address info - Used for sending out emails
 */
define('SYSTEM_NAME', 'University Housing'); // Used as "from" name in emails
define('EMAIL_ADDRESS', 'housing'); // user name of email account to send email from
define('DOMAIN_NAME', 'appstate.edu'); // domain name to send email from
define('FROM_ADDRESS', EMAIL_ADDRESS . '@' . DOMAIN_NAME); // fully qualified "from" address
define('TO_DOMAIN', '@'. DOMAIN_NAME); // Default domain to send email to, beginning with '@'
define('HMS_AUTOASSIGN_EMAIL', 'jb67803@appstate.edu');
/**
 * Online/Offline Defines
 */
define("ONLINE",    0);
define("OFFLINE",   1);

define("ONLINE_DESC",   'Online');
define("OFFLINE_DESC",  'Offline');

/**
 * Gender defines
 */
define('FEMALE',    0);
define('MALE',      1);
define('COED',      2);
define('AUTO',      3);

define('FEMALE_DESC',   'Female');
define('MALE_DESC',     'Male');
define('COED_DESC',     'Co-ed');
define('AUTO_DESC',     'Auto');

/**
 * Student Classes
 */
define('CLASS_FRESHMEN',    'FR');
define('CLASS_SOPHOMORE',   'SO');
define('CLASS_JUNIOR',      'JR');
define('CLASS_SENIOR',      'SR');

/**
 * Student Types
 */
define('TYPE_FRESHMEN',     'F');
define('TYPE_TRANSFER',     'T');
define('TYPE_CONTINUING',   'C');
define('TYPE_RETURNING',    'R');
define('TYPE_READMIT',      'Z');
define('TYPE_WITHDRAWN',    'W');
define('TYPE_NONDEGREE',    'N');
define('TYPE_GRADUATE',     'G');

/**
 * Student Levels
 */
define('LEVEL_UNDERGRAD',   'U');
define('LEVEL_GRAD',        'G');
define('LEVEL_DOCTORAL',    'D');
define('LEVEL_SPECIALIST',  'P');
define('LEVEL_UNDECLARED',  '00');
define('LEVEL_GRAD2',       'G2');

/****
 * Admissions Admit Codes
 */
define('ADMISSION_WITHDRAWN_PAID', 'WP');
define('ADMISSION_RESCIND',        'RE');

/***
 * Assignment Reasons
 */

// Default
define('ASSIGN_ADMIN', 		'admin'); // general administrative
define('ASSIGN_APPEALS',    'appeals'); // Appeal (waiting list, etc)

// General Populations
define('ASSIGN_LOTTERY',     'lottery');
define('ASSIGN_FR_AUTO',     'auto_assign'); // auto-assigner
define('ASSIGN_FR',          'freshmen');
define('ASSIGN_TRANSFER', 	 'transfer');

// Sororities
define('ASSIGN_APH', 	'aph');

// RLCs
define('ASSIGN_RLC_FRESHMEN',   'rlc_freshmen');
define('ASSIGN_RLC_TRANSFER',   'rlc_transfer');
define('ASSIGN_RLC_CONTINUING', 'rlc_continuing');

// Honors
define('ASSIGN_HONORS_FRESHMEN',   'honors_freshmen');
define('ASSIGN_HONORS_CONTINUING', 'honors_continuing');

// LLC
define('ASSIGN_LLC_FRESHMEN',   'llc_freshmen');
define('ASSIGN_LLC_CONTINUING', 'llc_continuing');

// International
define('ASSIGN_INTL',       'international');

// RAs
define('ASSIGN_RA',          'ra');
define('ASSIGN_RA_ROOMMATE', 'ra_roommate');

// Athletics
define('ASSIGN_ATHLETIC_FRESHMEN', 'athletic_freshmen');
define('ASSIGN_ATHLETIC_RETURNING', 'athletic_returning');

// Medical
define('ASSIGN_MEDICAL_FRESHMEN','medical_freshmen');
define('ASSIGN_MEDICAL_CONTINUING', 'medical_continuing');
define('ASSIGN_MEDICAL', 	'medical'); // Deprecated

// Special Needs
define('ASSIGN_SPECIAL_FRESHMEN', 'special_freshmen');
define('ASSIGN_SEPCIAL_CONTINUING', 'special_continuing');
define('ASSIGN_SPECIAL', 	'special'); // Deprecated

// RHA
define('ASSIGN_RHA', 'rha');
define('ASSIGN_SCHOLARS', 'scholars');

// Processes - DEPRECATED
define('ASSIGN_CHANGE', 	'achange'); // For room change requests
define('ASSIGN_COPY',		'acopy'); // For copying from previous term


/***
 * Unassignment Reasons
 */
define('UNASSIGN_ADMIN',	  'uadmin'); // General administrative
define('UNASSIGN_CHANGE',	  'uchange'); // For room change process - cannot be used manually
define('UNASSIGN_REASSIGN',   'ureassign'); // implicit removal for re-assign command
define('UNASSIGN_CANCEL',     'ucancel'); // Contract cancellation
define('UNASSIGN_PRE_SPRING', 'uprespring'); // Pre-spring room change
define('UNASSIGN_RELEASE',    'urelease'); // Contract release

/***
 * Pretty Names for Assign/Cancel Reasons
 */
define('admin', 	'Administrative');
define('appeals',   'Appeals');

define('lottery', 	'Lottery');
define('auto_assign',		'Auto-Assigned');
define('freshmen',	'Freshmen');
define('transfer', 'Transfer');

define('aph', 'APH');

define('rlc_freshmen', 'RLC Freshmen');
define('rlc_transfer', 'RLC Transfer');
define('rlc_continuing', 'RLC Continuing');

define('honors_freshmen', 'Honors Freshmen');
define('honors_continuing', 'Honors Continuing');

define('llc_freshmen', 'LLC Freshmen');
define('llc_continuing', 'LLC Continuing');

define('international', 'International');

define('ra', 'RA');
define('ra_roommate', 'RA Roommate');

// Athletics
define('athletic_freshmen', 'Athletics Freshmen');
define('athletic_returning', 'Athletics Returning');

// Medical
define('medical_freshmen', 'Medical Freshmen');
define('medical_continuing', 'Medical Continuing');

// Special Needs
define('special_freshmen', 'Special Needs Freshmen');
define('special_continuing', 'Special Needs Continuing');

define('medical', 	'Medical (general)'); // Deprecated
define('special',	'Special Needs (general)'); // Deprecated

define('rha', 'RHA');
define('scholars', 'Plemmons & Diversity');

// Deprecated
define('achange',   'Room Change');
define('acopy',     'Term Rollover');

// Removal Reasons
define('uadmin',	'Administrative');
define('ucancel', 'Contract Cancellation');
define('ureassign',	'Reassignment');
define('uchange',	'Room Change');
define('uprespring', 'Pre-spring Room Change');
define('urelease', 'Contract Release');

// This section is depricated
define('uwithdrawn','Withdrawn');
define('uintentnoreturn', 'Intent Not To Return');
define('unone',		'Not Specified');


/************************************
 * Application Cancellation Reasons
 */
define('CANCEL_BEFORE_JULY', 'before_july');
define('CANCEL_AFTER_JULY', 'after_july');
define('CANCEL_WITHDRAWN', 'withdrawn');
define('CANCEL_INTENT', 'intent_no_return');
define('CANCEL_BEFORE_ASSIGN', 'before_assignment');
define('CANCEL_OFFER_MADE', 'offer_made');


/**
 * Address types
 */
define('ADDRESS_PRMT_STUDENT',      'PS'); // Permanent student address
define('ADDRESS_PRMT_RESIDENCE',    'PR'); // permenent student residence

/**
 * Room Types (used for summer applications)
 */
define('ROOM_TYPE_DOUBLE', 0);
define('ROOM_TYPE_PRIVATE', 1);

/**
 * User classes
 */
define('STUDENT',   1);
define('ADMIN',     2);
define('BADCLASS',  3);

/**
 * Queue Types
 */
define('BANNER_QUEUE_ASSIGNMENT', 1);
define('BANNER_QUEUE_REMOVAL',    2);

/**
 * Menu Types
 */
define('MENU_TYPE_ALL',         0);
define('MENU_TYPE_STRUCTURE',   1);
define('MENU_TYPE_RLC',         2);
define('MENU_TYPE_ASSIGNMENT',  3);
define('MENU_TYPE_STATISTICS',  4);
define('MENU_TYPE_SETTINGS',    5);

/**
 * Assignment Features
 */
define('APPLICATION_RLC_APP',          0);
define('APPLICATION_ROOMMATE_PROFILE', 1);
define('APPLICATION_SELECT_ROOMMATE',  2);

/**
 * Errors
 */
define('E_SUCCESS', 0); // Everything is fine, nothing is broken.

define('TOOLATE',  -4);
define('TOOOLD',   -3);
define('BADTUPLE', -2);
define('TOOEARLY', -1);

/**
 * Roommate errors
 */
define('E_ROOMMATE_MALFORMED_USERNAME',  1); // Bad characters, null, etc
define('E_ROOMMATE_REQUESTED_SELF',      3); // You can't request yourself as a roommate
define('E_ROOMMATE_ALREADY_CONFIRMED',   4); // Requestor already has a confirmed roommate (shouldn't get here)
define('E_ROOMMATE_ALREADY_REQUESTED',   5); // This probably means that they are trying to request each other
define('E_ROOMMATE_PENDING_REQUEST',     6); // Requestor already has an unconfirmed roommate request
define('E_ROOMMATE_USER_NOINFO',         7); // Requestee does not seem to be in Banner
define('E_ROOMMATE_GENDER_MISMATCH',     8); // We don't room cats with dogs unless surgery is involved
define('E_ROOMMATE_NO_APPLICATION',      9); // Requestee has no application on file
define('E_ROOMMATE_TYPE_MISMATCH',      10); // In the fall, type F/T and C cannot live together
define('E_ROOMMATE_RLC_ASSIGNMENT',     11); // If requestor is assigned to a different RLC, STOP
define('E_ROOMMATE_RLC_APPLICATION',    12); // If requestor applied for a different RLC, remove their application
define('E_ROOMMATE_REQUESTED_CONFIRMED',13); // If requestee has a confirmed roommate

define('E_PERMISSION_DENIED',   14);

/**
 * Assignment Errors
 */
define('E_ASSIGN_MALFORMED_USERNAME',   15);
define('E_ASSIGN_NULL_HALL_OBJECT',     16);
define('E_ASSIGN_NULL_FLOOR_OBJECT',    17);
define('E_ASSIGN_NULL_ROOM_OBJECT',     18);
define('E_ASSIGN_NULL_BED_OBJECT',      19);
define('E_ASSIGN_ROOM_FULL',            20);
define('E_ASSIGN_GENDER_MISMATCH',      21);
define('E_ASSIGN_BANNER_ERROR',         22);
define('E_ASSIGN_HMS_DB_ERROR',         23);
define('E_ASSIGN_ALREADY_ASSIGNED',     24);
define('E_ASSIGN_NO_DESTINATION',       25);
define('E_ASSIGN_BED_NOT_EMPTY',        26);
define('E_ASSIGN_WITHDRAWN',            27);
define('E_ASSIGN_NO_DATA',              28);
define('E_ASSIGN_ROOM_OFFLINE',         29);

/**
 * Un-assignment Errors
 */
define('E_UNASSIGN_NOT_ASSIGNED',       30);
define('E_UNASSIGN_ASSIGN_LOAD_FAILED', 31);
define('E_UNASSIGN_BANNER_ERROR',       32);
define('E_UNASSIGN_HMS_DB_ERROR',       33);

/**
 * Lottery Errors
 */
define('E_LOTTERY_ROOMMATE_INVITE_NOT_FOUND',   33);
