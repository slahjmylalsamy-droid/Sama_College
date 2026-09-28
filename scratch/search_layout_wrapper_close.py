with open("index.php", "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "layout wrapper check" in line or "layout wrapper" in line:
            print(f"Line {idx+1}: {line.strip()}")
        elif "endif;" in line and idx + 1 > 2800:
            print(f"Line {idx+1}: {line.strip()}")
