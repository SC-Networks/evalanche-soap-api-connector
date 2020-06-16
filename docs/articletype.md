##### ARTICLE TYPE

Create a new article type object


```
create(
	string <name>,
	int <folder-id>
): ResourceInformation
```

Add an attribute to an article type


```
addAttribute(
    int <article-type-id>,
    string <title>,
    string <label>,
    int <attribute-type-id>,
    int <groupId>
): ContainerAttribute
```

Remove an attribute of an article type


```
removeAttribute(
    int <attribute-type-id>,
    int <attribute-id>
): bool
```

Change an attribute type of an attribute from an article type


```
changeAttributeType(
    int <article-type-id>,
    int <attribute-id>,
    int <attribute-type-id>
): bool
```

Assign a role to an attribute of an article type


```
assignRoleToAttribute(
    int <article-type-id>,
    int <attribute-id>,
    int <role-type-id>
): bool
```

Add an attribute group to an article type


```
addAttributeGroup(
    int <article-type-id>,
    string <title>
): ContainerAttributeGroup
```

Remove an attribute group of an article type


```
removeAttributeGroup(
    int <article-type-id>,
    int <attribute-group-id>
): ContainerAttributeGroup
```

Add an attribute option to an attribute of an article type


```
createAttributeOption(
    int <article-type-id>,
    int <attribute-id>,
    string <label>
): ContainerAttributeOption
```

Remove an attribute option from an attribute of an article type


```
removeAttributeOption(
    int <article-type-id>,
    int <attribute-id>,
    int <attribute-option-id>
): bool
```

Retrieve all attributes of an article type


```
getAttributes(int <article-type-id>): ContainerAttribute[]
```

Retrieve all attribute options of an attribute of an article type


```
getAttributeOptions(
    int <article-type-id>,
    int <attribute-id>
): ContainerAttributeOption[]
```

Retrieve all attribute groups of an article type


```
getAttributeGroups(int <article-type-id>): ContainerAttributeGroup[]
```

Retrieve all applicable role types of an attribute of an article type


```
getApplicableRoleTypes(
    int <article-type-id>,
    int <attribute-id>
): ContainerAttributeRoleType[]
```

Retrieve all assigned role types of an attribute of an article type


```
getAssignedRoleTypes(
    int <article-type-id>,
    int <attribute-id>
): ContainerAttributeRoleType[]
```

Move an article type to a folder


```
move(int <article-id>, int <folder-id>): ResourceInformation
```

Copy an article type to a folder


```
copy(int <article-id>, int <folder-id>): ResourceInformation
```

Delete an article type


```
delete(int <article-id>): bool
```

Retrieve all article types of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all article types in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve an article type by id


```
getById(int <article-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for article types


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve an article type by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
