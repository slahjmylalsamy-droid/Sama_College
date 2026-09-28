import os

search_dir = r"c:\xampp1\htdocs\Sama_College"
links = []

for root, dirs, files in os.walk(search_dir):
    if ".system_generated" in root or ".git" in root or "scratch" in root:
        continue
    for file in files:
        if file.endswith(".php"):
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    for line in f:
                        if "instagram.com" in line:
                            links.append((path, line.strip()))
            except:
                continue

for l in links:
    print(f"File: {l[0]}\n  Line: {l[1]}\n")
