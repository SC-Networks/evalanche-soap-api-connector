##### MAILING

*Note*
The statistics related methods won't work with mailing types which don't
provide statistical data. Also methods which modify the object won't work with
read-only mailing types like sent mailings.

Move a mailing to a folder


```
move(int <mailing-id>, int <folder-id>): ResourceInformation
```

Copy a mailing to a folder


```
copy(int <mailing-id>, int <folder-id>): ResourceInformation
```

Delete a mailing


```
delete(int <mailing-id>): bool
```

Retrieve all mailings of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all mailings in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a mailing by id


```
getById(int <mailing-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for mailings


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve a mailing by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```

Add articles to a mailing


```
addArticles(
	int <mailing-id>,
	MailingArticleInterface[] <mailing-article>
): MailingArticle
```

Retrieve the client statistic of a mailing

```
getClientStatisticById(int <mailing-id>): ClientStatistic
```

```
createDraft(
	string <object-name>,
	int <mailing-template-id>,
	int <folder-id>
	int <type-id> (optional)
): ResourceInformation
```

Retrieve all profiles with an article impression in a mailing

```
getAllArticleImpressionProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles with a link click in a mailing

```
getAllLinkClickProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles with a certain article impression in a mailing

```
getArticleImpressionProfiles(
	int <mailing-id>,
	int <article-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all articles of a mailing

```
getArticlesByMailingId(int <mailing-id>): MailingArticle[]
```

Retrieve the statistic of all articles in a mailing

```
getArticleStatistics(int <mailing-id>): ArticleStatistic[]
```

Retrieve all profiles which have bounced in a mailing

```
getBounceProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles which have clicked in a mailing

```
getClickProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all clicks in a mailing

```
getClicks(
	int <mailing-id>,
	int <timestamp-start>,
	int <timestamp-end>
): MailingClick[]
```

Retrieve the detailed configuration of a mailing

```
getConfiguration(int <mailing-id>): MailingConfiguration
```

Get object specific details of a mailing

```
getDetailsById(int <mailing-id>): MailingDetail
```

Retrieve all profiles with a hardbounce in a mailing

```
getHardbounceProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles with an impression in a mailing

```
getImpressionProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all impressions of a mailing

```
getImpressions(
	int <mailing-id>,
	int <timestamp-start>,
	int <timestamp-end>
): MailingImpression[]
```

Retrieve status information of an async job


```
getJobInformationByJobId(
	string <job-id>
): JobHandle
```

Retrieve all profiles which clicked on a certain link in a mailing

```
getLinkClickProfiles(
	int <mailing-id>,
	int <link-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles which clicked multiple times in a mailing

```
getMultipleClickProfiles(
	int <mailing-id>,
	int <link-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles which have multiple impression in a mailing

```
getMultipleImpressionProfiles(
	int <mailing-id>,
	int <link-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve all profiles which are recipients of a mailing

```
getRecipientsProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Get the cursor position of an async job


```
getResultCursorByJobId(string <job-id>): string
```

Retrieve the result of an async job

```
getResults(
	string <job-id>
): JobResult
```

Retrieve a list of all sendable mailing drafts

```
getSendableDrafts(
	bool <just-unsent-mailings>
): ResourceInformation[]
```

Like `getSendableDrafts` but with a mandator constraint

```
getSendableDraftsByMandatorId(
	int <mandator-id>,
	bool <just-unsent-mailings>
): ResourceInformation[]
```

Retrieve all profiles with a softbounce in a mailing

```
getSoftbounceProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Retrieve the statistics of a mailing

```
getStatisticsByMailingId(int <mailing-id>): MailingStatistic
```

Retrieve the status of all addressees of an sent mailing

```
getStatus(
	int <mailing-id>,
	int <time-in-seconds-from-now-in-the-past>,
	string[] <pool-attribute-names>
): MailingStatus
```

Retrieve all configured subject variants of a mailing

```
getSubjectsByMailingId(int <mailing-id>): MailingSubjec[]
```

Retrieve all profiles which have an unsubscription in a mailing

```
getUnsubscriptionProfiles(
	int <mailing-id>,
	string[] <pool-attribute-names>
): JobHandle
```

Remove all articles of a mailing

```
removeAllArticles(int <mailing-id>): bool
```

Remove certain articles of a mailing

```
removeArticles(
	int <mailing-id>,
	int[] <article-reference-ids>
): MailingArticle[]
```

Update the title of a mailing

```
updateTitle(
    int <mailing-template-id>,
    string <title>
): ResourceInformation
```

Send a mailing to a list of profiles

```
sendToProfiles(
	int <mailing-id>,
	int[] <profile-ids>
): int[]
```

Send a mailing to the profiles of a targetgroup

```
sendToTargetGroup(
	int <mailing-id>,
	int <targetgroup-id>,
	int <sendstart-date-as-unix-timestamp>,
	int <sendout-speed-in-mails-per-hour>
): MailingDetail
```

Set the detail configuration of a mailing

```
setConfiguration(
    int <mailing-id>
    MailingConfiguration <mailing-configuration>
): MailingConfiguration
```

Set the result cursor of an async job


```
setResultCursor(
	string <job-id>,
	int <cursor-position>
): bool
```

Set the subject variants of a mailing

```
setSubjects(
	int <mailing-id>,
	array <subject-lines-and-targetgroup-id>
): bool
```

Retrieve the content of the container container of a mailing

```
getContentContainerData(
    int <mailing_id>
): HashMap
```

Update the content container of a mailing

```
setContentContainerData(
    int <mailing_id>,
    HashMap <data>
): EvalancheResourceInformation
```