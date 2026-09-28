import os
import re
import sys
sys.stdout.reconfigure(encoding='utf-8')

# Search for arabic words like 'إعلانات' or 'أخبار' or 'news' or 'announcements' in the codebase
keywords = ['إعلان', 'أخبار', 'news', 'page', 'اعلان']

# Let's search inside index.php first
with open('index.php', 'r', encoding='utf-8', errors='ignore') as f:
    index_content = f.read()

print("Searching index.php for page variables:")
# find all elseif ($page == '...')
matches = re.findall(r'(\$page\s*==\s*\'[^\']+\')', index_content)
for m in matches:
    print("  ", m)

print("\nSearching index.php for keyword occurrences:")
for kw in keywords:
    pos = [m.start() for m in re.finditer(kw, index_content)]
    if pos:
        print(f"Keyword '{kw}' found {len(pos)} times. Examples:")
        for p in pos[:3]:
            print(f"  ... {index_content[max(0, p-100):min(len(index_content), p+100)]} ...")
