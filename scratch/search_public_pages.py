with open("index.php", "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "public_pages" in line:
            print(f"Line {idx+1}: {line.strip()}")
