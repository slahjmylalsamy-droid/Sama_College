import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
candidates = []

if os.path.exists(scratch_dir):
    for file in os.listdir(scratch_dir):
        if file.startswith("git_recovered_v2_") and file.endswith(".php"):
            path = os.path.join(scratch_dir, file)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    first_chars = f.read(100).strip()
                if first_chars.startswith("<?php"):
                    size = os.path.getsize(path)
                    candidates.append((file, size, first_chars[:50]))
            except Exception as e:
                continue

print(f"Found {len(candidates)} real PHP backups starting with <?php:")
for c in candidates:
    print(f"  File: {c[0]}, Size: {c[1]} bytes, Start: {repr(c[2])}")
