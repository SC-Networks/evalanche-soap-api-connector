##### REPORT

Create a new report object


```
create(
	string <name>,
	int <folder-id>
): ResourceInformation
```

Attach an object to an existing report object


```
addResourceIdToReport(
	int <resource-id>,
	int <report-id>
): bool
```

Move a report to a folder


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

Update the title of a report

```
updateTitle(
    int <report-id>,
    string <title>
): ResourceInformation
```

Retrieve all reports of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all reports in a folder


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

Retrieve a report by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
