##### POOL

Copy an pool to a folder


```
copy(int <pool-id>, int <folder-id>): ResourceInformation
```

Delete an pool


```
delete(int <pool-id>): bool
```

Retrieve all pools of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all pools of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve the pool by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```

Retrieve an article-type by id


```
getById(int <pool-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for pool


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Moves an pool to a folder


```
move(int <pool-id>, int <folder-id>): ResourceInformation
```


Add an attribute to a pool


```
addAttribute(int <pool-id>, string <name>, string <label>, int <type-id>): PoolAttribute
```

Adds options to an existing attribute


```
addAttributeOption(int <pool-id>, int <attribute-id>, string[] <option-labels>): PoolAttribute
```

Delete an existing attribute


```
deleteAttribute(int <pool-id>, int <attribute-id>): bool
```

Delete an existing attribute option


```
deleteAttributeOption(int <pool-id>, int <attribute-id>, int <option-id>): PoolAttribute
```

Retrieve all existing attributes of a pool


```
getAttributesByPool(int <pool-id>): PoolAttribute[]
```

Update an existing attribute option


```
updateAttributeOption(int <pool-id>, int <attribute-id>, int <option-id>, string <label>): PoolAttribute
```