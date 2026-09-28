<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة الطالب
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$user_id = intval($_SESSION['user_id']);
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$is_paid = ($user['payment_status'] === 'paid');

// تحديد مجموعة الطالب الافتراضية
$department = trim($user['department'] ?? '');
$level = trim($user['level'] ?? '');
$has_default_group = (!empty($department) && !empty($level));
$default_group = $has_default_group ? ($department . ' - ' . $level) : '';

// جلب كافة المجموعات المنسوبة للطالب (الافتراضية + اليدوية)
$student_groups = [];
if ($has_default_group) {
    $student_groups[] = $default_group;
}

$m_query = mysqli_query($conn, "SELECT DISTINCT group_name FROM group_manual_members WHERE user_id = $user_id");
while ($row = mysqli_fetch_assoc($m_query)) {
    $g_name = trim($row['group_name']);
    if (!in_array($g_name, $student_groups)) {
        $student_groups[] = $g_name;
    }
}

$has_any_group = (count($student_groups) > 0);
$active_group = $has_any_group ? $student_groups[0] : '';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مجموعات التخصص والتواصل - كلية سماء المتميزين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#006654',
                        primaryDark: '#004c3f',
                        gold: '#c5a059',
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .chat-container {
            height: calc(100vh - 180px);
        }
        /* تخصيص مظهر شريط التمرير */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .active-group-btn {
            background-color: #f1f5f9;
            border-right: 4px solid #006654;
        }
    </style>
</head>
<body class="font-cairo bg-gray-100 min-h-screen flex flex-col">
    <!-- الشريط العلوي للطلاب -->
    <nav class="bg-primary text-white shadow-lg no-print">
        <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center gap-3">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-graduation-cap text-2xl text-gold"></i>
                <span class="text-xl font-bold">كلية سماء المتميزين</span>
                <span class="text-xs text-gold bg-white/10 px-3 py-1 rounded">بوابة الطالب</span>
            </div>
            
            <div class="flex items-center gap-2 md:gap-4 flex-wrap">
                <a href="dashboard.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الرئيسية</a>
                <a href="grades.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الدرجات</a>
                <a href="schedule.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الجدول</a>
                <a href="lectures.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">المحاضرات</a>
                <a href="study_plan.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الخطة الدراسية</a>
                <a href="upload_receipt.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">رفع إيصال الدفع</a>
                <a href="academic_groups.php" class="bg-white/20 px-3 py-1 rounded-lg text-sm font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-comments"></i> المجموعات
                </a>
                <a href="../logout.php" class="bg-red-50 hover:bg-red-600 px-3 py-1 rounded-lg transition text-sm text-red-700 hover:text-white font-bold">
                    <i class="fa-solid fa-sign-out-alt"></i> خروج
                </a>
            </div>
        </div>
    </nav>

    <!-- المحتوى الرئيسي للدردشة -->
    <div class="container mx-auto px-4 py-6 flex-grow flex flex-col">
        
        <?php if (!$has_any_group): ?>
            <!-- تنبيه عدم اكتمال التخصص والمستوى وعدم وجود مجموعات مضافة يدوياً -->
            <div class="bg-yellow-50 border-r-4 border-yellow-500 p-6 rounded-xl shadow-md text-center max-w-2xl mx-auto my-12">
                <i class="fa-solid fa-triangle-exclamation text-4xl text-yellow-500 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">عذراً، لم يتم إعداد مجموعتك الدراسية بعد</h3>
                <p class="text-gray-600 text-sm">حسابك لا يمتلك قسماً أو مستوى دراسياً محدداً في النظام، ولم يتم إضافتك يدوياً لأي مجموعة من قبل الإدارة. يرجى التواصل مع إدارة القبول والتسجيل أو شؤون الطلاب لإكمال بياناتك وتفعيل مجموعتك الدراسية.</p>
                <a href="dashboard.php" class="mt-4 inline-block bg-primary hover:bg-primaryDark text-white px-6 py-2 rounded-lg text-sm font-bold transition">العودة للرئيسية</a>
            </div>
        <?php else: ?>
            
            <div class="bg-white rounded-2xl shadow-lg border overflow-hidden flex flex-row flex-grow chat-container" style="direction: rtl;">
                
                <!-- عمود جانبي للمجموعات إذا كان لدى الطالب أكثر من مجموعة واحدة -->
                <?php if (count($student_groups) > 1): ?>
                <div class="w-72 bg-white border-l flex flex-col shrink-0">
                    <div class="p-4 border-b bg-gray-50 flex items-center justify-between">
                        <h3 class="font-bold text-gray-700 flex items-center gap-1.5">
                            <i class="fa-solid fa-comments text-primary"></i> مجموعاتي النشطة
                        </h3>
                    </div>
                    <div class="flex-grow overflow-y-auto divide-y">
                        <?php foreach ($student_groups as $grp): ?>
                            <button onclick="selectGroup('<?php echo htmlspecialchars($grp); ?>')" id="btn_<?php echo md5($grp); ?>" class="w-full p-4 text-right hover:bg-slate-50 transition flex items-center gap-3 <?php echo $grp === $active_group ? 'active-group-btn' : ''; ?>">
                                <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center text-lg border border-sky-200 shrink-0">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="font-bold text-gray-800 truncate"><?php echo htmlspecialchars($grp); ?></div>
                                    <div class="text-xs text-gray-400">مجموعة دراسية</div>
                                </div>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- مساحة الدردشة اليسرى -->
                <div class="flex-grow bg-slate-50 flex flex-col min-w-0">
                    
                    <!-- هيدر المجموعة -->
                    <div class="bg-slate-50 border-b p-4 flex justify-between items-center shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center text-xl shadow-inner border border-sky-200">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                            <div>
                                <h2 id="activeGroupTitle" class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($active_group); ?></h2>
                                <p class="text-xs text-green-600 font-semibold flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                    متصل الآن بالدعم التعليمي المباشر
                                </p>
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 bg-gray-200/50 px-3 py-1.5 rounded-lg">
                            <i class="fa-solid fa-circle-info"></i> هذه المجموعة تضم جميع دكاترة تخصصك والعمادة
                        </div>
                    </div>

                    <!-- مساحة عرض الرسائل -->
                    <div id="messagesContainer" class="flex-grow p-4 overflow-y-auto bg-slate-50/50 space-y-4">
                        <!-- سيتم تحميل الرسائل هنا ديناميكياً بواسطة JS -->
                        <div class="flex justify-center py-10" id="chatLoading">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-3xl text-primary"></i>
                                <span class="text-xs text-gray-500">جاري تحميل المحادثات...</span>
                            </div>
                        </div>
                    </div>

                    <!-- شريط الإدخال والتحكم بالرسائل -->
                    <div class="border-t p-3 bg-white shrink-0">
                        
                        <!-- أزرار خيارات الرسالة (مثل الاعتراض) -->
                        <div class="flex items-center gap-4 mb-2 px-2 text-xs">
                            <label class="flex items-center gap-1.5 text-red-600 font-bold cursor-pointer bg-red-50 hover:bg-red-100/80 px-2.5 py-1 rounded transition select-none">
                                <input type="checkbox" id="isObjection" class="w-3.5 h-3.5 rounded text-red-600 focus:ring-red-500 border-red-300">
                                <i class="fa-solid fa-triangle-exclamation"></i> إرسال كـ "اعتراض رسمي" ⚠️
                            </label>
                            <span class="text-gray-400">|</span>
                            <span class="text-gray-500">يمكنك رفع صورة، ملف PDF، أو تسجيل صوتي مباشر للعمادة والدكاترة.</span>
                        </div>

                        <!-- نموذج الكتابة والإرسال والتسجيل -->
                        <form id="chatForm" onsubmit="sendMessage(event)" class="flex items-center gap-2" enctype="multipart/form-data">
                            <!-- زر المرفقات -->
                            <button type="button" onclick="triggerFileInput()" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 transition flex items-center justify-center text-lg shadow-sm" title="إرفاق ملف">
                                <i class="fa-solid fa-paperclip"></i>
                            </button>
                            <input type="file" id="attachmentInput" onchange="handleFileSelected()" class="hidden" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.txt">

                            <!-- حقل النص -->
                            <input type="text" id="messageText" placeholder="اكتب استفسارك أو رسالتك هنا..." class="flex-grow border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary bg-slate-50 focus:bg-white transition" autocomplete="off">

                            <!-- قسم مسجل الصوت (يظهر عند التسجيل) -->
                            <div id="voiceRecorderPanel" class="hidden flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-1.5 rounded-xl flex-grow">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-600 animate-pulse"></span>
                                <span class="text-xs font-bold">جاري التسجيل:</span>
                                <span id="recordingTimer" class="font-mono text-sm font-bold">00:00</span>
                                <button type="button" onclick="cancelVoiceRecording()" class="mr-auto text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 px-2.5 py-1 rounded-lg transition font-bold">إلغاء</button>
                                <button type="button" onclick="stopAndSendVoice()" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs font-bold transition">إيقاف وإرسال</button>
                            </div>

                            <!-- أزرار الإرسال والتسجيل -->
                            <div class="flex items-center gap-1.5">
                                <!-- زر التسجيل الصوتي -->
                                <button type="button" id="recordVoiceBtn" onclick="startVoiceRecording()" class="w-10 h-10 rounded-full bg-amber-500 hover:bg-amber-600 text-white transition flex items-center justify-center text-lg shadow" title="تسجيل صوتي">
                                    <i class="fa-solid fa-microphone"></i>
                                </button>
                                
                                <!-- زر الإرسال -->
                                <button type="submit" class="w-10 h-10 rounded-full bg-primary hover:bg-primaryDark text-white transition flex items-center justify-center text-lg shadow" title="إرسال">
                                    <i class="fa-solid fa-paper-plane rotate-180"></i>
                                </button>
                            </div>
                        </form>

                        <!-- معاينة الملف المحدد -->
                        <div id="filePreview" class="hidden mt-2 p-2 bg-slate-100 rounded-lg flex items-center justify-between text-xs">
                            <span class="font-medium text-gray-700" id="filePreviewName">اسم الملف.pdf</span>
                            <button type="button" onclick="clearFileSelection()" class="text-red-500 hover:text-red-700 font-bold"><i class="fa-solid fa-times"></i> إزالة</button>
                        </div>

                    </div>

                </div>

            </div>

        <?php endif; ?>

    </div>

    <!-- مودال عرض الصور المصغرة بالكامل -->
    <div id="imageLightbox" class="fixed inset-0 bg-black/80 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox()">
        <img id="lightboxImg" src="" class="max-w-full max-h-full rounded-lg shadow-2xl object-contain">
    </div>

    <script>
        var currentGroupName = "<?php echo $active_group; ?>";
        var currentUserId = <?php echo $user_id; ?>;
        var lastMessageId = 0;
        var pollingInterval = null;
        var mediaRecorder = null;
        var audioChunks = [];
        var recordingStartTime = null;
        var recordingTimerInterval = null;

        // تحميل الرسائل عند جاهزية الصفحة
        document.addEventListener("DOMContentLoaded", function() {
            if (currentGroupName !== "") {
                loadMessages();
                pollingInterval = setInterval(loadMessages, 3000);
            }
        });

        // تبديل المجموعة النشطة (في حال تفعيل القائمة الجانبية)
        function selectGroup(name) {
            currentGroupName = name;
            lastMessageId = 0;
            
            // تغيير ترويسة المجموعة
            document.getElementById("activeGroupTitle").innerText = name;
            
            // تفريغ المحادثة الحالية لإظهار اللودر
            var container = document.getElementById("messagesContainer");
            container.innerHTML = `
                <div class="flex justify-center py-10">
                    <div class="flex flex-col items-center gap-2">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-primary"></i>
                        <span class="text-xs text-gray-500">جاري تحميل رسائل ${name}...</span>
                    </div>
                </div>
            `;

            // إبراز الزر النشط في القائمة اليمنى
            document.querySelectorAll(".divide-y button").forEach(btn => {
                btn.classList.remove("active-group-btn");
            });
            
            var searchBtn = document.getElementById("btn_" + md5(name));
            if (searchBtn) searchBtn.classList.add("active-group-btn");

            // جلب الرسائل وإعادة تفعيل التحديث التلقائي
            loadMessages();
            
            if (pollingInterval) clearInterval(pollingInterval);
            pollingInterval = setInterval(loadMessages, 3000);
        }

        // جلب الرسائل
        function loadMessages() {
            if (currentGroupName === "") return;

            fetch('../api/get_group_messages.php?group=' + encodeURIComponent(currentGroupName) + '&last_id=' + lastMessageId)
                .then(response => response.json())
                .then(data => {
                    var loader = document.getElementById("chatLoading");
                    if (loader) loader.remove();

                    if (data.status === 'success') {
                        if (lastMessageId === 0) {
                            var container = document.getElementById("messagesContainer");
                            container.innerHTML = ""; // تفريغ اللودر
                        }

                        if (data.messages.length > 0) {
                            var container = document.getElementById("messagesContainer");
                            var shouldScroll = (container.scrollTop + container.clientHeight >= container.scrollHeight - 100) || (lastMessageId === 0);
                            
                            data.messages.forEach(msg => {
                                appendMessageHTML(msg);
                                lastMessageId = Math.max(lastMessageId, msg.id);
                            });

                            if (shouldScroll) {
                                container.scrollTop = container.scrollHeight;
                            }
                        }
                    }
                })
                .catch(err => console.error("Error fetching messages:", err));
        }

        // إنشاء كود HTML للرسالة وإضافتها للمحادثة
        function appendMessageHTML(msg) {
            var container = document.getElementById("messagesContainer");
            if (document.getElementById("msg_" + msg.id)) return;

            var bubbleWrapper = document.createElement("div");
            bubbleWrapper.id = "msg_" + msg.id;
            bubbleWrapper.className = "flex flex-col mb-4 " + (msg.is_me ? "items-start" : "items-end");

            var bgClass = "bg-white text-gray-800 border-gray-200";
            var headerLabel = "طالب";
            var headerColor = "text-gray-500";

            if (msg.sender_permission >= 3) {
                bgClass = "bg-teal-50 border-r-4 border-gold shadow-sm text-gray-800";
                headerLabel = "العمادة والادارة 🏢";
                headerColor = "text-amber-600 font-extrabold";
            } else if (msg.sender_permission === 2) {
                bgClass = "bg-emerald-50 border-r-4 border-primary text-gray-800";
                headerLabel = "دكتور المادة / المدرس 👨‍🏫";
                headerColor = "text-primary font-bold";
            }

            if (msg.message_type === 'announcement') {
                bgClass = "bg-green-100 border-2 border-green-500 text-green-950 font-semibold p-4 shadow";
                headerLabel = "📢 إعلان رسمي هام";
                headerColor = "text-green-700 font-extrabold";
            }

            if (msg.message_type === 'objection') {
                bgClass = "bg-red-50 border-2 border-red-400 text-red-950 p-4 shadow-md";
                headerLabel = "⚠️ اعتراض رسمي من الطالب";
                headerColor = "text-red-700 font-extrabold";
            }

            var html = '<div class="max-w-[75%] rounded-2xl border px-4 py-2.5 shadow-sm ' + bgClass + '">';
            html += '<div class="flex items-center justify-between gap-6 mb-1 text-[11px] ' + headerColor + '">';
            html += '<span>' + msg.sender_name + ' (' + headerLabel + ')</span>';
            html += '<span class="text-gray-400 font-mono">' + msg.time + '</span>';
            html += '</div>';

            if (msg.message_text) {
                html += '<p class="text-sm leading-relaxed whitespace-pre-wrap select-text">' + msg.message_text + '</p>';
            }

            if (msg.attachment_path) {
                var ext = msg.attachment_path.split('.').pop().toLowerCase();
                var path = '../' + msg.attachment_path;
                
                html += '<div class="mt-2 pt-2 border-t border-dashed border-gray-300">';
                
                if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                    html += '<img src="' + path + '" onclick="openLightbox(\'' + path + '\')" class="max-h-48 rounded-lg cursor-pointer hover:opacity-90 border transition shadow-sm" alt="مرفق صورة">';
                } else if (['wav', 'mp3', 'webm', 'ogg', 'm4a'].includes(ext) || msg.message_type === 'voice') {
                    html += '<div class="flex items-center gap-2 bg-black/5 rounded-xl p-2 mt-1">';
                    html += '<i class="fa-solid fa-microphone text-primary text-lg"></i>';
                    html += '<audio src="' + path + '" controls class="h-8 max-w-full"></audio>';
                    html += '</div>';
                } else {
                    html += '<a href="' + path + '" download class="flex items-center gap-2 text-primary hover:text-primaryDark hover:underline font-bold text-xs bg-slate-100 p-2 rounded-lg border">';
                    html += '<i class="fa-solid fa-file-pdf text-red-500 text-lg"></i>';
                    html += '<span>تحميل المرفق (' + ext.toUpperCase() + ')</span>';
                    html += '</a>';
                }
                html += '</div>';
            }

            html += '</div>';
            bubbleWrapper.innerHTML = html;
            container.appendChild(bubbleWrapper);
        }

        // إرسال رسالة
        function sendMessage(e) {
            if (e) e.preventDefault();

            var textInput = document.getElementById("messageText");
            var isObjection = document.getElementById("isObjection");
            var fileInput = document.getElementById("attachmentInput");
            
            var text = textInput.value.trim();
            var file = fileInput.files[0];
            var type = isObjection.checked ? 'objection' : 'text';

            if (text === "" && !file) return;

            var formData = new FormData();
            formData.append("group_name", currentGroupName);
            formData.append("message_text", text);
            formData.append("message_type", type);
            if (file) {
                formData.append("attachment", file);
            }

            textInput.value = "";
            isObjection.checked = false;
            clearFileSelection();

            fetch('../api/send_group_message.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    loadMessages();
                } else {
                    alert("⚠️ فشل الإرسال: " + data.message);
                }
            })
            .catch(err => {
                console.error("Error sending message:", err);
                alert("⚠️ حدث خطأ غير متوقع أثناء الاتصال بالخادم.");
            });
        }

        // تفعيل اختيار الملفات
        function triggerFileInput() {
            document.getElementById("attachmentInput").click();
        }

        // معالجة اختيار ملف لعرض المعاينة
        function handleFileSelected() {
            var fileInput = document.getElementById("attachmentInput");
            var preview = document.getElementById("filePreview");
            var previewName = document.getElementById("filePreviewName");

            if (fileInput.files.length > 0) {
                previewName.innerText = "📁 ملف محدد: " + fileInput.files[0].name;
                preview.classList.remove("hidden");
            }
        }

        // إزالة الملف المحدد
        function clearFileSelection() {
            document.getElementById("attachmentInput").value = "";
            document.getElementById("filePreview").classList.add("hidden");
        }

        // فتح نافذة تكبير الصورة
        function openLightbox(src) {
            document.getElementById("lightboxImg").src = src;
            document.getElementById("imageLightbox").classList.remove("hidden");
        }

        function closeLightbox() {
            document.getElementById("imageLightbox").classList.add("hidden");
        }

        // دالة لتوليد كود md5 بسيط للاستخدام في جافاسكريبت
        function md5(string) {
            function RotateLeft(lValue, iShiftBits) {
                return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
            }
            function AddUnsigned(lX,lY) {
                var lX4,lY4,lX8,lY8,lResult;
                lX8 = (lX & 0x80000000);
                lY8 = (lY & 0x80000000);
                lX4 = (lX & 0x40000000);
                lY4 = (lY & 0x40000000);
                lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
                if (lX4 & lY4) {
                    return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
                }
                if (lX4 | lY4) {
                    if (lResult & 0x40000000) {
                        return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
                    } else {
                        return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
                    }
                } else {
                    return (lResult ^ lX8 ^ lY8);
                }
            }
            function F(x,y,z) { return (x & y) | ((~x) & z); }
            function G(x,y,z) { return (x & z) | (y & (~z)); }
            function H(x,y,z) { return (x ^ y ^ z); }
            function I(x,y,z) { return (y ^ (x | (~z))); }
            function II(a,b,c,d,x,s,ac) {
                a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b,c,d), x), ac));
                return AddUnsigned(RotateLeft(a, s), b);
            }
            function GG(a,b,c,d,x,s,ac) {
                a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b,c,d), x), ac));
                return AddUnsigned(RotateLeft(a, s), b);
            }
            function HH(a,b,c,d,x,s,ac) {
                a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b,c,d), x), ac));
                return AddUnsigned(RotateLeft(a, s), b);
            }
            function II2(a,b,c,d,x,s,ac) {
                a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b,c,d), x), ac));
                return AddUnsigned(RotateLeft(a, s), b);
            }
            function ConvertToWordArray(string) {
                var lWordCount;
                var lMessageLength = string.length;
                var lNumberOfWords_temp1=lMessageLength + 8;
                var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
                var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
                var lWordArray=Array(lNumberOfWords-1);
                var lBytePosition = 0;
                var lByteCount = 0;
                while ( lByteCount < lMessageLength ) {
                    lWordCount = (lByteCount-(lByteCount % 4))/4;
                    lBytePosition = (lByteCount % 4)*8;
                    lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
                    lByteCount++;
                }
                lWordCount = (lByteCount-(lByteCount % 4))/4;
                lBytePosition = (lByteCount % 4)*8;
                lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
                lWordArray[lWordArray.length-2] = lMessageLength<<3;
                lWordArray[lWordArray.length-1] = lMessageLength>>>29;
                return lWordArray;
            }
            function WordToHex(lValue) {
                var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
                for (lCount = 0;lCount<=3;lCount++) {
                    lByte = (lValue>>>(lCount*8)) & 255;
                    WordToHexValue_temp = "0" + lByte.toString(16);
                    WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
                }
                return WordToHexValue;
            }
            function Utf8Encode(string) {
                string = string.replace(/\r\n/g,"\n");
                var utftext = "";
                for (var n = 0; n < string.length; n++) {
                    var c = string.charCodeAt(n);
                    if (c < 128) {
                        utftext += String.fromCharCode(c);
                    } else if((c > 127) && (c < 2048)) {
                        utftext += String.fromCharCode((c >> 6) | 192);
                        utftext += String.fromCharCode((c & 63) | 128);
                    } else {
                        utftext += String.fromCharCode((c >> 12) | 224);
                        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                        utftext += String.fromCharCode((c & 63) | 128);
                    }
                }
                return utftext;
            }
            var x=Array();
            var k,AA,BB,CC,DD,a,b,c,d;
            var S11=7, S12=12, S13=17, S14=22;
            var S21=5, S22=9 , S23=14, S24=20;
            var S31=4, S32=11, S33=16, S34=23;
            var S41=6, S42=10, S43=15, S44=21;
            string = Utf8Encode(string);
            x = ConvertToWordArray(string);
            a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;
            for (k=0;k<x.length;k+=16) {
                AA=a; BB=b; CC=c; DD=d;
                a=II(a,b,c,d,x[k+0], S11,0xD76AA478); d=II(d,a,b,c,x[k+1], S12,0xE8C7B756); c=II(c,d,a,b,x[k+2], S13,0x242070DB); b=II(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
                a=II(a,b,c,d,x[k+4], S11,0xF57C0FAF); d=II(d,a,b,c,x[k+5], S12,0x4787C62A); c=II(c,d,a,b,x[k+6], S13,0xA8304613); b=II(b,c,d,a,x[k+7], S14,0xFD469501);
                a=II(a,b,c,d,x[k+8], S11,0x698098D8); d=II(d,a,b,c,x[k+9], S12,0x8B44F7AF); c=II(c,d,a,b,x[k+10],S13,0xFFFF5BB1); b=II(b,c,d,a,x[k+11],S14,0x895CD7BE);
                a=II(a,b,c,d,x[k+12],S11,0x6B901122); d=II(d,a,b,c,x[k+13],S12,0xFD987193); c=II(c,d,a,b,x[k+14],S13,0xA679438E); b=II(b,c,d,a,x[k+15],S14,0x49B40821);
                a=GG(a,b,c,d,x[k+1], S21,0xF61E2562); d=GG(d,a,b,c,x[k+6], S22,0xC040B340); c=GG(c,d,a,b,x[k+11],S23,0x265E5A51); b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
                a=GG(a,b,c,d,x[k+5], S21,0xD62F105D); d=GG(d,a,b,c,x[k+10],S22,0x2441453);  c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681); b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
                a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6); d=GG(d,a,b,c,x[k+14],S22,0xC33707D6); c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87); b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
                a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905); d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8); c=GG(c,d,a,b,x[k+7], S23,0x676F02D9); b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
                a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942); d=HH(d,a,b,c,x[k+8], S32,0x8771F681); c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122); b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
                a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44); d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9); c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60); b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
                a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6); d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA); c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085); b=HH(b,c,d,a,x[k+6], S34,0x4881D05;  
                a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039); d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5); c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8); b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
                a=II2(a,b,c,d,x[k+0], S41,0xF4292244); d=II2(d,a,b,c,x[k+7], S42,0x432AFF97); c=II2(c,d,a,b,x[k+14],S43,0xAB9423A7); b=II2(b,c,d,a,x[k+5], S44,0xFC93A039);
                a=II2(a,b,c,d,x[k+12],S41,0x655B59C3); d=II2(d,a,b,c,x[k+3], S42,0x8F0CCC92); c=II2(c,d,a,b,x[k+10],S43,0xFFEFF47D); b=II2(b,c,d,a,x[k+1], S44,0x85845DD1);
                a=II2(a,b,c,d,x[k+8], S41,0x6FA87E4F); d=II2(d,a,b,c,x[k+15],S42,0xFE2CE6E0); c=II2(c,d,a,b,x[k+6], S43,0xA3014314); b=II2(b,c,d,a,x[k+13],S44,0x4E0811A1);
                a=II2(a,b,c,d,x[k+4], S41,0xF7537E82); d=II2(d,a,b,c,x[k+11],S42,0xBD3AF235); c=II2(c,d,a,b,x[k+2], S43,0x2AD7D2BB); b=II2(b,c,d,a,x[k+9], S44,0xEB86D391);
                a=AddUnsigned(a,AA); b=AddUnsigned(b,BB); c=AddUnsigned(c,CC); d=AddUnsigned(d,DD);
            }
            var temp=WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
            return temp.toLowerCase();
        }

        // ==========================================
        // أنظمة التسجيل الصوتي المباشر (Voice Recording)
        // ==========================================
        function startVoiceRecording() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert("تسجيل الصوت غير مدعوم في متصفحك الحالي.");
                return;
            }

            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    audioChunks = [];
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.addEventListener("dataavailable", event => {
                        audioChunks.push(event.data);
                    });

                    mediaRecorder.addEventListener("stop", () => {
                        var audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        uploadVoiceBlob(audioBlob);
                    });

                    document.getElementById("messageText").classList.add("hidden");
                    document.getElementById("recordVoiceBtn").classList.add("hidden");
                    document.getElementById("voiceRecorderPanel").classList.remove("hidden");

                    mediaRecorder.start();
                    recordingStartTime = Date.now();
                    updateRecordingTimer();
                    recordingTimerInterval = setInterval(updateRecordingTimer, 1000);
                })
                .catch(err => {
                    console.error("Microphone access denied:", err);
                    alert("يرجى إعطاء صلاحية الوصول للميكروفون لتسجيل الصوت.");
                });
        }

        function updateRecordingTimer() {
            var elapsed = Math.floor((Date.now() - recordingStartTime) / 1000);
            var mins = String(Math.floor(elapsed / 60)).padStart(2, '0');
            var secs = String(elapsed % 60).padStart(2, '0');
            document.getElementById("recordingTimer").innerText = mins + ":" + secs;
        }

        function stopAndSendVoice() {
            if (mediaRecorder && mediaRecorder.state !== "inactive") {
                mediaRecorder.stop();
                mediaRecorder.stream.getTracks().forEach(track => track.stop());
                
                clearInterval(recordingTimerInterval);
                resetVoiceRecorderUI();
            }
        }

        function cancelVoiceRecording() {
            if (mediaRecorder && mediaRecorder.state !== "inactive") {
                mediaRecorder.addEventListener("stop", function() {
                    audioChunks = [];
                }, { once: true });

                mediaRecorder.stop();
                mediaRecorder.stream.getTracks().forEach(track => track.stop());
                
                clearInterval(recordingTimerInterval);
                resetVoiceRecorderUI();
            }
        }

        function resetVoiceRecorderUI() {
            document.getElementById("messageText").classList.remove("hidden");
            document.getElementById("recordVoiceBtn").classList.remove("hidden");
            document.getElementById("voiceRecorderPanel").classList.add("hidden");
        }

        function uploadVoiceBlob(blob) {
            if (blob.size === 0) return;

            var formData = new FormData();
            formData.append("group_name", currentGroupName);
            formData.append("message_text", "");
            formData.append("message_type", "voice");
            
            var file = new File([blob], "voice_msg.wav", { type: "audio/wav" });
            formData.append("attachment", file);

            fetch('../api/send_group_message.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    loadMessages();
                } else {
                    alert("⚠️ فشل إرسال التسجيل الصوتي: " + data.message);
                }
            })
            .catch(err => {
                console.error("Error sending voice:", err);
                alert("⚠️ حدث خطأ أثناء إرسال التسجيل الصوتي.");
            });
        }
    </script>
</body>
</html>
