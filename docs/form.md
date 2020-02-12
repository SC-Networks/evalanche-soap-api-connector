##### FORM

Updates the title of a form


```
updateTitle(
    int <form-id>,
    string <title>
): ResourceInformation
```

Updates the template of a form


```
updateTemplate(
    int <form-id>,
    string <template>
): ResourceInformation
```

Creates a alias of a form


```
createAlias(
    int <form-id>,
    string <alias>,
    int <folder-id>,
): ResourceInformation
```

Adds a attribute to a form


```
addAttribute(
    int <form-id>,
    int <attribute-id>
): bool
```

Removes a attribute from a form


```
removeAttribute(
    int <form-id>,
    int <attribute-id>
): bool
```

Adds a attribute option to a form


```
addAttributeOption(
    int <form-id>,
    int <attribute-option-id>
): bool
```

Removes a attribute option from a form


```
removeAttributeOption(
    int <form-id>,
    int <attribute-option-id>
): bool
```

Retrieve statistics of a form


```
getStatistics(
    int <form-id>,
    bool <include-aliases>
): FormStatisticInterface
```

Retrieve a form by alias


```
getFormByAlias(
    int <alias-id>,
): ResourceInformation
```

Retrieve all aliases of a form


```
getAliases(
    int <alias-id>,
): ResourceInformation[]
```

Moves a form to a folder


```
move(int <form-id>, int <folder-id>): ResourceInformation
```

Copy a form to a folder


```
copy(int <form-id>, int <folder-id>): ResourceInformation
```

Delete a form


```
delete(int <form-id>): bool
```

Retrieve all forms of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all forms of a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a form by id


```
getById(int <form-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for forms


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve the form by an external id


```
getByExternalId(string <external-id>): ResourceInformation
```