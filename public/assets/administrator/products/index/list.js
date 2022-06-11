
function actionDelete(event){
    event.preventDefault()
    let urlRequest = $(this).data('url')
    let that = $(this)

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (response) {
                    if(response.code === 200){
                        that.parent().parent().remove()

                        Swal.fire(
                            'Đã xóa!',
                            'Đã xóa bản ghi.',
                            'success'
                        )
                    }
                },
                error: function (err) {
                    console.log(err)
                },
            })
        }
    })
}

function actionConfirm(event){
    event.preventDefault()
    let urlRequest = $(this).data('url')
    let that = $(this)

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (response) {
                    console.log(response)
                    if(response.code === 200){
                        that.parent().html(`<a class="btn btn-success btn-sm" title="Đã thu">
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                        </a>`)


                    }
                },
                error: function (err) {
                    console.log(err)
                },
            })
        }
    })
}


function search(ele) {
    if(event.key === 'Enter') {
        addUrlParameter('search_query' , $('#input_search').val())
    }
}

function addUrlParameter(name, value) {
    const searchParams = new URLSearchParams(window.location.search)
    searchParams.set(name, value)
    window.location.search = searchParams.toString()
}

function addUrlParameterObjects($params) {
    const searchParams = new URLSearchParams(window.location.search)

    for(let i = 0 ; i < $params.length; i++){
        searchParams.set($params[i].name, $params[i].value)
    }

    window.location.search = searchParams.toString()
}

$(function (){
    $(document).on('click', '.action_delete', actionDelete);
    $(document).on('click', '.action_confirm', actionConfirm);

    const url = new URL(decodeURIComponent(window.location.href));
    $('#input_search').val(url.searchParams.get("search_query"))

})


