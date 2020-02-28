##### SMARTLINK

Create a smartlink


```
create(
	string <name>,
	int <folder-id>
): ResourceInformation
```

Append a new tracking link to an existing smartlink


```
createLink(
	int <smartlink-id>,
	string <link-name>,
	string <link-url>
): string <link-short-url>
```

Get all tracking links from a smartlink


```
getTrackingUrls(
	int <smartlink-id>
): SmartLink[]
```

Move a smartlink to a folder


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

Retrieve all smartlinks in a folder


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

Retrieve a smartlink by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
