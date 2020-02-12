##### POOL

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