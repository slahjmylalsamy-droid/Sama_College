import sys
sys.stdout.reconfigure(encoding='utf-8')

with open("pages/about.php", "r", encoding="utf-8") as f:
    lines = f.readlines()

for idx in range(754, 768):
    if idx < len(lines):
        print(f"Line {idx+1}: {lines[idx].strip()}")
