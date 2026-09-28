import os

base_dir = r"c:\xampp1\htdocs\Sama_College"
for root, dirs, files in os.walk(base_dir):
    # Skip .git and scratch
    if ".git" in root or "scratch" in root:
        continue
    for file in files:
        if file.endswith(".php"):
            path = os.path.join(root, file)
            print(f"PHP File: {path}, Size: {os.path.getsize(path)}")
