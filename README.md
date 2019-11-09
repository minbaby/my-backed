# 我的

## 参考

- https://github.com/meili/TeamTalk
- https://gitee.com/pwsns/cloudtalk
- https://gitee.com/xchao/j-im


## 

- packet => WsPacket, HttpPacket, TcpPackert
- command, 
- message
- responseBody
- protocol

----


protocol 就是 http/websocket/tcp 等这些东西
packet 可以理解是，传输消息格式，如 json/msgpack 等
message 可以理解是消息实体

```json
{
  "code": "111",
  "message": "info",
  "body": [],
  "version": 1
}
```


```yaml
op: xx
version: 1
```

```yaml
message:
  from: minbaby
  to: 'babab'
  type: chat/error/groupchat/headline/normal
  subject: title
  body: are you ok?
```

```yaml
# req
iq:
  from: minbaby
  id: ???
  type: get
  query:fasdfdsa
```

```yaml
# res
iq:
  from: minbaby
  id: ???
  type: result
  query:
    - item:
        jid: 1
        name: xxx
        group: friends
```

```yaml
presence:
  from: minbaby
  to: abab
  type: unavailable
  status: gone home
```

```json
{
  "id": "1",
  "delivery_data": "2",
  "deletion_date": "3",
  "text": "yes",
  "sender_id": "a",
  "group_id": "b",
  "recipient_id": "c",
  "records": "d"
}
```