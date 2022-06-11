

let chat_group_id

function addMessageToChatBox(content, time, sender = true, add_to_bottom = true, img_link = ""){
    const element = $(`#container_chat`)

    let data = ``

    if(sender){
        data = `<div class="d-flex flex-row justify-content-end">
                                    <div>
                                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">${content}</p>
                                        <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${time}</p>
                                    </div>
                                    <img src="{{auth()->user()->feature_image_path}}" class="avatar-chat">
                                </div>`
    }else{
        data = `<div class="d-flex flex-row justify-content-start mb-4">
                        <img src="${img_link}"  class="avatar-chat">
                        <div>
                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">${content}</p>
                            <p class="small ms-3 mb-3 rounded-3 text-muted">${time}</p>
                        </div>
                    </div>`
    }

    if(add_to_bottom){
        element.append(data)
    }else{
        element.prepend(data)
    }

    element.animate({
        scrollTop: element.prop("scrollHeight")
    }, 0);
}

$("#input_message").on("keydown",function search(e) {

    if(e.keyCode == 13 && $(this).val() && chat_group_id) {
        $.ajax({
            type: 'POST',
            url: "{{route('administrator.chat.create')}}",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                'sender_id': "{{auth()->id()}}",
                'contents': $(this).val(),
                'chat_group_id': chat_group_id,
            },
            cache: false,
            success: function (response) {
                addMessageToChatBox(response.content, response.created_at)
            },
            error: function (err) {
                console.log(err)
            },
        })

        $(this).val('')
    }
})

$(document).ready(function ($) {
    $("tbody tr").click(function () {
        const element = $(`#container_chat`)

        element.html('')
        chat_group_id = $(this).data('id')
        $('tr').css("color", "black")
        $(this).css("color", "red")
        let urlRequest = $(this).data('url')

        $.ajax({
            type: 'GET',
            url: urlRequest,
            success: function (response) {
                for (let i =0 ; i < response.data.length; i++){
                    if(response.data[i].user_id == "{{auth()->id()}}"){
                        addMessageToChatBox(response.data[i].content, response.data[i].created_at, true, false, response.data[i].user.feature_image_path)
                    }else{
                        addMessageToChatBox(response.data[i].content, response.data[i].created_at, false, false, response.data[i].user.feature_image_path)
                    }
                }
            },
            error: function (err) {
                console.log(err)
            },
        })

    });
});
