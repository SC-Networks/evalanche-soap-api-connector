##### CONTAINER TYPE

Create a new container type object


```
create(
	string <name>,
	int <folder-id>
): ResourceInformation
```

Add an attribute to a container type


```
addAttribute(
    int <container-type-id>,
    string <title>,
    string <label>,
    int <type-id>,
    int <attribute-group-id>
): ContainerAttribute
```

Add an attribute group to a container type


```
addAttributeGroup(
    int <container-type-id>,
    string <title>
): ContainerAttributeGroup
```

Update an attribute type of a container type


```
updateAttributeType(
    int <container-type-id>,
    int <attribute-id>,
    int <type-id>
): bool
```

Add an option to an attribute of a container type


```
addAttributeOption(
    int <container-type-id>,
    int <attribute-id>,
    string <label>
): ContainerAttributeOption
```

Retrieve all attribute groups of a container type


```
getAttributeGroupsByResourceId(int <container-type-id>): ContainerAttributeGroup[]
```

Retrieve all attribute options of a container type


```
getAttributeOptionsByResourceIdAndAttributeId(
    int <container-type-id>,
    int <attribute-id>
): ContainerAttributeOption[]
```

Retrieve all attributes of a container type


```
getAttributesByResourceId(
    int <container-type-id>
): ContainerAttribute[]
```

Remove an attribute of a container type


```
removeAttribute(
    int <container-type-id>
    int <attribute-id>
): bool
```

Remove an attribute group of a container type


```
removeAttributeGroup(
    int <container-type-id>
    int <attribute-group-id>
): bool
```

Remove an attribute option from an attribute of a container type


```
removeAttributeOption(
    int <container-type-id>
    int <attribute-id>,
    int <attribute-option-id>
): bool
```

Update an attribute of a container type


```
updateAttribute(
    int <container-type-id>
    int <attribute-id>,
    int <hash-map>
): ContainerAttribute
```

Move a container type to a folder


```
move(int <container-type-id>, int <folder-id>): ResourceInformation
```

Copy a container type to a folder


```
copy(int <container-type-id>, int <folder-id>): ResourceInformation
```

Delete a container type


```
delete(int <container-type-id>): bool
```

Update the title of a container-type

```
updateTitle(
    int <container-type-id>,
    string <title>
): ResourceInformation
```

Retrieve all container types of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

Retrieve all container types in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

Retrieve a container type by id


```
getById(int <container-type-id>): ResourceInformation
```

Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

Retrieve the default folder for container types


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

Retrieve a container type by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```
