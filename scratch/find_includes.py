with open("index.php", "r", encoding="utf-8", errors="ignore") as f:
    for idx, line in enumerate(f):
        if "include" in line.lower() or "require" in line.lower():
            if "$" in line or "pages/" in line:
                print(f"Line {idx+1}: {line.strip()}")
