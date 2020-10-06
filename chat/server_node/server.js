var io = require('socket.io')(6001)
var Redis = require('ioredis')
var redis = new Redis(6379)
redis.psubscribe("*", function (error, count) {
})
redis.on('pmessage', function (partner, channel, message) {
    message = JSON.parse(message)
    io.emit(channel, message.data.chat)
})