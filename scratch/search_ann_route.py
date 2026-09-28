with open('index.php', 'r', encoding='utf-8', errors='ignore') as f:
    content = f.read()

import re
matches = [m.start() for m in re.finditer(r'announcements_public', content)]
print(f"Total matches of 'announcements_public' in index.php: {len(matches)}")
for idx, m in enumerate(matches):
    print(f"Match {idx+1}:")
    print(content[m-100:m+200])
    print("-" * 50)
