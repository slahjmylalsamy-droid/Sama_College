import os

for root, dirs, files in os.walk("."):
    for fn in files:
        if fn.endswith(".php"):
            if "reconstructed" in fn or "scratch" in fn:
                continue
            fp = os.path.join(root, fn)
            with open(fp, "r", encoding="utf-8", errors="ignore") as f:
                content = f.read()
                if "manage_students" in content or "admin_dashboard" in content:
                    # print matching line numbers
                    f.seek(0)
                    for idx, line in enumerate(f):
                        if "manage_students" in line or "admin_dashboard" in line:
                            print(f"{fp} Line {idx+1}: {line.strip()}")
