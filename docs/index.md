## Usage

### First steps

First create a connection using your credentials

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
##### [COUPON LIST](couponlist.md)
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

## HashMaps

Dict-like, untyped datatypes are transmitted using a `HashMap` and `HashMapItem`.

In example, this command will update some attribute content of all profiles having a certain email-address.

```php
$connection->createProfileClient()->updateByKey(
    666, // your pool id
    'EMAIL', // name of the key to search for
    'hjs@compuglobalhypermega.net', // value to search for
    new \Scn\EvalancheSoapStruct\Struct\Generic\HashMap([
        new \Scn\EvalancheSoapStruct\Struct\Generic\HashMapItem('STREET', '123 Fake Street'),
        new \Scn\EvalancheSoapStruct\Struct\Generic\HashMapItem('CITY', 'Springfield'),
    ])
);
```