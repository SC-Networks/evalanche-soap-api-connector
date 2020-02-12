##### DOCUMENT

Moves a document to a folder


```
move(int <document-id>, int <folder-id>): ResourceInformation
```

Copy a document to a folder


```
copy(int <document-id>, int <folder-id>): ResourceInformation
```

Delete n document


```
delete(int <document-id>): bool
```

Retrieve all documents of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all documents of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a document by id


```
getById(int <document-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for documents


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the document by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```