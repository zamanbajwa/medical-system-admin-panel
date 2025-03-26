<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
Use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

//Models
use App\ChatUser;
use App\ChatMessage;
use App\User;

class ChatController extends Controller {

    private $userId;
    private $userName;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->userId = Auth::user()->id;
            $this->userName = Auth::user()->first_name;
            return $next($request);
        });
    }

    function getChats() {

        $user_id = $this->userId;
        $data['title'] = 'Messages';
        $data['chats'] = ChatUser::with('sender', 'receiver')
                        ->withCount(['messages' => function ($q) {
                                $q->where('is_read', 0);
                            }])
                        ->where(function ($q) use($user_id) {
                            $q->where('sender_id', $user_id);
                            $q->orWhere('receiver_id', $user_id);
                        })
                        ->whereRaw("IF(`sender_id` = $user_id, `sender_deleted`, `receiver_deleted`)= 0")
                        ->orderBy('updated_at', 'desc')->get();
//                    echo '<pre>';
//                    print_r($data);exit;
        return view('user.chats', $data);
    }

    function getChatDetails($other_user) {
        $user_id = $this->userId;
        $data['title'] = 'Messages';
        ChatMessage::where(array('receiver_id' => $user_id))->update(['is_read' => 1]);
//        $data['chat_user_id'] = $chat_id;
        $data['messages'] = ChatMessage::with('sender', 'receiver')
                ->where(function ($q) use($user_id) {
                    $q->where('sender_id', $user_id);
                    $q->orWhere('receiver_id', $user_id);
                })
                ->where(function ($q) use($other_user) {
                    $q->where('sender_id', $other_user);
                    $q->orWhere('receiver_id', $other_user);
                })
//                ->where('chat_id', $chat_id)
                ->whereRaw("IF(`sender_id` = $user_id, `sender_deleted`, `receiver_deleted`)= 0")
                ->get();
//        $chat = ChatUser::find($chat_id);
//        $other_user = $chat->sender_id;
//        if ($chat->sender_id == $user_id) {
//            $other_user = $chat->receiver_id;
//        }
        $data['other_user'] = User::find($other_user);
        $data['other_user_chat_id'] = $other_user;

        return view('hospital_views.first_responder_chat', $data);
        return Response::json(array('successData' => $data));
    }

    function getChatUserDetails($other_id) {

        $user_id = $this->userId;
        $data['title'] = 'Messages';
        ChatMessage::where(array('sender_id' => $other_id, 'receiver_id' => $user_id))->update(['is_read' => 1]);
        $chat = ChatUser::where(function ($q) use($user_id,$other_id) {
                            $q->where('sender_id', $user_id);
                            $q->where('receiver_id', $other_id);
                        })
                        ->orwhere(function ($q) use($other_id,$user_id) {
                            $q->where('sender_id', $other_id);
                            $q->where('receiver_id', $user_id);
                        })->first();
                        
        if ($chat) {
            $data['chat_user_id'] = $chat->id;
        } else {
            $data['chat_user_id'] = '';
        }
        $data['messages'] = ChatMessage::with('sender', 'receiver')
                ->where(function ($q) use($user_id,$other_id) {
                            $q->where('sender_id', $user_id);
                            $q->where('receiver_id', $other_id);
                        })
                        ->orwhere(function ($q) use($other_id,$user_id) {
                            $q->where('sender_id', $other_id);
                            $q->where('receiver_id', $user_id);
                        })
                ->whereRaw("IF(`sender_id` = $user_id, `sender_deleted`, `receiver_deleted`)= 0")
                ->get();

        $data['other_user'] = User::find($other_id);
        $data['other_user_chat_id'] = $other_id;

        return view('user.chat-detail', $data);
//        return Response::json(array('successData' => $data));
    }

    function returnMessage(request $request) {

        echo json_encode($request['message']);
    }

    function addMessage(Request $request) {
        $validation = $this->validate($request, [
            'receiver_id' => 'required'
        ]);
        if ($request['file']) {
            $file_type = $request['file']->getMimeType();
        }
        $sender_id = $this->userId;
        $receiver_id = $request['receiver_id'];
        $chat_user = ChatUser::where(function($q) use($receiver_id, $sender_id) {
                            $q->where('sender_id', $sender_id)
                            ->where('receiver_id', $receiver_id);
                        })
                        ->orwhere(function($q) use($receiver_id, $sender_id) {
                            $q->where('sender_id', $receiver_id);
                            $q->where('receiver_id', $sender_id);
                        })->first();
        if ($chat_user) {
            if ($chat_user->receiver_id == $sender_id) {
                $chat_user->receiver_deleted = 0;
                $chat_user->sender_deleted = 0;
                $chat_user->save();
            }
            if ($chat_user->sender_id == $sender_id) {
                $chat_user->sender_deleted = 0;
                $chat_user->receiver_deleted = 0;
                $chat_user->save();
            }
        }
        if (!$chat_user) {
            $chat_user = new ChatUser;
            $chat_user->sender_id = $sender_id;
            $chat_user->receiver_id = $receiver_id;
            $chat_user->save();
        }

        $message = new ChatMessage;
        $message->sender_id = $sender_id;
        $message->receiver_id = $receiver_id;
        $message->chat_id = $chat_user->id;
        if ($request['message']) {
            $tagged_message  = $request['message'];
            $message->message = $tagged_message;
        }
        if ($request['file']) {
            
            if (substr($file_type, 0, 5) == 'image') {
                $message->file_path = $this->addFile($request['file'], 'chat');
                $message->poster = '';
                $message->file_type = 'image';
            }
            if (substr($file_type, 0, 5) == 'video') {
//                echo 'video';
//                exit();
                $video = $request['file'];
                $video_data = $this->addVideo($video, 'chat');
                $message->file_path = $video_data['file'];
                $message->poster = $video_data['poster'];
                $message->file_type = 'video';
            }
        }

        $message->save();

        ChatUser::where(function($q) use($receiver_id, $sender_id) {
                    $q->where('sender_id', $sender_id)
                    ->where('receiver_id', $receiver_id);
                })
                ->orwhere(function($q) use($receiver_id, $sender_id) {
                    $q->where('sender_id', $receiver_id);
                    $q->where('receiver_id', $sender_id);
                })->update(['last_message_id' => $message->id]);
        $mesage = ChatMessage::find($message->id);
        $mesage->image_base = asset('images');
        $mesage->video_base = asset('videos');



        //Nodification code
        /*if ($receiver_id != $this->userId) {
            $message_obj = ChatMessage::where('id', $message->id)->with('sender', 'receiver')->first();
            $heading = 'User Chat';
            $messagex = $this->userName . ' send you a private message.';
            $data['activityToBeOpened'] = "Chat";
            $data['message'] = $message_obj;
            $url = asset('message-detail/' . $sender_id);
            sendNotification($heading, $messagex, $data, $receiver_id, $url);
        }*/
        //Activity Log
        /*$on_user = $request['receiver_id'];
        $text = 'You send a message.';
        $notification_text = $this->userName . ' send you a private message.';
        $description = $message->message;
        $unique_description = $message->message . '<span style="display:none">' . $message->id . '_' . $this->userId . '</span>';
        $type = 'Chat';
        $relation = 'ChatMessage';
        $type_id = $message->id;
        addActivity($on_user, $text, $notification_text, $description, $type, $relation, $type_id, '', $unique_description);*/
        echo json_encode($mesage);
    }

    function readMessages(Request $request) {
        $validation = $this->validate($request, [
            'chat_id' => 'required'
        ]);
        if ($validation) {
            return Response::json(array('status' => 'error', 'errorMessage' => $validation));
        }

        $receiver_id = $this->userId;

        $messages = ChatMessage::where(['chat_id' => $request['chat_id'], 'receiver_id' => $receiver_id])->update(['is_read' => 1]);
        return Response::json(array('status' => 'success', 'successData' => $messages, 'successMessage' => 'Messages read successfully.'));
    }

    function deleteMessage(Request $request) {
        $validation = $this->validate($request, [
            'message_id' => 'required'
        ]);
        if ($validation) {
            return Response::json(array('status' => 'error', 'errorMessage' => $validation));
        }

        $user_id = $this->userId;

        $message = ChatMessage::find($request['message_id']);
        if ($message->sender_id == $user_id) {
            $message->sender_deleted = 1;
        } elseif ($message->receiver_id == $user_id) {
            $message->receiver_deleted = 1;
        }
        $message->is_read = 1;
        $message->save();

        return Response::json(array('status' => 'success', 'successData' => $message, 'successMessage' => 'Messages deleted successfully.'));
    }

    function deleteChat($id) {
        $user_id = $this->userId;
        $chat = ChatUser::find($id);
        if ($chat->sender_id == $user_id) {
            $chat->sender_deleted = 1;
        } elseif ($chat->receiver_id == $user_id) {
            $chat->receiver_deleted = 1;
        }
        $chat->save();
        ChatMessage::where(['chat_id' => $id, 'receiver_id' => $user_id])->update(['receiver_deleted' => 1, 'is_read' => 1]);
        ChatMessage::where(['chat_id' => $id, 'sender_id' => $user_id])->update(['sender_deleted' => 1, 'is_read' => 1]);
        Session::flash('success', "Chat Deleted Successfully");
        return Redirect::to(URL::previous('messages'));
    }

//    function addFile(Request $request) {
//
//        print_r($request->all());
//    }

    public function scrapeUrl($scrape_url) {
        if (!empty($scrape_url) && filter_var($scrape_url, FILTER_VALIDATE_URL)) {
            $get_url = $scrape_url;

            $parse = parse_url($get_url);
            $url = $parse['host'];

            //get URL content
            $get_content = HtmlDomParser::file_get_html($scrape_url);
            if (!$get_content) {
                return Response::json([FALSE], 200);
            }
//            return Response::json(['data' => $get_content], 200);
            $dom_obj = new \DOMDocument();
            libxml_use_internal_errors(true);

            $dom_obj->loadHTML($get_content);
            $meta_val = null;
            //$page_body = null;
            //Get Page Title
            $page_title = '';
            foreach ($get_content->find('title') as $element) {
                $page_title = $element->plaintext;
            }


            //Get Body Text
            $page_body = '';
            if (count($get_content->find('body')) > 0) {
                foreach ($get_content->find('body') as $element) {
                    $page_body = trim($element->plaintext);
                    if ($page_body) {
                        $pos = strpos($page_body, ' ', 200); //Find the numeric position to substract
                        $page_body = substr($page_body, 0, $pos); //shorten text to 200 chars
                    }
                }
            } if (!$page_body) {


                foreach ($dom_obj->getElementsByTagName('meta') as $meta) {

                    if ($meta->getAttribute('property') == 'og:description') {
                        $page_body = $meta->getAttribute('content');

                        //return $page_body;
                    } elseif ($meta->getAttribute('name') == 'description') {
                        $page_body = $meta->getAttribute('content');
                        //return $page_body;
                    }
                }
            }
            $image_urls = array();

            if (count($get_content->find('img')) > 0) {

                foreach ($dom_obj->getElementsByTagName('meta') as $meta) {

                    if ($meta->getAttribute('property') == 'og:image') {

                        $image_urls[] = $meta->getAttribute('content');
                        //dd($meta->getAttribute('content'));
                    }
                }
                if (empty($image_urls)) {
                    //get all images URLs in the content
                    foreach ($get_content->find('img') as $element) {
                        //  check image URL is valid and name isn't blank.gif/blank.png etc..
                        // you can also use other methods to check if image really exist 
                        if (!preg_match('/blank.(.*)/i', $element->src) && filter_var($element->src, FILTER_VALIDATE_URL)) {
                            $image_urls[] = $element->src;
                        }
                    }
                }
            } else {
                foreach ($dom_obj->getElementsByTagName('meta') as $meta) {

                    if ($meta->getAttribute('property') == 'og:image') {

                        $image_urls[] = $meta->getAttribute('content');
                        //dd($meta->getAttribute('content'));
                    }
                }
            }

            //prepare for JSON
            $output = array('title' => $page_title, 'images' => $image_urls, 'content' => $page_body, 'url' => $url);
            return $output; //output JSON data
        } else {
            return FALSE;
        }
    }

    
    
    function addFile($file, $path) {
        if ($file) {
            if ($file->getClientOriginalExtension() != 'exe') {
                $type = $file->getClientMimeType();
                if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
                    $destination_path = 'images/' . $path; // upload path
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $fileName = 'image_' . Str::random(15) . '.' . $extension; // renameing image
                    $file->move($destination_path, $fileName);
                    $file_path = '/' . $path . '/' . $fileName;
    //                $data['file'] = $file_path;
                    return $file_path;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    
    function addVideo($video, $path) {
        $video_extension = $video->getClientOriginalExtension(); // getting image extension
        $video_extension = strtolower($video_extension);
        $allowedextentions = ["mov", "3g2", "3gp", "4xm", "a64", "aa", "aac", "ac3", "act", "adf", "adp", "adts", "adx", "aea", "afc", "aiff", "alaw", "alias_pix", "alsa", "amr", "anm", "apc", "ape", "apng",
            "aqtitle", "asf", "asf_o", "asf_stream", "ass", "ast", "au", "avi", "avisynth", "avm2", "avr", "avs", "bethsoftvid", "bfi", "bfstm", "bin", "bink", "bit", "bmp_pipe",
            "bmv", "boa", "brender_pix", "brstm", "c93", "caf", "cavsvideo", "cdg", "cdxl", "cine", "concat", "crc", "dash", "data", "daud", "dds_pipe", "dfa", "dirac", "dnxhd",
            "dpx_pipe", "dsf", "dsicin", "dss", "dts", "dtshd", "dv", "dv1394", "dvbsub", "dvd", "dxa", "ea", "ea_cdata", "eac3", "epaf", "exr_pipe", "f32be", "f32le", "f4v",
            "f64be", "f64le", "fbdev", "ffm", "ffmetadata", "film_cpk", "filmstrip", "flac", "flic", "flv", "framecrc", "framemd5", "frm", "g722", "g723_1", "g729", "gif", "gsm", "gxf",
            "h261", "h263", "h264", "hds", "hevc", "hls", "hls", "applehttp", "hnm", "ico", "idcin", "idf", "iff", "ilbc", "image2", "image2pipe", "ingenient", "ipmovie",
            "ipod", "ircam", "ismv", "iss", "iv8", "ivf", "j2k_pipe", "jacosub", "jpeg_pipe", "jpegls_pipe", "jv", "latm", "lavfi", "live_flv", "lmlm4", "loas", "lrc",
            "lvf", "lxf", "m4v", "matroska", "mkv", "matroska", "webm", "md5", "mgsts", "microdvd", "mjpeg", "mkvtimestamp_v2", "mlp", "mlv", "mm", "mmf", "mp4", "m4a", "3gp",
            "3g2", "mj2", "mp2", "mp3", "mp4", "mpc", "mpc8", "mpeg", "mpeg1video", "mpeg2video", "mpegts", "mpegtsraw", "mpegvideo", "mpjpeg", "mpl2", "mpsub", "msnwctcp",
            "mtv", "mulaw", "mv", "mvi", "mxf", "mxf_d10", "mxf_opatom", "mxg", "nc", "nistsphere", "nsv", "null", "nut", "nuv", "oga", "ogg", "oma", "opus", "oss", "paf",
            "pictor_pipe", "pjs", "pmp", "png_pipe", "psp", "psxstr", "pulse", "pva", "pvf", "qcp", "qdraw_pipe", "r3d", "rawvideo", "realtext", "redspark", "rl2", "rm",
            "roq", "rpl", "rsd", "rso", "rtp", "rtp_mpegts", "rtsp", "s16be", "s16le", "s24be", "s24le", "s32be", "s32le", "s8", "sami", "sap", "sbg", "sdl", "sdp", "sdr2",
            "segment", "sgi_pipe", "shn", "siff", "singlejpeg", "sln", "smjpeg", "smk", "smoothstreaming", "smush", "sol", "sox", "spdif", "spx", "srt", "stl",
            "stream_segment", "ssegment", "subviewer", "subviewer1", "sunrast_pipe", "sup", "svcd", "swf", "tak", "tedcaptions", "tee", "thp", "tiertexseq",
            "tiff_pipe", "tmv", "truehd", "tta", "tty", "txd", "u16be", "u16le", "u24be", "u24le", "u32be", "u32le", "u8", "uncodedframecrc", "v4l2", "vc1", "vc1test",
            "vcd", "video4linux2", "v4l2", "vivo", "vmd", "vob", "vobsub", "voc", "vplayer", "vqf", "w64", "wav", "wc3movie", "webm", "webm_chunk", "webm_dash_manife",
            "webp", "webp_pipe", "webvtt", "wsaud", "wsvqa", "wtv", "wv", "x11grab", "xa", "xbin", "xmv", "xv", "xwma", "wmv", "yop", "yuv4mpegpipe"];
        if (in_array($video_extension, $allowedextentions)) {
            $video_destinationPath = base_path('public/videos/' . $path); // upload path
            $video_fileName = 'video_' . Str::random(15) . '.' . 'mp4'; // renameing image
            $fileDestination = $video_destinationPath . '/' . $video_fileName;
            $filePath = $video->getRealPath();
            exec("ffmpeg -i $filePath -strict -2 -vf scale=320:240 $fileDestination 2>&1", $result, $status);
    //        echo '<pre>';
    //        print_r($result);
    //        print_r($status);exit;
            $info = $this->getVideoInformation($result);
            $poster_name = explode('.', $video_fileName)[0] . '.jpg';
            $poster = 'public/images/' . $path . '/posters/' . $poster_name;
            exec("ffmpeg -ss $info[1] -i $filePath -frames:v 1 $poster 2>&1");
            $data['file'] = '/' . $path . '/' . $video_fileName;
            $data['poster'] = '/' . $path . '/posters/' . $poster_name;
        } else {
            $data['file'] = '';
            $data['poster'] = '';
        }
        return $data;
    }
    
    function getVideoInformation($video_information) {
        $regex_duration = "/Duration: ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}).([0-9]{1,2})/";
        if (preg_match($regex_duration, implode(" ", $video_information), $regs)) {
            $hours = $regs [1] ? $regs [1] : null;
            $mins = $regs [2] ? $regs [2] : null;
            $secs = $regs [3] ? $regs [3] : null;
            $ms = $regs [4] ? $regs [4] : null;
            $random_duration = sprintf("%02d:%02d:%02d", rand(0, $hours), rand(0, $mins), rand(0, $secs));
            $original_duration = $hours . ":" . $mins . ":" . $secs;
            $parsed = date_parse($original_duration);
            $seconds = ($parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']) > 20 ? true : false;
            return [$original_duration, $random_duration, $seconds];
        }
    }
    
    
}
