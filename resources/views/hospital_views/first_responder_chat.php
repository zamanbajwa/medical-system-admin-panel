<?php
$current_user = Auth::user();
$current_id = $current_user->id;
$current_user->first_name = 'test hospital';
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <div class="chat">
            <div class="chatt-header">
                <div class="header-content">
                    <button type="button" class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#myModal"><img src="<?php echo asset('hospital/images/gallery.png')?>"></button>
                </div>
            </div>
            <div class="message-area" id='chat_listing'>
                <?php if($messages){ ?>
                    <?php foreach($messages as $message){ ?>
                        <?php if($message->receiver_id == $current_id) { ?>
                            <div class="messagesending  message-left">
                                <div class="profle">
                                    <img src="<?php echo asset('hospital/images/profile.png')?>" class="message-profiles">
                                </div>
                                
                                <p><?= $message->message; ?></p>
                                <?php if ($message->file_type == 'image') { ?>
                                    <img src="<?php echo asset('/images' . $message->file_path); ?>" class="message-profiles">
                                <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <div class="messagesending message-right">
                                <div class="profle">
                                    <img src="<?php echo asset('hospital/images/profile.png')?>" class="message-profiles">
                                </div>
                                <p><?= $message->message; ?></p>
                                <?php if ($message->file_type == 'image') { ?>
                                    <img src="<?php echo asset('/images' . $message->file_path); ?>" class="message-profiles">
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="messageform">
                <form id="message-form">
                    <div class="form-group">
                        <input type="text" id="messagetext" class="form-control" placeholder="Type something" autocomplete="off"/>
                        <ul> 
                            <li>
                                <div class="chats-btns">
                                    <button class="send">
                                        <img src="<?php echo asset('hospital/images/send.png')?>">
                                    </button>
                                </div>
                            </li>
                            <li>
                                <div class="file">
<!--                                    <div class="input-group input-file" name="Fichier1">
                                        <span class="input-group-btn">
                                            <button class="send btn-choose" type="button">
                                                <img src="<?php echo asset('hospital/images/addmore.png')?>" />
                                            </button>
                                        </span>
                                        <input type="text" class="form-control" placeholder='Choose a file...' style="visibility: hidden;padding: 0;width: 0;height: 0;" />
                                    </div>-->


                                    <label for="attachment" class="attachment-label">Attachment</label>
                                    <input type="file" id="attachment" class="hidden" accept="video/*,  video/x-m4v, video/webm, video/x-ms-wmv, video/x-msvideo, video/3gpp, video/flv, video/x-flv, video/mp4, video/quicktime, video/mpeg, video/ogv, .ts, .mkv, image/*" src="">
                                </div>
                            </li>
                            <li>
                                <div class="attach-tile">
                                    <img id="loader_upload" style="display: none" class="attach-loader" src="<?php echo asset('public/images/attach-loader.gif') ?>">
                                    <div class="tiny-div chat-img">
                                        <a href="#" class="file-remover"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        <img id="tiny-icon" src="#">
                                        <video id="tiny-video" src="#"></video>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <!-- Gallery Modal-->
        <div id="myModal" class="modal fade galeerys" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Gallery</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="gallery-img">
                            <li><img src="images/monitor.png"></li>
                            <li><img src="images/monitor.png"></li>
                            <li><img src="images/monitor.png"></li>
                            <li><img src="images/monitor.png"></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">
          
        </script>
        <script>
            
            $('#messagetext').keypress(function (e) {
                if (e.which === 13) {
                    event.preventDefault();
                    sendMessage();
                }
            });
            
            current_id =<?= $current_id ?>;
            other_id=<?= $other_user_chat_id?>;
            socket.on('message_send', function (data) {
                console.log(data);
    //            console.log(current_id);
    //            console.log(other_id);
                if (data.user_id == current_id && other_id == data.other_id) {
    //                  console.log(data)
                    if (data.text) {
                                var chat_message = '<div class="messagesending  message-left">'+
                                                        '<div class="profle">'+
                                                            '<img src="<?php echo asset('hospital/images/profile.png')?>" class="message-profiles">'+
                                                        '</div>'+           
                                                        '<p><?= $message->message; ?></p>'+
                                                    '</div>';
                        $('#chat_listing').append(chat_message);
                        $("html, body").animate({scrollTop: $(document).height()}, "fast");
                    }
                    if (data.file_type == 'image') {
                        var text_message= '';
                        if(data.text){ // text attach with image
                            $('#chat_listing .message-left:last').fadeOut(); //remove text dive attach with image first
                            text_message = '<p>' + data.text + '</p>';
                        }
//                        var chat_message = '<div class="message-left">' +
//                                '<img class="img-user chat-icon" src="<?php echo getImage($other_user->image_path, $other_user->avatar)?>">'+
//                                '<div class="inner">' + text_message +
//                                '<img src="' + data.images_base + data.file + '" alt="" />' +
//                                '<span class="chat-time">Just Now</span>'+
//                                '</div>' +
//                                '</div>';
                        var chat_message = '<div class="messagesending  message-left">'+
                                                '<div class="profle">'+
                                                    '<img src="<?php echo asset('hospital/images/profile.png')?>" class="message-profiles">'+
                                                '</div>'+           
                                                text_message+
                                                '<img src="' + data.images_base + data.file + '" class="message-profiles">'+
                                            '</div>';
                        $('#chat_listing').append(chat_message);
                        $('.messages img').click(function () {
                            $('#chat-image-popup').show(300);
                            var curent_img = $(this).attr('src');
                            console.log(curent_img);
                            $('#chat-image-popup .txt img').attr('src', curent_img);
                        });
                        $("html, body").animate({scrollTop: $(document).height()}, "fast");
                    }
//                    if (data.file_type == 'video') {
//                        var text_message= '';
//                        if(data.text){ // text attach with video
//                            $('#chat_listing .message-left:last').fadeOut(); //remove text dive attach with video first
//                            text_message = '<p>' + data.text + '</p>';
//                        }
//                        var chat_message = '<div class="message-left">' +
//                                '<img class="img-user chat-icon" src="<?php echo getImage($other_user->image_path, $other_user->avatar)?>">'+
//                                '<div class="inner">' + text_message +
//                                '<video controls="" poster="' + data.images_base + data.file_poster + '">' +
//                                '<source src="' + data.video_base + data.file + '" type="video/mp4">' +
//                                '</video>' +
//                                '<span class="chat-time">Just Now</span>'+
//                                '</div>' +
//                                '</div>';
//                        $('#chat_listing').append(chat_message);
//                        $("html, body").animate({scrollTop: $(document).height()}, "fast");
//                    }
                }
            });
            
            
            var files;
            $('.messages img').click(function () {
                $('#chat-image-popup').show(300);
                var curent_img = $(this).attr('src');
                console.log(curent_img);
                $('#chat-image-popup .txt img').attr('src', curent_img);
            });
            $('.file-remover').click(function (e) {
                e.preventDefault();

                $('.tiny-div').hide();
                $("#tiny-video").attr("src", '');
                $("#tiny-icon").attr("src", '');
                $("#attachment").val('');
                  files = '';
            });
            $("#attachment").change(function () {
                $('.tiny-div').show();
                var fileInput = document.getElementById('attachment');
                var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
                var image_type = fileInput.files[0].type;

                if (image_type == "image/png" || image_type == "image/jpeg" || image_type == "image/bmp" || image_type == "image/jpg") {
                    $("#tiny-video").attr("src", '');
                    $("#tiny-icon").attr("src", fileUrl);
                } else if (fileInput.files[0].type == "video/mp4") {
                    $("#tiny-video").attr("src", fileUrl);
                    var myVideo = document.getElementById("tiny-video");
                        myVideo.addEventListener("loadedmetadata", function ()
                        {
                            duration = (Math.round(myVideo.duration * 100) / 100);
                            if (duration >= 21) {
                                alert('Video is greater than 20 sec.');
                                $("#tiny-video").attr("src", '');
                                $('.tiny-div').hide();
                            }
                        });
                    $("#tiny-icon").attr("src", '');
                } else {
                    files = '';
                    alert('Please Select a valid image or video');
                }
            });
            
            
            $('#attachment').on('change', prepareUpload);
            function prepareUpload(event)
            {
                alert('image');
                files = event.target.files;
                var input = document.getElementById('attachment');
                var filePath = input.value;
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.mp4|\.mkv|\.mov|\.flv|\.mpeg|\.webm|\.mpeg|\.avi|\.ts|\.ogv)$/i;
                if (!allowedExtensions.exec(filePath)) {
                    alert('Please upload file having extensions .jpeg/.jpg/.png/.gif/.mp4/.mkv/.mov/.3gp/.flv/.mpeg/.webm/.mpeg/.avi/.ts/.ogv/bm  only.');
                    $('#attachment').val('');
                    $('#imagePreview').html('');
                    $('.tiny-div').hide();
                    files = '';
                    return false;
                }
            }
            
            function sendMessage(){
        
                var otherid = <?= $other_user_chat_id ?>;
                var message = $('#messagetext').val();
                console.log(message);
//                var scrape_url = $('#scrape_url').val();
                $('#messagetext').val('');
//                $('#scrape_url').val('');
                $('.tiny-div').hide();
                if (message) {
                    $.ajax({
                        type: "get",
                        url: "<?php echo asset('hospital/get_url_message'); ?>",
                        data: {
                                "message": message
//                                "scrape_url": scrape_url
                            },
                        success: function (data) {
//                            console.log(data);
                            var chat_message = '<div class="messagesending message-right">'+
                                                    '<div class="profle">'+
                                                        '<img src="<?php echo asset('hospital/images/profile.png')?>" class="message-profiles">'+
                                                    '</div>'+
                                                    '<p>'+ JSON.parse(data) +'</p>'+
                                                '</div>';
                            $('#chat_listing').append(chat_message);
                        $("html, body").animate({scrollTop: $(document).height()}, "fast");
                        }
                    });
                }
                if (message || files) {
                    console.log('Text: ',message);
                    if (files) {
                        $('#loader_upload').show();
                    }
                    var data = new FormData();
                    $.each(files, function (key, value)
                    {
                        data.append('file', value);
                    });
                    data.append('message', message);
                    data.append('receiver_id', otherid);
//                    data.append('scrape_url', scrape_url);
                    

                    $('#attachment').attr('src', "");
                    $("#attachment").val('');
                    files = '';
                    $.ajax({
                        type: "POST",
                        url: "<?php echo asset('hospital/add_message'); ?>",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if (data) {
                                $('#loader_upload').hide();
                                $('#tiny-video').attr('src', "");
                                $('#tiny-icon').attr('src', "");
                                result = JSON.parse(data);
                                console.log(result);
//                                if (result.file_type == 'video') {
//                                    var text_message= '';
//                                    if(result.message){ // text attach with video
//                                        $('#chat_listing .message-right:last').fadeOut(); //remove text dive attach with video first
//                                        text_message = '<p>' + result.message + '</p>';
//                                    }
//                                    var chat_message = '<div class="message-right">' +
//                                            '<div class="inner">' + text_message +
//                                            '<video controls="" poster="' + result.image_base + result.poster + '">' +
//                                            '<source src="' + result.video_base + result.file_path + '" type="video/mp4">' +
//                                            '</video>' +
//                                            '<span class="chat-time">Just Now</span>'+
//                                            '</div>' +
//                                            '</div>';
//                                    $('#chat_listing').append(chat_message);
//                                    $("html, body").animate({scrollTop: $(document).height()}, "fast");
//                                }
                                if (result.file_type == 'image') {
//                                    $('.messages img').click(function () {
//                                        $('#chat-image-popup').show(300);
//                                        var curent_img = $(this).attr('src');
//                                        console.log(curent_img);
//                                        $('#chat-image-popup .txt img').attr('src', curent_img);
//                                    });
                                    var text_message= '';
                                    if(result.message){ // text attach with image
                                        $('#chat_listing .message-right:last').fadeOut(); //remove text dive attach with image first
                                        text_message = '<p>' + result.message + '</p>';
                                    }
                                    
                                    
                                    var chat_message = '<div class="messagesending message-right">'+
                                                            '<div class="profle">'+
                                                                '<img src="<?php echo asset('hospital/images/profile.png')?>" class="message-profiles">'+
                                                            '</div>'+
                                                            '<p>'+ text_message +'</p>'+
                                                            '<img src="<?php echo asset('/images' . $message->file_path); ?>" class="message-profiles">'+
                                                        '</div>';
                                    $('#chat_listing').append(chat_message);
                                    $("html, body").animate({scrollTop: $(document).height()}, "fast");
                                }
                                
                                socket.emit('message_get', {
                                    "user_id": otherid,
                                    "other_id": '<?php echo $current_id; ?>',
                                    "other_name": '<?php echo $current_user->first_name; ?>',
                                    "photo": '',
                                    "text": message,
                                    "file": result.file_path,
                                    "file_type": result.file_type,
                                    "file_poster": result.poster,
                                    "images_base": result.image_base,
                                    "video_base": result.video_base,
//                                    "site_extracted_url":result.site_extracted_url,
//                                    "site_title":result.site_title,
//                                    "site_image":result.site_image,
//                                    "site_content":result.site_content,
//                                    "site_url":result.site_url
                                });
                            }
                        }
                    });
                }
            }
            

            function bs_input_file() {
            
                $(".input-file").before(
                        function () {
                            if (!$(this).prev().hasClass('input-ghost')) {
                                var element = $("<input type='file' id='attachment' class='input-ghost' style='visibility:hidden; height:0'>");
                                element.attr("name", $(this).attr("name"));
                                element.change(function () {
                                    element.next(element).find('input').val((element.val()).split('\\').pop());
                                });
                                $(this).find("button.btn-choose").click(function () {
                                    element.click();
                                });
                                $(this).find("button.btn-reset").click(function () {
                                    element.val(null);
                                    $(this).parents(".input-file").find('input').val('');
                                });
                                $(this).find('input').css("cursor", "pointer");
                                $(this).find('input').mousedown(function () {
                                    $(this).parents('.input-file').prev().click();
                                    return false;
                                });
                                return element;
                            }
                        }
                );
            }
            $(function () {
                bs_input_file();
                
            });
        </script>

    </body>
</html>