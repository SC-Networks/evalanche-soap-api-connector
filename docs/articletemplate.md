##### ARTICLE TEMPLATE

Create an article template. Template should be a valid (x)html string, and will be tidied up on save


```
create(
    string <title>,
    int <type-id>
    string <template>, 
    int <folder-id>
): ResourceInformation
```

Update an article template's template


```
updateTemplate(
    int <template-id>
    string <template>
): ResourceInformation
```

Move an article template to a folder


```
move(int <article-id>, int <folder-id>): ResourceInformation
```

Copy an article template to a folder


```
copy(int <article-id>, int <folder-id>): ResourceInformation
```

Delete an article-template


```
delete(int <article-id>): bool
```

Retrieve all article templates of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all article templates in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an article template by id


```
getById(int <article-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for article templates


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve an article template by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
