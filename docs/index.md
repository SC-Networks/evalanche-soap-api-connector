##### ACCOUNT

Get Customer Account Info

```
getAccountByMandatorId(int <mandator-id>): Account
```

##### ARTICLE

Creates a article


```
create(
    int <article-id>,
    string <title>,
    int <folder-id>,
    HashMap <hash-map>
): ResourceInformation
```

Retrieve details of an article


```
getDetailById(
    int <article-id>
): HashMap
```

Update details of an article


```
update(
    int <article-id>,
    HashMap <hash-map>
): HashMap
```

Moves an article to a folder


```
move(int <article-id>, int <folder-id>): ResourceInformation
```

Copy an article to a folder


```
copy(int <article-id>, int <folder-id>): ResourceInformation
```

Delete an article


```
delete(int <article-id>): bool
```

Retrieve all articles of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all articles of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an article by id


```
getById(int <article-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for articles


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the article by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### ARTICLE-TEMPLATE

Moves an article-template to a folder


```
move(int <article-id>, int <folder-id>): ResourceInformation
```

Copy an article-template to a folder


```
copy(int <article-id>, int <folder-id>): ResourceInformation
```

Delete an article-template


```
delete(int <article-id>): bool
```

Retrieve all article-template of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all article-template of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an article-template by id


```
getById(int <article-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for article-templates


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the article-template by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### ARTICLE-TYPE

Add a attribute to an article-type


```
addAttribute(
    int <article-type-id>,
    string <title>,
    string <label>,
    int <attribute-type-id>,
    int <$groupId>
): ContainerAttribute
```

Remove a attribute of an article-type


```
removeAttribute(
    int <attribute-type-id>,
    int <attribute-id>
): bool
```

Change a attribute-type of attribute from article-type


```
changeAttributeType(
    int <article-type-id>,
    int <attribute-id>,
    int <attribute-type-id>
): bool
```

Assign a role to an attribute of article-type


```
assignRoleToAttribute(
    int <article-type-id>,
    int <attribute-id>,
    int <role-type-id>
): bool
```

Add a attribute-group to an article-type


```
addAttributeGroup(
    int <article-type-id>,
    string <title>
): ContainerAttributeGroup
```

Remove a attribute-group of an article-type


```
removeAttributeGroup(
    int <article-type-id>,
    int <attribute-group-id>
): ContainerAttributeGroup
```

Add a attribute-option to an attribute of article-type


```
createAttributeOption(
    int <article-type-id>,
    int <attribute-id>,
    string <label>
): ContainerAttributeOption
```

Remove a attribute-option from an attribute of article-type


```
removeAttributeOption(
    int <article-type-id>,
    int <attribute-id>,
    int <attribute-option-id>
): bool
```

Retrieve all attributes of a article-type


```
getAttributes(int <article-type-id>): ContainerAttribute[]
```

Retrieve all attribute-options of a attribute of article-type


```
getAttributeOptions(
    int <article-type-id>,
    int <attribute-id>
): ContainerAttributeOption[]
```

Retrieve all attribute-groups of article-type


```
getAttributeGroups(int <article-type-id>): ContainerAttributeGroup[]
```

Retrieve all applicable role types of a attribute of article-type


```
getApplicableRoleTypes(
    int <article-type-id>,
    int <attribute-id>
): ContainerAttributeRoleType[]
```

Retrieve all assigned role types of a attribute of article-type


```
getAssignedRoleTypes(
    int <article-type-id>,
    int <attribute-id>
): ContainerAttributeRoleType[]
```

Moves an article-type to a folder


```
move(int <article-id>, int <folder-id>): ResourceInformation
```

Copy an article-type to a folder


```
copy(int <article-id>, int <folder-id>): ResourceInformation
```

Delete an article-type


```
delete(int <article-id>): bool
```

Retrieve all article-type of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all article-type of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an article-type by id


```
getById(int <article-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for article-type


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the article-type by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### BLACKLIST

Add an entry to a mandators blacklist


```
add(int <mandator-id>, string <email address>, string <comment>): bool
```

Remove an entry from a mandators blacklist


```
remove(int <mandator-id>, string <email address>): bool
```

Retrieve the mandators blacklist


```
get(int <mandator-id>): BlackList
```

##### FOLDER

Create a new folder


```
create(
	string <name>,
	int <parent-folder-id>
): FolderInformation
```

Delete an folder


```
delete(int <folder-id>): bool
```

Get Subfolders from Folder


```
getSubFolderById(
	int <folder-id>
): FolderInformation[]
```

##### CONTAINER

Retrieve the details of a Container


```
getDetailById(int <container-id>): HashMap
```

Update a Container


```
update(int <container-id>, HashMap <hash-map>): ResourceInformation
```

Moves a container to a folder


```
move(int <container-id>, int <folder-id>): ResourceInformation
```

Copy a container to a folder


```
copy(int <container-id>, int <folder-id>): ResourceInformation
```

Delete a container


```
delete(int <container-id>): bool
```

Retrieve all containers of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all containers of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a container by id


```
getById(int <container-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for containers


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the container by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### CONTAINER-TYPE

Add an attribute to a container-type


```
addAttribute(
    int <container-type-id>,
    string <title>,
    string <label>,
    int <type-id>,
    int <attribute-group-id>
): ContainerAttribute
```

Add an attribute group to a container-type


```
addAttribute(
    int <container-type-id>,
    string <title>
): ContainerAttributeGroup
```

Update a attribute-type of a container-type


```
updateAttributeType(
    int <container-type-id>,
    int <attribute-id>,
    int <type-id>
): bool
```

Add an option to attribute of a container-type


```
addAttributeOption(
    int <container-type-id>,
    int <attribute-id>,
    string <label>
): ContainerAttributeOption
```

Retrieve all attribute-groups of a container-type


```
getAttributeGroupsByResourceId(int <container-type-id>): ContainerAttributeGroup[]
```

Retrieve all attribute-options of a container-type


```
getAttributeOptionsByResourceIdAndAttributeId(
    int <container-type-id>,
    int <attribute-id>
): ContainerAttributeOption[]
```

Retrieve all attributes of a container-type


```
getAttributesByResourceId(
    int <container-type-id>
): ContainerAttribute[]
```

Removes a attribute of a container-type


```
removeAttribute(
    int <container-type-id>
    int <attribute-id>
): bool
```

Removes a attribute-group of a container-type


```
removeAttribute(
    int <container-type-id>
    int <attribute-group-id>
): bool
```

Removes a attribute-option from an attribute of a container-type


```
removeAttributeOption(
    int <container-type-id>
    int <attribute-id>,
    int <attribute-option-id>
): bool
```

Updates an Attribute of a container-type


```
updateAttribute(
    int <container-type-id>
    int <attribute-id>,
    int <hash-map>
): ContainerAttribute
```

Moves a container-type to a folder


```
move(int <container-type-id>, int <folder-id>): ResourceInformation
```

Copy a container-type to a folder


```
copy(int <container-type-id>, int <folder-id>): ResourceInformation
```

Delete a container-type


```
delete(int <container-type-id>): bool
```

Retrieve all container-types of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all container-types of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a container-type by id


```
getById(int <container-type-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for container-types


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the container-type by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### DOCUMENT

Moves a document to a folder


```
move(int <document-id>, int <folder-id>): ResourceInformation
```

Copy a document to a folder


```
copy(int <document-id>, int <folder-id>): ResourceInformation
```

Delete n document


```
delete(int <document-id>): bool
```

Retrieve all documents of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all documents of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a document by id


```
getById(int <document-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for documents


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the document by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### FORM

Updates the title of a form


```
updateTitle(
    int <form-id>,
    string <title>
): ResourceInformation
```

Updates the template of a form


```
updateTemplate(
    int <form-id>,
    string <template>
): ResourceInformation
```

Creates a alias of a form


```
createAlias(
    int <form-id>,
    string <alias>,
    int <folder-id>,
): ResourceInformation
```

Adds a attribute to a form


```
addAttribute(
    int <form-id>,
    int <attribute-id>
): bool
```

Removes a attribute from a form


```
removeAttribute(
    int <form-id>,
    int <attribute-id>
): bool
```

Adds a attribute option to a form


```
addAttributeOption(
    int <form-id>,
    int <attribute-option-id>
): bool
```

Removes a attribute option from a form


```
removeAttributeOption(
    int <form-id>,
    int <attribute-option-id>
): bool
```

Retrieve statistics of a form


```
getStatistics(
    int <form-id>,
    bool <include-aliases>
): FormStatisticInterface
```

Retrieve a form by alias


```
getFormByAlias(
    int <alias-id>,
): ResourceInformation
```

Retrieve all aliases of a form


```
getAliases(
    int <alias-id>,
): ResourceInformation[]
```

Moves a form to a folder


```
move(int <form-id>, int <folder-id>): ResourceInformation
```

Copy a form to a folder


```
copy(int <form-id>, int <folder-id>): ResourceInformation
```

Delete a form


```
delete(int <form-id>): bool
```

Retrieve all forms of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all forms of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a form by id


```
getById(int <form-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for forms


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the form by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### TARGETGROUP

Moves a targetgroup to a folder


```
move(int <targetgroup-id>, int <folder-id>): ResourceInformation
```

Copy a targetgroup to a folder


```
copy(int <targetgroup-id>, int <folder-id>): ResourceInformation
```

Delete a targetgroup


```
delete(int <targetgroup-id>): bool
```

Retrieve all targetgroups of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all targetgroups of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a targetgroup by id


```
getById(int <targetgroup-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for targetgroups


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the targetgroup by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

Retrieve the details of a targetgroup


```
getDetailById(int <targetgroup-id>): TargetGroupDetail
```

Create a targetgroup using a pool attribute option


```
createByOption(
	int <pool-id>,
	int <pool-attribute-id>,
	int <pool-attribute-option-id>,
	int <folder-id>,
	string <name>
): ResourceInformation
```

##### IMAGE

Create a new image


```
create(
	string <base-64-encoded-file-content>,
	string <image-title>
	int <folder-id>
): ResourceInformation
```

Moves an image to a folder


```
move(int <image-id>, int <folder-id>): ResourceInformation
```

Copy an image to a folder


```
copy(int <image-id>, int <folder-id>): ResourceInformation
```

Delete an image


```
delete(int <image-id>): bool
```

Retrieve all images of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all images of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an image by id


```
getById(int <image-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for images


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the image by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### MAILING

*Note*
The statistics related methods won't work with mailing types which don't
provide statistical data. Also method which modify the object won't work with
read-only mailing types like sent mailings.

Moves a mailing to a folder


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

Retrieve all mailings of a folder


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

Retrieve the mailing by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

Add articles to a mailing


```
addArticles(
	int <mailing-id>,

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

Retrieve all mailings of a certain type within a mandator

```
getByTypeId(
	int <mailing-id>,
	int <mandator-id>
): MailingDetail
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

Retrieve status information about an async job


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

Retrieve all profiles which a recipients of a mailing

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

Retrieve the list of supported mailing type ids

```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve all profiles which have a unsubscription in a mailing

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
removeArticle(
	int <mailing-id>,
	int[] <article-reference-ids>
): MailingArticle[]
```

Updates the title of a mailing

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

Retrieve all mailings of a mandator

```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all mailings of a folder

```
getByFolderId(int <folder-id>): ResourceInformation[]
``
```

Retrieve a mailing by id

```
getById(int <mailing-template-id>): ResourceInformation
```

Retrieve the default folder for mailings

```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve a mailing by an external id

```
getByExternalId(string <external-id>): ResourceInformation
```

##### MAILING-TEMPLATE

Updates the title of a mailing-template


```
updateTitle(
    int <mailing-template-id>,
    string <title>
): ResourceInformation
```

Moves a mailing-template to a folder


```
move(int <mailing-template-id>, int <folder-id>): ResourceInformation
```

Copy a mailing-template to a folder


```
copy(int <mailing-template-id>, int <folder-id>): ResourceInformation
```

Delete a mailing-template


```
delete(int <mailing-template-id>): bool
```

Retrieve all mailing-templates of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all mailing-templates of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a mailing-template by id


```
getById(int <mailing-template-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for mailing-templates


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the mailing-template by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### MANDATOR

Gets a list of customers by given customer id


```
getById(
	int <customer-id>
): Mandator
```

Gets a list of customers for your Account


```
getList(): Mandator[]
```

##### POOL

Add an attribute to a pool


```
addAttribute(int <pool-id>, string <name>, string <label>, int <type-id>): PoolAttribute
```

Adds options to an existing attribute


```
addAttributeOption(int <pool-id>, int <attribute-id>, string[] <option-labels>): PoolAttribute
```

Delete an existing attribute


```
deleteAttribute(int <pool-id>, int <attribute-id>): bool
```

Delete an existing attribute option


```
deleteAttributeOption(int <pool-id>, int <attribute-id>, int <option-id>): PoolAttribute
```

Retrieve all existing attributes of a pool


```
getAttributesByPool(int <pool-id>): PoolAttribute[]
```

Update an existing attribute option


```
updateAttributeOption(int <pool-id>, int <attribute-id>, int <option-id>, string <label>): PoolAttribute
```

##### POOL-DATA-MINER

Updates the title of a pooldataminer


```
updateTitle(
    int <pooldataminer-id>,
    string <title>
): ResourceInformation
```

Moves an pooldataminer to a folder


```
move(int <pooldataminer-id>, int <folder-id>): ResourceInformation
```

Copy an pooldataminer to a folder


```
copy(int <pooldataminer-id>, int <folder-id>): ResourceInformation
```

Delete an pooldataminer


```
delete(int <pooldataminer-id>): bool
```

Retrieve all pooldataminer of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all pooldataminer of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an pooldataminer by id


```
getById(int <pooldataminer-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for pooldataminer


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the pooldataminer by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### PROFILE

Add a specific score value to a profiles activity scoring


```
addScore(
	int <profile-id>,
	int <scoring-group-id>,
	int <score-value>,
	string <title>
): bool
```

Create a profile and return the profile id


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

Retrieve a profiles status in a certain mailing


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

Check whether a certain profile is in a list of targetgroups


```
isInTargetgroups(
	int <profile-id>,
	int[] <targetgroup-ids>
): TargetGroupMemberShip[]
```

Updates data of a set of profiles


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

Revoke a profiles permission


```
revokePermission(int <profile-id>): bool
```

Revoke a profiles tracking permission


```
revokeTracking(int <profile-id>): bool
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

##### REPORT

Create a new report object


```
create(
	string <name>,
	int <folder-id>
): ResourceInformation
```

Attaches an object to an existing report object


```
addResourceIdToReport(
	int <resource-id>,
	int <report-id>
): bool
```

Moves a report to a folder


```
move(int <report-id>, int <folder-id>): ResourceInformation
```

Copy a report to a folder


```
copy(int <report-id>, int <folder-id>): ResourceInformation
```

Delete a report


```
delete(int <report-id>): bool
```

Retrieve all reports of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all reports of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a report by id


```
getById(int <report-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for reports


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the report by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### SCORING

Retrieve the list of available scoring groups of a mandator


```
getListByMandatorId(int <mandator-id>): ScoringGroupDetail
```

##### SMARTLINK

Create a smartlink


```
create(
	string <name>,
	int <folder-id>
): ResourceInformation
```

Appends a new Tracking Link to an existing smartlink object


```
createLink(
	int <smartlink-id>,
	string <link-name>,
	string <link-url>
): string <link-short-url>
```

Get all Tracking Links from a smartlink object


```
getTrackingUrls(
	int <smartlink-id>
): SmartLink[]
```

Moves a smartlink to a folder


```
move(int <smartlink-id>, int <folder-id>): ResourceInformation
```

Copy a smartlink to a folder


```
copy(int <smartlink-id>, int <folder-id>): ResourceInformation
```

Delete a smartlink


```
delete(int <smartlink-id>): bool
```

Retrieve all smartlinks of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all smartlinks of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a smartlink by id


```
getById(int <smartlink-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for smartlinks


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the smartlink by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

##### USER

Retrieve an user by its name;


```
getByUsername(string <username>): User
```

Retrieve all users of a mandator


```
getListByMandatorId(int <mandator-id>): User[]
```

Update an user


```
updateUser(User <user-data>): User
```

##### WEBHOOK

Trigger Webhook

```
trigger(int <webook-id>, int <profile-id>): void
```

##### WORKFLOW

Moves a workflow to a folder


```
move(int <workflow-id>, int <folder-id>): ResourceInformation
```

Copy a workflow to a folder


```
copy(int <workflow-id>, int <folder-id>): ResourceInformation
```

Delete a workflow


```
delete(int <workflow-id>): bool
```

Retrieve all workflows of a mandator


```
getListByMadatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all workflows of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a workflow by id


```
getById(int <workflow-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for workflows


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the workflow by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

Retrieve all workflows based on their start date


```
getByStartDateRange(int <from-timestamp>, int <to-timestamp>): ResourceInformation[]
```

Retrieve all workflows based on their end date


```
getByEndDateRange(int <from-timestamp>, int <to-timestamp>): ResourceInformation[]
```

Retrieve the details of a workflow


```
getDetailById(int <workflow-id>): WorkflowDetail
```

Push existing profiles into a workflow


```
pushProfilesIntoCampaign(int <workflow-id>, int[] <profile-ids>): bool
```


Create a workflow by a JSON configuration


```
createConfigured(string <name>, int <schema-version>, string <workflow-configuration>, int <category-id>): ResourceInformationInterface
```


Export a specific workflow configuration as JSON string


```
export(int <workflow-id>): string
```
