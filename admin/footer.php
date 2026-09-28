        </div> <!-- نهاية منطقة المحتوى الفعلي -->

    </main>
</div> <!-- نهاية الحاوية الكلية -->

<!-- شريط الحالة السفلي الموحد (مطابق تماماً للشريط في صورة العميل) -->
<footer class="bg-gray-800 text-gray-200 py-3.5 px-6 text-sm flex justify-between items-center no-print border-t border-gray-700 select-none">
    <div class="flex items-center gap-2">
        <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
        <span class="font-semibold text-emerald-400" id="global_status_connection_text">جهاز بصمة الـ USB متصل باللابتوب جاهز للقراءة...</span>
    </div>
    <p class="font-bold text-gray-400">© 2026 كلية سماء المتميزين - نظام الحسابات والبصمة الحيوية</p>
</footer>

<script>
    // تحديث الساعة والتاريخ الحي في الهيدر العلوي
    function startHeaderClock() {
        const dateEl = document.getElementById('header_date');
        const clockEl = document.getElementById('header_clock');
        if (!clockEl) return;

        function update() {
            const now = new Date();
            
            // تهيئة الوقت
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? 'م' : 'ص';
            hours = hours % 12;
            hours = hours ? hours : 12; // الساعة 0 تصبح 12
            
            clockEl.innerText = `${hours}:${minutes}:${seconds} ${ampm}`;
            
            // تهيئة التاريخ الهجري والميلادي التقريبي
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', calendar: 'islamic' };
            try {
                // محاولة توليد التاريخ الهجري
                const hijriDate = new Intl.DateTimeFormat('ar-SA-u-ca-islamic', {
                    day: 'numeric',
                    month: 'numeric',
                    year: 'numeric'
                }).format(now);
                
                dateEl.innerText = `${hijriDate} هـ | ${now.toLocaleDateString('ar-YE')} م`;
            } catch(e) {
                dateEl.innerText = `${now.toLocaleDateString('ar-YE')} م`;
            }
        }
        
        update();
        setInterval(update, 1000);
    }
    
    startHeaderClock();
</script>
</body>
</html>
