##### FOLDER

Create a new folder


```
create(
	string <name>,
	int <parent-folder-id>
): FolderInformation
```

Delete an folder


```
delete(int <folder-id>): bool
```

Get Subfolders from Folder


```
getSubFolderById(
	int <folder-id>
): FolderInformation[]
```
