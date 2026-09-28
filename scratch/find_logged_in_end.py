with open('index.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

for i in range(len(lines) - 50, len(lines)):
    print(f"Line {i+1}: {lines[i].strip()}")
