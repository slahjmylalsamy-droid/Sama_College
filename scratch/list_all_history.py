import os

history_dir = r"C:\Users\asus\AppData\Roaming\Antigravity\User\History"
found = []

if os.path.exists(history_dir):
    print("Scanning history directory for 'layout_pages'...")
    for root, dirs, files in os.walk(history_dir):
        for file in files:
            path = os.path.join(root, file)
            try:
                # We check files larger than 10KB
                size = os.path.getsize(path)
                if size > 10000:
                    with open(path, "r", encoding="utf-8", errors="ignore") as f:
                        content = f.read()
                    if "layout_pages" in content:
                        mtime = os.path.getmtime(path)
                        found.append((path, size, mtime))
                        print(f"Match: {path}, Size: {size}, Last Modified: {mtime}")
            except Exception as e:
                continue

print("Completed scan. Found matches:", len(found))
