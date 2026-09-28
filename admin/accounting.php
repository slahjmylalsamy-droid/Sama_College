<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// معالجة تسجيل سند صرف مصروف يدوياً وتوثيقه محاسبياً بالقيد المزدوج
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_expense'])) {
    $amount = floatval($_POST['amount']);
    $expense_date = mysqli_real_escape_string($conn, $_POST['expense_date']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $admin_id = intval($_SESSION['user_id']);

    if ($amount <= 0) {
        $error = "❌ عذراً، يجب أن يكون مبلغ المصروف أكبر من صفر!";
    } else {
        // التحقق من توفر رصيد كافٍ في الخزينة (حساب 101) قبل الصرف
        $cash_check = mysqli_query($conn, "SELECT balance FROM accounts WHERE account_code = '101'");
        $cash_balance = 0;
        if ($cash_check && $cash_row = mysqli_fetch_assoc($cash_check)) {
            $cash_balance = floatval($cash_row['balance']);
        }
        
        if ($cash_balance < $amount) {
            $error = "❌ عذراً، الرصيد المتوفر في الخزينة النقدية غير كافٍ لإتمام عملية الصرف! الرصيد الحالي: " . number_format($cash_balance, 2) . " ر.ي";
        } else {
            // 1. تسجيل المصروف في جدول المصروفات
            $ins_query = "INSERT INTO expenses (amount, expense_date, description, added_by) 
                          VALUES ($amount, '$expense_date', '$description', $admin_id)";
            if (mysqli_query($conn, $ins_query)) {
                $expense_id = mysqli_insert_id($conn);
                
                // 2. تسجيل القيد المحاسبي المزدوج تلقائياً
                // مدين: حساب مصروفات المشتريات والمستلزمات (503)
                // دائن: حساب الخزينة النقدية (101)
                $expense_acc = getAccountIdByCode('503');
                $cash_acc = getAccountIdByCode('101');
                
                if ($expense_acc && $cash_acc) {
                    $journal_details = [
                        ['account_id' => $expense_acc, 'debit' => $amount, 'credit' => 0.00, 'notes' => "صرف مصروف: $description"],
                        ['account_id' => $cash_acc, 'debit' => 0.00, 'credit' => $amount, 'notes' => "صرف من الخزينة لـ: $description"]
                    ];
                    
                    $entry_id = addJournalEntry($expense_date, "سند صرف مصروف - $description", 'expense', $expense_id, $journal_details, $admin_id);
                    if ($entry_id) {
                        $msg = "✅ تم تسجيل المصروف وتدوين القيد المحاسبي المزدوج وتحديث الأرصدة بنجاح!";
                    } else {
                        $error = "⚠️ تم حفظ المصروف ولكن حدث خطأ أثناء تدوين القيد المحاسبي.";
                    }
                }
            } else {
                $error = "❌ حدث خطأ أثناء محاولة تسجيل المصروف: " . mysqli_error($conn);
            }
        }
    }
}

// 1. جلب أرصدة الحسابات الإجمالية للتقارير
$revenue_query = mysqli_query($conn, "SELECT SUM(balance) as total FROM accounts WHERE account_type = 'income'");
$total_revenue = floatval(mysqli_fetch_assoc($revenue_query)['total'] ?? 0);

$expense_query = mysqli_query($conn, "SELECT SUM(balance) as total FROM accounts WHERE account_type = 'expense'");
$total_expenses = floatval(mysqli_fetch_assoc($expense_query)['total'] ?? 0);

$net_profit = $total_revenue - $total_expenses;

// 2. جلب شجرة ودليل الحسابات
$accounts_list = mysqli_query($conn, "SELECT * FROM accounts ORDER BY account_code ASC");

// 3. جلب دفتر القيود اليومية مع التفاصيل المزدوجة
$entries_query = mysqli_query($conn, "
    SELECT je.*, jd.debit, jd.credit, jd.notes, a.account_name, a.account_code, u.full_name as admin_name 
    FROM journal_entries je 
    JOIN journal_details jd ON je.id = jd.entry_id 
    JOIN accounts a ON jd.account_id = a.id 
    JOIN users u ON je.added_by = u.id 
    ORDER BY je.entry_date DESC, je.id DESC, jd.id ASC 
    LIMIT 100
");

// تجميع تفاصيل القيود لعرضها بشكل منظم
$journal_entries = [];
if ($entries_query) {
    while ($row = mysqli_fetch_assoc($entries_query)) {
        $entry_id = $row['id'];
        if (!isset($journal_entries[$entry_id])) {
            $journal_entries[$entry_id] = [
                'id' => $entry_id,
                'entry_date' => $row['entry_date'],
                'description' => $row['description'],
                'source_type' => $row['source_type'],
                'admin_name' => $row['admin_name'],
                'details' => []
            ];
        }
        $journal_entries[$entry_id]['details'][] = [
            'account_code' => $row['account_code'],
            'account_name' => $row['account_name'],
            'debit' => $row['debit'],
            'credit' => $row['credit'],
            'notes' => $row['notes']
        ];
    }
}
?>

<?php include_once 'header.php'; ?>
        <!-- الرسائل -->
        <?php if ($msg): ?>
            <div class="bg-green-100 border-r-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 shadow">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 shadow">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- لوحة الإحصائيات والتقارير المحاسبية -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-emerald-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">إجمالي إيرادات الكلية</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo number_format($total_revenue, 2); ?> ر.ي</p>
                    </div>
                    <div class="text-3xl text-emerald-500 bg-emerald-50 w-12 h-12 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-rose-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">إجمالي المصروفات والخصومات</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo number_format($total_expenses, 2); ?> ر.ي</p>
                    </div>
                    <div class="text-3xl text-rose-500 bg-rose-50 w-12 h-12 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-teal-600">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">صافي الفائض / العجز المالي</p>
                        <p class="text-2xl font-bold <?php echo $net_profit >= 0 ? 'text-emerald-700' : 'text-rose-700'; ?> mt-1">
                            <?php echo number_format($net_profit, 2); ?> ر.ي
                        </p>
                    </div>
                    <div class="text-3xl <?php echo $net_profit >= 0 ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50'; ?> w-12 h-12 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            
            <!-- دليل الحسابات (شجرة الحسابات) -->
            <div class="bg-white rounded-xl shadow-md p-6 lg:col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-sitemap text-primary"></i> دليل الحسابات الرئيسي (Chart of Accounts)
                </h2>
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-3 text-sm font-bold border-b">كود الحساب</th>
                            <th class="px-4 py-3 text-sm font-bold border-b">اسم الحساب</th>
                            <th class="px-4 py-3 text-sm font-bold border-b">نوع الحساب</th>
                            <th class="px-4 py-3 text-sm font-bold border-b text-left">الرصيد الحالي</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php while ($acc = mysqli_fetch_assoc($accounts_list)): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-mono font-bold text-gray-700"><?php echo htmlspecialchars($acc['account_code']); ?></td>
                            <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo htmlspecialchars($acc['account_name']); ?></td>
                            <td class="px-4 py-3 text-sm">
                                <?php 
                                $types = [
                                    'asset' => '<span class="text-blue-700 bg-blue-50 px-2 py-0.5 rounded text-xs font-bold">أصول</span>',
                                    'liability' => '<span class="text-orange-700 bg-orange-50 px-2 py-0.5 rounded text-xs font-bold">خصوم</span>',
                                    'equity' => '<span class="text-purple-700 bg-purple-50 px-2 py-0.5 rounded text-xs font-bold">حقوق ملكية</span>',
                                    'income' => '<span class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded text-xs font-bold">إيرادات</span>',
                                    'expense' => '<span class="text-rose-700 bg-rose-50 px-2 py-0.5 rounded text-xs font-bold">مصروفات</span>',
                                ];
                                echo $types[$acc['account_type']] ?? '';
                                ?>
                            </td>
                            <td class="px-4 py-3 text-sm font-bold text-left text-gray-900"><?php echo number_format($acc['balance'], 2); ?> ر.ي</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- تسجيل سند صرف مصروف يدوياً -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice-dollar text-gold"></i> تسجيل سند صرف مصروف
                </h2>
                <form method="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">تاريخ سند الصرف</label>
                            <input type="date" name="expense_date" value="<?php echo date('Y-m-d'); ?>" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">المبلغ المطلوب صرفه (ريال)</label>
                            <input type="number" step="0.01" name="amount" placeholder="0.00" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">بيان المصروف بالتفصيل</label>
                            <textarea name="description" placeholder="مثال: شراء أحبار طابعات وقرطاسية للإدارة" rows="3" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">الحساب الدائن (طريقة الدفع)</label>
                            <select disabled class="w-full bg-gray-100 border rounded-lg px-4 py-2 text-sm text-gray-600 focus:outline-none cursor-not-allowed">
                                <option>الخزينة النقدية (101) - صرف مباشر</option>
                            </select>
                        </div>
                        <button type="submit" name="add_expense" class="w-full bg-primary hover:bg-primaryDark text-white font-bold py-2.5 rounded-lg text-sm transition shadow mt-2">
                            <i class="fa-solid fa-paper-plane ml-1"></i> تدوين سند الصرف وترحيل القيد
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- دفتر اليومية العامة (أحدث القيود المزدوجة المتوازنة) -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-book-open text-primary"></i> دفتر اليومية العامة والقيود المحاسبية المزدوجة (أحدث القيود)
            </h2>
            <div class="space-y-6">
                <?php if (empty($journal_entries)): ?>
                    <p class="text-center text-gray-400 italic py-6">لا توجد قيود يومية مسجلة بعد في الدفاتر.</p>
                <?php else: ?>
                    <?php foreach ($journal_entries as $entry): ?>
                        <div class="border rounded-lg overflow-hidden shadow-sm">
                            <!-- رأس القيد -->
                            <div class="bg-gray-55 border-b p-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-2 bg-gray-50">
                                <div>
                                    <span class="bg-teal-100 text-teal-800 border border-teal-200 px-2 py-0.5 rounded text-xs font-bold font-mono">قيد رقم: #<?php echo $entry['id']; ?></span>
                                    <strong class="text-gray-800 text-sm md:text-base mr-2"><?php echo htmlspecialchars($entry['description']); ?></strong>
                                </div>
                                <div class="text-xs text-gray-500 font-semibold flex items-center gap-3">
                                    <span>📅 التاريخ: <?php echo htmlspecialchars($entry['entry_date']); ?></span>
                                    <span>👤 كاتب القيد: <?php echo htmlspecialchars($entry['admin_name']); ?></span>
                                    <span>⚙️ المصدر: <?php 
                                        $sources = ['attendance' => 'بصمة حضور', 'payment' => 'سداد رسوم', 'expense' => 'سند صرف', 'manual' => 'يدوي'];
                                        echo $sources[$entry['source_type']] ?? $entry['source_type']; 
                                    ?></span>
                                </div>
                            </div>
                            
                            <!-- تفاصيل القيد (دائن ومدين) -->
                            <table class="w-full text-right border-collapse text-xs md:text-sm">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 border-b">
                                        <th class="px-4 py-2 font-bold">الحساب</th>
                                        <th class="px-4 py-2 font-bold text-left">مدين (Debit)</th>
                                        <th class="px-4 py-2 font-bold text-left">دائن (Credit)</th>
                                        <th class="px-4 py-2 font-bold">ملاحظات الحركة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total_debit = 0;
                                    $total_credit = 0;
                                    foreach ($entry['details'] as $detail): 
                                        $total_debit += $detail['debit'];
                                        $total_credit += $detail['credit'];
                                    ?>
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-2.5">
                                                <span class="font-mono font-semibold text-gray-500 mr-1"><?php echo htmlspecialchars($detail['account_code']); ?></span> - 
                                                <strong class="text-gray-800"><?php echo htmlspecialchars($detail['account_name']); ?></strong>
                                            </td>
                                            <td class="px-4 py-2.5 text-left font-bold text-emerald-700"><?php echo $detail['debit'] > 0 ? number_format($detail['debit'], 2) : '-'; ?></td>
                                            <td class="px-4 py-2.5 text-left font-bold text-rose-700"><?php echo $detail['credit'] > 0 ? number_format($detail['credit'], 2) : '-'; ?></td>
                                            <td class="px-4 py-2.5 text-gray-500 italic"><?php echo htmlspecialchars($detail['notes']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- صف توازن القيد -->
                                    <tr class="bg-gray-50 font-bold">
                                        <td class="px-4 py-2.5 text-left">إجمالي القيد المزدوج:</td>
                                        <td class="px-4 py-2.5 text-left border-t border-double text-emerald-800"><?php echo number_format($total_debit, 2); ?></td>
                                        <td class="px-4 py-2.5 text-left border-t border-double text-rose-800"><?php echo number_format($total_credit, 2); ?></td>
                                        <td class="px-4 py-2.5 text-emerald-600 italic">
                                            <?php if (abs($total_debit - $total_credit) < 0.01): ?>
                                                <i class="fa-solid fa-circle-check"></i> متوازن
                                            <?php else: ?>
                                                <span class="text-rose-600"><i class="fa-solid fa-triangle-exclamation"></i> غير متوازن!</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <?php include_once 'footer.php'; ?>
