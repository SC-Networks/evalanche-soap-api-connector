## COUPON LIST

### Create a coupon list object

```
create(
    string <title>,
    int <folderId>
): ResourceInformation
```

### Generate coupon codes in an existing object

```
generate(
    int <couponListId>,
    int <amount>
): bool
```

### Remove a certain coupon code from an existing object

```
removeById(
    int <couponListId>,
    int <profileCouponId>
): bool
```

### Remove all existing codes from an existing object

```
removeAll(
    int <couponListId>
): bool
```

### Retrieve all codes (including meta data) from an object

```
getProfileCouponList(
    int <couponListId>
): ProfileCoupon
```

### Import existing codes (including meta data) in an existing object

```
import(
    int <couponListId>,
    array <profileCouponItems>
): bool
```