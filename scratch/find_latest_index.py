import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
files = [f for f in os.listdir(scratch_dir) if f.startswith("git_recovered_v2_") and f.endswith(".php")]

best_file = None
best_len = 0

for file in files:
    path = os.path.join(scratch_dir, file)
    try:
        with open(path, "r", encoding="utf-8", errors="ignore") as f:
            content = f.read()
        
        # Check for updateClock and layout_pages
        if "updateClock" in content and "layout_pages" in content:
            dup_count = content.count("<!-- مودال التفاصيل الكاملة لآخر الأخبار متطابق مع صفحة الفعاليات -->")
            print(f"File: {file}, Size: {len(content)}, Dup count: {dup_count}")
            
            if dup_count <= 1:
                if len(content) > best_len:
                    best_len = len(content)
                    best_file = file
    except Exception as e:
        continue

print(f"\n---> Best candidate file to restore: {best_file} (Size: {best_len})")
if best_file:
    with open(os.path.join(scratch_dir, best_file), "r", encoding="utf-8", errors="ignore") as src:
        code = src.read()
    with open(r"c:\xampp1\htdocs\Sama_College\index.php", "w", encoding="utf-8") as out:
        out.write(code)
    print("Successfully restored index.php from", best_file)
