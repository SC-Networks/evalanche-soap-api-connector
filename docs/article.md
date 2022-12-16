##### ARTICLE

Create an article


```
create(
    int <article-id>,
    string <title>,
    int <folder-id>,
    HashMap <hash-map>
): ResourceInformation
```

Retrieve details of an article


```
getDetailById(
    int <article-id>
): HashMap
```

Update details of an article


```
update(
    int <article-id>,
    HashMap <hash-map>
): HashMap
```

Move an article to a folder


```
move(int <article-id>, int <folder-id>): ResourceInformation
```

Copy an article to a folder


```
copy(int <article-id>, int <folder-id>): ResourceInformation
```

Delete an article


```
delete(int <article-id>): bool
```

Retrieve all articles of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all articles in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an article by id


```
getById(int <article-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for articles


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve an article by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```

Get object specific details of an article


```
getDetailsById(int <article-id>): ArticleDetail
```
