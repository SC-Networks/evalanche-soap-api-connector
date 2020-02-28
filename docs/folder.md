##### FOLDER

Create a new folder


```
create(
	string <name>,
	int <parent-folder-id>
): FolderInformation
```

Delete a folder


```
delete(int <folder-id>): bool
```

Get a folder's subfolders


```
getSubFolderById(
	int <folder-id>
): FolderInformation[]
```
