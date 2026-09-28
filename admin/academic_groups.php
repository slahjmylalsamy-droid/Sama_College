<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة الكادر
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../login.php");
    exit();
}

$user_id = intval($_SESSION['user_id']);
$user_permission = intval($_SESSION['permission'] ?? 1);

// 1. تحديد المجموعات المتاحة لهذا الكادر
$groups_list = [];

if ($user_permission >= 3) {
    // العمادة والإدارة والمسؤولين: تظهر لهم جميع مجموعات الكلية النشطة
    // نجلب المجموعات من جدول المواد subjects
    $g_query = mysqli_query($conn, "
        SELECT DISTINCT department, level 
        FROM subjects 
        WHERE department IS NOT NULL AND department != '' 
        AND level IS NOT NULL AND level != ''
        ORDER BY department ASC, level ASC
    ");
    while ($row = mysqli_fetch_assoc($g_query)) {
        $groups_list[] = trim($row['department'] . ' - ' . $row['level']);
    }
} else {
    // الدكاترة / أعضاء هيئة التدريس العاديين:
    // تظهر لهم المجموعات التي يقومون بتدريسها (التي رفعوا لها محاضرات)
    $g_query = mysqli_query($conn, "
        SELECT DISTINCT s.department, s.level 
        FROM lectures l 
        JOIN subjects s ON l.subject_id = s.id 
        WHERE l.uploaded_by = $user_id
        AND s.department IS NOT NULL AND s.department != ''
        AND s.level IS NOT NULL AND s.level != ''
        ORDER BY s.department ASC, s.level ASC
    ");
    while ($row = mysqli_fetch_assoc($g_query)) {
        $groups_list[] = trim($row['department'] . ' - ' . $row['level']);
    }
    
    // جلب المجموعات المنسوبة يدوياً لهذا المدرس
    $m_query = mysqli_query($conn, "SELECT DISTINCT group_name FROM group_manual_members WHERE user_id = $user_id");
    while ($row = mysqli_fetch_assoc($m_query)) {
        $g_name = trim($row['group_name']);
        if (!in_array($g_name, $groups_list)) {
            $groups_list[] = $g_name;
        }
    }
}

// مجموعة الكادر الأكاديمي والتعليمي متاحة لجميع الموظفين
$default_staff_group = 'كادر الكلية';
?>

<?php include_once 'header.php'; ?>

<!-- حاوية المجموعات الأكاديمية (تقسيم لعمودين: المجموعات يمين + الدردشة يسار) -->
<div class="flex flex-1 overflow-hidden" style="height: calc(100vh - 75px); direction: rtl;">
    
    <!-- القائمة الجانبية اليمنى للمجموعات -->
    <div class="w-80 bg-white border-l flex flex-col shrink-0">
        <div class="p-4 border-b bg-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-700 flex items-center gap-1.5">
                <i class="fa-solid fa-comments text-primary"></i> المجموعات النشطة
            </h3>
            <span class="bg-primary/10 text-primary text-xs px-2 py-0.5 rounded-full font-bold">
                <?php echo count($groups_list) + 1; ?>
            </span>
        </div>

        <!-- قائمة المجموعات بالتمرير -->
        <div class="flex-grow overflow-y-auto divide-y">
            
            <!-- مجموعة كادر الكلية الخاصة بالمدرسين والإدارة -->
            <button onclick="selectGroup('<?php echo $default_staff_group; ?>')" id="btn_staff_group" class="w-full p-4 text-right hover:bg-slate-50 transition flex items-center gap-3 active-group-btn">
                <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-lg border border-amber-200 shrink-0">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div class="flex-grow min-w-0">
                    <div class="font-bold text-gray-800 truncate">كادر الكلية (خاص)</div>
                    <div class="text-xs text-amber-600 font-semibold">مجموعة خاصة بالموظفين والدكاترة</div>
                </div>
            </button>

            <!-- بقية المجموعات الطلابية للأقسام -->
            <?php if (count($groups_list) > 0): ?>
                <?php foreach ($groups_list as $grp): ?>
                    <button onclick="selectGroup('<?php echo htmlspecialchars($grp); ?>')" id="btn_<?php echo md5($grp); ?>" class="w-full p-4 text-right hover:bg-slate-50 transition flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center text-lg border border-sky-200 shrink-0">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div class="flex-grow min-w-0">
                            <div class="font-bold text-gray-800 truncate"><?php echo htmlspecialchars($grp); ?></div>
                            <div class="text-xs text-gray-400">مجموعة طلابية وتفاعلية</div>
                        </div>
                    </button>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-6 text-center text-gray-400 text-xs">
                    <i class="fa-solid fa-graduation-cap text-3xl mb-2 block"></i>
                    لا توجد مجموعات طلابية مسجلة باسمك حالياً.
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- مساحة الدردشة اليسرى -->
    <div class="flex-grow bg-slate-50 flex flex-col min-w-0 relative">
        
        <!-- حالة عدم اختيار مجموعة -->
        <div id="noChatSelected" class="absolute inset-0 bg-slate-100 flex flex-col items-center justify-center p-6 text-center z-10">
            <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center text-primary text-5xl mb-4 shadow-sm border border-primary/20">
                <i class="fa-solid fa-comments"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">المجموعات الأكاديمية المشتركة</h3>
            <p class="text-gray-500 text-sm max-w-md">يرجى تحديد مجموعة من القائمة اليمنى لعرض المحادثة والبدء في التواصل الفوري مع الطلاب أو زملائك من أعضاء هيئة التدريس.</p>
        </div>

        <!-- هيدر الدردشة النشطة -->
        <div class="bg-white border-b p-4 flex justify-between items-center shrink-0">
            <div class="flex items-center gap-3">
                <div id="activeGroupIcon" class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center text-xl shadow-inner border border-sky-200">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div>
                    <h2 id="activeGroupTitle" class="text-lg font-bold text-gray-800">اسم المجموعة</h2>
                    <p id="activeGroupSub" class="text-xs text-green-600 font-semibold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        نشط الآن بالتواصل المباشر
                    </p>
                </div>
            </div>
            <div class="text-xs text-gray-400 bg-gray-100 px-3 py-1.5 rounded-lg font-bold">
                بوابة الموظف الأكاديمي والتعليمي
            </div>
        </div>

        <!-- مساحة عرض الرسائل -->
        <div id="messagesContainer" class="flex-grow p-4 overflow-y-auto space-y-4">
            <!-- سيتم تحميل الرسائل هنا ديناميكياً بواسطة JS -->
        </div>

        <!-- شريط الإدخال والتحكم بالرسائل -->
        <div class="border-t p-3 bg-white shrink-0">
            
            <!-- خيارات إرسال الرسالة (مثل الإعلان الهام) -->
            <div class="flex items-center gap-4 mb-2 px-2 text-xs">
                <label class="flex items-center gap-1.5 text-green-700 font-bold cursor-pointer bg-green-50 hover:bg-green-100/80 px-2.5 py-1 rounded transition select-none">
                    <input type="checkbox" id="isAnnouncement" class="w-3.5 h-3.5 rounded text-green-600 focus:ring-green-500 border-green-300">
                    <i class="fa-solid fa-bullhorn"></i> إرسال كـ "إعلان رسمي هام" 📢
                </label>
                <span class="text-gray-400">|</span>
                <span class="text-gray-500">يمكنك رفع المستندات وملخصات المحاضرات (PDF / صور) والتسجيلات الصوتية مباشرة للمجموعة.</span>
            </div>

            <!-- نموذج الكتابة والإرسال والتسجيل -->
            <form id="chatForm" onsubmit="sendMessage(event)" class="flex items-center gap-2" enctype="multipart/form-data">
                <!-- زر المرفقات -->
                <button type="button" onclick="triggerFileInput()" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 transition flex items-center justify-center text-lg shadow-sm" title="إرفاق ملف">
                    <i class="fa-solid fa-paperclip"></i>
                </button>
                <input type="file" id="attachmentInput" onchange="handleFileSelected()" class="hidden" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.txt">

                <!-- حقل النص -->
                <input type="text" id="messageText" placeholder="اكتب توجيهاتك أو رسالتك للمجموعة..." class="flex-grow border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary bg-slate-50 focus:bg-white transition" autocomplete="off">

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

<!-- مودال عرض الصور المصغرة بالكامل -->
<div id="imageLightbox" class="fixed inset-0 bg-black/80 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox()">
    <img id="lightboxImg" src="" class="max-w-full max-h-full rounded-lg shadow-2xl object-contain">
</div>

<style>
    /* تنسيق لتحديد الزر النشط في المجموعات */
    .active-group-btn {
        background-color: #f1f5f9;
        border-right: 4px solid #006654;
    }
</style>

<script>
    var currentGroupName = "";
    var currentUserId = <?php echo $user_id; ?>;
    var lastMessageId = 0;
    var pollingInterval = null;
    var mediaRecorder = null;
    var audioChunks = [];
    var recordingStartTime = null;
    var recordingTimerInterval = null;

    // تشغيل الصفحة بمجموعة كادر الكلية الافتراضية
    document.addEventListener("DOMContentLoaded", function() {
        selectGroup('كادر الكلية');
    });

    // تبديل المجموعة النشطة
    function selectGroup(name) {
        currentGroupName = name;
        lastMessageId = 0;
        
        // إخفاء لوحة البداية
        document.getElementById("noChatSelected").classList.add("hidden");
        
        // تعديل عنوان وتفاصيل المحادثة
        document.getElementById("activeGroupTitle").innerText = name;
        
        // تعديل أيقونة ووصف هيدر المجموعة
        var iconContainer = document.getElementById("activeGroupIcon");
        var subText = document.getElementById("activeGroupSub");
        
        if (name === 'كادر الكلية') {
            iconContainer.className = "w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-xl shadow-inner border border-amber-200 shrink-0";
            iconContainer.innerHTML = '<i class="fa-solid fa-users-gear"></i>';
            subText.innerText = "قناة تواصل مغلقة بين الدكاترة والعمادة فقط";
            document.getElementById("isAnnouncement").parentElement.classList.add("hidden"); // لا حاجة لإعلان في مجموعة الكادر المغلقة
        } else {
            iconContainer.className = "w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center text-xl shadow-inner border border-sky-200 shrink-0";
            iconContainer.innerHTML = '<i class="fa-solid fa-graduation-cap"></i>';
            subText.innerText = "التواصل الأكاديمي المباشر مع طلاب هذا التخصص";
            document.getElementById("isAnnouncement").parentElement.classList.remove("hidden");
        }

        // تفريغ المحادثة الحالية لإظهار لودر التحميل
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
        
        if (name === 'كادر الكلية') {
            document.getElementById("btn_staff_group").classList.add("active-group-btn");
        } else {
            // استخدام md5 أو البحث عبر المعرف المناسب
            var searchBtn = document.getElementById("btn_" + md5(name));
            if (searchBtn) searchBtn.classList.add("active-group-btn");
        }

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
                if (lastMessageId === 0) {
                    var container = document.getElementById("messagesContainer");
                    container.innerHTML = ""; // تفريغ اللودر
                }

                if (data.status === 'success') {
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

    // بناء رسالة وإضافتها
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
        if (currentGroupName === "") return;

        var textInput = document.getElementById("messageText");
        var isAnnounce = document.getElementById("isAnnouncement");
        var fileInput = document.getElementById("attachmentInput");
        
        var text = textInput.value.trim();
        var file = fileInput.files[0];
        var type = isAnnounce.checked ? 'announcement' : 'text';

        if (text === "" && !file) return;

        var formData = new FormData();
        formData.append("group_name", currentGroupName);
        formData.append("message_text", text);
        formData.append("message_type", type);
        if (file) {
            formData.append("attachment", file);
        }

        textInput.value = "";
        isAnnounce.checked = false;
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
            lWordArray[lNumberOfWords-2] = lMessageLength<<3;
            lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
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
        if (blob.size === 0 || currentGroupName === "") return;

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

<?php include_once 'footer.php'; ?>
