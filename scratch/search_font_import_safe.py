import sys
sys.stdout.reconfigure(encoding='utf-8')

with open("index.php", "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "fonts.google" in line or "cairo" in line.lower():
            print(f"Line {idx+1}: {line.strip()}")
