import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('pages/events.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

for idx in range(25, min(len(lines), 65)):
    print(f"Line {idx+1}: {lines[idx].strip()}")
