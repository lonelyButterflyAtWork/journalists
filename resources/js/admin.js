showVotes = function(id = 0){
    console.log('Button 1 is clicked');
};
delJournalist = function(id = 0){
    console.log('Button 2 is clicked');
};

sendAjax = function(event, id){
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
        function createListEL( id, ip, date, time){
            return `<div class="d-flex justify-content-between pt1 pb1" style="width: 100%;padding-right:15px;padding-left:15px">
                        <span>` + ip + `</span>
                        <span>` + date + ` ` + time + `</span>
                        <a onclick = 'deleteVote(`+ id +`)' class="btn btn-danger btn-sm mt-1 mb-1" href="#" onclick="delJournalist({{ $item['id'] }})">
                                  <i class="fas fa-trash">
                                  </i>
                                  Usuń
                        </a>
                    </div>
                    `;
        }
        function printMsg (msg) {
            if($.isEmptyObject(msg.error)){

                    if(msg.data[0].ip){

                    console.log(msg.data.ip);

                    let template = ``;

                    msg.data.forEach(element => {

                        let date = element.journalists[0].pivot.created_at.split('T')[0];
                        let time = element.journalists[0].pivot.created_at.split("T")[1].split(".")[0];
                        console.log(element.journalists[0].pivot.created_at);
                        template+= createListEL( element.id, element.ip, date, time);

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
