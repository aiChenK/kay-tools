# kay-tools
> 工具类

## 运行环境
- PHP 7.2+

## 安装方法
        composer require aichenk/kay-tools
        
## 使用
```php
use KayTools\TimeTool;

var_dump(TimeTool::friendlyCost(86670));    //1天4分30秒
```

## 更新说明
2022-03-16 - v2.0.0
- 去除`RequestTool`中客户端信息获取方法
- 去除`whichbrowser/parser`依赖

2021-01-25 - v1.3.4
- 更改`ServerTool`获取域名方法

2020-12-23 - v1.3.3
- 修复`ServerTool`获取域名方法

2020-10-30 - v1.3.2
- `getZeroTimestamp`支持获取13位时间戳

2020-08-05 - v1.3.1
- 增加`whichbrowser/parser`依赖，替换获取浏览器及操作系统方法

2020-07-01 - v1.3.0
- 增加`ServerTool`，支持获取域名等信息
- 移动`isUnderCli|getServerOS`方法到`ServerTool`

2020-06-26 - v1.2.0
- 增加`Tree`类，主要处理导航树等
