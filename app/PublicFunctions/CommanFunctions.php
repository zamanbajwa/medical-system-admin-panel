<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//Models

use App\User;
use App\Hospital;


function getHospitalLatLng($user_id) {
    $hospital = Hospital::where('user_id', $user_id)->first();
    if ($hospital->lat && $hospital->lng) {
        $data['lat'] = $hospital->lat;
        $data['lng'] = $hospital->lng;
    }else {
        $data['lat'] = '37.0902';
        $data['lng'] = '95.7129';
    }
    return $data;
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
        $info = getVideoInformation($result);
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

function getImage($image, $icon) {
    if (strpos($image, 'http') !== false) {
        return $image;
    }
    if ($image) {
        return asset(image_fix_orientation('public/images' . $image));
    }
    if ($icon) {
        return asset('public/images' . $icon);
    } else {
        return asset('public/images/profile_pics/demo.png');
    }
}

function timeago($ptime) {
    $difference = time() - strtotime($ptime);
    if ($difference) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        for ($j = 0; $difference >= $lengths[$j]; $j++)
            $difference /= $lengths[$j];

        $difference = round($difference);
        if ($difference != 1)
            $periods[$j] .= "s";

        $text = "$difference $periods[$j] ago";


        return $text;
    }else {
        return 'Just Now';
    }
}

function get_time_zone($lat, $lng) {
    // get time zone
    $timestamp = strtotime(date('Y-m-d'));
//        $lat  	   = $request['lat'];
//        $lng  	   = $request['lng'];
    $curl_url = "https://maps.googleapis.com/maps/api/timezone/json?location=$lat,$lng&timestamp=$timestamp&key=AIzaSyDdxlXEZmkr-7RJsFN7wqX5bJpBUTfzhxk";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curl_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = json_decode(curl_exec($ch));
    curl_close($ch);

    //$timezone = $response->timeZoneId;
    $sign = "+";
    $GMT_hours = "+00";



    if ($response) {
        if ($response->status == 'OK') {
            if (strpos($response->rawOffset, '-') !== FALSE)
                $sign = "-";

            $GMT_hours = $sign . gmdate("H", abs($response->rawOffset));
            return $GMT_hours;
        }
        else {
            return FALSE;
        }
    } else {
        return $GMT_hours;
    }
}



function floorToFraction($number, $denominator = 1) {
    $x = $number * $denominator;
    $x = floor($x);
    $x = $x / $denominator;
    return $x;
}




function sendSuccess($message, $data) {
//    return Response::json(array('status' => 'success', 'successMessage' => $message, 'successData' => $data), 200, [], JSON_NUMERIC_CHECK);
    return Response::json(array('status' => 'success', 'successMessage' => $message, 'successData' => $data), 200, []);
}

function sendError($error_message, $code) {
    return Response::json(array('status' => 'error', 'errorMessage' => $error_message), $code);
}

function addFile($file, $path) {
    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
                $destination_path = 'public/images/' . $path; // upload path
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


function sendNotification($heading, $message, $data = null, $userId, $url = NULL) {
    $ios_badgeType = 'SetTo';
    $ios_badgeCount = UserActivity::where('on_user', $userId)->where('user_id', '!=', $userId)->where('is_read', 0)->count();
    $send = checkNotificationSetting($heading, $userId);
    if ($send) {

        //web
        OneSignal::sendNotificationUsingTags(
                $heading, $message, [array("key" => "device_type", "relation" => "=", "value" => 'web'), array("key" => "user_id", "relation" => "=", "value" => $userId)], $url, $data, $buttons = null, $schedule = null, $ios_badgeType, $ios_badgeCount
        );
        //ios
        OneSignal::sendNotificationUsingTags(
                $heading, $message, [array("key" => "device_type", "relation" => "=", "value" => 'ios'), array("key" => "user_id", "relation" => "=", "value" => $userId)], $url = null, $data, $buttons = null, $schedule = null, $ios_badgeType, $ios_badgeCount
        );
        //android
        OneSignal::sendNotificationUsingTags(
                $heading, $message, [array("key" => "device_type", "relation" => "=", "value" => 'android'), array("key" => "user_id", "relation" => "=", "value" => $userId)], $url = null, $data, $buttons = null, $schedule = null, $ios_badgeType, $ios_badgeCount
        );
    }
}



function timeZoneConversion($date, $formate, $ip) {
    $user = LoginUsers::where(['user_id' => Auth::user()->id, 'device_type' => 'web', 'device_id' => $ip])->first();

    if ($user) {
        $time_zone = $user->time_zone * 60;
        return date($formate, strtotime($date . " $time_zone minutes"));
    } else {
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = 'Asia/Karachi';
        if (isset($ipInfo->timezone)) {
            $timezone = $ipInfo->timezone;
        }
        $time = new \DateTime('now', new DateTimeZone($timezone));

        $timezoneOffset = $time->format('P');

        $time_zone = intval($timezoneOffset) * 60;
//        echo $time_zone;exit;
        return date($formate, strtotime($date . " $time_zone minutes"));
    }
}

function getMessageUnreadCount() {
    $unread_count = ChatMessage::where('receiver_id', Auth::user()->id)->where('is_read', 0)->count();
    if ($unread_count) {
        return $unread_count;
    } else {
        return false;
    }
}



function getChats() {
    $user_id = Auth::user()->id;
    return ChatUser::with('sender', 'receiver')
                    ->withCount(['messages' => function ($q) {
                            $q->where('is_read', 0);
                        }])
                    ->where(function ($q) use($user_id) {
                        $q->where('sender_id', $user_id);
                        $q->orWhere('receiver_id', $user_id);
                    })
                    ->whereRaw("IF(`sender_id` = $user_id, `sender_deleted`, `receiver_deleted`)= 0")
                    ->orderBy('updated_at', 'desc')->get();
}


function getUserLatLng($user_id) {
    $headers = getallheaders();
    $user = User::where('id', $user_id)->first();
    $login_user = LoginUsers::where(['user_id' => $user_id, 'session_key' => $headers['session_token']])->first();
    if ($login_user->lat && $login_user->lng) {
        $data['lat'] = $login_user->lat;
        $data['lng'] = $login_user->lng;
    } elseif ($user->lat && $user->lng) {
        $data['lat'] = $user->lat;
        $data['lng'] = $user->lng;
    } else {
        $data['lat'] = '37.0902';
        $data['lng'] = '95.7129';
    }
    if (env('location_mode') == 'dev') {
        $data['lat'] = env('lat');
        $data['lng'] = env('lng');
    }
    return $data;
}




function image_fix_orientation($filename) {
    $exif = @exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
        imagejpeg($image, $filename, 90);
    }
    return $filename;
}

