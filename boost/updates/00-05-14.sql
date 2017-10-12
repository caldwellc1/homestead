ALTER TABLE hms_activity_log ADD COLUMN banner_id INTEGER NOT NULL;

CREATE TABLE hms_activities(
    id INTEGER NOT NULL,
    action VARCHAR,
    description VARCHAR,
    primary key(id)
);

INSERT INTO hms_activities(id, action, description) VALUES (0, ACTIVITY_LOGIN, "Logged in");
INSERT INTO hms_activities(id, action, description) VALUES (1, ACTIVITY_AGREED_TO_TERMS, "Agreed to terms & agreement");
INSERT INTO hms_activities(id, action, description) VALUES (2, ACTIVITY_SUBMITTED_APPLICATION, "Submitted housing application");
INSERT INTO hms_activities(id, action, description) VALUES (3, ACTIVITY_SUBMITTED_RLC_APPLICATION, "Submitted RLC application");
INSERT INTO hms_activities(id, action, description) VALUES (4, ACTIVITY_ACCEPTED_TO_RLC, "Accepted to an RLC");
INSERT INTO hms_activities(id, action, description) VALUES (5, ACTIVITY_TOO_OLD_REDIRECTED, "Over 25, redirected");
INSERT INTO hms_activities(id, action, description) VALUES (6, ACTIVITY_REQUESTED_AS_ROOMMATE, "Roommate request");
INSERT INTO hms_activities(id, action, description) VALUES (7, ACTIVITY_REJECTED_AS_ROOMMATE, "Roommate request rejected");
INSERT INTO hms_activities(id, action, description) VALUES (8, ACTIVITY_ACCEPTED_AS_ROOMMATE, "Roommate request accepted");
INSERT INTO hms_activities(id, action, description) VALUES (9, ACTIVITY_STUDENT_BROKE_ROOMMATE, "Broke roommate pairing");
INSERT INTO hms_activities(id, action, description) VALUES (10, ACTIVITY_STUDENT_CANCELLED_ROOMMATE_REQUEST, "Cancelled roommate request");
INSERT INTO hms_activities(id, action, description) VALUES (11, ACTIVITY_PROFILE_CREATED, "Created a profile");
INSERT INTO hms_activities(id, action, description) VALUES (12, ACTIVITY_ASSIGNED, "Assigned to room");
INSERT INTO hms_activities(id, action, description) VALUES (13, ACTIVITY_AUTO_ASSIGNED, "Auto-assigned to room");
INSERT INTO hms_activities(id, action, description) VALUES (14, ACTIVITY_REMOVED, "Removed from room");
INSERT INTO hms_activities(id, action, description) VALUES (15, ACTIVITY_ASSIGNMENT_REPORTED, "Assignment reported to Banner");
INSERT INTO hms_activities(id, action, description) VALUES (16, ACTIVITY_REMOVAL_REPORTED, "Removal reported to Banner");
INSERT INTO hms_activities(id, action, description) VALUES (17, ACTIVITY_LETTER_PRINTED, "Assignment letter printed");
INSERT INTO hms_activities(id, action, description) VALUES (18, ACTIVITY_BANNER_ERROR, "Banner error");
INSERT INTO hms_activities(id, action, description) VALUES (19, ACTIVITY_LOGIN_AS_STUDENT, "Admin logged in as student");
INSERT INTO hms_activities(id, action, description) VALUES (20, ACTIVITY_ADMIN_ASSIGNED_ROOMMATE, "Admin assigned roommate");
INSERT INTO hms_activities(id, action, description) VALUES (21, ACTIVITY_ADMIN_REMOVED_ROOMMATE, "Admin removed roommate");
INSERT INTO hms_activities(id, action, description) VALUES (22, ACTIVITY_AUTO_CANCEL_ROOMMATE_REQ, "Automatically canceled roommate request");
INSERT INTO hms_activities(id, action, description) VALUES (23, ACTIVITY_WITHDRAWN_APP, "Application withdrawn");
INSERT INTO hms_activities(id, action, description) VALUES (24, ACTIVITY_WITHDRAWN_ASSIGNMENT_DELETED, "Assignment deleted due to withdrawal");
INSERT INTO hms_activities(id, action, description) VALUES (25, ACTIVITY_WITHDRAWN_ROOMMATE_DELETED, "Roommate request deleted due to withdrawal");
INSERT INTO hms_activities(id, action, description) VALUES (26, ACTIVITY_WITHDRAWN_RLC_APP_DENIED, "RLC application denied due to withdrawal");
INSERT INTO hms_activities(id, action, description) VALUES (27, ACTIVITY_WITHDRAWN_RLC_ASSIGN_DELETED, "RLC assignment deleted due to withdrawal");
INSERT INTO hms_activities(id, action, description) VALUES (28, ACTIVITY_APPLICATION_REPORTED, "Application reported to Banner");
INSERT INTO hms_activities(id, action, description) VALUES (29, ACTIVITY_DENIED_RLC_APPLICATION, "Denied RLC Application");
INSERT INTO hms_activities(id, action, description) VALUES (30, ACTIVITY_UNDENIED_RLC_APPLICATION, "Un-denied RLC Application");
INSERT INTO hms_activities(id, action, description) VALUES (31, ACTIVITY_ASSIGN_TO_RLC, "Assigned student to RLC");
INSERT INTO hms_activities(id, action, description) VALUES (32, ACTIVITY_RLC_UNASSIGN, "Removed from RLC");
INSERT INTO hms_activities(id, action, description) VALUES (33, ACTIVITY_USERNAME_UPDATED, "Updated Username");
INSERT INTO hms_activities(id, action, description) VALUES (34, ACTIVITY_APPLICATION_UPDATED, "Updated Application");
INSERT INTO hms_activities(id, action, description) VALUES (35, ACTIVITY_RLC_APPLICATION_UPDATED, "Updated RLC Application");
INSERT INTO hms_activities(id, action, description) VALUES (36, ACTIVITY_RLC_APPLICATION_DELETED, "RLC Application Deleted");
INSERT INTO hms_activities(id, action, description) VALUES (37, ACTIVITY_ASSIGNMENTS_UPDATED, "Updated Assignments");
INSERT INTO hms_activities(id, action, description) VALUES (38, ACTIVITY_BANNER_QUEUE_UPDATED, "Updated Banner Queue");
INSERT INTO hms_activities(id, action, description) VALUES (39, ACTIVITY_ROOMMATES_UPDATED, "Updated Roommates");
INSERT INTO hms_activities(id, action, description) VALUES (40, ACTIVITY_ROOMMATE_REQUESTS_UPDATED, "Updated Roommate Requests");
INSERT INTO hms_activities(id, action, description) VALUES (41, ACTIVITY_CHANGE_ACTIVE_TERM, "Changed Active Term");
INSERT INTO hms_activities(id, action, description) VALUES (42, ACTIVITY_ADD_NOTE, "Note");
INSERT INTO hms_activities(id, action, description) VALUES (43, ACTIVITY_LOTTERY_SIGNUP_INVITE, "Invited to enter lottery");
INSERT INTO hms_activities(id, action, description) VALUES (44, ACTIVITY_LOTTERY_ENTRY, "Lottery entry submitted");
INSERT INTO hms_activities(id, action, description) VALUES (45, ACTIVITY_LOTTERY_INVITED, "Lottery invitation sent");
INSERT INTO hms_activities(id, action, description) VALUES (46, ACTIVITY_LOTTERY_REMINDED, "Lottery invitation reminder sent");
INSERT INTO hms_activities(id, action, description) VALUES (47, ACTIVITY_LOTTERY_ROOM_CHOSEN, "Lottery room chosen");
INSERT INTO hms_activities(id, action, description) VALUES (48, ACTIVITY_LOTTERY_REQUESTED_AS_ROOMMATE, "Requested as a roommate for lottery room");
INSERT INTO hms_activities(id, action, description) VALUES (49, ACTIVITY_LOTTERY_ROOMMATE_REMINDED, "Lottery roommate invivation reminder sent");
INSERT INTO hms_activities(id, action, description) VALUES (50, ACTIVITY_LOTTERY_CONFIRMED_ROOMMATE, "Confirmed lottery roommate request");
INSERT INTO hms_activities(id, action, description) VALUES (51, ACTIVITY_LOTTERY_EXECUTED, "Lottery process executed");
INSERT INTO hms_activities(id, action, description) VALUES (52, ACTIVITY_CREATE_TERM, "Created a new Term");
INSERT INTO hms_activities(id, action, description) VALUES (53, ACTIVITY_NOTIFICATION_SENT, "Notification sent");
INSERT INTO hms_activities(id, action, description) VALUES (54, ACTIVITY_ANON_NOTIFICATION_SENT, "Anonymous notification sent");
INSERT INTO hms_activities(id, action, description) VALUES (55, ACTIVITY_HALL_NOTIFIED, "Email notification sent to hall");
INSERT INTO hms_activities(id, action, description) VALUES (56, ACTIVITY_HALL_NOTIFIED_ANONYMOUSLY, "Anonymous email notification sent to hall");
INSERT INTO hms_activities(id, action, description) VALUES (57, ACTIVITY_LOTTERY_OPTOUT, "Opted-out of waiting list");
INSERT INTO hms_activities(id, action, description) VALUES (58, ACTIVITY_FLOOR_NOTIFIED_ANONYMOUSLY, "Anonymous email notification sent to floor");
INSERT INTO hms_activities(id, action, description) VALUES (59, ACTIVITY_FLOOR_NOTIFIED, "Email notification sent to floor");
INSERT INTO hms_activities(id, action, description) VALUES (60, ACTIVITY_ROOM_CHANGE_SUBMITTED, "Submitted Room Change Request");
INSERT INTO hms_activities(id, action, description) VALUES (61, ACTIVITY_ROOM_CHANGE_APPROVED_RD, "RD Approved Room Change");
INSERT INTO hms_activities(id, action, description) VALUES (62, ACTIVITY_ROOM_CHANGE_APPROVED_HOUSING, "Housing Approved Room Change");
INSERT INTO hms_activities(id, action, description) VALUES (63, ACTIVITY_ROOM_CHANGE_COMPLETED, "Room Change Completed");
INSERT INTO hms_activities(id, action, description) VALUES (64, ACTIVITY_ROOM_CHANGE_DENIED, "Room Change Denied");
INSERT INTO hms_activities(id, action, description) VALUES (65, ACTIVITY_ROOM_CHANGE_AGREED, "Agreed to Room Change Request");
INSERT INTO hms_activities(id, action, description) VALUES (66, ACTIVITY_ROOM_CHANGE_DECLINE, "Declined Room Change Request");
INSERT INTO hms_activities(id, action, description) VALUES (67, ACTIVITY_LOTTERY_ROOMMATE_DENIED, "Denied lottery roommate invite");
INSERT INTO hms_activities(id, action, description) VALUES (68, ACTIVITY_CANCEL_HOUSING_APPLICATION, "Housing Application Cancelled");
INSERT INTO hms_activities(id, action, description) VALUES (69, ACTIVITY_ACCEPT_RLC_INVITE, "Accepted RLC Invitation");
INSERT INTO hms_activities(id, action, description) VALUES (70, ACTIVITY_DECLINE_RLC_INVITE, "Declined RLC Invitation");
INSERT INTO hms_activities(id, action, description) VALUES (71, ACTIVITY_RLC_INVITE_SENT, "RLC Invitation Sent");
INSERT INTO hms_activities(id, action, description) VALUES (72, ACTIVITY_EMERGENCY_CONTACT_UPDATED, "Emergency Contact & Missing Person information updated");
INSERT INTO hms_activities(id, action, description) VALUES (73, ACTIVITY_CHECK_IN, 'Checked-in');
INSERT INTO hms_activities(id, action, description) VALUES (74, ACTIVITY_CHECK_OUT, 'Checked-out');
INSERT INTO hms_activities(id, action, description) VALUES (75, ACTIVITY_REAPP_WAITINGLIST_APPLY, 'Applied for Re-application Waiting List');
INSERT INTO hms_activities(id, action, description) VALUES (76, ACTIVITY_REINSTATE_APPLICATION, 'Reinstated Application');
INSERT INTO hms_activities(id, action, description) VALUES (77, ACTIVITY_ROOM_CHANGE_REASSIGNED, 'Reassigned due to Room Change');
INSERT INTO hms_activities(id, action, description) VALUES (78, ACTIVITY_CONTRACT_CREATED, 'Created a Contract');
INSERT INTO hms_activities(id, action, description) VALUES (79, ACTIVITY_CONTRACT_SENT_EMAIL, 'Contract Sent via Email');
INSERT INTO hms_activities(id, action, description) VALUES (80, ACTIVITY_CONTRACT_STUDENT_SIGN_EMBEDDED, 'Student Signed Contract via Embedded Signing');
INSERT INTO hms_activities(id, action, description) VALUES (81, ACTIVITY_CONTRACT_REMOVED_VOIDED, 'Removed Voided Contract');
INSERT INTO hms_activities(id, action, description) VALUES (82, ACTIVITY_MEAL_PLAN_SENT, 'Meal Plan Reported to Banner');
