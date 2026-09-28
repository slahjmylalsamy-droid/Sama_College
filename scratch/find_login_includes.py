with open("index.php", "r", encoding="utf-8", errors="ignore") as f:
    for idx, line in enumerate(f):
        if "login" in line.lower() and ("include" in line or "require" in line or "header" in line):
            print(f"Line {idx+1}: {line.strip()}")
