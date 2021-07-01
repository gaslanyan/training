---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://training.gtech.am/docs/collection.json)

<!-- END_INFO -->

#Account & Course


APIs for a account course
<!-- START_73fe40f73a354522414284f5a0299a8a -->
## api/auth/gettestsbyaid
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/gettestsbyaid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/gettestsbyaid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/gettestsbyaid`


<!-- END_73fe40f73a354522414284f5a0299a8a -->

<!-- START_e94f62009c3f968869eb41a8048f24a8 -->
## Course Test Result

get the result by test
if percent < 50% 3x block account
first number is question order, second number is answer order
if answer the checkbox, then true ex: 2_3: true, or radio button then answers number ex: 1_2: 2

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getresult?access_token=eaque&model=%7B1_2%3A+2%2C+1_3%3A+3%2C+2_2%3A+true%2C+2_3%3A+true%2C+3_2%3A+true%2C+3_3%3A+true%2C+4_1%3A+true%2C+4_2%3A+true%2C+5_2%3A+true%7D&user_id=2&course_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getresult"
);

let params = {
    "access_token": "eaque",
    "model": "{1_2: 2, 1_3: 3, 2_2: true, 2_3: true, 3_2: true, 3_3: true, 4_1: true, 4_2: true, 5_2: true}",
    "user_id": "2",
    "course_id": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "access_token": "",
    "percent": 42.857142857142854,
    "token_type": "bearer",
    "expires_in": 21600000
}
```

### HTTP Request
`POST api/auth/getresult`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `model` |  optional  | The answers
    `user_id` |  optional  | The account id to filter
    `course_id` |  optional  | The course id to filter by id

<!-- END_e94f62009c3f968869eb41a8048f24a8 -->

<!-- START_7f1e90abe772086d55a91477c4af5533 -->
## Payment- Init Payment Request
Init Payment Request

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/payment?ClientID=corrupti&Username=username&Password=password&Currency=AMD&Description=SHMZ&Amount=10&OrderID=AMD&BackURL=https%3A%2F%2Fwww.shmz.am%2Flesson&Opaque=TEST+Opaque+VPOS&CardHolderID=TEST+CARD+VPOS" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/payment"
);

let params = {
    "ClientID": "corrupti",
    "Username": "username",
    "Password": "password",
    "Currency": "AMD",
    "Description": "SHMZ",
    "Amount": "10",
    "OrderID": "AMD",
    "BackURL": "https://www.shmz.am/lesson",
    "Opaque": "TEST Opaque VPOS",
    "CardHolderID": "TEST CARD VPOS",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "PaymentID": "sample string 1",
    "ResponseCode": 2,
    "ResponseMessage": "sample string 3"
}
```

### HTTP Request
`POST api/auth/payment`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `ClientID` |  optional  | The client ID Example:
    `Username` |  optional  | The username
    `Password` |  optional  | The password
    `Currency` |  optional  | The currency  to filter
    `Description` |  optional  | The description
    `Amount` |  optional  | The amount
    `OrderID` |  optional  | The Order ID to filter
    `BackURL` |  optional  | The back url
    `Opaque` |  optional  | The opaque
    `CardHolderID` |  optional  | The card holder ID url

<!-- END_7f1e90abe772086d55a91477c4af5533 -->

<!-- START_dee65a3a2a142750c59bf8363465e553 -->
## api/auth/getpayment
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getpayment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getpayment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getpayment`


<!-- END_dee65a3a2a142750c59bf8363465e553 -->

<!-- START_5c87d360f51017316df370a612e946b2 -->
## api/auth/getcpcourse
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getcpcourse" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getcpcourse"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getcpcourse`


<!-- END_5c87d360f51017316df370a612e946b2 -->

<!-- START_18f84473e953505349f3115ce02db437 -->
## api/auth/videoinfo
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/videoinfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/videoinfo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/videoinfo`


<!-- END_18f84473e953505349f3115ce02db437 -->

<!-- START_3161a5db305df380d0f557d871301305 -->
## Add Video Point

get the result by test

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/addpoint?access_token=suscipit&point=7.199989&user_id=2&id=3" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/addpoint"
);

let params = {
    "access_token": "suscipit",
    "point": "7.199989",
    "user_id": "2",
    "id": "3",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "access_token": "",
    "video": false
}
```

### HTTP Request
`POST api/auth/addpoint`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `point` |  optional  | Get the video point by the user
    `user_id` |  optional  | The account id to filter
    `id` |  optional  | The video id to filter by id

<!-- END_3161a5db305df380d0f557d871301305 -->

#Course


APIs for a course
<!-- START_9f50fa3baec274a21b2452b43596cd02 -->
## api/auth/coursedetails
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/coursedetails" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/coursedetails"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/coursedetails`


<!-- END_9f50fa3baec274a21b2452b43596cd02 -->

<!-- START_fc5573b80ed8893c343bef96931ac2fe -->
## api/auth/getcoursebyspec
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getcoursebyspec" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getcoursebyspec"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getcoursebyspec`


<!-- END_fc5573b80ed8893c343bef96931ac2fe -->

<!-- START_0dedaa340626cef408ed80564c1667e1 -->
## api/auth/getcoursesinfo
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getcoursesinfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getcoursesinfo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getcoursesinfo`


<!-- END_0dedaa340626cef408ed80564c1667e1 -->

<!-- START_0317b8281ac175ff55ea1e820e767f84 -->
## api/auth/getbook
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getbook" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getbook"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getbook`


<!-- END_0317b8281ac175ff55ea1e820e767f84 -->

<!-- START_8a8c43917aadf44a47770adbca8548bd -->
## api/auth/book
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/book" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/book"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/book`


<!-- END_8a8c43917aadf44a47770adbca8548bd -->

<!-- START_03e55876cf479e1d6ca5a88365052913 -->
## Course Test
get Test by id

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/gettests?access_token=token&id=1&account_id=2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/gettests"
);

let params = {
    "access_token": "token",
    "id": "1",
    "account_id": "2",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/auth/gettests`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `id` |  optional  | The course id to filter
    `account_id` |  optional  | The account id to filter

<!-- END_03e55876cf479e1d6ca5a88365052913 -->

<!-- START_a437d75ef646b50af992896c66563c68 -->
## api/auth/gettitle
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/gettitle" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/gettitle"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/gettitle`


<!-- END_a437d75ef646b50af992896c66563c68 -->

#Front page


APIs for front page
<!-- START_e99bcc586900c53ddcaeb008e440fad2 -->
## Fetch all profession

Fetch all profession

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/prof" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/prof"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "prof": [
        {
            "name": "ԲԺԻՇԿ",
            "id": 1
        },
        {
            "name": "ԲՈՒԺՔՈՒՅՐ",
            "id": 2
        },
        {
            "name": "ԴԵՂԱԳԵՏ",
            "id": 3
        },
        {
            "name": "ԴԵՂԱԳՈՐԾ",
            "id": 4
        }
    ]
}
```

### HTTP Request
`POST api/prof`


<!-- END_e99bcc586900c53ddcaeb008e440fad2 -->

<!-- START_642150e19947c0a19901117354d0a952 -->
## api/edu
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/edu" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/edu"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/edu`


<!-- END_642150e19947c0a19901117354d0a952 -->

<!-- START_70e51fbf30677a8027d859de94215b81 -->
## api/educate
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/educate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/educate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/educate`


<!-- END_70e51fbf30677a8027d859de94215b81 -->

<!-- START_252745ed5304af9726d6659260a5ef29 -->
## api/spec
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/spec" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/spec"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/spec`


<!-- END_252745ed5304af9726d6659260a5ef29 -->

#general


<!-- START_2e1c96dcffcfe7e0eb58d6408f1d619e -->
## Get a JWT via given credentials.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/register`


<!-- END_2e1c96dcffcfe7e0eb58d6408f1d619e -->

<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Get a JWT via given credentials.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/login`


<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
## Log the user out (Invalidate the token).

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/logout`


<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->

<!-- START_994af8f47e3039ba6d6d67c09dd9e415 -->
## Refresh a token.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/refresh`


<!-- END_994af8f47e3039ba6d6d67c09dd9e415 -->

<!-- START_a19f97e120902d01a27fb7ac23c9a2c1 -->
## api/auth/avatar/{id}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/avatar/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/avatar/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/auth/avatar/{id}`

`PATCH api/auth/avatar/{id}`


<!-- END_a19f97e120902d01a27fb7ac23c9a2c1 -->

<!-- START_13790c84e17bb9810ede0e7aa98a01f1 -->
## api/auth/approve/{id}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/approve/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/approve/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/auth/approve/{id}`

`PATCH api/auth/approve/{id}`


<!-- END_13790c84e17bb9810ede0e7aa98a01f1 -->

<!-- START_a47210337df3b4ba0df697c115ba0c1e -->
## Get the authenticated User.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/me" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/me"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/me`


<!-- END_a47210337df3b4ba0df697c115ba0c1e -->

<!-- START_8e088abc88be0a4785c5a04626f0482f -->
## api/auth/getaccountbyid
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getaccountbyid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getaccountbyid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getaccountbyid`


<!-- END_8e088abc88be0a4785c5a04626f0482f -->

<!-- START_6b2b0b8ab787dfbbad2bb427b98ed234 -->
## api/auth/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/api/auth/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/auth/edit/{id}`


<!-- END_6b2b0b8ab787dfbbad2bb427b98ed234 -->

<!-- START_8ae19e30af451dc6031b22a8e271fc34 -->
## api/auth/getstatus
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getstatus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getstatus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/getstatus`


<!-- END_8ae19e30af451dc6031b22a8e271fc34 -->

<!-- START_ec2b7e10ed4deb3cededb17caf85bfaf -->
## api/auth/edit/{id}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/auth/edit/{id}`

`PATCH api/auth/edit/{id}`


<!-- END_ec2b7e10ed4deb3cededb17caf85bfaf -->

<!-- START_59d115d508f64860035363af26e59b9d -->
## api/auth/changePass/{id}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/changePass/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/changePass/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/auth/changePass/{id}`

`PATCH api/auth/changePass/{id}`


<!-- END_59d115d508f64860035363af26e59b9d -->

<!-- START_a404ad2680ae39b37bf51a3f1dd26c95 -->
## api/auth/finishedvideo
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/finishedvideo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/finishedvideo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/finishedvideo`


<!-- END_a404ad2680ae39b37bf51a3f1dd26c95 -->

<!-- START_1f26a7d3b191a04ab9c1bc160deb8481 -->
## api/about
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/about" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/about"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/about`


<!-- END_1f26a7d3b191a04ab9c1bc160deb8481 -->

<!-- START_43d9d67cb3377388b57e0a44f52dd3c7 -->
## api/coursestitle
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/coursestitle" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/coursestitle"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/coursestitle`


<!-- END_43d9d67cb3377388b57e0a44f52dd3c7 -->

<!-- START_3a10cf81f4e87228f264184c7366a0f3 -->
## api/applicantcount
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/applicantcount" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/applicantcount"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/applicantcount`


<!-- END_3a10cf81f4e87228f264184c7366a0f3 -->

<!-- START_efff75ed7db70dd218b420c2474e811b -->
## api/coursescount
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/coursescount" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/coursescount"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/coursescount`


<!-- END_efff75ed7db70dd218b420c2474e811b -->

<!-- START_8fc2e53df93fe611de1d3519d04fae69 -->
## api/allcourses
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/allcourses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/allcourses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/allcourses`


<!-- END_8fc2e53df93fe611de1d3519d04fae69 -->

<!-- START_e795fade4d25e2473e7fd22cababfe99 -->
## api/comment
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/comment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/comment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/comment`


<!-- END_e795fade4d25e2473e7fd22cababfe99 -->

<!-- START_cd5946798b0d62ceae6a8f51f12d8234 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/regions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/regions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/regions`


<!-- END_cd5946798b0d62ceae6a8f51f12d8234 -->

<!-- START_e153eceb5196c5f56daf0146cbddf515 -->
## api/territory
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/territory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/territory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/territory`


<!-- END_e153eceb5196c5f56daf0146cbddf515 -->

<!-- START_6d3061d375666b8cf6babe163b36f250 -->
## api/reset-password
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/reset-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/reset-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/reset-password`


<!-- END_6d3061d375666b8cf6babe163b36f250 -->

<!-- START_b60a6dbb8352bc96ab96389756f7522e -->
## Handle reset password

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/reset/password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/reset/password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/reset/password`


<!-- END_b60a6dbb8352bc96ab96389756f7522e -->

<!-- START_f453d442cbe270ed50c2def3a3416115 -->
## about
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/about" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/about"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET about`


<!-- END_f453d442cbe270ed50c2def3a3416115 -->

<!-- START_679ea4e19d49028fd5a7bd6ee9f0f308 -->
## contact
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/contact" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/contact"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET contact`


<!-- END_679ea4e19d49028fd5a7bd6ee9f0f308 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Where to redirect users after login.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## logout
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_adb100bcc5e3d38618f830ef694ef08c -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/password/request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/password/request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET backend/password/request`


<!-- END_adb100bcc5e3d38618f830ef694ef08c -->

<!-- START_aac2e293e378fa4e8200ea33bcf36f46 -->
## Where to redirect users after login.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET backend`


<!-- END_aac2e293e378fa4e8200ea33bcf36f46 -->

<!-- START_03ee5583184d4e27ee80183efe078035 -->
## Where to redirect users after login.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET backend/login`


<!-- END_03ee5583184d4e27ee80183efe078035 -->

<!-- START_7611be0c6ab462c74bed74ccf0d59a2e -->
## backend/doLogin
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/doLogin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/doLogin"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/doLogin`


<!-- END_7611be0c6ab462c74bed74ccf0d59a2e -->

<!-- START_003c18dcbe2983e80881bcef2f036da9 -->
## backend/logout
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET backend/logout`


<!-- END_003c18dcbe2983e80881bcef2f036da9 -->

<!-- START_f3525b40972553430438f6663a856786 -->
## backend/logout
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/logout`


<!-- END_f3525b40972553430438f6663a856786 -->

<!-- START_9f18aa1898ab33efad43015e3e96e2ee -->
## backend/dashboard
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/dashboard`


<!-- END_9f18aa1898ab33efad43015e3e96e2ee -->

<!-- START_3e1e413f9bfb20d5d37c4079111c785c -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/admin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/admin`


<!-- END_3e1e413f9bfb20d5d37c4079111c785c -->

<!-- START_5d5831e9a40450d48492b27b846a5d45 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/admin/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/admin/create`


<!-- END_5d5831e9a40450d48492b27b846a5d45 -->

<!-- START_68695784950f81b6e0819e16f10d604f -->
## backend/admin
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/admin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/admin`


<!-- END_68695784950f81b6e0819e16f10d604f -->

<!-- START_f0ca64566d8f8b9a35b2204b6c03e9b7 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/admin/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/admin/{admin}`


<!-- END_f0ca64566d8f8b9a35b2204b6c03e9b7 -->

<!-- START_67a7869f607bf1487e9153a875292d41 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/admin/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/admin/{admin}`

`PATCH backend/admin/{admin}`


<!-- END_67a7869f607bf1487e9153a875292d41 -->

<!-- START_8bdf3cee0ff566eac35a9b1efe719852 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/admin/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/admin/{admin}`


<!-- END_8bdf3cee0ff566eac35a9b1efe719852 -->

<!-- START_d3753d3f15d9016bc5a9cf05ab6431a6 -->
## backend/changePassword/{id}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/changePassword/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/changePassword/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/changePassword/{id}`

`PATCH backend/changePassword/{id}`


<!-- END_d3753d3f15d9016bc5a9cf05ab6431a6 -->

<!-- START_7c3760cf7a3c16f338f3c4a00ad1d207 -->
## backend/sendEmail
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/sendEmail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/sendEmail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/sendEmail`


<!-- END_7c3760cf7a3c16f338f3c4a00ad1d207 -->

<!-- START_023dc4da363acd018fa692233ce411c8 -->
## backend/sendEmails
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/sendEmails" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/sendEmails"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/sendEmails`


<!-- END_023dc4da363acd018fa692233ce411c8 -->

<!-- START_a1e261f9a6e0632107d8ab4abdac3d29 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/videos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/videos`


<!-- END_a1e261f9a6e0632107d8ab4abdac3d29 -->

<!-- START_1f5e56ac67b76e36d4f9f944d69d051b -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/videos/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/videos/create`


<!-- END_1f5e56ac67b76e36d4f9f944d69d051b -->

<!-- START_e1766113a433b8c1061b415f2b9a24b3 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/videos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/videos`


<!-- END_e1766113a433b8c1061b415f2b9a24b3 -->

<!-- START_acccf016c93d0c1346ca4b7600689446 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/videos/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET backend/videos/{video}`


<!-- END_acccf016c93d0c1346ca4b7600689446 -->

<!-- START_ff235fb510dcdf57f2f312c82a5cfb05 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/videos/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET backend/videos/{video}/edit`


<!-- END_ff235fb510dcdf57f2f312c82a5cfb05 -->

<!-- START_0765874d6be7def09fdacd626486de4a -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/videos/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/videos/{video}`

`PATCH backend/videos/{video}`


<!-- END_0765874d6be7def09fdacd626486de4a -->

<!-- START_d513eef5f8ebfe7a3b2b4d8e1e638573 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/videos/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/videos/{video}`


<!-- END_d513eef5f8ebfe7a3b2b4d8e1e638573 -->

<!-- START_19ffe74e66a39b2a5730fcd928b750db -->
## delete-video
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/delete-video" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/delete-video"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST delete-video`


<!-- END_19ffe74e66a39b2a5730fcd928b750db -->

<!-- START_05dec41742b1fc2c98bf97b7a2ef078c -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/videos/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/videos/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/videos/{id}`


<!-- END_05dec41742b1fc2c98bf97b7a2ef078c -->

<!-- START_d6b4091805adfc10d3d6e2c7b5356b54 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/image`


<!-- END_d6b4091805adfc10d3d6e2c7b5356b54 -->

<!-- START_448d16f88da0f726b9fc1d05aa20adb6 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/image/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/image/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/image/create`


<!-- END_448d16f88da0f726b9fc1d05aa20adb6 -->

<!-- START_3c28362f2f30e8b91b0e301546626fbf -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/image`


<!-- END_3c28362f2f30e8b91b0e301546626fbf -->

<!-- START_247284710b888b31084fcf6fe37bdc41 -->
## delete-image
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/delete-image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/delete-image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST delete-image`


<!-- END_247284710b888b31084fcf6fe37bdc41 -->

<!-- START_a7d77a77cd96fecff4508a540ed86fdd -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/book" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/book`


<!-- END_a7d77a77cd96fecff4508a540ed86fdd -->

<!-- START_57d3ef63e52bb9c4f997ffe768eac1f5 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/book/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/book/create`


<!-- END_57d3ef63e52bb9c4f997ffe768eac1f5 -->

<!-- START_911d83aeab2a8b822f913307fdcbf4f1 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/book" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/book`


<!-- END_911d83aeab2a8b822f913307fdcbf4f1 -->

<!-- START_3f4ef3e08765827a9e5a55d0787d5a81 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/book/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET backend/book/{book}`


<!-- END_3f4ef3e08765827a9e5a55d0787d5a81 -->

<!-- START_73c068e2882a42c88e4b475503655f1b -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/book/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/book/{book}/edit`


<!-- END_73c068e2882a42c88e4b475503655f1b -->

<!-- START_c00d7d47a28f9a8f8578d91437ce623b -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/book/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/book/{book}`

`PATCH backend/book/{book}`


<!-- END_c00d7d47a28f9a8f8578d91437ce623b -->

<!-- START_99c64362567375a937d54e574daad23b -->
## backend/book/{book}
> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/book/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/book/{book}`


<!-- END_99c64362567375a937d54e574daad23b -->

<!-- START_2dd2c63eea951ed1d3224f71fc61e050 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/book/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/book/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/book/{id}`


<!-- END_2dd2c63eea951ed1d3224f71fc61e050 -->

<!-- START_d05e5f71cf91bdc6b2ccdc04ac6a82de -->
## backend/course/result
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course/result" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/result"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course/result`


<!-- END_d05e5f71cf91bdc6b2ccdc04ac6a82de -->

<!-- START_181c60cec752fd46b8d9b8560dc7cfba -->
## backend/course/result-speciality
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course/result-speciality" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/result-speciality"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course/result-speciality`


<!-- END_181c60cec752fd46b8d9b8560dc7cfba -->

<!-- START_16cf09271e74771f6ccaa3305003f808 -->
## backend/course
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course`


<!-- END_16cf09271e74771f6ccaa3305003f808 -->

<!-- START_71ebda643cec43a5e65278bb1d3fe552 -->
## backend/course/create
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course/create`


<!-- END_71ebda643cec43a5e65278bb1d3fe552 -->

<!-- START_727b538fd8b947f0683f2735830cccd8 -->
## backend/course
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/course" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/course`


<!-- END_727b538fd8b947f0683f2735830cccd8 -->

<!-- START_43cff1c0934a6f8697e940d00f372853 -->
## backend/course/{course}
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course/{course}`


<!-- END_43cff1c0934a6f8697e940d00f372853 -->

<!-- START_b41e09bf51f0fe31b061a85e0a0e0e7d -->
## backend/course/{course}/edit
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course/{course}/edit`


<!-- END_b41e09bf51f0fe31b061a85e0a0e0e7d -->

<!-- START_a0fa374bf57cc9c61477f80ca9498947 -->
## backend/course/{course}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/course/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/course/{course}`

`PATCH backend/course/{course}`


<!-- END_a0fa374bf57cc9c61477f80ca9498947 -->

<!-- START_e8cb692095338d73da3d1609dc1c270f -->
## backend/course/{course}
> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/course/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/course/{course}`


<!-- END_e8cb692095338d73da3d1609dc1c270f -->

<!-- START_839010f00cf379f64bd5d93824a985c5 -->
## backend/course/{id}
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/course/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/course/{id}`


<!-- END_839010f00cf379f64bd5d93824a985c5 -->

<!-- START_8f687ea9b54425bd92e779f1d7acc11b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account/{role}`


<!-- END_8f687ea9b54425bd92e779f1d7acc11b -->

<!-- START_15a35be296ef22bb126a6dc90190ef65 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account/create`


<!-- END_15a35be296ef22bb126a6dc90190ef65 -->

<!-- START_2e9ea5026e07226683838f2042734e90 -->
## backend/account/{role}
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/account/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/account/{role}`


<!-- END_2e9ea5026e07226683838f2042734e90 -->

<!-- START_ea83570a23aab9b05afbaaa35169bb55 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/account/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/account/{id}`

`PATCH backend/account/{id}`


<!-- END_ea83570a23aab9b05afbaaa35169bb55 -->

<!-- START_56744d1efd92a73f49573a0a65cbb75f -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/updateAccount/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/updateAccount/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/updateAccount/{id}`

`PATCH backend/updateAccount/{id}`


<!-- END_56744d1efd92a73f49573a0a65cbb75f -->

<!-- START_7057f60398343a873790eb78c172964f -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account/{id}`


<!-- END_7057f60398343a873790eb78c172964f -->

<!-- START_ea041004afb42591bf2e3fbf5cdc5d03 -->
## backend/account_tests/{id}
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account_tests/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account_tests/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account_tests/{id}`


<!-- END_ea041004afb42591bf2e3fbf5cdc5d03 -->

<!-- START_d713f81b1ba0e4e6d64c5375d41effd2 -->
## backend/change_status
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/change_status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/change_status"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/change_status`


<!-- END_d713f81b1ba0e4e6d64c5375d41effd2 -->

<!-- START_840270402a1f9d26a8f3f487bd79820c -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account_test/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account_test/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account_test/{a_id}/{id}`


<!-- END_840270402a1f9d26a8f3f487bd79820c -->

<!-- START_1a1c3f6dffa45d0aa92631d808ec15f1 -->
## backend/accountCheck
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/accountCheck" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/accountCheck"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/accountCheck`


<!-- END_1a1c3f6dffa45d0aa92631d808ec15f1 -->

<!-- START_74eab63d4b332042b27aacd69f556cef -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/account`


<!-- END_74eab63d4b332042b27aacd69f556cef -->

<!-- START_495d2eb655a4519b6359e306a32be162 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account/{id}/edit`


<!-- END_495d2eb655a4519b6359e306a32be162 -->

<!-- START_7f03e086ef66f83a0465ef1652811ee3 -->
## backend/sendAttachment
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/sendAttachment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/sendAttachment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/sendAttachment`


<!-- END_7f03e086ef66f83a0465ef1652811ee3 -->

<!-- START_cc44194e6cd5e1db985724859a60e898 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/type`


<!-- END_cc44194e6cd5e1db985724859a60e898 -->

<!-- START_27d5a847300c640134df65979ec64700 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/type/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/type/create`


<!-- END_27d5a847300c640134df65979ec64700 -->

<!-- START_9010d80e3bbd0384133afe5333233741 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/type`


<!-- END_9010d80e3bbd0384133afe5333233741 -->

<!-- START_cd9e8eaf2aceb04ce7eb724964f20dd2 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/type/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/type/{type}`


<!-- END_cd9e8eaf2aceb04ce7eb724964f20dd2 -->

<!-- START_3fcf853a0e42c1922b0ce448a951af13 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/type/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/type/{type}/edit`


<!-- END_3fcf853a0e42c1922b0ce448a951af13 -->

<!-- START_823c0de011581c90ec2751d876e90d86 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/type/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/type/{type}`

`PATCH backend/type/{type}`


<!-- END_823c0de011581c90ec2751d876e90d86 -->

<!-- START_a4dcef3d080a7b72bfbf41ecdba07e87 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/type/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/type/{type}`


<!-- END_a4dcef3d080a7b72bfbf41ecdba07e87 -->

<!-- START_4cf0bd374e02becd069f57f779bfa715 -->
## backend/admin_gdPDF
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/admin_gdPDF" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin_gdPDF"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/admin_gdPDF`


<!-- END_4cf0bd374e02becd069f57f779bfa715 -->

<!-- START_99f9dd2a5fa5622c129738f4bfb34e0e -->
## backend/admin_gdExcel
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/admin_gdExcel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/admin_gdExcel"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/admin_gdExcel`


<!-- END_99f9dd2a5fa5622c129738f4bfb34e0e -->

<!-- START_ebfa73f06d704860dbc193a8c13ab57f -->
## backend/course_gdPDF
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course_gdPDF" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course_gdPDF"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course_gdPDF`


<!-- END_ebfa73f06d704860dbc193a8c13ab57f -->

<!-- START_eb6424ac81c70d5f67e75052e7b94ad3 -->
## backend/course_gdExcel
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/course_gdExcel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/course_gdExcel"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/course_gdExcel`


<!-- END_eb6424ac81c70d5f67e75052e7b94ad3 -->

<!-- START_336a5fe127128edaf881852ff1f437cc -->
## backend/type_gdPDF
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/type_gdPDF" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type_gdPDF"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/type_gdPDF`


<!-- END_336a5fe127128edaf881852ff1f437cc -->

<!-- START_6fcbd3e2e92795eb4dfc4250db3bd998 -->
## backend/type_gdExcel
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/type_gdExcel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/type_gdExcel"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/type_gdExcel`


<!-- END_6fcbd3e2e92795eb4dfc4250db3bd998 -->

<!-- START_4d1d3c07f78ef894deca0add8f194592 -->
## backend/account_gdPDF
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account_gdPDF" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account_gdPDF"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account_gdPDF`


<!-- END_4d1d3c07f78ef894deca0add8f194592 -->

<!-- START_c5de8e254ca37067461cb11f30eae92b -->
## backend/account_gdExcel
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account_gdExcel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account_gdExcel"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account_gdExcel`


<!-- END_c5de8e254ca37067461cb11f30eae92b -->

<!-- START_a86f466c389a05d04f1fe41612054dd7 -->
## backend/tests_gdPDF/{id}
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/tests_gdPDF/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/tests_gdPDF/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/tests_gdPDF/{id}`


<!-- END_a86f466c389a05d04f1fe41612054dd7 -->

<!-- START_86bb3e8f088f3f38077d50146cb0db26 -->
## backend/test_gdPDF/{a_id}/{id}
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/test_gdPDF/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test_gdPDF/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/test_gdPDF/{a_id}/{id}`


<!-- END_86bb3e8f088f3f38077d50146cb0db26 -->

<!-- START_4a7d33ea9275220191c92105d4496e72 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/message" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/message"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/message`


<!-- END_4a7d33ea9275220191c92105d4496e72 -->

<!-- START_0fe43756009562f83a52d8c1134a3db5 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/message/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/message/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/message/create`


<!-- END_0fe43756009562f83a52d8c1134a3db5 -->

<!-- START_970fdd7da8d84f5e122e682d79f2628b -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/message" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/message"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/message`


<!-- END_970fdd7da8d84f5e122e682d79f2628b -->

<!-- START_c44cc74dbb797fb60b59cff9301483a5 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/message/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/message/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/message/{message}`


<!-- END_c44cc74dbb797fb60b59cff9301483a5 -->

<!-- START_a2c34f03255239c4d9324051720304be -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/message/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/message/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/message/{message}/edit`


<!-- END_a2c34f03255239c4d9324051720304be -->

<!-- START_13b5ccf9cfd01353a011c7bf902b0847 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/message/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/message/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/message/{message}`

`PATCH backend/message/{message}`


<!-- END_13b5ccf9cfd01353a011c7bf902b0847 -->

<!-- START_40ae793c19a27c1ce625724edfb4773c -->
## backend/account_gdPDF/{id}
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/account_gdPDF/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/account_gdPDF/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/account_gdPDF/{id}`


<!-- END_40ae793c19a27c1ce625724edfb4773c -->

<!-- START_69acb056e069d69cad5339de4a1f9893 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/logs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/logs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/logs`


<!-- END_69acb056e069d69cad5339de4a1f9893 -->

<!-- START_6a0de9e0ee3fc61d3617eee7984b24cd -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/logs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/logs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/logs/{log}`


<!-- END_6a0de9e0ee3fc61d3617eee7984b24cd -->

<!-- START_08472b7cb1a128f829319c8377570dd6 -->
## backend/test/getCourses
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/test/getCourses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test/getCourses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/test/getCourses`


<!-- END_08472b7cb1a128f829319c8377570dd6 -->

<!-- START_796eac85706d45beb39f1ea59795f90e -->
## backend/test
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/test`


<!-- END_796eac85706d45beb39f1ea59795f90e -->

<!-- START_b3b2b506f612838cccdf7d22cfaa00d2 -->
## backend/test/create
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/test/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/test/create`


<!-- END_b3b2b506f612838cccdf7d22cfaa00d2 -->

<!-- START_c906784fda5665b5c7ad54574bde291b -->
## backend/test
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/test`


<!-- END_c906784fda5665b5c7ad54574bde291b -->

<!-- START_54ca86590fda22a1677d54f782538546 -->
## backend/test/{test}/edit
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/test/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/test/{test}/edit`


<!-- END_54ca86590fda22a1677d54f782538546 -->

<!-- START_68126e2639026a0662e2263bebe7ee51 -->
## backend/test/{test}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/test/{test}`

`PATCH backend/test/{test}`


<!-- END_68126e2639026a0662e2263bebe7ee51 -->

<!-- START_2faa24756d0aa8ef82285d159aa56b08 -->
## backend/test/{test}
> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/test/{test}`


<!-- END_2faa24756d0aa8ef82285d159aa56b08 -->

<!-- START_57a2747dc6ac8c254238a0708f3b0dbe -->
## backend/test/{id}
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/test/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/test/{id}`


<!-- END_57a2747dc6ac8c254238a0708f3b0dbe -->

<!-- START_ebecb9ce717122705fd7cc137773c186 -->
## territory
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/territory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/territory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST territory`


<!-- END_ebecb9ce717122705fd7cc137773c186 -->

<!-- START_b05e7256bb53a26866857862adc89034 -->
## edu
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/edu" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/edu"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST edu`


<!-- END_b05e7256bb53a26866857862adc89034 -->

<!-- START_3a6a8a11529975c160d2be56d62588e1 -->
## spec
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/spec" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/spec"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST spec`


<!-- END_3a6a8a11529975c160d2be56d62588e1 -->

<!-- START_1ad6a4828ce175d8c157be402ed7aade -->
## updateSpec
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/updateSpec" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/updateSpec"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST updateSpec`


<!-- END_1ad6a4828ce175d8c157be402ed7aade -->

<!-- START_dfbf5b2d1bb09b083f482957075cd701 -->
## backend/specialtyCheck
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/specialtyCheck" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialtyCheck"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/specialtyCheck`


<!-- END_dfbf5b2d1bb09b083f482957075cd701 -->

<!-- START_8e5bb4dc7f6898e46860065c9a728249 -->
## backend/ajaxImageUpload
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/ajaxImageUpload" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/ajaxImageUpload"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/ajaxImageUpload`


<!-- END_8e5bb4dc7f6898e46860065c9a728249 -->

<!-- START_fd1c691995f9a989288a3b4a867435fd -->
## backend/ajaxRemoveImage
> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/ajaxRemoveImage" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/ajaxRemoveImage"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/ajaxRemoveImage`


<!-- END_fd1c691995f9a989288a3b4a867435fd -->

<!-- START_baad26f4cd96122e057183a3029d2978 -->
## backend/typeCheck
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/typeCheck" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/typeCheck"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/typeCheck`


<!-- END_baad26f4cd96122e057183a3029d2978 -->

<!-- START_4a1b4ee2155a4c5e95793f02b8917910 -->
## backend/specialty/list
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/specialty/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialty/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/specialty/list`


<!-- END_4a1b4ee2155a4c5e95793f02b8917910 -->

<!-- START_4156e5e3c3ddd3d740e7d57744065f89 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/specialty" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialty"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/specialty`


<!-- END_4156e5e3c3ddd3d740e7d57744065f89 -->

<!-- START_eeee5327c11a4b78afb8ecdd0e2e87ff -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/specialty/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialty/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/specialty/create`


<!-- END_eeee5327c11a4b78afb8ecdd0e2e87ff -->

<!-- START_5264f304a7e6565bec0281f8f04926f5 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/specialty" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialty"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/specialty`


<!-- END_5264f304a7e6565bec0281f8f04926f5 -->

<!-- START_e0ae487a5dac5c20dd02fd06eb827ccf -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/specialty/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialty/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/specialty/{specialty}`


<!-- END_e0ae487a5dac5c20dd02fd06eb827ccf -->

<!-- START_6f374d84c518ee0382063ef0d160e5f5 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/specialty/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/specialty/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/specialty/{specialty}`


<!-- END_6f374d84c518ee0382063ef0d160e5f5 -->

<!-- START_479ee017e99eea42b320477b89feac5d -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/pages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/pages`


<!-- END_479ee017e99eea42b320477b89feac5d -->

<!-- START_3705ac8ece5973216cb6eb44326f4db0 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/pages/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/pages/create`


<!-- END_3705ac8ece5973216cb6eb44326f4db0 -->

<!-- START_f009f4b2d4c366c37f5faf75141b8b2e -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/pages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/pages`


<!-- END_f009f4b2d4c366c37f5faf75141b8b2e -->

<!-- START_a8c8b807f0d6bbcf8f36d74c9e8a9a90 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/pages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/pages/{page}`


<!-- END_a8c8b807f0d6bbcf8f36d74c9e8a9a90 -->

<!-- START_a07341c4279f6ebbb863c00d764fb08c -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/pages/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET backend/pages/{page}/edit`


<!-- END_a07341c4279f6ebbb863c00d764fb08c -->

<!-- START_fe31febb0de22af8e999d2c3cc29a8f9 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/pages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/pages/{page}`

`PATCH backend/pages/{page}`


<!-- END_fe31febb0de22af8e999d2c3cc29a8f9 -->

<!-- START_690982804da1a3e6a4ab5953d6784bb1 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/pages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/pages/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/pages/{page}`


<!-- END_690982804da1a3e6a4ab5953d6784bb1 -->

<!-- START_aea09b4625d5e1b7d4693365733a8ef9 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/comments`


<!-- END_aea09b4625d5e1b7d4693365733a8ef9 -->

<!-- START_856437a8ef23ce97beb2dfc9df4c8b95 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/comments/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET backend/comments/create`


<!-- END_856437a8ef23ce97beb2dfc9df4c8b95 -->

<!-- START_1daa9a2329b598220d2f3aa8d2160946 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/backend/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST backend/comments`


<!-- END_1daa9a2329b598220d2f3aa8d2160946 -->

<!-- START_d15242b67488df7d67a466e531a67620 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/comments/{comment}`


<!-- END_d15242b67488df7d67a466e531a67620 -->

<!-- START_9f9820f207fbecbc0bffbd46fd3fcfbc -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/backend/comments/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET backend/comments/{comment}/edit`


<!-- END_9f9820f207fbecbc0bffbd46fd3fcfbc -->

<!-- START_2e72efddaa10b3599fe1c8750066811e -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/backend/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT backend/comments/{comment}`

`PATCH backend/comments/{comment}`


<!-- END_2e72efddaa10b3599fe1c8750066811e -->

<!-- START_a609de799e595ac6bc1a228ee94a6d64 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/backend/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/backend/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE backend/comments/{comment}`


<!-- END_a609de799e595ac6bc1a228ee94a6d64 -->

<!-- START_8d4719da98b334b52782027f53f14284 -->
## commentstatus
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/commentstatus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/commentstatus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST commentstatus`


<!-- END_8d4719da98b334b52782027f53f14284 -->

