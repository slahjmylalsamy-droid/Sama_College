with open("index.php", "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "if (" in line or "if(" in line:
            if any(k in line for k in ["$page", "layout", "enroll"]):
                print(f"Line {idx+1}: {line.strip()}")
