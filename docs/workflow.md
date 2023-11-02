##### WORKFLOW

Move a workflow to a folder


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

Update the title of a workflow

```
updateTitle(
    int <workflow-id>,
    string <title>
): ResourceInformation
```

Retrieve all workflows of a mandator


```
getListByMadatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all workflows in a folder


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

Retrieve a workflow by its external id


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
