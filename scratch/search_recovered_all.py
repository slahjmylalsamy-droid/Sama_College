import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
if os.path.exists(scratch_dir):
    for file in sorted(os.listdir(scratch_dir)):
        if file.startswith("git_recovered_v2_") and file.endswith(".php"):
            path = os.path.join(scratch_dir, file)
            size = os.path.getsize(path)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    content = f.read()
                keywords = []
                for k in ["updateClock", "layout_pages", "complaints", "successModal", "printReceipt"]:
                    if k in content:
                        keywords.append(k)
                print(f"File: {file}, Size: {size} bytes, Keywords: {keywords}")
            except Exception as e:
                print(f"Error reading {file}: {e}")
