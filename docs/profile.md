##### PROFILE

Add a specific score value to a profile's activity scoring


```
addScore(
	int <profile-id>,
	int <scoring-group-id>,
	int <score-value>,
	string <title>
): bool
```

Create a profile and return its id


```
create(
	int <pool-id>,
	HashMap <profile-data>
): int
```

Delete certain profiles


```
delete(int[] <profile-ids>): bool
```

Retrieve the activity scoring history of a profile in a certain date range


```
getActivityScoringHistory(
	int <profile-id>,
	int <scoring-group-id>,
	int <scoring-type-id>,
	int <object-id>,
	int <timestamp-start>,
	int <timestamp-end>
): ProfileActivityScore[]
```

Retrieve all bounces and their profile-data in a certain date range


```
getBounces(
	int <pool-id>,
	string[] <pool-attribute-names>,
	int <timestamp-start>,
	int <timestamp-end>
): ProfileBounceStatus[]
```

Retrieve a profile by id


```
getById(int <profile-id>): HashMap
```

Retrieve all profiles by key


```
getByKey(
	int <pool-id>,
	string <pool-attribute-name>,
	string <value-to-search-for>,
	string[] <pool-attribute-names>
): HashMap[]
```

Retrieve all profiles of a milestone in a certain date


```
public function getByMilestone(
	int <milestone-id>,
	string[] <pool-attribute-names>,
	int <timestamp-start>,
	int <$timestamp-end>
): JobHandle
```

Retrieve all profiles of a pool


```
getByPool(
	int <pool-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles of a targetgroup


```
getByTargetGroup(
	int <targetgroup-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles which received a permission grant in a certain date
range


```
getGrantedPermissions(
	int <pool-id>,
	string[] <pool-attribute-names>,
	int <timestamp-start>,
	int <timestamp-end>
): HashMap[]
```

Retrieve status information about an async job


```
getJobInformationByJobId(
	string <job-id>
): JobHandle
```

Retrieve a profile's status in a certain mailing


```
getMailingStatus(
	int <profile-id>,
	int <mailing-id>
): MailingStatus[]
```

Retrieve all profiles which have been modified within a certain date range


```
getModifiedProfiles(
	int <pool-id>,
	string[] <pool-attribute-names>,
	int <timestamp-start>,
	int <timetamp-end>
): HashMap[]
```

Get the cursor position of an async export job


```
getResultCursorByJobId(string <job-id>): string
```

Retrieve the result on an async job


```
getResultByJobId(string <job-id>): JobResult
```

Retrieve all scoring values of a profile


```
getScoresByProfileId(int <profile-id>): ProfileGroupScore[]
```

Retrieve the tracking history of a profile in a certain date range


```
getTrackingHistory(
	int <profile-id>,
	int <timestamp-start>,
	int <timestamp-end>
): ProfileTrackingHistory[]
```

Retrieve all profiles which received a permission revocation in a certain date
range


```
getUnsubscriptions(
	int <pool-id>,
	string[] <pool-attribute-names>
	int <timestamp-start>,
	int <timestamp-end>
): HashMap[]
```

Grant permission to a certain profile


```
grantPermission(int <profile-id>): bool
```

Check whether a certain profile is in a specific milestone within a certain
date range


```
hasMilestone(
	int <profile-id>,
	int <milestone-id>,
	int <timestamp-start>,
	int <timestamp-end>
): bool
```

Check whether a certain profile is in a list of targetgroups


```
isInTargetgroups(
	int <profile-id>,
	int[] <targetgroup-ids>
): TargetGroupMemberShip[]
```

Update data of a set of profiles


```
massUpdate(
	int <pool-id>,
	string <key-pool-attribute-name>,
	string[] <pool-attribute-names>,
	string[][] <data>,
	bool <merge>,
	bool <ignore-missing>
): MassUpdateResult
```

Merge data of a profile


```
mergeById(
	int <profile-id>,
	HashMap <profile-data>
): bool
```

Merge data of all profiles which match to a search term


```
mergeByKey(
	int <pool-id>,
	string <key-pool-attribute-name>,
	string <value>,
	HashMap <data>
): bool
```

Merge data of all profiles in a pool


```
mergeByPoolId(
	int <pool-id>,
	HashMap <data>
): bool
```

Merge data of all profiles in a targetgroup


```
mergeByTargetGroupId(
	int <targetgroup-id>,
	HashMap <data>
): bool
```

Revoke a profile's permission


```
revokePermission(int <profile-id>): bool
```

Revoke a profile's tracking permission


```
revokeTracking(int <profile-id>): bool
```

Set milestone of a profile


```
setMilestone(int <profile-id>, int <milestone-id>): bool
```

Set the result cursor of an async job


```
setResultCursor(
	string <job-id>,
	int <cursor-position>
): bool
```

Tag all profiles with a pool attribute option


```
tagWithOption(
	int <pool-attribute-option-id>,
	string[] <search-values>,
	string <key-pool-attribute-name>,
	bool <update-edit-date>
): bool
```

Untag all profiles with a pool attribute option


```
untagWithOption(
	int <pool-attribute-option-id>,
	string[] <search-values>,
	string <key-pool-attribute-name>,
	bool <update-edit-date>
): bool
```

Update data of a profile


```
updateById(
	int <profile-id>,
	HashMap <profile-data>
): bool
```

Update data of all profiles which match to a search term


```
updateByKey(
	int <pool-id>,
	string <key-pool-attribute-name>,
	string <value>,
	HashMap <data>
): bool
```

Update data of all profiles in a pool


```
updateByPool(
	int <pool-id>,
	HashMap <data>
): bool
```

Update data of all profiles in a targetgroup


```
updateByTargetGroup(
	int <targetgroup-id>,
	HashMap <data>
): bool
```
