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

----

### heartbeat
```json
{"op":7,"version":"v1"}
```

### message
```json
{"op":512,"version":"v1"}
```

----

C1: client1
C2: client2
S1: server1

C1 -> 发送消息, 问C2在线吗 -> S1 -> 看了以下，回复消息，C2在线
C1-> 发送消息给C2 -> S1 -> 看了一下C2在线 -> 给C2发送消息说 “C1 给你发了一条消息”


-----
https://github.com/winlion/chat/blob/e6fe40db51/ctrl/chat.go
```go
/**
消息发送结构体
1、MEDIA_TYPE_TEXT
{id:1,userid:2,dstid:3,cmd:10,media:1,content:"hello"}
2、MEDIA_TYPE_News
{id:1,userid:2,dstid:3,cmd:10,media:2,content:"标题",pic:"http://www.baidu.com/a/log,jpg",url:"http://www.a,com/dsturl","memo":"这是描述"}
3、MEDIA_TYPE_VOICE，amount单位秒
{id:1,userid:2,dstid:3,cmd:10,media:3,url:"http://www.a,com/dsturl.mp3",anount:40}
4、MEDIA_TYPE_IMG
{id:1,userid:2,dstid:3,cmd:10,media:4,url:"http://www.baidu.com/a/log,jpg"}
5、MEDIA_TYPE_REDPACKAGR //红包amount 单位分
{id:1,userid:2,dstid:3,cmd:10,media:5,url:"http://www.baidu.com/a/b/c/redpackageaddress?id=100000","amount":300,"memo":"恭喜发财"}
6、MEDIA_TYPE_EMOJ 6
{id:1,userid:2,dstid:3,cmd:10,media:6,"content":"cry"}
7、MEDIA_TYPE_Link 6
{id:1,userid:2,dstid:3,cmd:10,media:7,"url":"http://www.a,com/dsturl.html"}
7、MEDIA_TYPE_Link 6
{id:1,userid:2,dstid:3,cmd:10,media:7,"url":"http://www.a,com/dsturl.html"}
8、MEDIA_TYPE_VIDEO 8
{id:1,userid:2,dstid:3,cmd:10,media:8,pic:"http://www.baidu.com/a/log,jpg",url:"http://www.a,com/a.mp4"}
9、MEDIA_TYPE_CONTACT 9
{id:1,userid:2,dstid:3,cmd:10,media:9,"content":"10086","pic":"http://www.baidu.com/a/avatar,jpg","memo":"胡大力"}
*/
```

