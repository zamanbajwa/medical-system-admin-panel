var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var db = require('./db.js');
var mydb = new db();

app.get('/', function(req, res){
    res.send('Working fine on link merge admin panel.');
});
var sockets = {};
var arr = [];
io.on('connection', function(socket){
    socket.on('message_get', function(data){
        io.emit('message_send', {
            'user_id':data.user_id,
            'other_name':data.other_name,
            'photo':data.photo,
            'text':data.text,
            'other_id':data.other_id,
            'file':data.file,
            'file_type':data.file_type,
            'file_poster':data.file_poster,
            'images_base':data.images_base,
            'video_base':data.video_base,
//            "site_url":data.site_url,
//            "site_content":data.site_content,
//            "site_image":data.site_image,
//            "site_title":data.site_title,
//            "site_extracted_url":data.site_extracted_url
        });
    });
//    socket.on('group_message_get', function(data){
//        io.emit('group_message_send', {'group_id':data.group_id,'other_name':data.other_name,'photo':data.photo,'text':data.text,'other_id':data.other_id,'file':data.file,'file_type':data.type,'file_poster':data.file_poster,'images_base':data.images_base,'video_base':data.video_base,'message_id':data.message_id
//        });
//    });

    socket.on('get_responder_location', function(data){
        io.emit('send_responder_location', {
            'id':data.id,
            'user_id':data.user_id,
            'hospital_id':data.hospital_id,
            'first_name':data.first_name,
            'last_name':data.last_name,
            'user_image':data.user_image,
            'user_type':data.user_type,
            'lat':data.lat,
            'lng':data.lng,
            'status':data.status
        });
    });
    
    socket.on('get_patient_location', function(data){
        io.emit('send_patient_location', {
            'id':data.id,
            'user_id':data.user_id,
            'user_name':data.user_name,
            'first_name':data.first_name,
            'last_name':data.last_name,
            'thumb_id':data.thumb_id,
            'user_image':data.user_image,
            'lat':data.lat,
            'lng':data.lng
        });
    });
    
    socket.on('disconnect', function(){
        if(sockets[socket.id] != undefined){
            mydb.releaseRequest(sockets[socket.id].user_id).then(function (result) {
                console.log('disconected: '+sockets[socket.id].request_id);
                io.emit('request-released',{
                    'request_id':sockets[socket.id].request_id
                });
                delete sockets[socket.id];
            });
        }
    });
});

http.listen(5004, function(){
    console.log('listening on *:5004');
});