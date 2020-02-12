##### MAILING-TEMPLATE

Updates the title of a mailing-template


```
updateTitle(
    int <mailing-template-id>,
    string <title>
): ResourceInformation
```

Moves a mailing-template to a folder


```
move(int <mailing-template-id>, int <folder-id>): ResourceInformation
```

Copy a mailing-template to a folder


```
copy(int <mailing-template-id>, int <folder-id>): ResourceInformation
```

Delete a mailing-template


```
delete(int <mailing-template-id>): bool
```

Retrieve all mailing-templates of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all mailing-templates of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a mailing-template by id


```
getById(int <mailing-template-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for mailing-templates


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the mailing-template by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```