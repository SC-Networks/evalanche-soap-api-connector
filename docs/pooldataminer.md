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