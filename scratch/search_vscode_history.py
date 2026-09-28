import os

history_dir = r"C:\Users\asus\AppData\Roaming\Antigravity\User\History"
print("Searching Antigravity IDE local history at:", history_dir)

found = []

if os.path.exists(history_dir):
    for root, dirs, files in os.walk(history_dir):
        for file in files:
            path = os.path.join(root, file)
            try:
                size = os.path.getsize(path)
                # index.php should be between 240KB and 300KB
                if 240000 <= size <= 300000:
                    with open(path, "r", encoding="utf-8", errors="ignore") as f:
                        content = f.read()
                    if "updateClock" in content and "layout_pages" in content and "$page_titles" in content:
                        mtime = os.path.getmtime(path)
                        found.append((path, size, mtime))
                        print(f"Found candidate: {path}, Size: {size}, Last Modified: {mtime}")
            except Exception as e:
                continue

if found:
    found.sort(key=lambda x: x[2], reverse=True)
    best_path = found[0][0]
    print(f"\nBest backup path (most recent): {best_path}")
    with open(best_path, "r", encoding="utf-8", errors="ignore") as src:
        code = src.read()
    
    with open(r"c:\xampp1\htdocs\Sama_College\index.php", "w", encoding="utf-8") as out:
        out.write(code)
    print("Successfully restored index.php backup from Antigravity IDE Local History!")
else:
    print("No index.php backup found in Antigravity IDE History.")
