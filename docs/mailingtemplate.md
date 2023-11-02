## MAILING TEMPLATE

### Update the title of a mailing template

```
updateTitle(
    int <mailing-template-id>,
    string <title>
): ResourceInformation
```

### Move a mailing template to a folder

```
move(int <mailing-template-id>, int <folder-id>): ResourceInformation
```

### Copy a mailing template to a folder


```
copy(int <mailing-template-id>, int <folder-id>): ResourceInformation
```

### Delete a mailing template


```
delete(int <mailing-template-id>): bool
```

### Update the title of a mailing-template

```
updateTitle(
    int <mailing-template-id>,
    string <title>
): ResourceInformation
```

### Retrieve all mailing templates of a mandator


```
getListByMandatorId(int <mandator-id>): ResourceInformation[]
```

### Retrieve all mailing templates in a folder


```
getByFolderId(int <folder-id>): ResourceInformation[]
```

### Retrieve a mailing template by id


```
getById(int <mailing-template-id>): ResourceInformation
```

### Retrieve all related objects by type id


```
getByTypeId(int <type-id>, int <mandator-id>): ResourceInformation[]
```

### Retrieve the default folder for mailing templates


```
getDefaultFolderByMandatorId(int <mandator-id>): FolderInformation
```

### Retrieve all related object type ids


```
getTypeIds(): ResourceTypeInformation[]
```

### Retrieve a mailing template by its external id


```
getByExternalId(string <external-id>): ResourceInformation
```

### Add articles to a mailing template

```
addArticles(
	int <mailing-tempalte-id>,
	MailingArticleInterface[] <mailing-article>
): MailingArticle
```

### Remove all articles of a mailing template

```
removeAllArticles(int <mailing-id>): bool
```

### Remove certain articles of a mailing

```
removeArticles(
	int <mailing-id>,
	int[] <article-reference-ids>
): MailingArticle[]
```

### Retrieve the detailed configuration of a mailing template

```
getConfiguration(int <mailing-template-id>): MailingTemplateConfiguration
```

### Set the detail configuration of a mailing template

```
setConfiguration(
    int <mailing-template-id>
    MailingTemplateConfiguration <mailing-template-configuration>
): MailingTemplateConfiguration
```

### Retrieve the source codes of a mailing template

```
getSources(
    int <mailing-template-id>
): MailingTemplateSources
```

### Set the source codes of a mailing template

```
setSources(
    int <mailing-template-id>
    MailingTemplateSources <mailing-template-sources>
    bool <overwrite>
): MailingTemplateSources
```

### Remove a slot from the slot configuration

```
removeSlot(
    int <mailing-template-id>
    int <slot-id>
): bool
```

### Remove an article template configuration entry from a slot

```
removeTemplateFromSlot(
    int <mailing-template-id>
    int <slot-id>
    int <template-type-id>
    int <article-type-id) (optional, default: 0)
): bool
```

### Retrieve all configured slots

```
getSlotconfiguration(
    int <mailing-template-id>
): MailingSlotConfiguration
```

### Add a slot with a specific number

```
addSlot(
    int <mailing-template-id>
    int <slot-number>
): MailingSlot
```

### Update the configuration of a slot

Please consult the `MailingSlotSortTypeEnum` for a list of valid sort type-ids.

```
updateSlot(
    int <mailing-template-id>
    int <slot-id>
    int <slot-number>
    string <name>
    int <sort-type-id>
    int <sort-value>
): MailingSlot
```

### Add a template configuration to a slot

```
addTemplatesToSlot(
    int <mailing-template-id>
    int <slot-id>
    HashMap <$config>,
    int <article-type-id) (optional, deault: 0)
): MailingSlotItem
```


The HashMap is basically a dictionary containing the article template type-id as key and the template resource id as value.
Please consult the `ArticleTemplateTypeEnum` for a list of valid type-ids.

```
$hashMap = new HashMap([
    new HashMapItem((string) ArticleTemplateTypeEnum::HTML, '42')
]);
```

### Update the template configuration of a slot

```
updateSlotTemplates(
    int <mailing-template-id>
    int <slot-id>
    HashMap <$config>,
    int <article-type-id) (optional, deault: 0)
): MailingSlotItem
```
