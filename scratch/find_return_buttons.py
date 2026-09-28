import os

targets = ["index.php", "index_reconstructed_all.php", "login.php"]
for root, dirs, files in os.walk("pages"):
    for fn in files:
        if fn.endswith(".php"):
            targets.append(os.path.join(root, fn))

with open("scratch/return_buttons_found.txt", "w", encoding="utf-8") as out:
    for fp in targets:
        if not os.path.exists(fp):
            continue
        with open(fp, "r", encoding="utf-8", errors="ignore") as f:
            for idx, line in enumerate(f):
                if "العودة للصفحة الرئيسية" in line or "العودة لصفحة الرئيسية" in line or "العودة للرئيسية" in line:
                    out.write(f"{fp}:{idx+1}:{line.strip()}\n")
