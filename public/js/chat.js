window.addEventListener("beforeunload", function (e) {

    /*logout ajax call*/
    for (var i = 0; i < 500000000; i++) { }

    return undefined;
});

function escapeRegExp(string) {
  return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
}

function replaceAll(str, find, replace) {
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function load_users(){

    $.ajax({
        url: 'user-list',
        method: "GET",
        dataType: 'json',
        success: function (data) {
            $('#user-list').html('')
            if(typeof data[0] != 'undefined' && $('#selected-user-id').val() == ''){
               $('#selected-user-id').val(data[0].id)
               $('#selected-user-name').html(data[0].name)
               loadUserMesssages()
            }
            for(let j in data){
                let user = data[j]

                let html = $('#user-template').html()
                for(let i in user){
                    // console.log("##"+i+"##")
                    // console.log(this[i])
                    html = replaceAll(html,"##"+i+"##", user[i])
                }
                $('#user-list').append(html)
            }
            attachUserEvents()
            checkNewMessages()
        }
    });
}

function attachUserEvents(){
    $('.user-item').click(function(){
        $('#selected-user-id').val($(this).data('id'))
        $('#selected-user-name').text($(this).data('name'))
        loadUserMesssages()
        $('#selected-user-id').val($(this).data('id'))
    })
}

function loadUserMesssages(){
    let userId = $('#selected-user-id').val()
    $.ajax({
        url: 'load-messages?sender_id='+userId,
        method: "GET",
        dataType: 'json',
        success: function (data) {
            $('#message-box').html('')
            for(let j in data){
                let message = data[j]
                let templateName = message.sender_id == userId ? 'received-message' : 'sent-message'

                let html = $('#'+templateName).html()
                for(let i in message){
                    // console.log("##"+i+"##")
                    // console.log(this[i])
                    html = replaceAll(html,"##"+i+"##", message[i])
                    // console.log(html)
                }
                $('#message-box').append(html)
            }
            attachMessageEvents()
            markAsReadMessage()
        }
    });
}

function markAsReadMessage(){
    let userId = $('#selected-user-id').val()
    $.ajax({
        url: 'mark-as-read-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), sender_id : userId},
        success: function (data) {
            // 
        }
    });
}

function attachMessageEvents(){
}

function checkNewMessages(){
    $.ajax({
        url: 'check-messages',
        method: "GET",
        dataType: 'json',
        success: function (data) {
            $('.message-count').html('').removeClass('inline-block py-1 px-1.5 leading-none text-xs text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded-full ml-2')
            if(data['new_messages']){
                for(let j in data['new_messages']){
                    let update = data['new_messages'][j]
                    $('#user-message-count-'+ update.sender_id).html(update.message_count)
                    if(update.message_count){
                        // $('#user-message-count-'+ update.sender_id).addClass("bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-200 dark:text-red-900 w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500")
                        $('#user-message-count-'+ update.sender_id).addClass("inline-block py-1 px-1.5 leading-none text-xs text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded-full ml-2")
                    }
                    if(update.sender_id == $('#selected-user-id').val()){
                        loadUserMesssages()
                    }
                }
            }
            if(data['deleted_messages']){
                for(let j in data['deleted_messages']){
                    let deleted = data['deleted_messages'][j]
                    if(deleted.sender_id == $('#selected-user-id').val()){
                        loadUserMesssages()
                    }
                }
            }
        }
    });
}
function deleteMessage(messageId){
    $.ajax({
        url: 'delete-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), message_id : messageId},
        success: function (data) {
            if(data){
                $('#message_'+messageId).remove()
            }
        }
    });
}
$(function(){
    
    load_users()

    setInterval(checkNewMessages, 1000)

    $('#sendMessage').click(function(){
        $.ajax({
            url: 'send-message',
            method: "POST",
            data: { _token : $('meta[name="csrf-token"]').attr('content'), receiver_id : $('#selected-user-id').val(), text : $('#message').val()},
            success: function (data) {
                $('#message').val('')
                loadUserMesssages()
            }
        });
    })

})
