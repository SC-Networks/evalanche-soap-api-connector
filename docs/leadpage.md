##### LEADPAGE

Move a leadpage to a folder


```
move(int <leadpage-id>, int <folder-id>): ResourceInformation
```

Copy a leadpage to a folder


```
copy(int <leadpage-id>, int <folder-id>): ResourceInformation
```

Delete a leadpage


```
delete(int <leadpage-id>): bool
```

Retrieve all leadpages of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all leadpages in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a leadpage by id


```
getById(int <leadpage-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for leadpages


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve a leadpage by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```


Get object specific details of a leadpage

```
getDetailsById(int <leadpage-id>): ResourceInformation
```

Set the detail configuration of a leadpage

```
setConfiguration(
    int <leadpage-id>
    LeadpageConfiguration <leadpage-configuration>
): LeadpageConfiguration
```

Retrieve the detailed configuration of a leadpage

```
getConfiguration(int <leadpage-id>): LeadpageConfiguration
```