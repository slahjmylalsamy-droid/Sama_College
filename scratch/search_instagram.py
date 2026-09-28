import os

search_dir = r"c:\xampp1\htdocs\Sama_College"
found = []

for root, dirs, files in os.walk(search_dir):
    if ".system_generated" in root or ".git" in root or "scratch" in root:
        continue
    for file in files:
        if file.endswith(".php") or file.endswith(".js") or file.endswith(".css"):
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    content = f.read()
                if "instagram" in content.lower() or "انستجرام" in content or "انستقرام" in content:
                    found.append(path)
            except:
                continue

print("Files containing Instagram references:")
for f in found:
    print(f)
