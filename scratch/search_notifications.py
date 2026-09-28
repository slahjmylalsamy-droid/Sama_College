import os

for root, dirs, files in os.walk("."):
    for fn in files:
        if fn.endswith(".php"):
            if "reconstructed" in fn or "scratch" in fn:
                continue
            fp = os.path.join(root, fn)
            with open(fp, "r", encoding="utf-8", errors="ignore") as f:
                content = f.read()
                if "notifications" in content:
                    print(f"Found notifications in: {fp}")
