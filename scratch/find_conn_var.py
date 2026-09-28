import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('index.php', 'r', encoding='utf-8') as f:
    content = f.read()

import re
matches = re.finditer(r'\$conn\s*=', content)
print("Matches for $conn =:")
for m in matches:
    start = max(0, m.start() - 50)
    end = min(len(content), m.end() + 200)
    print(content[start:end])
    print("-" * 50)
