## Usage

### General

First create a connection with the access credentials provided by SC-Networks.

```php
require 'vendor/autoload.php';

$connection = \Scn\EvalancheSoapApiConnector\EvalancheConnection::create(
    'given host',
    'given username',
    'given password'
);
```

Then create the client of your choice e.g. FormClient

`$statistic = $connection->createFormClient()->getStatistics(123, false);`

Work with the results

`$statistic->getImpressions()`

Most of the methods will require/return structs which are defined and
described in [the struct repository](https://github.com/SC-Networks/evalanche-soap-api-struct).

## Method Documentation

##### [ACCOUNT](account.md)
##### [ARTICLE](article.md)
##### [ARTICLE TEMPLATE](articletemplate.md)
##### [ARTICLE TYPE](articletype.md)
##### [BLACKLIST](blacklist.md)
##### [FOLDER](folder.md)
##### [CONTAINER](container.md)
##### [CONTAINER TYPE](containertype.md)
##### [DOCUMENT](document.md)
##### [FORM](form.md)
##### [TARGETGROUP](targetgroup.md)
##### [IMAGE](image.md)
##### [MAILING](mailing.md)
##### [MAILING TEMPLATE](mailingtemplate.md)
##### [MANDATOR](mandator.md)
##### [MILESTONE](milestone.md)
##### [POOL](pool.md)
##### [POOLDATAMINER](pooldataminer.md)
##### [PROFILE](profile.md)
##### [REPORT](report.md)
##### [SCORING](scoring.md)
##### [SMARTLINK](smartlink.md)
##### [USER](user.md)
##### [WEBHOOK](webhook.md)
##### [WORKFLOW](workflow.md)
