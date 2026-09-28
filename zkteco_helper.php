<?php
// zkteco_helper.php - مكتبة ربط ومزامنة البيانات مع أجهزة البصمة المادية ZKTeco

class ZKTecoHelper {
    private $ip;
    private $port;
    private $socket;
    private $connected = false;

    public function __construct($ip, $port = 4370) {
        $this->ip = $ip;
        $this->port = $port;
    }

    // فتح الاتصال المباشر مع جهاز البصمة عبر بروتوكول UDP
    public function connect() {
        if (!extension_loaded('sockets')) {
            error_log("ZKTeco: PHP Sockets extension is not enabled. Please enable extension=sockets in php.ini");
            return false;
        }

        $this->socket = @socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if (!$this->socket) {
            return false;
        }

        // ضبط مهلة الاتصال (Timeout) لثانية ونصف لضمان عدم توقف الموقع
        socket_set_option($this->socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 1, "usec" => 500000));
        socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 1, "usec" => 500000));

        // إرسال طلب اتصال أولي للجهاز (صيغة بروتوكول ZK)
        $command = $this->createCommand(1000, "");
        $this->sendData($command);
        $response = $this->receiveData();

        if ($response) {
            $this->connected = true;
            return true;
        }

        return false;
    }

    // جلب كافة سجلات الحضور الحالية من الذاكرة الداخلية لجهاز البصمة
    public function getAttendanceLogs() {
        if (!$this->connected) return [];

        // إرسال طلب جلب سجلات الحضور
        $command = $this->createCommand(1503, ""); // أمر جلب سجلات الحضور في ZKTeco
        $this->sendData($command);
        $response = $this->receiveData();

        $logs = [];
        if ($response) {
            // معالجة البيانات الثنائية المستلمة وتحليلها لاستخراج رقم الموظف والوقت
            // نقوم بمحاكاة التحليل الثنائي لتسهيل التكامل
            $data_size = strlen($response);
            $record_size = 40; // حجم السجل الواحد في أجهزة ZK الحديثة
            
            for ($i = 24; $i < $data_size; $i += $record_size) {
                if ($i + $record_size > $data_size) break;
                
                $record = substr($response, $i, $record_size);
                // فك ضغط البيانات الثنائية (Unpack)
                $unpacked = unpack('vuid/vstatus/Vtimestamp', substr($record, 0, 8));
                
                $uid = $unpacked['uid'];
                $status = $unpacked['status'];
                $time_val = $unpacked['timestamp'];
                
                $date_time = date('Y-m-d H:i:s', $this->decodeZKTime($time_val));
                
                $logs[] = [
                    'uid' => $uid,
                    'status' => $status,
                    'timestamp' => $date_time
                ];
            }
        }
        return $logs;
    }

    // إرسال أمر إيقاف الاتصال بالجهاز وإغلاق السوكيت
    public function disconnect() {
        if ($this->socket) {
            $command = $this->createCommand(1001, "");
            $this->sendData($command);
            @socket_close($this->socket);
            $this->connected = false;
        }
    }

    // إنشاء الأوامر وفقاً لبروتوكول ZKTeco الثنائي
    private function createCommand($cmd, $data) {
        $command_string = pack('vvV', $cmd, 0, 0) . $data;
        return $command_string;
    }

    private function sendData($data) {
        @socket_sendto($this->socket, $data, strlen($data), 0, $this->ip, $this->port);
    }

    private function receiveData() {
        $buf = '';
        $from = '';
        $port = 0;
        @socket_recvfrom($this->socket, $buf, 10240, 0, $from, $port);
        return $buf;
    }

    // فك تشفير تنسيق وقت ZK المخزن رقمياً
    private function decodeZKTime($t) {
        $second = $t % 60;
        $t = ($t - $second) / 60;
        $minute = $t % 60;
        $t = ($t - $minute) / 60;
        $hour = $t % 24;
        $t = ($t - $hour) / 24;
        $day = $t % 31 + 1;
        $t = ($t - $day + 1) / 31;
        $month = $t % 12 + 1;
        $year = ($t - $month + 1) / 12 + 2000;
        
        return strtotime("$year-$month-$day $hour:$minute:$second");
    }
}
?>
