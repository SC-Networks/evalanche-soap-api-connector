##### BLACKLIST

Add an entry to a mandator's blacklist


```
add(int <mandator-id>, string <email-address>, string <comment>): bool
```

Remove an entry from a mandator's blacklist


```
remove(int <mandator-id>, string <email-address>): bool
```

Retrieve the mandator's blacklist


```
get(int <mandator-id>): BlackList
```
