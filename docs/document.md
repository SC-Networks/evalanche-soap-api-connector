##### DOCUMENT

Move a document to a folder


```
move(int <document-id>, int <folder-id>): ResourceInformation
```

Copy a document to a folder


```
copy(int <document-id>, int <folder-id>): ResourceInformation
```

Delete a document


```
delete(int <document-id>): bool
```

Update the title of a document

```
updateTitle(
    int <document-id>,
    string <title>
): ResourceInformation
```

Retrieve all documents of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all documents in a folder


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

Retrieve a document by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
