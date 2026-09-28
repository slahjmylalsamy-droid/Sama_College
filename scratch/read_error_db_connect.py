import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('db_connect.php', 'r', encoding='cp1256') as f:
    lines = f.readlines()

start = 100
end = min(len(lines), 140)
for idx in range(start, end):
    print(f"Line {idx+1}: {lines[idx].strip()}")
