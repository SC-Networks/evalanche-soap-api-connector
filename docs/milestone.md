##### MILESTONE

Create a new milestone


```
create(
	string <milestone-name>
	int <folder-id>
): ResourceInformation
```

Move a milestone to a folder


```
move(int <milestone-id>, int <folder-id>): ResourceInformation
```

Copy a milestone to a folder


```
copy(int <milestone-id>, int <folder-id>): ResourceInformation
```

Delete a milestone


```
delete(int <milestone-id>): bool
```

Update the title of a milestone

```
updateTitle(
    int <milestone-id>,
    string <title>
): ResourceInformation
```

Retrieve all milestones of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all milestones in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a milestone by id


```
getById(int <milestone-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for milestones


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve a milestone by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
