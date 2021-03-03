showVotes = function(event, id){
    if( document.querySelector( "#votesList" + id ) == null ){

        var _token = $('meta[name="csrf-token"]').attr('content');
        var url = $('#editUrl').attr('value');

        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url: url,
            type:'POST',
            data: {_token:_token, id:id},
            success: function(data) {
            printMsg(data);

            }

        });
        function createListEL( id, ip, date, time, counterId){
            return `<div class="d-flex justify-content-between pt1 pb1" style="width: 100%;padding-right:15px;padding-left:15px" id="vote` + id + `">
                        <span>` + ip + `</span>
                        <span>` + date + ` ` + time + `</span>
                        <div onclick = "deleteVote(event, `+ id +`, '#counter`+ counterId +`')" class="btn btn-danger btn-sm mt-1 mb-1">
                                  <i class="fas fa-trash">
                                  </i>
                                  Usuń
                        </div>
                    </div>
                    `;
        }
        function printMsg (msg) {
            if($.isEmptyObject(msg.error)){

                    if(msg.data[0].ip){


                    let template = ``;

                    msg.data.forEach(element => {
                        console.log(element.journalists[0].pivot);


                        let date = element.journalists[0].pivot.created_at.split('T')[0];
                        let time = element.journalists[0].pivot.created_at.split("T")[1].split(".")[0];
                        console.log(element.journalists[0].pivot.created_at);
                        template+= createListEL( element.journalists[0].pivot.id , element.ip, date, time, id);

                    });

                    console.log( $( event.target ).parent().parent() );
                        $( "<td colspan='6'><div id = 'votesList" + id + "' style='width: 100%'>" + template + "</div></td>" ).insertAfter( $( event.target ).parent().parent() );


                }

                }else{
                $.each( msg.error, function( key, value ) {
                $('.'+key+'_err').text(value);
                });
            }
        }
    }
}
deleteVote = function(event, id, counterId){
    if( true ){

        var _token = $('meta[name="csrf-token"]').attr('content');
        var url = $('#delVote').attr('value');

        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url: url,
            type:'POST',
            data: {_token:_token, id:id},
            success: function(data) {
            printMsg(data);

            }

        });
        function printMsg (msg) {
            if($.isEmptyObject(msg.error)){

                let counter = document.querySelector(counterId).innerText*1;

                document.querySelector(counterId).innerText = counter - 1;

                document.querySelector("#vote" + id ).outerHTML="";

            } else{

            }
        }
    }
}
