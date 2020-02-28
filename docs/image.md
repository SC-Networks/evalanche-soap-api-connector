##### IMAGE

Create a new image


```
create(
	string <base-64-encoded-file-content>,
	string <image-title>
	int <folder-id>
): ResourceInformation
```

Move an image to a folder


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

Retrieve all images in a folder


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

Retrieve an image by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
