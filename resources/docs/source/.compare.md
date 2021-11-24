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

<!-- START_6f448d5c55c35e8c44456de7f5c14084 -->
## api/auth/getpaymentbyid
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getpaymentbyid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getpaymentbyid"
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
`POST api/auth/getpaymentbyid`


<!-- END_6f448d5c55c35e8c44456de7f5c14084 -->

<!-- START_e94f62009c3f968869eb41a8048f24a8 -->
## Course Test Result

get the result by test
if percent < 50% 3x block account
first number is question order, second number is answer order
if answer the checkbox, then true ex: 2_3: true, or radio button then answers number ex: 1_2: 2

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/getresult?access_token=sit&model=%7B1_2%3A+2%2C+1_3%3A+3%2C+2_2%3A+true%2C+2_3%3A+true%2C+3_2%3A+true%2C+3_3%3A+true%2C+4_1%3A+true%2C+4_2%3A+true%2C+5_2%3A+true%7D&user_id=2&course_id=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/getresult"
);

let params = {
    "access_token": "sit",
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
important for mobile --- send account_id, course_id, token, mobile=true

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/payment?ClientID=consequuntur&Username=username&Password=password&Currency=AMD&Description=SHMZ&Amount=10&OrderID=AMD&BackURL=https%3A%2F%2Fwww.shmz.am%2Flesson&Opaque=Opaque+VPOS&CardHolderID=CARD+VPOS" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/payment"
);

let params = {
    "ClientID": "consequuntur",
    "Username": "username",
    "Password": "password",
    "Currency": "AMD",
    "Description": "SHMZ",
    "Amount": "10",
    "OrderID": "AMD",
    "BackURL": "https://www.shmz.am/lesson",
    "Opaque": "Opaque VPOS",
    "CardHolderID": "CARD VPOS",
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
    "https://training.gtech.am/api/auth/addpoint?access_token=nam&point=7.199989&user_id=2&id=3" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/addpoint"
);

let params = {
    "access_token": "nam",
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

<!-- START_424dd09a003bf3d070fdd381e318111b -->
## Certificate
get certificate by test id

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/certificate?access_token=token&id=1&user_id=2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/certificate"
);

let params = {
    "access_token": "token",
    "id": "1",
    "user_id": "2",
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
    "data": "img name.png",
    "token_type": "bearer"
}
```

### HTTP Request
`POST api/auth/certificate`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `id` |  optional  | The test id to filter
    `user_id` |  optional  | The account id to filter

<!-- END_424dd09a003bf3d070fdd381e318111b -->

#Account Profile


APIs for a account profile
<!-- START_a19f97e120902d01a27fb7ac23c9a2c1 -->
## Change avatar

change avatar by account id

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/avatar/1?access_token=rerum&avatar=%22%28binary%29%22&_method=PUT" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/avatar/1"
);

let params = {
    "access_token": "rerum",
    "avatar": ""(binary)"",
    "_method": "PUT",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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


> Example response (200):

```json
{
    "token": ""
}
```

### HTTP Request
`PUT api/auth/avatar/{id}`

`PATCH api/auth/avatar/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `avatar` |  optional  | the image
    `_method` |  optional  | 

<!-- END_a19f97e120902d01a27fb7ac23c9a2c1 -->

<!-- START_13790c84e17bb9810ede0e7aa98a01f1 -->
## Edit Account profile and approve by admin
multipart/form-data
edit profile by account id

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/approve/1?access_token=fuga&name=%22name%22&surname=%22surname%22&father_name=%22father_name%22&date_of_expiry=%222022-06-13%22&date_of_issue=%222020-06-02%22&diplomas=%22%5B%22OfU5qs_2.jpeg%22%5D%22&j_diplomas=%22OfU5qs_2.jpeg%2C3NqMqY_2.jpeg%22&diploma_1=%22%28binary%29%22&passport=%22AN0771747%22&member_of_palace=%220%22&_method=PUT" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/approve/1"
);

let params = {
    "access_token": "fuga",
    "name": ""name"",
    "surname": ""surname"",
    "father_name": ""father_name"",
    "date_of_expiry": ""2022-06-13"",
    "date_of_issue": ""2020-06-02"",
    "diplomas": ""["OfU5qs_2.jpeg"]"",
    "j_diplomas": ""OfU5qs_2.jpeg,3NqMqY_2.jpeg"",
    "diploma_1": ""(binary)"",
    "passport": ""AN0771747"",
    "member_of_palace": ""0"",
    "_method": "PUT",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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


> Example response (200):

```json
{
    "success": "pending",
    "user": "2"
}
```

### HTTP Request
`PUT api/auth/approve/{id}`

`PATCH api/auth/approve/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `name` |  optional  | The account name
    `surname` |  optional  | The account surname
    `father_name` |  optional  | The account father_name
    `date_of_expiry` |  optional  | The date of expiry
    `date_of_issue` |  optional  | The date of issue
    `diplomas` |  optional  | The rest after removing
    `j_diplomas` |  optional  | The passport field /all img from db
    `diploma_1` |  optional  | The new upload file
    `passport` |  optional  | The passport field
    `member_of_palace` |  optional  | The member of palace 0 or 1
    `_method` |  optional  | 

<!-- END_13790c84e17bb9810ede0e7aa98a01f1 -->

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
## Profile by account id
get the profile by id

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


> Example response (200):

```json
{
    "access_token": null,
    "user": {
        "id": 2,
        "name": "name",
        "surname": "surname",
        "father_name": "father_name",
        "image_name": "avatar_2.png",
        "bday": "1978-09-13",
        "email": "g_aslanyan@mail.ru",
        "phone": "93610174",
        "home_address": "{\"h_region\": \"7\", \"h_street\": \"վերդի 7\/8\", \"h_territory\": \"523\"}",
        "work_address": "{\"w_region\": \"3\", \"w_street\": \"հիմնական 7\", \"w_territory\": \"145\"}",
        "workplace_name": "պոլիկնիկա",
        "specialty_id": 30,
        "education_id": 7,
        "profession": 3,
        "info": "Wfwf"
    },
    "app": {
        "id": 2,
        "name": "name",
        "surname": "surname",
        "father_name": "father_name",
        "date_of_expiry": "2022-06-13",
        "passport": "AN0771747",
        "date_of_issue": "2020-06-02",
        "prof": {
            "specialty_id": 30,
            "member_of_palace": 0,
            "diplomas": "[\"OfU5qs_2.jpeg\", \"3NqMqY_2.jpeg\"]",
            "account_id": 2
        }
    },
    "token_type": "bearer",
    "expires_in": 0
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
## Edit Account profile

edit profile by account id

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/edit/1?access_token=commodi&phone=%2293656565%22&bday=%222022-06-13%22&workplace_name=%22name%22&h_region=%222%22&w_region=%222%22&h_territory=%222%22&w_territory=%222%22&w_street=%22name%22&h_street=%22name%22&profession=%220%22&specialty_id=%2230%22&education_id=%223%22&info=%22%22&_method=PUT" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/edit/1"
);

let params = {
    "access_token": "commodi",
    "phone": ""93656565"",
    "bday": ""2022-06-13"",
    "workplace_name": ""name"",
    "h_region": ""2"",
    "w_region": ""2"",
    "h_territory": ""2"",
    "w_territory": ""2"",
    "w_street": ""name"",
    "h_street": ""name"",
    "profession": ""0"",
    "specialty_id": ""30"",
    "education_id": ""3"",
    "info": """",
    "_method": "PUT",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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


> Example response (200):

```json
{
    "success": "true",
    "user": "2"
}
```

### HTTP Request
`PUT api/auth/edit/{id}`

`PATCH api/auth/edit/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `phone` |  optional  | The account phone number
    `bday` |  optional  | The account bday
    `workplace_name` |  optional  | The workplace name
    `h_region` |  optional  | The home region id
    `w_region` |  optional  | The work region id
    `h_territory` |  optional  | The home territory id
    `w_territory` |  optional  | The work territory id
    `w_street` |  optional  | The work street name
    `h_street` |  optional  | The home street name
    `profession` |  optional  | The member of palace 0 or 1
    `specialty_id` |  optional  | The specialty id
    `education_id` |  optional  | The education id
    `info` |  optional  | The info description
    `_method` |  optional  | 

<!-- END_ec2b7e10ed4deb3cededb17caf85bfaf -->

<!-- START_59d115d508f64860035363af26e59b9d -->
## Change password

change password by account id

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/api/auth/changePass/1?access_token=commodi&old_password=%22111111111%22&password=%226666666%22&re-password=%226666666%22&_method=PUT" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/changePass/1"
);

let params = {
    "access_token": "commodi",
    "old_password": ""111111111"",
    "password": ""6666666"",
    "re-password": ""6666666"",
    "_method": "PUT",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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


> Example response (200):

```json
{
    "success": "true",
    "user_id": "2"
}
```

### HTTP Request
`PUT api/auth/changePass/{id}`

`PATCH api/auth/changePass/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token
    `old_password` |  optional  | 
    `password` |  optional  | 
    `re-password` |  optional  | 
    `_method` |  optional  | 

<!-- END_59d115d508f64860035363af26e59b9d -->

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

<!-- START_a404ad2680ae39b37bf51a3f1dd26c95 -->
## Check Course Test count
get watched the test video or not

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/finishedvideo?access_token=token&id=1&user_id=2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/finishedvideo"
);

let params = {
    "access_token": "token",
    "id": "1",
    "user_id": "2",
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
    "": "1|0 true or false"
}
```

### HTTP Request
`POST api/auth/finishedvideo`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `access_token` |  optional  | token.
    `id` |  optional  | The course id to filter.
    `user_id` |  optional  | The account id to filter.

<!-- END_a404ad2680ae39b37bf51a3f1dd26c95 -->

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

<!-- START_ef1943c162e0d7f81b61ecdb44d4713e -->
## api/courseinfo
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/courseinfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/courseinfo"
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
`POST api/courseinfo`


<!-- END_ef1943c162e0d7f81b61ecdb44d4713e -->

<!-- START_a6744504741d554f6a457928554be41e -->
## api/getcoursebyprof
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/getcoursebyprof" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/getcoursebyprof"
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
`POST api/getcoursebyprof`


<!-- END_a6744504741d554f6a457928554be41e -->

<!-- START_519c11c4aad1151b7af3151a2d6d8a0d -->
## api/getcoursebyid
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/getcoursebyid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/getcoursebyid"
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
`POST api/getcoursebyid`


<!-- END_519c11c4aad1151b7af3151a2d6d8a0d -->

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
## The account registration

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/register?name=%22name%22&surname=%22surname%22&father_name=%22father_name%22&date_of_expiry=%222022-06-13%22&date_of_issue=%222020-06-02%22&diplomas=%22%5B%22OfU5qs_2.jpeg%22%5D%22&j_diplomas=%22OfU5qs_2.jpeg%2C3NqMqY_2.jpeg%22&diploma_1=%22%28binary%29%22&passport=%22AN0771747%22&re_passport=%22AN0771747%22&member_of_palace=%220%22&bday=%221978-09-13%22%2C&email=%22g_aslanyan%40mail.ru%22%2C&phone=%2293610174%22%2C&h_region=%223%22%2C&h_street=%22%D5%B0%D5%AB%D5%B4%D5%B6%D5%A1%D5%AF%D5%A1%D5%B6+7%22%2C&h_territory=%22145%22%2C&w_region=%223%22%2C&w_street=dolores&w_territory=velit&workplace_name=laudantium&specialty_id=laborum&education_id=reprehenderit&profession=sit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/register"
);

let params = {
    "name": ""name"",
    "surname": ""surname"",
    "father_name": ""father_name"",
    "date_of_expiry": ""2022-06-13"",
    "date_of_issue": ""2020-06-02"",
    "diplomas": ""["OfU5qs_2.jpeg"]"",
    "j_diplomas": ""OfU5qs_2.jpeg,3NqMqY_2.jpeg"",
    "diploma_1": ""(binary)"",
    "passport": ""AN0771747"",
    "re_passport": ""AN0771747"",
    "member_of_palace": ""0"",
    "bday": ""1978-09-13",",
    "email": ""g_aslanyan@mail.ru",",
    "phone": ""93610174",",
    "h_region": ""3",",
    "h_street": ""հիմնական 7",",
    "h_territory": ""145",",
    "w_region": ""3",",
    "w_street": "dolores",
    "w_territory": "velit",
    "workplace_name": "laudantium",
    "specialty_id": "laborum",
    "education_id": "reprehenderit",
    "profession": "sit",
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
    "success": "pending",
    "user": "2"
}
```

### HTTP Request
`POST api/auth/register`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `name` |  optional  | The account name.
    `surname` |  optional  | The account surname.
    `father_name` |  optional  | The account father_name.
    `date_of_expiry` |  optional  | The date of expiry.
    `date_of_issue` |  optional  | The date of issue
    `diplomas` |  optional  | The rest after removing.
    `j_diplomas` |  optional  | The passport field /all img from db.
    `diploma_1` |  optional  | The new upload file.
    `passport` |  optional  | The passport field.
    `re_passport` |  optional  | The confirm passport field.
    `member_of_palace` |  optional  | The member of palace 0 or 1.
    `bday` |  optional  | The bday
    `email` |  optional  | The account email
    `phone` |  optional  | The account phone
    `h_region` |  optional  | The home region id
    `h_street` |  optional  | The home street name
    `h_territory` |  optional  | The home territory id
    `w_region` |  optional  | The work region id
    `w_street` |  optional  | The work street name "հիմնական 7",
    `w_territory` |  optional  | The work territory id "145",
    `workplace_name` |  optional  | The work place name "պոլիկնիկա",
    `specialty_id` |  optional  | Կրթությունը  "30",
    `education_id` |  optional  | Մասնագիտացումը "7",
    `profession` |  optional  | Մասնագիտական խումբը "3",

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

<!-- START_5f6caf6e0084445f9485e6b796d33d7b -->
## Handle the incoming request.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/auth/verify/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/auth/verify/1/1"
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
`POST api/auth/verify/{id}/{key}`


<!-- END_5f6caf6e0084445f9485e6b796d33d7b -->

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

<!-- START_42a8dac97355f027158a787e284824f7 -->
## api/sendMail
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/sendMail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/sendMail"
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
`POST api/sendMail`


<!-- END_42a8dac97355f027158a787e284824f7 -->

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

<!-- START_8dc73d45daa776ebe968a06c2e353bdc -->
## api/rating
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/api/rating" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/api/rating"
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
`POST api/rating`


<!-- END_8dc73d45daa776ebe968a06c2e353bdc -->

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

<!-- START_785f30eaa5561b9f7ece59c2d9ce76bc -->
## Handle reset password

> Example request:

```bash
curl -X PUT \
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
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/reset/password`

`PATCH api/reset/password`


<!-- END_785f30eaa5561b9f7ece59c2d9ce76bc -->

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

<!-- START_c46872470c7977ec8d12c221bb50cfe0 -->
## howtouse
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/howtouse" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/howtouse"
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
`GET howtouse`


<!-- END_c46872470c7977ec8d12c221bb50cfe0 -->

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

<!-- START_26c055ba7624ce9f55fcba29bbc8497b -->
## test/getCourses
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/test/getCourses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test/getCourses"
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
`GET test/getCourses`


<!-- END_26c055ba7624ce9f55fcba29bbc8497b -->

<!-- START_c1aa27515bf03f12d5698af59e31585a -->
## test
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test"
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
`GET test`


<!-- END_c1aa27515bf03f12d5698af59e31585a -->

<!-- START_02540a8edc609a5a314226b37dab9872 -->
## test/create
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/test/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test/create"
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
`GET test/create`


<!-- END_02540a8edc609a5a314226b37dab9872 -->

<!-- START_7132fd4af5f56c29675526f8ecf4206c -->
## test
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test"
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
`POST test`


<!-- END_7132fd4af5f56c29675526f8ecf4206c -->

<!-- START_2de5d5aceb76f5a4496931ef12597b15 -->
## test/{test}/edit
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/test/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test/1/edit"
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
`GET test/{test}/edit`


<!-- END_2de5d5aceb76f5a4496931ef12597b15 -->

<!-- START_9c0bc0085cc87c9a767b44635846ee3e -->
## test/{test}
> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test/1"
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
`PUT test/{test}`

`PATCH test/{test}`


<!-- END_9c0bc0085cc87c9a767b44635846ee3e -->

<!-- START_8031bb235c7296066d140241c4bd0c5a -->
## test/{test}
> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test/1"
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
`DELETE test/{test}`


<!-- END_8031bb235c7296066d140241c4bd0c5a -->

<!-- START_ce19587bbf8c6ead41418d3c13e4a046 -->
## test/{id}
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/test/1"
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
`POST test/{id}`


<!-- END_ce19587bbf8c6ead41418d3c13e4a046 -->

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

<!-- START_232c1f249f32a1935117a74e61939f0a -->
## specialtyCheck
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/specialtyCheck" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/specialtyCheck"
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
`POST specialtyCheck`


<!-- END_232c1f249f32a1935117a74e61939f0a -->

<!-- START_29bbb7b8c0bf6bfb56c255010f276f34 -->
## ajaxImageUpload
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/ajaxImageUpload" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/ajaxImageUpload"
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
`POST ajaxImageUpload`


<!-- END_29bbb7b8c0bf6bfb56c255010f276f34 -->

<!-- START_bea9dd6a2edb797c995ba14427b874a1 -->
## ajaxRemoveImage
> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/ajaxRemoveImage" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/ajaxRemoveImage"
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
`DELETE ajaxRemoveImage`


<!-- END_bea9dd6a2edb797c995ba14427b874a1 -->

<!-- START_cdb9d105051f344660fdcdba70d4c6c5 -->
## typeCheck
> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/typeCheck" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/typeCheck"
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
`POST typeCheck`


<!-- END_cdb9d105051f344660fdcdba70d4c6c5 -->

<!-- START_e14b5e0eae7c6a1147f1f179bc73d6b8 -->
## specialty/list
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/specialty/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/specialty/list"
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
`GET specialty/list`


<!-- END_e14b5e0eae7c6a1147f1f179bc73d6b8 -->

<!-- START_38a1ab74eea98c018efd5149ed85ef7c -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/specialty" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/specialty"
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
`GET specialty`


<!-- END_38a1ab74eea98c018efd5149ed85ef7c -->

<!-- START_b3cf8cb1271c79009526625041808138 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/specialty/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/specialty/create"
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
`GET specialty/create`


<!-- END_b3cf8cb1271c79009526625041808138 -->

<!-- START_a253d111e60f82be3307b9fa014ff014 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/specialty/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/specialty/1"
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
`GET specialty/{specialty}`


<!-- END_a253d111e60f82be3307b9fa014ff014 -->

<!-- START_ba4694734f7d1a767c1f8a414d1b3337 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/specialty/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/specialty/1"
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
`DELETE specialty/{specialty}`


<!-- END_ba4694734f7d1a767c1f8a414d1b3337 -->

<!-- START_0b50eedcba418efccbd6d6bd4a854fbf -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/pages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages"
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
`GET pages`


<!-- END_0b50eedcba418efccbd6d6bd4a854fbf -->

<!-- START_8a60b4754cbd2227557eca9e2d3feb87 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/pages/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages/create"
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
`GET pages/create`


<!-- END_8a60b4754cbd2227557eca9e2d3feb87 -->

<!-- START_0125370d1ef8c56d7cbcf2f6b0c412f0 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/pages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages"
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
`POST pages`


<!-- END_0125370d1ef8c56d7cbcf2f6b0c412f0 -->

<!-- START_0a443f82a8cafd7d0b372f7db7619236 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/pages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages/1"
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
`GET pages/{page}`


<!-- END_0a443f82a8cafd7d0b372f7db7619236 -->

<!-- START_83dea3193588f66f4ce30488641bacdf -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/pages/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages/1/edit"
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
`GET pages/{page}/edit`


<!-- END_83dea3193588f66f4ce30488641bacdf -->

<!-- START_8a86bab0f64706deb73542f8ff2118ec -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/pages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages/1"
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
`PUT pages/{page}`

`PATCH pages/{page}`


<!-- END_8a86bab0f64706deb73542f8ff2118ec -->

<!-- START_a0f9c3cf938a173796b4eabccf7573d0 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/pages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/pages/1"
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
`DELETE pages/{page}`


<!-- END_a0f9c3cf938a173796b4eabccf7573d0 -->

<!-- START_d728f2176d9cdd509e70b4addfa59568 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments"
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
`GET comments`


<!-- END_d728f2176d9cdd509e70b4addfa59568 -->

<!-- START_1b00d25d48d0ffecbd7666826bca1161 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/comments/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments/create"
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
`GET comments/create`


<!-- END_1b00d25d48d0ffecbd7666826bca1161 -->

<!-- START_dbbdec5432271c7207f66a514c3d40f3 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments"
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
`POST comments`


<!-- END_dbbdec5432271c7207f66a514c3d40f3 -->

<!-- START_4b70241db734b6750c3cf375d7fb7f3d -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments/1"
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
`GET comments/{comment}`


<!-- END_4b70241db734b6750c3cf375d7fb7f3d -->

<!-- START_2214a0a6ed2bbd597061f5bac09eba14 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/comments/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments/1/edit"
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
`GET comments/{comment}/edit`


<!-- END_2214a0a6ed2bbd597061f5bac09eba14 -->

<!-- START_d77a52a1ec0772eb16f009b222565815 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments/1"
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
`PUT comments/{comment}`

`PATCH comments/{comment}`


<!-- END_d77a52a1ec0772eb16f009b222565815 -->

<!-- START_4be6c9e6ba186c0d21ea11a3179908f0 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/comments/1"
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
`DELETE comments/{comment}`


<!-- END_4be6c9e6ba186c0d21ea11a3179908f0 -->

<!-- START_0af9fab88fd7253ac8ccee578f299141 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/payments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments"
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
`GET payments`


<!-- END_0af9fab88fd7253ac8ccee578f299141 -->

<!-- START_bee5c0ed5b4d16d42fc0347401ec39e5 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/payments/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments/create"
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
`GET payments/create`


<!-- END_bee5c0ed5b4d16d42fc0347401ec39e5 -->

<!-- START_8c8a1dbf0b7a7750e3c029f286ad53c5 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "https://training.gtech.am/payments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments"
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
`POST payments`


<!-- END_8c8a1dbf0b7a7750e3c029f286ad53c5 -->

<!-- START_78f503fb9658b1ceadabc4775a31735e -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/payments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments/1"
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
`GET payments/{payment}`


<!-- END_78f503fb9658b1ceadabc4775a31735e -->

<!-- START_486913730c9e1a25de563202cfde3d0d -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/payments/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments/1/edit"
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
`GET payments/{payment}/edit`


<!-- END_486913730c9e1a25de563202cfde3d0d -->

<!-- START_675c31be071655650d33175d7b59a834 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "https://training.gtech.am/payments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments/1"
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
`PUT payments/{payment}`

`PATCH payments/{payment}`


<!-- END_675c31be071655650d33175d7b59a834 -->

<!-- START_48199b0f0eae75aec5cf8f5dfc525b96 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "https://training.gtech.am/payments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/payments/1"
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
`DELETE payments/{payment}`


<!-- END_48199b0f0eae75aec5cf8f5dfc525b96 -->

<!-- START_99cd2fc0467744403b501ad7ba6c0eaa -->
## account/cancelPayment
> Example request:

```bash
curl -X GET \
    -G "https://training.gtech.am/account/cancelPayment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://training.gtech.am/account/cancelPayment"
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
`GET account/cancelPayment`


<!-- END_99cd2fc0467744403b501ad7ba6c0eaa -->

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


