with open("admin/dashboard.php", "r", encoding="utf-8", errors="ignore") as f:
    for idx, line in enumerate(f):
        if "notification" in line.lower() or "إشعار" in line or "إشعارات" in line:
            print(f"Line {idx+1}: {line.strip()}")
