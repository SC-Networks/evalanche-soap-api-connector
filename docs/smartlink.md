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