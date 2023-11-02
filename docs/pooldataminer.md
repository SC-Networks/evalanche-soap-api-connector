##### POOLDATAMINER

Update the title of a pooldataminer


```
updateTitle(
    int <pooldataminer-id>,
    string <title>
): ResourceInformation
```

Move a pooldataminer to a folder


```
move(int <pooldataminer-id>, int <folder-id>): ResourceInformation
```

Copy a pooldataminer to a folder


```
copy(int <pooldataminer-id>, int <folder-id>): ResourceInformation
```

Delete a pooldataminer


```
delete(int <pooldataminer-id>): bool
```

Update the title of a pooldataminer

```
updateTitle(
    int <pooldataminer-id>,
    string <title>
): ResourceInformation
```

Retrieve all pooldataminers of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all pooldataminer in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a pooldataminer by id


```
getById(int <pooldataminer-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for pooldataminers


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve a pooldataminer by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
