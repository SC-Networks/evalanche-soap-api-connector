##### TARGETGROUP

Move a targetgroup to a folder


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

Update the title of a targetgroup

```
updateTitle(
    int <targetgroup-id>,
    string <title>
): ResourceInformation
```

Retrieve all targetgroups of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all targetgroups in a folder


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

Retrieve a targetgroup by its external id


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
