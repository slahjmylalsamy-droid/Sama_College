import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('index.php', 'r', encoding='utf-8') as f:
    content = f.read()

import re
matches = [m.start() for m in re.finditer("is_logged_in", content)]
for m in matches:
    start = max(0, m - 100)
    end = min(len(content), m + 200)
    print(f"Match at index {m}:\n{content[start:end]}\n" + "-"*50)
