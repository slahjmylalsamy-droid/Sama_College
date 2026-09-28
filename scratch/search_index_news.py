with open("index.php", "r", encoding="utf-8") as f:
    lines = f.readlines()

for idx, line in enumerate(lines):
    if "آخر الأخبار" in line or "الخبر" in line or "latest_news" in line or "news.php" in line:
        print(f"Line {idx+1}: {line.strip()[:100]}")
