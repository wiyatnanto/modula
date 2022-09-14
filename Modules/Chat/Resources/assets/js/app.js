import Echo from 'laravel-echo'

window.Pusher = require('pusher-js')

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
})

var channel = window.Echo.channel('chat.3')
channel.listen('.MessageSent', function (data) {
    alert(JSON.stringify(data))
})
