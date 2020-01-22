# 消息协议

## 思路

- api
- websocket

## op code

0x0001： 

| code |  en | zh |
|:---:|:---:|:---:|
| 0 |  unknown | 未知 |
| 1 |  heartbeat | 心跳 |
| 2 |  decode failed | 解码失败 |
| 100 |  single message | 单条消息 |
| 200 |  group message | 获取消息 |
| 300 |  spec message | 提示 |

## error message

### 未知code
```json
{
  "id": "uuid()",
  "op": 0
}
```

### 心跳
```json
{
  "id": "uuid()",
  "op": 1
}
```

### single message

```json
{
  "id": "uuid()",
  "op": 100,
  "from": "a",
  "to": "b",
  "message": "yes"
}
```