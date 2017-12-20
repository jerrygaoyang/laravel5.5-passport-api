# laravel passport api auth

### 说明

* 基于 passport 封装的 login, logout, register, refresh_token, verify_code

* 以上接口逻辑你都不需要再去管理

* app/Http/Controllers/Api/AuthenticateController 中 verify_code 方法添加对应的手机和邮箱发送接口调用

* 以上 auth 接口同时支持手机和邮箱

### 使用说明

> git clone https://github.com/jerrygaoyang/laravel5.5-passport-api.git

> cd laravel5.5-passport-api

> cp .env.example .env    (配置好数据库,以及APP_URL)

> composer install 

> php artisan key:generate

> php artisan migrate

> php artisan passport:install


### 接口文档

##### 登陆获取 token 

> POST /api/auth/login

* 请求参数

```json
{
    "account": "18888888888",   //手机或邮箱
    "password": "123456"        
}
```

* 请求回调

```json
{
    "code": 0,
    "message": "success",
    "data": {
        "token_type": "Bearer",
        "expires_in": 1296000,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE4YTI5OGQ3YTk4YWM5YzJkNjI0MWEwMTMxNGFjZjA3Njg3MTBlMTIxMzVjNzQzNzhlNDM1NTcyZTM1YWNjZWNmNGVmNzU0MTMwNDE0M2M0In0.eyJhdWQiOiIyIiwianRpIjoiYThhMjk4ZDdhOThhYzljMmQ2MjQxYTAxMzE0YWNmMDc2ODcxMGUxMjEzNWM3NDM3OGU0MzU1NzJlMzVhY2NlY2Y0ZWY3NTQxMzA0MTQzYzQiLCJpYXQiOjE1MTM3NTY2MzksIm5iZiI6MTUxMzc1NjYzOSwiZXhwIjoxNTE1MDUyNjM5LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.WwC_aCEBJoEmryKKRhvAZXvwFE1En0w_Le5pLLBr3et1x9k9k7Z55kffN5_R8Cm-qvFnGGn8uIJfvNMWpx-WjPPNf7BEAkb1bHtfy_jRFDmi0W22KEtywywUomX4gamBJWRQQJ_rjQyzAcA0nf_LMGHZmRfvFwTvg9dElwVh-25-HSvS4wlhv0HHWPt-YpsSN8HgP_QjM702OthAyAtT-BUZp4lwDa1Od0IVRuw6OKMdVgisMdc_ZVSDxpBMbADaEQl8f6lmwjCGxBuGcOanprQpN7x6dUPgSAvunCb60V3w1dtlDAcsErunwbSiQomPmHeEpK2n_LLC9S9hDxaf6VCFqAVqD0oDBpLJ1NLzGOSq3nKbEorUt6TBUS0p4eYXLATQ1D6nlfHH_VHiqqPIXI944UeuWcf1lxQWlenK3fW064-KFuKsuzvTSwQuS75zKrfg4i1tdOYlY7i1WV5yS-SA-ppXn30QAl7EI6WMp31d1D1BerckOBG69EX2aLgwuOa-dnUJhBmICoIppfuBMvIOeSwMpPxBfXDV0GksOhaKAqcOIr6gNK_METcKvjKQBLD_1h258pp-e_JCjC6zHH8pz3pgS2YJf9wBY3K4VSXlmidV5U6zdHt2J5qlhh-iGsk83GRQpIGJcnZOe1n7HPhMWfaFp4rsajsnb-jrL5s",
        "refresh_token": "def50200e9c1f3a624918f3c7feed0d5975e62d4940b778b70c4632088cdc2c3e707ad7e78124438f12c83797073a82fe12cd4826809c6eed8fdda54a7aeda3e854c1ad8ddf5d6e47b78c28eb5adda708c824dfeb8ffe269da87026188a599433edc5c3dad6217cf440d8a0e23bb561c4000912f8982950a1123e1399746528c2453a2ec594d420b50eda98a94d79e06bd283ca661f2f0360c248c657d0bc5dcba64463c67e8ece0a484a68233e77ce7a1566bea2705f807d1d81310641119632d32b40c6c3ecc0d4836d865ade7a5cf78d2ac8166ca56e12a1d1cf7a1bdd827dd030b7009b005e31cee7b98aaf8e4de3d77b004b9167e875b3801735884186adb446d7a343b6c0eb8f5d5c8345654c0e180501b67ae1c422b91f40722f5bf0cc9202e2515be98e071eabfd671159896278b9c5b1d134e4c351eb28860ab67fdc2a6a8edab6e7892cf1473fbe6e16e0b3b8a8a75759810a1f88f71d6a4f07f"
    }
}
```


##### 刷新 token 

> POST /api/auth/refresh_token

* 请求参数

```json
{
    "refresh_token": "def50200e9c1f3a624918f3c7feed0d5975e62d4940b778b70c4632088cdc2c3e707ad7e78124438f12c83797073a82fe12cd4826809c6eed8fdda54a7aeda3e854c1ad8ddf5d6e47b78c28eb5adda708c824dfeb8ffe269da87026188a599433edc5c3dad6217cf440d8a0e23bb561c4000912f8982950a1123e1399746528c2453a2ec594d420b50eda98a94d79e06bd283ca661f2f0360c248c657d0bc5dcba64463c67e8ece0a484a68233e77ce7a1566bea2705f807d1d81310641119632d32b40c6c3ecc0d4836d865ade7a5cf78d2ac8166ca56e12a1d1cf7a1bdd827dd030b7009b005e31cee7b98aaf8e4de3d77b004b9167e875b3801735884186adb446d7a343b6c0eb8f5d5c8345654c0e180501b67ae1c422b91f40722f5bf0cc9202e2515be98e071eabfd671159896278b9c5b1d134e4c351eb28860ab67fdc2a6a8edab6e7892cf1473fbe6e16e0b3b8a8a75759810a1f88f71d6a4f07f"
}
```

* 请求回调

```json
{
    "code": 0,
    "message": "success",
    "data": {
        "token_type": "Bearer",
        "expires_in": 1296000,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE4YTI5OGQ3YTk4YWM5YzJkNjI0MWEwMTMxNGFjZjA3Njg3MTBlMTIxMzVjNzQzNzhlNDM1NTcyZTM1YWNjZWNmNGVmNzU0MTMwNDE0M2M0In0.eyJhdWQiOiIyIiwianRpIjoiYThhMjk4ZDdhOThhYzljMmQ2MjQxYTAxMzE0YWNmMDc2ODcxMGUxMjEzNWM3NDM3OGU0MzU1NzJlMzVhY2NlY2Y0ZWY3NTQxMzA0MTQzYzQiLCJpYXQiOjE1MTM3NTY2MzksIm5iZiI6MTUxMzc1NjYzOSwiZXhwIjoxNTE1MDUyNjM5LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.WwC_aCEBJoEmryKKRhvAZXvwFE1En0w_Le5pLLBr3et1x9k9k7Z55kffN5_R8Cm-qvFnGGn8uIJfvNMWpx-WjPPNf7BEAkb1bHtfy_jRFDmi0W22KEtywywUomX4gamBJWRQQJ_rjQyzAcA0nf_LMGHZmRfvFwTvg9dElwVh-25-HSvS4wlhv0HHWPt-YpsSN8HgP_QjM702OthAyAtT-BUZp4lwDa1Od0IVRuw6OKMdVgisMdc_ZVSDxpBMbADaEQl8f6lmwjCGxBuGcOanprQpN7x6dUPgSAvunCb60V3w1dtlDAcsErunwbSiQomPmHeEpK2n_LLC9S9hDxaf6VCFqAVqD0oDBpLJ1NLzGOSq3nKbEorUt6TBUS0p4eYXLATQ1D6nlfHH_VHiqqPIXI944UeuWcf1lxQWlenK3fW064-KFuKsuzvTSwQuS75zKrfg4i1tdOYlY7i1WV5yS-SA-ppXn30QAl7EI6WMp31d1D1BerckOBG69EX2aLgwuOa-dnUJhBmICoIppfuBMvIOeSwMpPxBfXDV0GksOhaKAqcOIr6gNK_METcKvjKQBLD_1h258pp-e_JCjC6zHH8pz3pgS2YJf9wBY3K4VSXlmidV5U6zdHt2J5qlhh-iGsk83GRQpIGJcnZOe1n7HPhMWfaFp4rsajsnb-jrL5s",
        "refresh_token": "def50200e9c1f3a624918f3c7feed0d5975e62d4940b778b70c4632088cdc2c3e707ad7e78124438f12c83797073a82fe12cd4826809c6eed8fdda54a7aeda3e854c1ad8ddf5d6e47b78c28eb5adda708c824dfeb8ffe269da87026188a599433edc5c3dad6217cf440d8a0e23bb561c4000912f8982950a1123e1399746528c2453a2ec594d420b50eda98a94d79e06bd283ca661f2f0360c248c657d0bc5dcba64463c67e8ece0a484a68233e77ce7a1566bea2705f807d1d81310641119632d32b40c6c3ecc0d4836d865ade7a5cf78d2ac8166ca56e12a1d1cf7a1bdd827dd030b7009b005e31cee7b98aaf8e4de3d77b004b9167e875b3801735884186adb446d7a343b6c0eb8f5d5c8345654c0e180501b67ae1c422b91f40722f5bf0cc9202e2515be98e071eabfd671159896278b9c5b1d134e4c351eb28860ab67fdc2a6a8edab6e7892cf1473fbe6e16e0b3b8a8a75759810a1f88f71d6a4f07f"
    }
}
```


##### 注册，并获取token 

> POST /api/auth/register

* 请求参数

```json
{
    "account": "18656660@163.com",    //手机或邮箱
    "password": "123456",
    "code": 1234
}
```

* 请求回调

```json
{
    "code": 0,
    "message": "success",
    "data": {
        "token_type": "Bearer",
        "expires_in": 1296000,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE4YTI5OGQ3YTk4YWM5YzJkNjI0MWEwMTMxNGFjZjA3Njg3MTBlMTIxMzVjNzQzNzhlNDM1NTcyZTM1YWNjZWNmNGVmNzU0MTMwNDE0M2M0In0.eyJhdWQiOiIyIiwianRpIjoiYThhMjk4ZDdhOThhYzljMmQ2MjQxYTAxMzE0YWNmMDc2ODcxMGUxMjEzNWM3NDM3OGU0MzU1NzJlMzVhY2NlY2Y0ZWY3NTQxMzA0MTQzYzQiLCJpYXQiOjE1MTM3NTY2MzksIm5iZiI6MTUxMzc1NjYzOSwiZXhwIjoxNTE1MDUyNjM5LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.WwC_aCEBJoEmryKKRhvAZXvwFE1En0w_Le5pLLBr3et1x9k9k7Z55kffN5_R8Cm-qvFnGGn8uIJfvNMWpx-WjPPNf7BEAkb1bHtfy_jRFDmi0W22KEtywywUomX4gamBJWRQQJ_rjQyzAcA0nf_LMGHZmRfvFwTvg9dElwVh-25-HSvS4wlhv0HHWPt-YpsSN8HgP_QjM702OthAyAtT-BUZp4lwDa1Od0IVRuw6OKMdVgisMdc_ZVSDxpBMbADaEQl8f6lmwjCGxBuGcOanprQpN7x6dUPgSAvunCb60V3w1dtlDAcsErunwbSiQomPmHeEpK2n_LLC9S9hDxaf6VCFqAVqD0oDBpLJ1NLzGOSq3nKbEorUt6TBUS0p4eYXLATQ1D6nlfHH_VHiqqPIXI944UeuWcf1lxQWlenK3fW064-KFuKsuzvTSwQuS75zKrfg4i1tdOYlY7i1WV5yS-SA-ppXn30QAl7EI6WMp31d1D1BerckOBG69EX2aLgwuOa-dnUJhBmICoIppfuBMvIOeSwMpPxBfXDV0GksOhaKAqcOIr6gNK_METcKvjKQBLD_1h258pp-e_JCjC6zHH8pz3pgS2YJf9wBY3K4VSXlmidV5U6zdHt2J5qlhh-iGsk83GRQpIGJcnZOe1n7HPhMWfaFp4rsajsnb-jrL5s",
        "refresh_token": "def50200e9c1f3a624918f3c7feed0d5975e62d4940b778b70c4632088cdc2c3e707ad7e78124438f12c83797073a82fe12cd4826809c6eed8fdda54a7aeda3e854c1ad8ddf5d6e47b78c28eb5adda708c824dfeb8ffe269da87026188a599433edc5c3dad6217cf440d8a0e23bb561c4000912f8982950a1123e1399746528c2453a2ec594d420b50eda98a94d79e06bd283ca661f2f0360c248c657d0bc5dcba64463c67e8ece0a484a68233e77ce7a1566bea2705f807d1d81310641119632d32b40c6c3ecc0d4836d865ade7a5cf78d2ac8166ca56e12a1d1cf7a1bdd827dd030b7009b005e31cee7b98aaf8e4de3d77b004b9167e875b3801735884186adb446d7a343b6c0eb8f5d5c8345654c0e180501b67ae1c422b91f40722f5bf0cc9202e2515be98e071eabfd671159896278b9c5b1d134e4c351eb28860ab67fdc2a6a8edab6e7892cf1473fbe6e16e0b3b8a8a75759810a1f88f71d6a4f07f"
    }
}
```


##### 获取验证码

> POST /api/auth/verify_code

* 请求参数

```json
{
    "account": "18688888888"
}
```

* 请求回调

```json
{
    "code": 0,
    "message": "success",
    "data": ""
}
```


##### 退出登录，并销毁token 

> POST /api/auth/logout

* 请求 header

```json
{
    "Authorization": "Bearer token"
}
```

* 请求回调

```json
{
    "code": 0,
    "message": "success",
    "data": ""
}
```


