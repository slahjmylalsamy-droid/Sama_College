with open("scratch/git_recovered_v2_62.php", "r", encoding="utf-8", errors="ignore") as f:
    lines = f.readlines()

print(f"Total lines: {len(lines)}")
for idx, l in enumerate(lines[:30]):
    print(f"Line {idx+1}: {l[:150].strip()}")
