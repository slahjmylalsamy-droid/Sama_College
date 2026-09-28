with open("pages/about.php", "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "instagram" in line.lower() or "انستجرام" in line:
            print(f"Line {idx+1}: {line.strip()}")
