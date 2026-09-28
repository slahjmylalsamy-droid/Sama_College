import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
files = [f for f in os.listdir(scratch_dir) if f.startswith("git_recovered_") and f.endswith(".php")]

print(f"Checking {len(files)} files for liveClock...")

for file in files:
    path = os.path.join(scratch_dir, file)
    try:
        with open(path, "r", encoding="utf-8", errors="ignore") as f:
            content = f.read()
        if "liveClock" in content:
            # Check if it starts with <?php or has HTML structure
            is_php = content.strip().startswith("<?php") or "<html>" in content
            print(f"Match: {file}, Size: {len(content)}, Is PHP: {is_php}, First 150 chars: {repr(content[:150])}")
    except Exception as e:
        continue

print("Check completed.")
