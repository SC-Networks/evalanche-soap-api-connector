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