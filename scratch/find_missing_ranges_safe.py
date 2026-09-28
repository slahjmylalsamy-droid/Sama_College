import os
import sys

# Force UTF-8 encoding for stdout
sys.stdout.reconfigure(encoding='utf-8')

path = r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
with open(path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print(f"Total lines in reconstructed: {len(lines)}")

missing_ranges = []
in_range = False
start = None

for i, line in enumerate(lines):
    line_num = i + 1
    if "MISSING LINE" in line:
        if not in_range:
            in_range = True
            start = line_num
    else:
        if in_range:
            in_range = False
            missing_ranges.append((start, line_num - 1))

if in_range:
    missing_ranges.append((start, len(lines)))

print("Missing ranges:")
for r in missing_ranges:
    print(f"Range: {r[0]} to {r[1]} ({r[1] - r[0] + 1} lines)")
    print("  Before:")
    for j in range(max(1, r[0] - 4), r[0]):
        if j - 1 < len(lines):
            print(f"    {j}: {lines[j-1].rstrip()}")
    print("  After:")
    for j in range(r[1] + 1, min(len(lines) + 1, r[1] + 5)):
        if j - 1 < len(lines):
            print(f"    {j}: {lines[j-1].rstrip()}")
    print("-" * 40)
